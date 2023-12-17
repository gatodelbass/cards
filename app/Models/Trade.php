<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trade extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ownercard()
    {
        return $this->belongsTo(UserCard::class, 'owner_card_id', 'id');
    }

    public function playercard()
    {
        return $this->belongsTo(UserCard::class, 'player_card_id', 'id');
    }
}
