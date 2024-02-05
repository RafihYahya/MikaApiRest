<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sharedlove extends Model
{
    use HasFactory;

    protected $fillable = [
        "firstUser_id",
        "secondUser_id",
    ];

    protected $hidden = [
        "sharedLoveCount",
    ];
}
