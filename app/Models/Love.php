<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Love extends Model
{
    use HasFactory;


    protected $fillable = [
        "id",
        "user_id",
        "post_id"
    ];
}
