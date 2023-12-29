<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Collection;
use App\Models\Category;
use App\Models\Log;
use App\Models\Card;
use App\Models\UserCollection;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CollectionRequest;
use stdClass;
use Illuminate\Support\Facades\File;
use Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $collections = Collection::where('user_id', Auth::user()->id)->get();

        return Inertia::render('Collection/Index', [
            'collections' => $collections->load(['category', 'cards']),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Collection/Create', [
            'categories' => Category::all(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CollectionRequest $request)
    {

        $collection = Collection::create($request->validated());      
        Storage::makeDirectory("/public/collections/{$collection->id}");
        return Redirect::route('collections.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //Auth::user()->userAdmin();

        $category = Collection::find($id);

        if ($request->wantsJson()) {
            return response()->json([
                'selectedCollection' => $category,
            ]);
        }

        return Inertia::render('Collection/Show', [
            'record' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Auth::user()->userAdmin();

        return Inertia::render('Collection/Edit', [
            'record' => Collection::find($id),
        ]);
    }


    public function update(CollectionRequest $request, Collection $category)
    {
        Auth::user()->userAdmin();

        $category->update($request->validated());


        $log = new Log;
        $log->user_id = Auth::user()->id;
        $log->event = "editar locomotora";
        $log->message = Auth::user()->name . " (ID " . Auth::user()->id . ") ha editado locomotora " . $category->name . " (ID " . $category->id . ")";
        $log->save();

        return Redirect::route('collections.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::user()->userAdmin();

        $category = Collection::find($id);
        $category->delete();

        $log = new Log;
        $log->user_id = Auth::user()->id;
        $log->event = "eliminar locomotora";
        $log->message = Auth::user()->name . " (ID " . Auth::user()->id . ") ha eliminado locomotora " . $category->name . " (ID " . $category->id . ")";
        $log->save();

        return Redirect::route('collections.index');
    }


    public function addCards($collectionId)
    {

        $collection = Collection::find($collectionId);
        $cards = Card::where('collection_id', $collectionId)->orderby("order")->get();

        return Inertia::render('Collection/AddCard', [
            'cards' => $cards,
            'collection' => $collection,
        ]);
    }

    public function addNewCard(Request $request)
    {

        $maxOrder = Card::where('collection_id', $request->collectionId)->max('order');
        $card = new Card();
        $card->collection_id = $request->collectionId;
        $card->name = $request->cardName;
        $card->image = $request->cardImage;
        $card->order = $maxOrder + 1;
        $card->save();

        $cards = Card::where('collection_id', $request->collectionId)->orderby("order")->get();

        return back();

        return Inertia::render('Collection/AddCard', [
            'cards' => $cards,
            'collection' => $request->collectionId,
        ]);


       


        return response()->json([
            'cards' => $cards,
        ]);

        return response()->noContent();
    }

    public function manageCards($collectionId)
    {

        $collection = Collection::find($collectionId);
        $cards = Card::where('collection_id', $collectionId)->orderBy('order')->get();

        return Inertia::render('Collection/ManageCard', [
            'cards' => $cards,
            'collection' => $collection,
        ]);
    }

    public function manageCollection($collectionId)
    {

        $collection = Collection::find($collectionId);
        $cards = Card::where('collection_id', $collectionId)->orderBy('order')->get();

        $numberOfCards = $cards->count();

        $rarity = new stdClass();

        $fiveStars = floor($numberOfCards * 10 / 100);
        if ($fiveStars < 1) {
            $fiveStars = 1;
        }
        $numberOfCards = $numberOfCards - $fiveStars;

        $fourStars = floor($numberOfCards * 15 / 100);
        if ($fourStars < 1) {
            $fourStars = 1;
        }
        $numberOfCards = $numberOfCards - $fourStars;

        $threeStars = floor($numberOfCards * 25 / 100);
        if ($threeStars < 1) {
            $threeStars = 1;
        }
        $numberOfCards = $numberOfCards - $threeStars;

        $twoStars = floor($numberOfCards * 45 / 100);

        $numberOfCards = $numberOfCards - $twoStars;

        $oneStars =  $numberOfCards;

        $rarity->oneStars = intval($oneStars);
        $rarity->twoStars = intval($twoStars);
        $rarity->threeStars = intval($threeStars);
        $rarity->fourStars = intval($fourStars);
        $rarity->fiveStars = intval($fiveStars);

        return Inertia::render('Collection/ManageCollection', [
            'cards' => $cards,
            'collection' => $collection,
            'rarity' => $rarity,
        ]);
    }


    public function submitCollection(Request $request)
    {

        $collection = Collection::find($request->collection_id);
        $collection->status = "submitted";
        $collection->save();

        foreach ($request->cards as $requestCard) {
            // dd($card["id"]);

            $cost = 0;

            switch ($requestCard["rarity"]) {
                case '1':
                    $cost = rand(100, 499);
                    break;
                case '2':
                    $cost = rand(500, 999);
                    break;
                case '3':
                    $cost = rand(1000, 4999);
                    break;
                case '4':
                    $cost = rand(5000, 9999);
                    break;
                case '5':
                    $cost = rand(10000, 49999);
                    break;
                default:
                    $cost = 100;
                    break;
            }
            $cost = $cost * 10;

            $card = Card::find($requestCard["id"]);
            $card->rarity = $requestCard["rarity"];
            $card->cost = $cost;

            $card->save();
        }

        return Redirect::route('collections.index');
    }

    public function setCover($collectionId, $cardId)
    {
        $card = Card::find($cardId);
        $collection = Collection::find($collectionId);
        $collection->cover_card = $card->image;
        $collection->save();
        return response()->noContent();
    }

    public function previewAlbum($collectionId)
    {

        $collection = Collection::find($collectionId);

        return Inertia::render('Collection/Preview', [

            'collection' => $collection->load(["cards", "category", "user"]),

        ]);
    }

    public function exploreCollections()
    {

        $collections = Collection::where('status', 'active')->orderBy('created_at', 'DESC')->get();

        $userCollections = Auth::user()->usercollections()->pluck('collection_id');


        return Inertia::render('Collection/Explore', [

            'collections' => $collections->load(["cards", "category", "user"]),
            'categories' => Category::orderBy('name')->get(),
            'userCollections' => $userCollections,


        ]);
    }


    public function getResults(Request $request)
    {
        $collections = Collection::where('status', 'active')->whereIn('category_id', $request->selectedCategories)->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'collections' => $collections->load('cards', 'category')
        ]);
    }


    public function buyCollection($collectionId)
    {

        $collection = Collection::find($collectionId);

        $collectionPrice = $collection->cards->count() * 1000;

        if (Auth::user()->gold >= $collectionPrice) {

            $userCollection = new UserCollection();
            $userCollection->user_id = Auth::user()->id;
            $userCollection->collection_id = $collectionId;
            $userCollection->save();

            $user = User::find(Auth::user()->id);
            $user->gold = $user->gold - $collectionPrice;
            $user->save();

            $userCollections = Auth::user()->usercollections()->pluck('collection_id');

            return response()->json([
                'userCollections' => $userCollections,
                'gold' => $user->gold
            ]);
        } else {
        }


        $collection->cover_card = $card->image;
        $collection->save();
        return response()->noContent();
    }



    public function activateCollection($collectionId)
    {
        $collection = Collection::find($collectionId);
        $collection->status = "active";
        $collection->save();

        return response()->noContent();
    }


    public function errorsCollection($collectionId, Request $request)
    {
        $collection = Collection::find($collectionId);
        $collection->status = "errors";
        $collection->errors = $request->errors;
        $collection->save();

        return response()->noContent();
    }


    public function saveCardName($cardId, $cardName)
    {
        $card = Card::find($cardId);
        $card->name = $cardName;
        $card->save();

        return response()->json([
            'card' => $card,
        ]);
    }

    public function saveCardImage(Request $request)
    {
        $card = Card::find($request["id"]);
        $card->image = $request["image"];
        $card->save();

        return response()->noContent();
    }

    public function saveCardLayout($cardId, $cardLayout)
    {
        $card = Card::find($cardId);
        $card->layout = $cardLayout;
        $card->save();

        return response()->noContent();
    }

    public function saveCardOrder(Request $request)
    {

        $collectionId = $request->collection_id;
        $cards = $request->cards;

        $order = 1;

        foreach ($cards as $key => $card) {


            $card = Card::find($card["id"]);
            $card->order = $order;
            $card->save();
            $order++;
        }


        return redirect()->back();
    }

    public function createFromDirectory($collectionId){

        $files = Storage::disk('public')->files("collections/" . $collectionId);

        $maxOrder = 1;

     

        foreach ($files as $key => $file) {

            // dd(Str::of( $file)->basename());
 
          //  dd( url(''));
 
             
             $card = new Card();
             $card->collection_id = $collectionId;
             $card->name = Str::of( $file)->basename();
             $card->image = url('') . "/storage/" . $file;
             $card->order = $maxOrder;
             $card->save();
 
             $maxOrder++;
 
 
 
             # code...
         }

       
    }

    
}
