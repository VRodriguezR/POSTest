<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthManager as AuthFactory;


class logoutController extends Controller
{
    protected $session;
    protected $auth;

    public function __construct(Session $session, AuthFactory $auth)
    {
        $this->session = $session;
        $this->auth = $auth;
    }

    public function logout()
    {
        $this->session->flush();
        $this->auth->logout();

        return redirect()->route('login');
    }
}
