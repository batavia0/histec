<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use App\Models\Category;
use App\Models\TicketStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CreateTicketRequest;


class TicketController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->Category = new Category();
        $this->Tickets = new Tickets();
        $this->TicketStatus = new TicketStatus();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = $this->Category->getAllCategory();
        return view('sivitas_akademika.buat_tiket', ['category' => $category]);
    }
    public function indexSemuaTiket()
    {
        $all_tickets = $this->Tickets->getAllTickets()->paginate(20);
        $data['type_menu'] = 'tiket_nav';
        return view('tiket.semua_tiket',$data, ['all_tickets' => $all_tickets]);
        
    }

    public function indexTiketDitugaskan()
    {
        $auth_id = Auth::user()->role_id;
        $data['all_tickets'] = $this->Tickets->getAllTicketsByRoleId($auth_id)->paginate(20);
        $data['type_menu'] = 'tiket_nav';
        return view('tiket.tiket_ditugaskan',$data);
    }

    public function indexMutasiTiket()
    {
        $data['type_menu'] = 'tiket_nav';
        return view('tiket.mutasi_tiket',$data);
    }

    public function indexStatusTiket()
    {
        $data['type_menu'] = 'tiket_nav';
        return view('tiket.status_tiket',$data);
    }

    public function indexTiketSelesai()
    {
        $data['type_menu'] = 'tiket_nav';
        return view('tiket.tiket_selesai',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['detail_tiket'] = $this->Tickets->getTicketById($id);
        return view('tiket.read_tiket',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['tiket_status'] = $this->TicketStatus->getAllTicketStatus();
        $data['detail_id'] = $this->Tickets->getDetailByticket_id($id); 
        return view('tiket.edit_tiket',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updates(Request $request, $id)
    {
            $request->except('ticket_no');
            $validator = Validator::make($request->only([
                'status_name',
                'ticket_name',
            ]), [
                'status_name' => 'sometimes|required',
                'ticket_name' => 'sometimes|required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }
    
            $ticket = Tickets::findOrFail($id);
    
            $ticket->name = $request->input('ticket_name');
            $ticket->ticket_status_id = $request->input('status_name');
            $ticket->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Tiket berhasil diperbarui',
                'data' => $ticket
            ],201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tickets = Tickets::where('ticket_id',$id)->delete();
        return response()->json([
        'status' => 'success',
            'message' => 'Tiket dihapus'
        ],201);

    }
}
