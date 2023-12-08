<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class ReturnAuthUserController extends Controller
{
    use HttpResponses;
    public function index()
    {
        return $this->Ok([
            "user" => auth()->user(),
            "isAuth" => Auth::check()
        ]);
    }
}
