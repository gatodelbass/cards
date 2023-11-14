<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'nickname' => "ElGato",
            'email' => 'davemmgarcia@gmail.com',
            'password' => Hash::make('admin'),
            'status' => "active",
            'role' => "admin"
        ]);

        $users = User::all();        

        foreach ($users as $user) {
            $data = [];
            $data["cards_obtained"] = 0;
            $data["cards_pasted"] = 0;
            $data["exchanges_accepted"] = 0;
            $data["avatars_obtained"] = 0;
            $data["boxes_obtained"] = 0;
            $data["gold_obtained"] = 0;
            $user->data = json_encode($data);
            $user->save();
        }

    }
}
