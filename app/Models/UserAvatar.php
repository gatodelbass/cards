<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Avatar;

class UserAvatar extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function avatar()
    {
        return $this->belongsTo(Avatar::class);
    }
}
