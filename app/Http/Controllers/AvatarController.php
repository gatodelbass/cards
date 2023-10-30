<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Avatar;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\AvatarRequest;

use Carbon;
use Illuminate\Support\Facades\Storage;


class AvatarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Auth::user()->userCan("locomotoras ver");

        return Inertia::render('Avatar/Index', [
            'avatars' => Avatar::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Avatar/Create', [
           
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
       

        if ($request->image != null) {




            $path = Storage::disk('public')->put('avatars', $request->image);

            $avatar = new Avatar();
            $avatar->image = $path;
            $avatar->save();
        }       

        return Redirect::route('avatars.index');
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

        $Avatar = Avatar::find($id);

        if ($request->wantsJson()) {
            return response()->json([
                'selectedAvatar' => $Avatar,
            ]);
        }

        return Inertia::render('Avatar/Show', [
            'Avatar' => $Avatar,
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
        $Avatar = Avatar::find($id);

        return Inertia::render('Avatar/Edit', [
            'Avatar' => $Avatar,

        ]);
    }


    public function update(StoreAvatarRequest $request, Avatar $Avatar)
    {

        if ($request->hasFile('image')) {
            $now = Carbon\Carbon::now();
            $now->toDateTimeString();
            $imgName = $now->format('Y-m-d') . "_" . $now->format('his') . ".png";
            $request->image->storeAs('public/images/Avatars/', $imgName);
        } else {
            $imgName = $Avatar->image;
        }

        if ($request->has('id')) {

            switch ($request->rarity) {
                case '1':
                    $power = rand(100, 499);
                    break;
                case '2':
                    $power = rand(500, 999);
                    break;
                case '3':
                    $power = rand(1000, 4999);
                    break;
                case '4':
                    $power = rand(5000, 9999);
                    break;
                case '5':
                    $power = rand(10000, 49999);
                    break;
                case '6':
                    $power = rand(50000, 99999);
                    break;
                case '7':
                    $power = rand(100000, 499999);
                    break;
                default:
                    $power = 100;
                    break;
            }

            $power = $power * 100;



            Avatar::find($request->input('id'))->update($request->validated() + [
                'image' => $imgName,
                'power' => $power,

            ]);
        }


        return Redirect::route('Avatars.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Auth::user()->userCan("locomotoras eliminar");

        $Avatar = Avatar::find($id);
        $Avatar->delete();



        return Redirect::route('Avatars.index');
    }

    public function setRarity(Request $request)
    {
        //dd($request->request);

        $Avatar = Avatar::find($request->AvatarId);

        switch ($request->rarity) {
            case '1':
                $power = rand(100, 499);
                break;
            case '2':
                $power = rand(500, 999);
                break;
            case '3':
                $power = rand(1000, 4999);
                break;
            case '4':
                $power = rand(5000, 9999);
                break;
            case '5':
                $power = rand(10000, 49999);
                break;
            case '6':
                $power = rand(50000, 99999);
                break;
            case '7':
                $power = rand(100000, 499999);
                break;
            default:
                $power = 100;
                break;
        }

        $power = $power * 100;

        $Avatar->rarity = $request->rarity;
        $Avatar->power = $power;
        $Avatar->save();



        return response()->json([
            'Avatars' => Avatar::all(),
        ]);
    }

    public function setVisualFilter(Request $request)
    {
        //dd($request->request);

        $Avatar = Avatar::find($request->AvatarId);
        $Avatar->visual_filter = $request->filter;
        $Avatar->save();



        return response()->json([
            'Avatars' => Avatar::all(),
        ]);
    }



    public function getRandomAvatars($numberOfPlayers)
    {
        $Avatars = Avatar::inRandomOrder()->limit($numberOfPlayers)->get();

        return response()->json([
            'Avatars' => $Avatars,
        ]);
    }
}
