<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\FAQ;
use App\Models\Tickets;
use App\Models\Category;
use App\Rules\ReCaptcha;
use App\Models\Locations;
use App\Jobs\NewTicketJob;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use App\Models\TicketProcess;
use Illuminate\Support\Facades\Validator;



// use App\Http\Requests\CreateTicketRequest;

class SivitasAkademikaController extends Controller
{
    private $Tickets;
    /**
     * Class constructor.
     */
    public function __construct(Tickets $Tickets)
    {
        $this->Category = new Category();
        $this->Tickets = $Tickets;
        $this->TicketProcess = new TicketProcess();
        $this->Locations = new Locations();
        $this->Faq = new FAQ();
        $this->Notifikasi = new Notifikasi();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['category'] = $this->Category->getAllCategory();
        $data['locations'] = $this->Locations->getAllLocations();
        $data['all_faq'] = $this->Faq->getAllFaq()->get();
        return view('sivitas_akademika.buat_tiket', $data);
    }

    public function indexCekStatusTiket()
    {
        return view('sivitas_akademika.cek_status_tiket');
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
        $validator = Validator::make($request->all(), [
            'email'       => 'required|email',
            'keluhan'     => 'required|string',
            'kategori'    => 'required|string',
            'lokasi'      => 'required|string',
            'filenames' => 'nullable|mimes:jpg,png,jpeg,gif|max:16384',
            'deskripsi'   => 'nullable|string',
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ],[
            '*.required' => 'Kolom wajib diisi',
            '*.string' => 'Kolom harus bertipe text',
            'email.email' => 'Silakan masukkan email valid',
            'filenames.mimes' => 'Gambar hanya menerima ekstensi .jpg, .png, .jpeg, .gif',
            'filenames.max' => 'Ukuran gambar maksimal adalah 16MB',
        ]);


        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->toArray()],400);
        }

        $this->Tickets->email = $request->email;
        $this->Tickets->name = $request->keluhan;
        $this->Tickets->category_id = $request->kategori;
        $this->Tickets->ticket_location_id = $request->lokasi;
        $this->Tickets->ticket_status_id = 1; //Open
        $this->Tickets->description = $request->deskripsi;
        $this->Tickets->ticket_no = $this->generateTicketNumber($request->email, $request->kategori, $request->lokasi);
        $this->Tickets->created_at = now();

        $uploadedFile = []; //Create empty array
        if($request->hasFile('filenames')) {
            $uploadedFile[] = $request->file('filenames');
            foreach ($uploadedFile as $file) {
                // // Ambil nama file
                // $originalFileName = $file->getClientOriginalName();
                // // Ambil ekstensi file
                // $extension = $file->getClientOriginalExtension();
                // Generate New filename
                // $newFileName = $originalFileName . '_' . round(microtime(true) * 1000) . '.' . $extension;
                // Store to public path
                // $file->storeAs('public/image',$newFileName);
                $this->Tickets->image = $file->store('image');
                // $uploadedFile[] = $newFileName; //store filename to array
            }
        }
        // $imageString = implode(',', $uploadedFile); //Mengubah array nama file menjadi string
        // $this->Tickets->image = $imageString;
        if ($this->Tickets->save()) {
            $this->Notifikasi->category_id = $request->kategori;
            $this->Notifikasi->type = 'tickets';
            $this->Notifikasi->content = $this->Tickets->ticket_no;
            $this->Notifikasi->content = $this->Tickets->ticket_no;
            $this->Notifikasi->created_at = now();
            $this->Notifikasi->save();

            $ticket_no = $this->Tickets->ticket_no;
            $email = $this->Tickets->email;
            NewTicketJob::dispatch($email, $ticket_no);

            return response()->json(
                ['status' => 'success',
                'message' => 'Tiket berhasil dibuat',
                'data' => ['ticket_number' => $this->Tickets->ticket_no],
                'url' => route('tickets.index'),
                ]
                ,201);
        } else return response()->json(
            ['status' => 'fail',
            'message' => 'silakan coba kembali',
            'url' => route('tickets.index'),
            ]
            ,400);
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

    public function generateTicketNumber($email, $categoryId, $locationId)
    {
        $sha1Email = substr(sha1($email),0,5);
        $timestamp = round(microtime(true) * 1000);

        $ticketNumber = $sha1Email.$categoryId.$locationId.$timestamp;
        return $ticketNumber;
    }

    /**
     * @return Tickets
     */
    public function findTicketsByTicketNumber(Request $request)
    {
        // Check if request is Ajax
        if($request->ajax()){
            $output = '';
            $output2 = '';
            if(!empty($request->search_id_tiket)){
                $histori = $this->TicketProcess->getHistoryTicketById($request->search_id_tiket);
                $query = $this->Tickets->getQueryByIdTiket($request->search_id_tiket)->get();
            // start search
            if ($query) {
                foreach ($query as $data) {                
                    $output .= $this->html($data, $output);
                }
                $output2 .= '<div class="form-group">
                        <div class="list-group">';
                        $iteration = 0;
                        foreach ($histori as $data) {
                            // $diff = Carbon::parse($data->tickets->ticket_finished_at)->diffForHumans($data->tickets->created_at);
                            $isActive = ($iteration === 0 ? 'active' : '');   //Get the latest iteration
                $output2 .= '<a href="#" class="list-group-item list-group-item-action ' . $isActive . '">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">' . $data->name . '</h5>
                                    <small class="userDateTime">' . $data->created_at . '</small>
                                </div>
                                <p class="mb-1">' . $data->description . '</p>
                                <small>' . $data->tickets->locations->name . '</small>
                                <span>-</span>
                                <small>' . $data->tickets->category->name . '</small>
                            </a>';
                            $iteration++;
                        }
                        $output2 .= '</div>
                        </div>';
            }
            }
            
            return response()->json([
                'data' => ['output' => $output, 'output2' => $output2]
            ]);
            // return view('sivitas_akademika.cek_status_tiket');
        }
        
    }

    public function html($data,$output)
    {
        $output .='<ul>
                        <li><strong>Klien</strong>: '.$data->email.' </li>
                        <li><strong>ID Tiket</strong>: '.$data->ticket_no.'</li>
                        <li><strong>Keluhan</strong>: '.$data->name.'</li>
                        <li><strong>Kategori</strong>: '.$data->category->name.'</li>
                        <li><strong>Status Tiket</strong>: <span class="badge bg-info">'.$data->ticket_status->name.'</span></li>
                        <li><strong>Lokasi</strong>: '.$data->locations->name.'</li>
                        <li><strong>Tiket Dibuat</strong>: <div class="mx-auto userDateTime">'.$data->created_at.'</div></li>
                        <li><strong>Tiket Selesai</strong>: <div class="mx-auto userDateTime">'.($data->ticket_finished_at ?? "--|--").'</div></li>
                    </ul>';
                    return $output;
    }
}
