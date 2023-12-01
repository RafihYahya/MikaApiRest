<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponses;
    /**
     * Login A Registered User
     */
    public function login()
    {
        return $this->Ok('log in worked');
    }
    public function register()
    {
        return $this->Ok('register in worked');
    }
    public function logout()
    {
        return $this->Ok('logout in worked');
    }

}
