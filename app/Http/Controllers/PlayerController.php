<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Card;
use App\Models\UserCard;
use App\Models\Category;
use App\Models\Collection;
use App\Models\UserCollection;
use App\Models\Prize;
use App\Models\UserPrize;
use stdClass;
use App\Utilities\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Trade;
use App\Models\UserAvatar;

class PlayerController extends Controller
{

    public function playerProfile()
    {
        $user = User::find(Auth::user()->id);
        $userPrizes = UserPrize::where("user_id", $user->id)->orderBy('created_at', 'DESC')->get();

        return Inertia::render('Player/PlayerProfile', [
            'user' => $user,
            'userPrizes' => $userPrizes->load("prize"),
        ]);
    }


    public function playerCards()
    {

        $cardsPerPage = config('constants.pagination_cards_per_page');

        $totalCards =   $userCards  = DB::table('cards')
            ->join('user_cards', 'cards.id', '=',  'user_cards.card_id')
            ->where('user_cards.user_id', '=', Auth::user()->id)
            ->where('user_cards.status', '!=', 'sold')->get();


        $userCards  = DB::table('cards')
            ->join('user_cards', 'cards.id', '=',  'user_cards.card_id')
            ->where('user_cards.user_id', '=', Auth::user()->id)
            ->where('user_cards.status', '!=', 'sold')->orderBy("rarity", "DESC")->take($cardsPerPage)->get();

        $totalPages = ceil(count($totalCards) / $cardsPerPage);

        return Inertia::render('Player/PlayerCards', [
            'userCards' => $userCards,
            'currentPage' => 1,
            'totalPages' => $totalPages
        ]);
    }


    public function filterPlayerCards(Request $request)
    {
        $cardsPerPage = config('constants.pagination_cards_per_page');
        $skip = ($request->params["currentPage"] - 1) * $cardsPerPage;

        $rarity =  [];
        if ($request->params["star1"] == true) {
            array_push($rarity, 1);
        }
        if ($request->params["star2"] == true) {
            array_push($rarity, 2);
        }
        if ($request->params["star3"] == true) {
            array_push($rarity, 3);
        }
        if ($request->params["star4"] == true) {
            array_push($rarity, 4);
        }
        if ($request->params["star5"] == true) {
            array_push($rarity, 5);
        }

        $totalCards =   $userCards  = DB::table('cards')
            ->join('user_cards', 'cards.id', '=',  'user_cards.card_id')
            ->where('user_cards.user_id', '=', Auth::user()->id)
            ->where('user_cards.status', '!=', 'sold')
            ->whereIn("rarity", $rarity)->get();


        $userCards  = DB::table('cards')
            ->join('user_cards', 'cards.id', '=',  'user_cards.card_id')
            ->where('user_cards.user_id', '=', Auth::user()->id)
            ->where('user_cards.status', '!=', 'sold');

        $totalPages = ceil(count($totalCards) /  $cardsPerPage);

        $userCards->whereIn("rarity", $rarity);
        $userCards->skip($skip)->take($cardsPerPage);

        return response()->json([
            'userCards' => $userCards->orderBy('rarity', 'desc')->get(),
            'currentPage' => $request->params["currentPage"],
            'totalPages' => $totalPages

        ]);
    }


