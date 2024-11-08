<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Card;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CardRequest;
use App\Models\CardTag;
use Carbon;
use Illuminate\Support\Facades\Storage;
use App\Services\CardService;


class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Auth::user()->userCan("locomotoras ver");

        return Inertia::render('Card/Index', [
            'cards' => Card::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($collectionId)
    {
        return Inertia::render('Card/Create', [
            'collectionId' => $collectionId,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CardRequest $request)
    {

        $card = Card::create($request->validated());

        if ($request->image != null) {
            $path = Storage::disk('public')->put('cards', $request->image);
            $card->image = $path;
            $card->save();
        }

        return Redirect::route('manageCards', $request->collection_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //Auth::user()->userCan("locomotoras ver");

        $card = Card::find($id);

        if ($request->wantsJson()) {
            return response()->json([
                'selectedCard' => $card,
            ]);
        }

        return Inertia::render('Card/Show', [
            'card' => $card,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cardId)
    {

        $card = Card::find($cardId);

        $topFilters = config('constants.top_filters');
        $bottomFilters = config('constants.bottom_filters');


        return Inertia::render('Card/Edit', [
            'card' => $card,
            'topFilters' => $topFilters,
            'bottomFilters' => $bottomFilters,
        ]);
    }


    public function update(CardRequest $request, Card $card)
    {
        $card->update($request->validated());
        $previousImage = $card->image;

        if ($request->image != null) {

            $path = Storage::disk('public')->put('cards', $request->image);
            $card->image = $path;
            $card->save();

            if (!is_null($previousImage)) {
                Storage::disk('public')->delete($previousImage);
            }
        }

        return Redirect::route('manageCards', $request->collection_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $card = Card::find($id);
        $card->delete();

        return Redirect::route('cards.index');
    }

    public function setRarity(Request $request)
    {
        $cardService = new CardService();
        $cardService->setRarity($request);


        return response()->json([
            'cards' => Card::all(),
        ]);
    }

    public function setVisualFilter(Request $request)
    {
        //dd($request->request);

        $card = Card::find($request->cardId);
        $card->visual_filter = $request->filter;
        $card->save();

        return response()->json([
            'cards' => Card::all(),
        ]);
    }

    public function getRandomCards($numberOfPlayers)
    {
        $cards = Card::inRandomOrder()->limit($numberOfPlayers)->get();

        return response()->json([
            'cards' => $cards,
        ]);
    }

    public function setFilter($type, $filter, $cardId)
    {
        $card = Card::find($cardId);

        if ($type == "top") {
            $card->top_filter = $filter;
        } else {
            $card->bottom_filter = $filter;
        }
        $card->save();
        return response()->noContent();
    }
}
