<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use App\Models\User;
use App\Models\Notifikasi;
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
        $this->Notifikasi = new Notifikasi();
        $this->Tickets = new Tickets();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role_id = Auth::user()->role_id;
        $data['countTickets'] = Tickets::countTickets();
        $data['countNewTicket'] = Tickets::countNewTicket($role_id);
        $data['countAdmin'] = User::countAdmin();
        $data['userNotification'] = $this->Notifikasi->getUserNotification()->get();
        $data['countFinishedTicket'] = Tickets::countFinishedTickets($role_id);
        $data['countOpenedTicket'] = Tickets::dataCountOpenedTickets($role_id);
        $data['all_ticket_by_role'] = $this->Tickets->getAllTicketsByRoleIdOpen($role_id)->get();
        $data['all_finished_tickets_filtered'] = $this->Tickets->getAllTicketsFinishedByRoleId(auth()->user()->role_id)->get();
        return view('dashboard',$data,['type_menu' => 'dashboard']);
    }

    public function dataTicketLocation()
    {
     //   
    }
}
