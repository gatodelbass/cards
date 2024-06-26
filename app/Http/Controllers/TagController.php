<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Tag;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\TagRequest;


use Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Inertia::render('Tag/Index', [
            'tags' => Tag::orderBy("name")->get()
        ]);
    }

    public function filterTags($name)
    {

        $tags = Tag::where("name",  'like', '%' . $name . '%')->get();


        return response()->json([
            'tags' => $tags,
        ]);
    }



    public function addNewTag(Request $request)
    {

        $tagExists = Tag::where("name", $request->name)->first();

        if (!$tagExists) {

            $tag = new Tag();
            $tag->name = $request->name;
            $tag->save();
        }


        $tags = Tag::orderBy("name")->get();

        return back();
    }
}
