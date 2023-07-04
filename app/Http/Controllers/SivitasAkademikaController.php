<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Rules\ReCaptcha;
use App\Models\Locations;
use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;



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
        $this->Locations = new Locations();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = $this->Category->getAllCategory();
        $locations = $this->Locations->getAllLocations();
        return view('sivitas_akademika.buat_tiket', ['category' => $category],['locations' => $locations]);
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
                // // Generate New filename
                // $newFileName = $originalFileName . '_' . round(microtime(true) * 1000) . '.' . $extension;
                // Store to public path
                // $file->storeAs('public/image',$newFileName);
                $this->Tickets->image = $file->store('public/image');
                // $uploadedFile[] = $newFileName; //store filename to array
            }
        }
        // $imageString = implode(',', $uploadedFile); //Mengubah array nama file menjadi string
        // $this->Tickets->image = $imageString;
        if ($this->Tickets->save()) {
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

            $query = $this->Tickets->getQueryByIdTiket($request->search_id_tiket)->get();
            // start search
            if ($query) {
                foreach ($query as $data) {                
                    $output .=
                    '<ul>
                        <li><strong>Klien</strong>: '.$data->email.' </li>
                        <li><strong>ID Tiket</strong>: '.$data->ticket_no.'</li>
                        <li><strong>Keluhan</strong>: '.$data->name.'</li>
                        <li><strong>Kategori</strong>: '.$data->category->name.'</li>
                        <li><strong>Status Tiket</strong>: '.$data->ticket_status->name.' </li>
                        <li><strong>Lokasi</strong>: '.$data->locations->name.'</li>
                        <li><strong>Tiket Dibuat</strong>: '.$data->created_at.'</li>
                        <li><strong>Tiket Selesai</strong>: '.$data->ticket_finished_at.'</li>
                    </ul>';
                }
                return response()->json($output);
            }
        }
        return view('sivitas_akademika.cek_status_tiket');
        
    }
}
