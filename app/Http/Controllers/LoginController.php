<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Log;
use App\Models\Avatar;
use App\Models\UserAvatar;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Card;
use App\Models\UserBox;
use App\Models\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Notifications\WelcomeEmailNotification;
use App\Http\Requests\UpdateUserDataRequest;
use App\Notifications\ForgotPasswordEmailNotification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class LoginController extends Controller
{
    public function welcome()
    {
        $cards = DB::table('cards')->selectRaw('count(id) as number')
            ->where('rarity', '!=', null)
            ->groupBy('rarity')
            ->get()->toArray();

        $rarities = ['', '1 star', '2 stars', '3 stars', '4 stars', '5 stars'];

        //chart headings
        $chartData[0] = ['card', 'rarity'];

        for ($i = 1; $i <= 5; $i++) {
            $chartData[$i] = [$rarities[$i], $cards[$i - 1]->number];
        }


        $randomCards = null;
        $randomCollections = null;

        try {
            $randomCards = Card::all()->random(3);
            $randomCollections = Collection::all()->random(3);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $totalUserCardsObtained = DB::table("user_cards")->count();
        $totalUserCardsPasted = DB::table("user_cards")->where("status", "pasted")->count();
        $totalExchangesAccepted = DB::table("trades")->where("status", "accepted")->count();
        $totalCollections = DB::table("collections")->where("status", "active")->count();

        return Inertia::render('Welcome', [
            'randomCards' => $randomCards,
            'randomCollections' => $randomCollections->load(["cards", "category", "user"]),
            'chartData' => $chartData,
            'totalUserCardsObtained' => $totalUserCardsObtained,
            'totalUserCardsPasted' => $totalUserCardsPasted,
            'totalExchangesAccepted' => $totalExchangesAccepted,
            'totalCollections' => $totalCollections,
        ]);
    }

    public function index()
    {
        //check the daily box 
        $user = User::find(Auth::user()->id);
        $userBox = UserBox::whereDate('created_at', '=', \Carbon\Carbon::today()->toDateString())->where('user_id', '=', $user->id)->get();

        if ($userBox->isEmpty()) {
            $user->boxes = $user->boxes + 3;
            $user->save();
            $createUserBox = new UserBox();
            $createUserBox->user_id = $user->id;
            $createUserBox->save();
        }

        //check for incoming exchanges
        $incomingExchanges = DB::table('trades')
            ->join('user_cards', 'trades.owner_card_id', '=',  'user_cards.id')
            ->where('trades.status', '=', 'offered')
            ->where('user_cards.user_id', '=', Auth::user()->id)->get();

        if ($incomingExchanges->count() == 0) {
            $hasIncomingExchanges = false;
        } else {
            $hasIncomingExchanges = true;
        }
        

        return Inertia::render('Login/Index', [
            'hasIncomingExchanges' => $hasIncomingExchanges
        ]);
    }

    public function loginForm()
    {
        return Inertia::render('Login/Login');
    }

    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('login.index');
        }

        return back()->withErrors([
            'email' => 'Email or password not matching or not exist',
        ]);
    }

    public function registerForm()
    {
        return Inertia::render('Login/Register');
    }

    public function registerUser(RegisterRequest $request)
    {

        $validated = $request->validated();

        $errors = [];
        $nicknameExists = User::where('nickname', $request->nickname)->first();
        $emailExists = User::where('email', $request->email)->first();

        if ($nicknameExists) {
            $errors["nickname"] = "This nickname already exists";
        }

        if ($emailExists) {
            $errors["email"] = "This email already exists";
        }

        if ($request->password != $request->password2) {
            $errors["password"] = "The passwords doesn't match";
        }

        if ($errors) {
            return redirect()->back()->withErrors($errors);
        }

        $user = new User();
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = "user";
        $user->status = "created";

        $data = [];
        $data["cards_obtained"] = 0;
        $data["cards_pasted"] = 0;
        $data["exchanges_accepted"] = 0;
        $data["avatars_obtained"] = 0;
        $data["boxes_obtained"] = 0;
        $data["gold_obtained"] = 0;
        $user->data = json_encode($data);

        $user->save();
        $user->notify(new WelcomeEmailNotification($user));

        return $this->afterRegister($user);
    }


    public function afterRegister($user)
    {
        return Inertia::render('Login/AfterRegister', [
            'user' => $user
        ]);
    }

    public function registerVerify($id)
    {
        $user = User::find($id);

        if ($user->status = "created") {
            $user->status = "active";

            $user->gold = 200000;
            $user->status = "active";
            $user->tickets = 20;
            $user->boxes = 4;

            try {
                $avatar1 = Avatar::all()->random(1);
                $userAvatar1 = new UserAvatar();
                $userAvatar1->user_id = $user->id;
                $userAvatar1->avatar_id = $avatar1[0]->id;
                $userAvatar1->save();

                $avatar2 = Avatar::all()->random(1);
                $userAvatar2 = new UserAvatar();
                $userAvatar2->user_id = $user->id;
                $userAvatar2->avatar_id = $avatar2[0]->id;
                $userAvatar2->save();

                $user->avatar = $avatar2->image;
            } catch (\Throwable $th) {
                //throw $th;
            }


            $user->save();

            $log = new Log;
            $log->user_id = $user->id;
            $log->event = "Verify";
            $log->message = $user->nickname . " ha verificado su cuenta";
            $log->save();
        }

        return Inertia::render('Login/Activate', [

            'user' => $user
        ]);

        return response()->noContent();
    }


    public function updateUserData(UpdateUserDataRequest $request)
    {

        $validated = $request->validated();

        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->neighborhood = $request->neighborhood;
        $user->save();

        return Redirect::route('profileIndex');
    }


    public function logoutUser()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }

    public function forgotPassword()
    {
        return Inertia::render('Login/ForgotPassword', []);
    }

    public function sendPasswordCode(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {

            $user->remember_code  = strtoupper(Str::random(6));
            $user->save();
            $user->notify(new ForgotPasswordEmailNotification($user));

            return response()->noContent();
        } else {
            $errors['email'] = 'Email not found!';
            return response()->json([
                'errors' => $errors
            ], 422);
        }
    }

    public function checkRememberCode(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user->remember_code == $request->code) {

            return response()->noContent();
        } else {

            $errors['code'] = "The entered code doesn't exists. Please verify your email or repeat the process";
            return response()->json([
                'errors' => $errors
            ], 422);
        }
    }

    public function changePassword(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        if ($request->password == $request->password2 && $request->password != "") {

            $user->password = Hash::make($request->password);
            $user->save();

            return response()->noContent();
        } else {

            $errors['password'] = "The passwords doesn't match or are empty!";
            return response()->json([
                'errors' => $errors
            ], 422);
        }
    }


    public function changePasswordForm()
    {
        $user = User::find(Auth::user()->id);

        return Inertia::render('Login/ChangePasswordForm', [
            'record' => $user,
        ]);
    }

    public function fallback(){

        return Inertia::render('Login/Page404', [
           
        ]);
    }
}
