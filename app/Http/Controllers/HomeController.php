<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tab = 'timeline')
    {
      switch($tab) {
        case 'timeline':
          $tab = 0;
          break;
        case 'search':
          $tab = 1;
          break;
        case 'upload':
          $tab = 2;
          break;
        case 'like':
          $tab = 3;
          break;
        case 'profile':
          $tab = 4;
          break;
      }

        $user = Auth::user();
        return view('home', ['user' => $user, 'tab' => $tab]);
    }
}
