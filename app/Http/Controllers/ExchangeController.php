<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Card;
use App\Models\UserCard;
use App\Models\Category;
use App\Models\Collection;
use App\Models\UserCollection;
use stdClass;
use App\Utilities\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Models\UserPrize;
use App\Models\Prize;
use Illuminate\Support\Facades\Log;
use App\Models\Trade;



class ExchangeController extends Controller
{
    public function exchangeBag(Request $request)
    {
        $bagCards = null;
        $totalPages = 0;
        $currentPage = 1;
        $cardsPerPage = config('constants.pagination_cards_per_page');
        $skip = 0;

        if (!is_null($request->params) && array_key_exists("currentPage", $request->params)) {

            $currentPage = $request->params["currentPage"];
            $skip = ($request->params["currentPage"] - 1) * $cardsPerPage;

            $rarity = [];
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

            $bagCards  = DB::table('cards')->select('cards.*', "categories.icon", "users.nickname", "user_cards.*")
                ->join('user_cards', 'cards.id', '=',  'user_cards.card_id')
                ->join('users', 'user_cards.user_id', '=',  'users.id')
                ->join('collections', 'cards.collection_id', '=',  'collections.id')
                ->join('categories', 'collections.category_id', '=',  'categories.id')
                ->where('user_cards.user_id', '!=', Auth::user()->id)
                ->where('user_cards.status', 'exchange');

            if ($request->params["filter"] == "missing") {
                $myCards = UserCard::select("card_id")->where("user_id", Auth::user()->id)->distinct();
                $bagCards->whereNotIn("card_id",  $myCards);
            }

            $bagCards->whereIn("rarity", $rarity);
            $bagCards2 = $bagCards->clone();
            $totalPages = ceil($bagCards2->count() / $cardsPerPage);           

            return response()->json([
                'bagCards' => $bagCards->skip($skip)->take($cardsPerPage)->orderBy("rarity", "DESC")->get(),
                'currentPage' => $currentPage,
                'totalPages' => $totalPages    
            ]);
        } else {
            $bagCards  = DB::table('cards')->select('cards.*', "categories.icon", "users.nickname", "user_cards.id")
                ->join('user_cards', 'cards.id', '=',  'user_cards.card_id')
                ->join('users', 'user_cards.user_id', '=',  'users.id')
                ->join('collections', 'cards.collection_id', '=',  'collections.id')
                ->join('categories', 'collections.category_id', '=',  'categories.id')
                ->where('user_cards.user_id', '!=', Auth::user()->id)
                ->where('user_cards.status', 'exchange');

            $totalPages = ceil($bagCards->count() / $cardsPerPage);

            return Inertia::render('Exchange/Bag', [
                'bagCards' => $bagCards->skip($skip)->take($cardsPerPage)->orderBy("rarity", "DESC")->get(),
                'currentPage' => $currentPage,
                'totalPages' => $totalPages
            ]);
        }      
    }

    // public function getExchangeCards($filter)
    // {

    //     if ($filter == "missing") {
    //         $myCards = UserCard::select("card_id")->where("user_id", Auth::user()->id);
    //         $bagCards = UserCard::where("user_id", "!=", Auth::user()->id)->where("status", "exchange")->whereNotIn("card_id",  $myCards)->get();

    //         return response()->json([
    //             'bagCards' => $bagCards->load(["card.collection.category", "user"]),
    //         ]);
    //     } else {
    //         $bagCards = UserCard::where("user_id", "!=", Auth::user()->id)->where("status", "exchange")->get();
    //         return response()->json([
    //             'bagCards' => $bagCards->load(["card.collection.category", "user"]),
    //         ]);
    //     }
    // }


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
                //}
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
        $user->gold += $goldObtained;
        $user->save();
        $userCard->status = "sold";
        $userCard->save();

        /*
        $log = new Log;
        $log->user_id = $user->id;
        $log->event = "Sell Card";
        $log->message = "👤 " . $user->nickname . " ha vendido carta, rareza " . $card->rarity;
        $log->data = '{"cardId" : "' . $card->id . '", "goldObtained" : "' . $goldObtained . '"}';
        $log->save();
        */

        $userCard->delete();

        //return response()->noContent();


        //$userCards = UserCard::where("user_id", Auth::user()->id)->get(); 