    public function redeemCards($quantity)
    {

        $user = User::find(Auth::user()->id);

        if ($user->tickets >= $quantity) {

            $obtainedCards = [];

            for ($i = 1; $i <= $quantity; $i++) {

                $userCard = new UserCard;
                $rarity = Helper::getRandomWeightedElement();

                $status = "";

                $user->tickets--;
                $user->save();

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
                    $status = "obtained";
                }

                $userCard->status = $status;
                $userCard->save();

                /*
            $log = new Log;
            $log->user_id = $user->id;
            $log->event = "Redeem Ticket";
            $log->message = "👤 " . $user->nickname . " ha obtenido carta por ticket, " . $randomCard->name . " " . $randomCard->rarity . "★";
            $log->data = '{"cardId" : "' . $randomCard->id . '"}';
            $log->save();
            */

                $obtainedCard = new stdClass();
                $obtainedCard->randomCard = $randomCard->load("collection.category");
                $obtainedCard->exists =  $checkCard->count() == 0 ? false : true;

                array_push($obtainedCards, $obtainedCard);
            }


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


    public function sellUserCard($userCardId)
    {
        $userCard = UserCard::find($userCardId);
        $card = Card::find($userCard->card_id);
        $bottomLimit = $card->cost * 25 / 100;
        $topLimit = $card->cost * 75 / 100;
        $goldObtained = rand($bottomLimit, $topLimit);
        $user = User::find(Auth::id());

        $userData = json_decode($user->data);
        $userData->gold_obtained = $userData->gold_obtained + $goldObtained;
        $user->data = json_encode($userData);

        $user->gold += $goldObtained;
        $user->save();
        $userCard->status = "sold";
        $userCard->save();

        $trades = Trade::where("owner_card_id", $userCard->id)->orWhere("player_card_id", $userCard->id);
        $trades->delete();
        $userCard->delete();

        return response()->json([
            'goldObtained' => $goldObtained,
        ]);
    }


    public function sellCardsByStatus($status)
    {
        $userCards = UserCard::where('user_id', Auth::user()->id)->where('status', $status)->get();

        $userCards->load("card");

        $goldObtained = 0;

        foreach ($userCards as $userCard) {

            $bottomLimit = $userCard->card->cost * 25 / 100;
            $topLimit = $userCard->card->cost * 75 / 100;
            $goldObtained = $goldObtained + rand($bottomLimit, $topLimit);

            $userCard->status = "sold";
            $userCard->save();

            $trades = Trade::where("owner_card_id", $userCard->id)->orWhere("player_card_id", $userCard->id);
            $trades->delete();

            $userCard->delete();
        }

        $user = User::find(Auth::id());
        $userData = json_decode($user->data);
        $userData->gold_obtained = $userData->gold_obtained + $goldObtained;
        $user->data = json_encode($userData);

        $user->gold += $goldObtained;
        $user->save();

        $userCards = UserCard::where("user_id", Auth::user()->id)->whereIn("status", ["exchange", "protected"])->get();

        return response()->json([
            'goldObtained' => $goldObtained,
            'userCards' => $userCards->load("card.collection.category"),

        ]);
    }

    public function changeStatusUserCard($userCardId, $statusToChange)
    {
        $userCard = UserCard::find($userCardId);
        $userCard->status = $statusToChange;
        $userCard->save();

        if ($statusToChange != "exchange") {
            $trades = Trade::where("owner_card_id", $userCard->id)->orWhere("player_card_id", $userCard->id);
            $trades->delete();
        }

        return response()->noContent();
    }

    public function filterUserCardsa(Request $request)
    {
        $status = array();
        if ($request->params["exchange"] == true) {
            array_push($status, "exchange");
        }
        if ($request->params["protected"] == true) {
            array_push($status, "protected");
        }
        if ($request->params["pasted"] == true) {
            array_push($status, "pasted");
        }

        $userCards = UserCard::where("user_id", Auth::user()->id)->whereIn('status', $status)->get();

        return response()->json([

            'userCards' => $userCards->load("card.collection.category"),
            //'cardExist' => $checkCard->count(),
        ]);
    }


    public function albumIndex()
    {

        $userCollections =  UserCollection::where('user_id', Auth::user()->id)->get();
        $availableUserCards = UserCard::where('user_id', Auth::user()->id)->whereIn('status', ['obtained', 'exchange', 'protected'])->get();
        $pastedUserCards = UserCard::where('user_id', Auth::user()->id)->where('status', 'pasted')->get();

        return Inertia::render('Album/Index', [
            'categories' => Category::orderBy('name')->get(),
            'userCollections' => $userCollections->load(["collection.category", "collection.cards", "collection.user"]),
            'availableUserCards' => $availableUserCards->load("card")->pluck('card.id'),
            'pastedUserCards' => $pastedUserCards->load("card")->pluck('card.id'),
        ]);
    }

    public function albumPage($collectionId)
    {
        $collection = Collection::find($collectionId);
        $collectionCards = $collection->cards->pluck('id');
        $pastedUserCards = UserCard::where('user_id', Auth::user()->id)->where('status', 'pasted')->whereIn('card_id', $collectionCards)->get();
        $pastedUserCardsArray = $pastedUserCards->pluck('card_id');
        $availableUserCards = UserCard::where('user_id', Auth::user()->id)->whereNotIn('card_id', $pastedUserCardsArray)->whereIn('card_id', $collectionCards)->whereIn('status', ['protected'])->get();
        $availableUserCards = $availableUserCards->load("card")->unique('card.id')->sortBy('card.id')->pluck('card.id');

        return Inertia::render('Album/Page', [

            'collection' => $collection->load(["cards", "category", "user"]),
            'availableUserCards' => $availableUserCards,
            'pastedUserCards' => $pastedUserCards->load("card")->pluck('card.id'),

        ]);
    }

    public function pasteCard($cardId)
    {
        $userCard = UserCard::where('user_id', '=', Auth::user()->id)
            ->where('card_id', '=', $cardId)
            ->first();
        $userCard->status = "pasted";
        $userCard->save();

        $user = User::find(Auth::user()->id);
        $userData = json_decode($user->data);
        $userData->cards_pasted = $userData->cards_pasted + 1;

        if ($userData->cards_pasted  % config('constants.cards_pasted_interval') == 0) {

            $prizeCardsPasted = Prize::where("type", "cards pasted")->first();
            $prizeIcon = "";
            $prizeType = "";

            if ($userData->cards_pasted  % config('constants.cards_pasted_milestone') == 0) {
                $prizeIcon = $prizeCardsPasted->icon_milestone;
                $prizeType = "milestone";
            } else {
                $prizeIcon = $prizeCardsPasted->icon_interval;
                $prizeType = "interval";
            }

            //create new prize for the user
            $userPrize = new UserPrize;
            $userPrize->user_id = $user->id;
            $userPrize->prize_id = $prizeCardsPasted->id;
            $userPrize->icon = $prizeIcon;
            $userPrize->type = $prizeType;
            $userPrize->quantity = $userData->cards_pasted;
            $userPrize->redeemed = false;
            $userPrize->save();
        }

        $user->data = json_encode($userData);
        $user->save();

        return response()->noContent();
    }

    public function refreshAlbumPage($collectionId)
    {
        $collection = Collection::find($collectionId);
        $collectionCards = $collection->cards->pluck('id');
        $pastedUserCards = UserCard::where('user_id', Auth::user()->id)->where('status', 'pasted')->whereIn('card_id', $collectionCards)->get();
        $pastedUserCardsArray = $pastedUserCards->pluck('card_id');
        $availableUserCards = UserCard::where('user_id', Auth::user()->id)->whereNotIn('card_id', $pastedUserCardsArray)->whereIn('card_id', $collectionCards)->whereIn('status', ['protected'])->get();
        $availableUserCards = $availableUserCards->load("card")->unique('card.id')->sortBy('card.id')->pluck('card.id');

        return response()->json([

            'collection' => $collection->load(["cards", "category", "user"]),
            'availableUserCards' => $availableUserCards,
            'pastedUserCards' => $pastedUserCards->load("card")->pluck('card.id'),
        ]);
    }


    public function playerAvatars()
    {
        $userAvatars = UserAvatar::where("user_id", Auth::user()->id)->get();

        return Inertia::render('Player/PlayerAvatars', [
            'userAvatars' => $userAvatars->load(["avatar"]),
        ]);
    }


    public function selectAvatar($userAvatarId)
    {
        $userAvatar = UserAvatar::find($userAvatarId);
        $avatar = Avatar::find($userAvatar->avatar_id);

        $user = User::find(Auth::id());
        $user->avatar = $avatar->image;
        $user->save();

        return response()->json([

            'avatar' => $avatar->image
        ]);
    }



    public function sellUserAvatar($userAvatarId)
    {
        $userAvatar = UserAvatar::find($userAvatarId);

        $goldObtained = 10000;
        $user = User::find(Auth::id());
        $user->gold += $goldObtained;
        $user->save();
        $userAvatar->status = "sold";
        $userAvatar->save();

        $user = User::find(Auth::user()->id);
        $userData = json_decode($user->data);
        $userData->gold_obtained = $userData->gold_obtained + $goldObtained;
        $user->data = json_encode($userData);
        $user->save();

        /*
        $log = new Log;
        $log->user_id = $user->id;
        $log->event = "Sell Card";
        $log->message = "👤 " . $user->nickname . " ha vendido carta, rareza " . $card->rarity;
        $log->data = '{"cardId" : "' . $card->id . '", "goldObtained" : "' . $goldObtained . '"}';
        $log->save();
        */

        $userAvatar->delete();

        return response()->json([
            'goldObtained' => $goldObtained,
        ]);
    }


    public function players()
    {

        $users = User::all();

        return Inertia::render('Player/Players', [
            'players' => $users,
        ]);
    }
}
