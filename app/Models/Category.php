<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Collection;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
}
