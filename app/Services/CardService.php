<?php
namespace App\Services;

use App\Models\Card;

class CardService{

    public function setRarity($request){

dd("aja");

        $card = Card::find($request->cardId);

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

        $card->rarity = $request->rarity;
        $card->power = $power;
        $card->save();




    }







}