<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postcomments extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "user_id",
        "comment",
        "post_id",
    ];
}
