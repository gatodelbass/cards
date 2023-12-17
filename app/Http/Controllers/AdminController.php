<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Inertia\Inertia;
use App\Models\Collection;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\File;
use App\Models\Log;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function adminIndex()
    {
        Auth::user()->userAdmin();

        return Inertia::render('Admin/Index', []);
    }

    public function help()
    {
        return Inertia::render('Admin/Help', []);
    }

    public function helpSpanish()
    {
        return Inertia::render('Admin/HelpSpanish', []);
    }

    public function emoji()
    {
        return Inertia::render('Admin/Emoji', []);
    }

    public function submittedCollections()
    {
        Auth::user()->userAdmin();

        $submittedCollections =  Collection::where("status", "submitted")->get();

        return Inertia::render('Admin/SubmittedCollections', [
            'submittedCollections' => $submittedCollections->load(['category', 'cards']),
        ]);
    }


    public function batchCollection($collectionId)
    {
        try {

            $files = ((Storage::disk('public')->files("uploads")));
            sort($files, SORT_NATURAL);

            foreach ($files as $file) {

                $uniqueName = md5($file . time()) . "." . \File::extension($file);
                $path = "cards/" . $uniqueName;
                Storage::copy('public/' . $file, 'public/cards/' . $uniqueName);

                $cardName = substr($file, 8, -4);
                $cardName = str_replace("-", " ", $cardName);
                $cardName = str_replace("_", " ", $cardName);

                $card = new Card;
                $card->name = $cardName;
                $card->image = $path;
                $card->layout = "Vertical";
                $card->collection_id = $collectionId;
                $card->status = "created";
                $card->save();
            }
        } catch (\Throwable $th) {
        }

        $cards = Card::where("collection_id", $collectionId)->get();

        return Inertia::render('Collection/BatchCollection', [
            'cards' => $cards,
        ]);
    }


    public function saveCardName($cardId, $cardName)
    {
        $card = Card::find($cardId);
        $card->name = $cardName;
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
}
