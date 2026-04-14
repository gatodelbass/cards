<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Card;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CardRequest;
use App\Models\CampingItem;
use Carbon;
use Illuminate\Support\Facades\Storage;


class CampingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function campingIndex()
    {
        //Auth::user()->userCan("locomotoras ver");



        return Inertia::render('Camping/CampingIndex', [
            'campingItems' => CampingItem::all(),
        ]);
    }

    public function createCampingItem()
    {
        //Auth::user()->userCan("locomotoras ver");

        return Inertia::render('Camping/CreateCampingItem', []);
    }


    public function storeCampingitem(Request $request)
    {
        $campingItem = new CampingItem();
        $campingItem->name = $request->name;
        $campingItem->image = $request->image;
        $campingItem->price = $request->price;
        $campingItem->save();


        return Redirect::route('campingIndex');
    }


    public function campingPlay()
    {

        return Inertia::render('Camping/Play', [
            'campingItems' => CampingItem::all(),
        ]);
    }
}