        return response()->json([
            'goldObtained' => $goldObtained,
            //'userCards' => $userCards->load("card.collection.category"),
            //'cardExist' => $checkCard->count(),
        ]);
    }



    public function getAvailableCards($ownerCardId)
    {
        $ownerCard = UserCard::find($ownerCardId);
        $wantedCard = $ownerCard->card;
       

        $owner = $ownerCard->user;

        $ownerCards = DB::table('user_cards')
            ->join('cards', 'user_cards.card_id', '=',  'cards.id')
            ->where('user_cards.user_id', '=', $owner->id)
            ->where('user_cards.status', '!=', 'sold')->distinct()->pluck('cards.id');

        $excludeTrades = DB::table('user_cards')
            ->join('trades', 'user_cards.id', '=',  'trades.player_card_id')
            ->where('user_cards.user_id', '=', Auth::id())
            ->where('trades.status', '=', 'offered')->pluck('user_cards.id');       

          $availableCardsIds = DB::table('user_cards')
            ->select("user_cards.id")
            ->join('cards', 'user_cards.card_id', '=',  'cards.id')
            ->where("user_id", Auth::user()->id)
            ->where("status", "exchange")
            ->where("cards.rarity", $wantedCard->rarity)
            ->whereNotIn("cards.id",  $excludeTrades)
            ->where("cards.id", "!=", $wantedCard->id)->pluck('user_cards.id');

           // dd($availableCardsIds);
           

            $availableCards = UserCard::whereIn("id",  $availableCardsIds)
            ->get()->load("card.collection.category");
                 //dd($availableCards);


        // $availableCards =  $availableCards->filter(function ($userCard) use ($rarity) {

        //     if ($userCard->card->rarity == $rarity) {
        //         return $userCard;
        //     }
        // });

        return response()->json([
            'availableCards' => $availableCards,
            'ownerCards' => $ownerCards,
        ]);
    }

    public function changeStatusUserCard($userCardId, $statusToChange, Request $request)
    {
        //dd($request->request);

        $userCard = UserCard::find($userCardId);
        $userCard->status = $statusToChange;
        $userCard->save();

        /*
        $log = new Log;
        $log->user_id = $user->id;
        $log->event = "Sell Card";
        $log->message = "👤 " . $user->nickname . " ha vendido carta, rareza " . $card->rarity;
        $log->data = '{"cardId" : "' . $card->id . '", "goldObtained" : "' . $goldObtained . '"}';
        $log->save();
        */

        return response()->noContent();

        $userCards = UserCard::where("user_id", Auth::user()->id)->get();

        return response()->json([

            'userCards' => $userCards->load("card.collection.category"),
            //'cardExist' => $checkCard->count(),
        ]);
    }

    public function filterUserCards(Request $request)
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

        $availableUserCards = UserCard::where('user_id', Auth::user()->id)->whereIn('status', ['obtained', 'exchange', 'protected'])->get();
        $pastedUserCards = UserCard::where('user_id', Auth::user()->id)->where('status', 'pasted')->get();

        return Inertia::render('Album/Page', [

            'collection' => $collection->load(["cards", "category", "user"]),
            'availableUserCards' => $availableUserCards->load("card")->pluck('card.id'),
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

        return response()->noContent();
    }



    public function refreshAlbumPage($collectionId)
    {
        $collection = Collection::find($collectionId);

        $availableUserCards = UserCard::where('user_id', Auth::user()->id)->whereIn('status', ['obtained', 'exchange'])->get();
        $pastedUserCards = UserCard::where('user_id', Auth::user()->id)->where('status', 'pasted')->get();

        return response()->json([

            'collection' => $collection->load(["cards", "category", "user"]),
            'availableUserCards' => $availableUserCards->load("card")->pluck('card.id'),
            'pastedUserCards' => $pastedUserCards->load("card")->pluck('card.id'),
        ]);
    }


    public function createTrade($ownerCardId, $playerCardId)
    {
        $trade = new Trade;
        $trade->owner_card_id = $ownerCardId;
        $trade->player_card_id = $playerCardId;
        $trade->save();

        return response()->json([
            'algo' => "ffg"
        ]);
    }


    public function incomingExchanges()
    {
        $myCards = UserCard::select("id")->where("user_id", Auth::user()->id)->where("status", "exchange");
        $incomingExchanges = Trade::where("status", "offered")->whereIn("owner_card_id", $myCards)->get()->load("ownercard.card.collection.category", "ownercard.user",  "playercard.card.collection.category", "playercard.user",);

        return Inertia::render('Exchange/Incoming', [
            'incomingExchanges' => $incomingExchanges,
        ]);
    }

    public function outgoingExchanges()
    {
        $myCards = UserCard::select("id")->where("user_id", Auth::user()->id)->where("status", "exchange");
        $outgoingExchanges = Trade::where("status", "offered")->whereIn("player_card_id", $myCards)->get()->load("ownercard.card.collection.category", "playercard.card.collection.category");

        return Inertia::render('Exchange/Outgoing', [
            'outgoingExchanges' => $outgoingExchanges,
        ]);
    }

    public function acceptExchange($tradeId)
    {

        $trade = Trade::find($tradeId);
        $ownerUserCard = UserCard::find($trade->owner_card_id);
        $playerUserCard = UserCard::find($trade->player_card_id);

        $userIdTemp = $ownerUserCard->user_id;

        $ownerUserCard->user_id = $playerUserCard->user_id;
        $ownerUserCard->status = "protected";
        $ownerUserCard->save();

        $playerUserCard->user_id = $userIdTemp;
        $playerUserCard->status = "protected";
        $playerUserCard->save();

        $trade->status = "accepted";
        $trade->save();

        //looking for all trades with the involved cards and delete them

        $ownerUserCardTrades = Trade::whereIn('owner_card_id', [$ownerUserCard->id, $playerUserCard->id])
            ->where('status', '=', "offered")
            ->get();

        foreach ($ownerUserCardTrades as $trade) {
            $trade->status = "deleted";
            $trade->save();
            $trade->delete();
        }

        $playerUserCardTrades = Trade::whereIn('player_card_id', [$ownerUserCard->id, $playerUserCard->id])
            ->where('status', '=', "offered")
            ->get();

        foreach ($playerUserCardTrades as $trade) {
            $trade->status = "deleted";
            $trade->save();
            $trade->delete();
        }

        $myCards = UserCard::select("id")->where("user_id", Auth::user()->id)->where("status", "exchange");
        $incomingExchanges = Trade::where("status", "offered")->whereIn("owner_card_id", $myCards)->get()->load("ownercard.card.collection.category", "ownercard.user",  "playercard.card.collection.category", "playercard.user",);

        $user = User::find(Auth::user()->id);
        $userData = json_decode($user->data);
        $userData->exchanges_accepted = $userData->exchanges_accepted + 1;

        //check exchanges accepted prize
        if ($userData->exchanges_accepted  % config('constants.exchanges_accepted_interval') == 0) {

            $prizeExchangesAccepted = Prize::where("type", "exchanges accepted")->first();
            $prizeIcon = "";
            $prizeType = "";

            if ($userData->exchanges_accepted  % config('constants.exchanges_accepted_milestone') == 0) {
                $prizeIcon = $prizeExchangesAccepted->icon_milestone;
                $prizeType = "milestone";
            } else {
                $prizeIcon = $prizeExchangesAccepted->icon_interval;
                $prizeType = "interval";
            }

            //create new prize for the user
            $userPrize = new UserPrize;
            $userPrize->user_id = $user->id;
            $userPrize->prize_id = $prizeExchangesAccepted->id;
            $userPrize->icon = $prizeIcon;
            $userPrize->type = $prizeType;
            $userPrize->quantity = $userData->exchanges_accepted;
            $userPrize->redeemed = false;
            $userPrize->save();
        }

        $user->data = json_encode($userData);
        $user->save();

        return response()->json([
            'incomingExchanges' => $incomingExchanges
        ]);

        /*
            $log = new Log;
            $log->user_id = $userOwner->id;
            $log->event = "Accept Trade";
            $log->message = "👤 " . $userOwner->nickname . " ha aceptado un intercambio, " . $ownerCard->name . " (" . $ownerCard->rarity . "★) por " . $playerCard->name  . " (" . $playerCard->rarity . "★)";
            $log->data = '{"ownerCardId" : "' . $ownerCard->id . '", "playerCardId" : "' . $playerCard->id . '"}';
            $log->save();
      */
    }



    public function rejectExchange($tradeId)
    {
        $trade = Trade::find($tradeId);
        $trade->status = "rejected";
        $trade->save();

        $myCards = UserCard::select("id")->where("user_id", Auth::user()->id)->where("status", "exchange");
        $incomingExchanges = Trade::where("status", "offered")->whereIn("owner_card_id", $myCards)->get()->load("ownercard.card.collection.category", "ownercard.user",  "playercard.card.collection.category", "playercard.user",);


        return response()->json([

            'incomingExchanges' => $incomingExchanges
        ]);

        /*

        $user = User::find(Auth::id());

        $log = new Log;
        $log->user_id = $user->id;
        $log->event = "Reject Trade";
        $log->message = "👤 " . $user->nickname . " ha rechazado un intercambio";
        $log->data = '{"tradeId" : "' . $tradeId . '"}';
        $log->save();
        */
    }
}
