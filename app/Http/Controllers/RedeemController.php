<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Card;
use App\Models\UserCard;
use stdClass;
use App\Utilities\Helper;
use Illuminate\Support\Facades\Log;
use App\Models\Avatar;
use App\Models\UserAvatar;
use App\Models\UserPrize;
use App\Models\Prize;

class RedeemController extends Controller
{
    public function redeemTickets()
    {
        return Inertia::render('Redeem/Ticket', []);
    }

    public function redeemBoxes()
    {
        return Inertia::render('Redeem/Box', []);
    }

    public function redeemBox()
    {
        $user = User::find(Auth::user()->id);
        $userData = json_decode($user->data);

        if ($user->boxes > 0) {

            $tickets = rand(5, 15);
            $gold = rand(100, 5000) * 10;
            $avatar = rand(1, 10);
            $randomAvatar = null;

            if ($avatar > 5) {
                //obtener un avatar random y crearlo para el usuario

                $randomAvatar = Avatar::select("*")
                    ->inRandomOrder()
                    ->first();

                $userAvatar =  new UserAvatar();
                $userAvatar->user_id = Auth::id();
                $userAvatar->avatar_id = $randomAvatar->id;
                $userAvatar->save();
                $userData->avatars_obtained = $userData->avatars_obtained + 1;
            }

            $userData->boxes_obtained = $userData->boxes_obtained + 1;
            $userData->gold_obtained = $userData->gold_obtained + $gold;

            //check boxes redeemed prize
            if ($userData->boxes_obtained  % config('constants.boxes_redeemed_interval') == 0) {

                $prizeBoxesRedeemed = Prize::where("type", "boxes redeemed")->first();
                $prizeIcon = "";
                $prizeType = "";

                if ($userData->boxes_obtained  % config('constants.boxes_redeemed_milestone') == 0) {
                    $prizeIcon = $prizeBoxesRedeemed->icon_milestone;
                    $prizeType = "milestone";
                } else {
                    $prizeIcon = $prizeBoxesRedeemed->icon_interval;
                    $prizeType = "interval";
                }

                //create new prize for the user
                $userPrize = new UserPrize;
                $userPrize->user_id = $user->id;
                $userPrize->prize_id = $prizeBoxesRedeemed->id;
                $userPrize->icon = $prizeIcon;
                $userPrize->type = $prizeType;
                $userPrize->quantity = $userData->boxes_obtained;
                $userPrize->redeemed = false;
                $userPrize->save();
            }

            $user->data = json_encode($userData);
            $user->boxes--;
            $user->tickets = $user->tickets + $tickets;
            $user->gold = $user->gold + $gold;
            $user->save();

            /*
            $log = new Log;
            $log->user_id = $user->id;
            $log->event = "Redeem Daily Box";
            $log->message = "👤 " . $user->nickname . " ha reclamado caja, tickets " . $tickets . ", oro " . $gold . ", avatars " . $obtainedAvatars;
            $log->data = '{"tickets" : "' . $tickets . '", "oro" : "' . $gold . '","avatars" : "' . $obtainedAvatars . '"}';         
            $log->save();
            */

            $obtainedBox = new stdClass();
            $obtainedBox->tickets = $tickets;
            $obtainedBox->avatar = $randomAvatar;
            $obtainedBox->gold = $gold;

            return response()->json([
                'obtainedBox' => $obtainedBox,
            ]);
        } else {
            return response()->json([
                'error' => "Not enough boxes!"
            ]);
        }
    }


    public function redeemCards($quantity)
    {
        $user = User::find(Auth::user()->id);
        $userData = json_decode($user->data);

        if ($user->tickets >= $quantity) {

            $obtainedCards = [];

            for ($i = 1; $i <= $quantity; $i++) {

                $userCard = new UserCard;
                $rarity = Helper::getRandomWeightedElement();
                $status = "";
                $user->tickets--;

                $randomCard = Card::all()->where('rarity', '=', $rarity)->random();

                $userCard->user_id = $user->id;
                $userCard->card_id = $randomCard->id;
                $userCard->save();

                //check if card is already in collection

                $checkCard = UserCard::where('user_id', '=', Auth::id())
                    ->where('card_id', '=', $randomCard->id)
                    ->where('id', '!=', $userCard->id)
                    ->get();

                if ($checkCard->count() == 0) {
                    $status = "protected";
                } else {
                    $status = "exchange";
                }

                $userCard->status = $status;
                $userCard->save();

                $obtainedCard = new stdClass();
                $obtainedCard->randomCard = $randomCard->load("collection.category");
                $obtainedCard->exists =  $checkCard->count() == 0 ? false : true;
                array_push($obtainedCards, $obtainedCard);

                $userData->cards_obtained++;

                //check obtained cards prize
                if ($userData->cards_obtained  % config('constants.cards_obtained_interval') == 0) {

                    $prizeCardsObtained = Prize::where("type", "cards obtained")->first();
                    $prizeIcon = "";
                    $prizeType = "";

                    if ($userData->cards_obtained  % config('constants.cards_obtained_milestone') == 0) {
                        $prizeIcon = $prizeCardsObtained->icon_milestone;
                        $prizeType = "milestone";
                    } else {
                        $prizeIcon = $prizeCardsObtained->icon_interval;
                        $prizeType = "interval";
                    }

                    //create new prize for the user
                    $userPrize = new UserPrize;
                    $userPrize->user_id = $user->id;
                    $userPrize->prize_id = $prizeCardsObtained->id;
                    $userPrize->icon = $prizeIcon;
                    $userPrize->type = $prizeType;
                    $userPrize->quantity = $userData->cards_obtained;
                    $userPrize->redeemed = false;
                    $userPrize->save();
                }
            }

            //$userData = json_decode($user->data);

            $user->data = json_encode($userData);
            $user->save();

            return response()->json([
                'tickets' => $user->tickets,
                'obtainedCards' => $obtainedCards,
                'cardExist' => $checkCard->count(),

            ]);
        } else {
            return response()->json([
                'error' => "Not enough tickets!"
            ]);
        }
    }


    public function redeemGold()
    {
        return Inertia::render('Redeem/Gold', []);
    }

    public function buyTickets($quantity)
    {
        $user = User::find(Auth::user()->id);

        if ($user->gold >= $quantity * 10000) {

            $user->tickets = $user->tickets + $quantity;
            $user->gold = $user->gold - $quantity * 10000;
            $user->save();


            return response()->json([
                'gold' => $user->gold,
                'tickets' => $user->tickets,
            ]);
        } else {
            return response()->json([
                'error' => "Not enough gold!"
            ]);
        }
    }


    public function redeemPrizes($prizeId)
    {
        $user = User::find(Auth::user()->id);

        $userPrize = UserPrize::find($prizeId);
        if ($userPrize->type == "milestone") {
            $ticketsObtained = config('constants.prize_milestone');
        } else {
            $ticketsObtained = config('constants.prize_interval');
        }

        $user->tickets = $user->tickets + $ticketsObtained;
        $user->save();

        $userPrize->redeemed = true;
        $userPrize->save();

        return response()->json([
            'ticketsObtained' => $ticketsObtained,
        ]);
    }
}
