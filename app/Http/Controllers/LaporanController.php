<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tickets;
use App\Models\Category;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use App\Models\TicketMutasi;
use App\Models\TicketStatus;
use Illuminate\Http\Request;
use App\Models\TicketProcess;
use Illuminate\Support\Facades\Date;

class LaporanController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construct() {
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
        $data = Tickets::select('ticket_id','created_at')->get()->groupBy(function($data){
            return Carbon::parse($data->created_at)->format('M');
        });
        $dataFinishedTicket = $this->data_ticket_finished();
        $months = [];
        $monthCount = [];
        foreach($data as $month => $values){
            $months[] = $month;
            $monthCount[] = count($values);
        }
        $monthsFinished = [];
        $monthCountFinished = [];
        foreach($dataFinishedTicket as $month => $values)
        {
            $monthsFinished[] = $month;
            $monthCountFinished[] = count($values);
        }
        // $data['dataset_finished'] = $this->Tickets->getAllFinishedTicketPerDay();
        // $data['dataset_open'] = $this->Tickets->getAllOpenTicketPerDay();
        // $data['labels'] = $this->weekName();
        $data['type_menu'] = 'laporan';
        return view('laporan.index',$data, 
        ['month' => $months,
        'monthCount' => $monthCount,
        'monthsFinished' => $monthsFinished,
        'monthCountFinished' => $monthCountFinished,
    ]);
    }

    public function data_ticket_finished()
    {
        return Tickets::select('ticket_id','ticket_finished_at')->get()->groupBy(function($data){
            return Carbon::parse($data->ticket_finished_at)->format('M');
        });
    }

    public function weekName()
    {
        $labels = [];
        $startDate = Date::now()->startOfWeek()->locale('id'); // Mengambil tanggal awal minggu ini
        for ($i = 0; $i < 7; $i++) {
            $day = $startDate->copy()->addDay($i)->isoFormat('dddd, D MMMM Y'); // Mengambil nama hari dalam bahasa Indonesia
            $labels[] = $day;
        }
        return $labels;
        // Set locale to English
            // Carbon::setLocale('en');

            // Get day names in English
            // $dayNames = Carbon::getDays();
            // return $dayNames;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
