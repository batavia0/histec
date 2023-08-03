<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tickets;
use App\Models\Category;
use App\Models\TicketMutasi;
use App\Models\TicketStatus;
use Illuminate\Http\Request;
use App\Jobs\ProcessMailSend;
use App\Models\TicketProcess;
use App\Mail\MailtoTicketReply;
use App\Mail\MailtoTicketSender;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
        $this->TicketProcess = new TicketProcess();
        $this->TicketMutasi = new TicketMutasi();
        $this->User = new User();
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
        $data['all_tickets'] = $this->Tickets->getAllTicketsByRoleIdNotFinished($auth_id)->paginate(20);
        $data['type_menu'] = 'tiket_nav';
        return view('tiket.tiket_ditugaskan',$data);
    }

    public function indexMutasiTiket()
    {
        $auth_id = Auth::user()->role_id;
        $data['all_tickets'] = $this->TicketMutasi->getMutasiTiketByRoleId($auth_id)->paginate(20);
        $data['type_menu'] = 'tiket_nav';
        return view('tiket.mutasi_tiket',$data);
    }

    public function indexStatusTiket()
    {
        $data['all_ticket_status'] = $this->TicketStatus->getAllTicketStatus();
        $data['type_menu'] = 'tiket_nav';
        return view('tiket.status_tiket',$data);
    }

    public function indexTiketSelesai()
    {
        $auth_id = Auth::user()->role_id;
        $data['all_finished_tickets_filtered'] = $this->Tickets->getAllTicketsFinishedByRoleId($auth_id)->paginate(20);
        $data['type_menu'] = 'tiket_nav';
        return view('tiket.tiket_selesai',$data);
    }

    public function indexBalasanTiket()
    {
        $auth_id = Auth::user()->role_id;
        $data['all_finished_tickets_filtered'] = $this->Tickets->getAllTicketsFinishedByRoleId($auth_id)->get();
        $data['type_menu'] = 'balasan_tiket_nav';
        return view('balasan_tiket.index',$data);
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
    public function showTiketDitugaskan($id)
    {
        $data['detail_tiket'] = $this->Tickets->getTicketById($id);
        $data['histori_tiket'] = $this->TicketProcess->getHistoryTicketById($id);

        return view('tiket.read_tiket_ditugaskan',$data);
    }

    public function showTiketSelesai($id)
    {
        $data['detail_tiket'] = $this->Tickets->getClosedTicketById($id);
        $data['histori_tiket'] = $this->TicketProcess->getHistoryTicketById($id);
        return view('tiket.read_tiket_selesai',$data);
    }

    public function showStatusTiket($id)
    {
        $data['detail_status'] = $this->TicketStatus->getTicketStatusById($id);
        return view('tiket.read_status_tiket',$data);
    }

    public function showBalasanTiket($id)
    {
        $data['detail_tiket'] = $this->Tickets->getClosedTicketsByIdWithRoleId($id);
        return view('balasan_tiket.show',$data);
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

    public function editTiketDitugaskan($id)
    {
        $data['tiket_status'] = $this->TicketStatus->getAllTicketStatus();
        $data['detail_id'] = $this->Tickets->getDetailByticket_id($id);
        $data['histori_tiket'] = $this->Tickets->getHistoryTicketById($id);
 
        return view('tiket.proses_tiket',$data);
    }
    public function mutasiProsesTiket($id)
    {
        $auth_id = Auth::user()->role_id;
        $data['all_admin'] = $this->User->getAllAdmin($auth_id);
        $data['detail_id'] = $this->Tickets->getDetailByticket_id($id);       
        return view('tiket.mutasi_proses_tiket',$data);
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
            $validator = Validator::make($request->only([
                'status_name',
                'ticket_name',
                'description',
            ]), [
                'status_name' => 'sometimes',
                'ticket_name' => 'sometimes',
                'description' => 'sometimes',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }
    
            $ticket = Tickets::findOrFail($id);
            $ticket->ticket_status_id = $request->input('status_name');
            $ticket->name = $request->input('ticket_name');
            $ticket->description = $request->input('description');
    
            if ($ticket->isDirty(['ticket_status_id', 'name', 'description'])) {
                // There are changes in the data
                $ticket->save();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Tiket berhasil diperbarui',
                ],201);
                // No changes were made
            } else return response()->json([
                'status' => 'success',
                'message' => 'Tidak ada yang diperbarui'
            ],200);                
    }

    public function updateTiketDitugaskan(Request $request, $id)
    {
        $validator = Validator::make($request->only([
            'status_name',
            'detail_pengerjaan',
            'deskripsi',
        ]),[
            'status_name' => 'required',
            'detail_pengerjaan' => 'string|required' ,
            'deskripsi' => 'sometimes',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $ticket = Tickets::findOrFail($id);
        $ticket->ticket_status_id = $request->input('status_name');
        if($request->input('status_name') == '2'){
            $ticket->ticket_finished_at = now();
        }
        $ticket->save();

        $this->TicketProcess->name = $request->input('detail_pengerjaan');
        $this->TicketProcess->description = $request->input('deskripsi');
        $this->TicketProcess->ticket_id = $id;
        $this->TicketProcess->ticket_process_status_id = $request->input('status_name');
        $this->TicketProcess->technician_id = Auth::user()->role_id;
        $this->TicketProcess->updated_at = now();
        $this->TicketProcess->save();
    }

    public function updateMutasiProsesTiket(Request $request, $id)
    {
        $validator = Validator::make($request->only([
            'technician',
        ]),[
            'technician' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $ticket = Tickets::findOrFail($id);            
        $ticket->category_id = $request->input('technician');
        $ticket->save();
        

        $this->TicketMutasi->ticket_id = $id;
        $this->TicketMutasi->technician_id = $request->input('technician');
        $this->TicketMutasi->created_at = now();
        $this->TicketMutasi->updated_at = now();
        $this->TicketMutasi->save();
        return response()->json(['message' => 'Mutasi Tiket Berhasil'], 201);
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

    public function sendMail()
    {
        Mail::to("testingmail@gmail.com")->send(new MailtoTicketSender());
        return "Email telah dikirim";
    }

    public function mailBalasanTiket(Request $request,$email)
    {
        $validator = Validator::make($request->only([
            'email_body',
        ]),[
            'email_body' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $message_body = $request->input('email_body');
        // Mail::to($email)->send(new MailtoTicketReply($message_body));
        ProcessMailSend::dispatch($message_body,$email);
        return redirect()->route('indexBalasanTiket');
    }
}
