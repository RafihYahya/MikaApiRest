<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;

class PublicController extends Controller
{
    use HttpResponses;
    public function userInfo(string $id)
    {

        $user = User::where("id", $id)->get();

        return $this->Ok([
            "User" => $user,
        ]);
    }
    
}
