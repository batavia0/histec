<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use App\Models\User;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $auth_id = Auth::user()->role_id;
        $data['countTickets'] = Tickets::countTickets();
        $data['countNewTicket'] = Tickets::countNewTicket($auth_id);
        $data['countAdmin'] = User::countAdmin();
        return view('dashboard',$data,['type_menu' => 'dashboard']);
    }
}
