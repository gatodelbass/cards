<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Card;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CardRequest;
use App\Models\Tale;
use Carbon;
use Illuminate\Support\Facades\Storage;


class ConfiController extends Controller
{
   
 public function confiIndex()
    {
  return Inertia::render('Confi/Index', [
           
        ]);

    }

    public function talesIndex()
    {
       

         return Inertia::render('Confi/TalesIndex', [
            'tales' => Tale::all(),
        ]);
    }

    public function campingItems()
    {
        //Auth::user()->userCan("locomotoras ver");

        return Inertia::render('Camping/campingItems', [
            'items' => Item::all(),
        ]);
    }

    public function talesCreate()
    {
       

        return Inertia::render('Confi/TalesCreate', []);
    }

    public function taleStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'text' => 'required|string',
            

        ]);

        $tale = new Tale;
       
        $tale->name = $request->name;
        $tale->text = $request->text;
       
        $tale->save();
       

        return Redirect::route('talesIndex');
    }

    public function taleEdit($id)
    {
        Auth::user()->usertaleas();
        $tale = tale::find($id);
        $conditions = Condition::where('tale_id', $tale->id)->get();

        return Inertia::render('tale/Edit', [
            'tale' => $tale,
            'conditions' => $conditions,
        ]);
    }
}
