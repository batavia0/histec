<?php

namespace App\Http\Controllers;

use App\Models\Locations;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LocationController extends Controller
{
    protected $locations;
    /**
     * Class constructor.
     */
    public function __construct(Locations $locations)
    {
        $this->locations = $locations;
    }
    protected function getLocationById($id)
    {
        return $this->locations->where('location_id', $id)->first();
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Locations  $locations
     * @return \Illuminate\Http\Response
     */
    public function index(Locations $locations)
    {
        $data['all_locations'] = $locations->all();
        $data['type_menu'] = 'location_nav';
        return view('lokasi.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\Models\Locations  $locationss
     * @return \Illuminate\Http\Response
     */
    public function create(Locations $locations)
    {
        $data['all_locations'] = $locations->all();
        return view('lokasi.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Locations $locations)
    {
        $validator = Validator::make($request->only([
            'name',
        ]), [
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
        ], [
            // Pesan validasi kustom
            'name.required' => 'Kolom nama wajib diisi.',
            'name.regex' => 'Format nama tidak valid. Nama hanya boleh terdiri dari huruf dan spasi.',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toArray()], 422);
        }
        $locations->name = $request->input('name');
        if ($locations->save()) {
            return response()->json(['success' => true, 'message' => 'Lokasi berhasil ditambahkan.'], 200);
        }
        return response()->json(['success' => false, 'message' => 'Lokasi gagal ditambahkan.'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Locations  $locations
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['locations'] = $this->getLocationById($id);
        return view('lokasi.read', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Locations  $locations
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $data['locations'] = $this->getLocationById($id);
        return view('lokasi.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $locations = Locations::findOrFail($id);
        $validator = Validator::make($request->only([
            'name',
        ]), [
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
        ], [
            // Pesan validasi kustom
            'name.required' => 'Kolom nama wajib diisi.',
            'name.regex' => 'Format nama tidak valid. Nama hanya boleh terdiri dari huruf dan spasi.',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toArray()], 422);
        }
    
        // Periksa apakah ada perubahan data
        $locations->name = $request->input('name');
        $locations->updated_at = now();
    
        if ($locations->isDirty(['name'])) {
            $locations->save();
            return response()->json(['success' => true, 'message' => 'Lokasi berhasil diperbarui.'], 200);
        }
        return response()->json(['success' => false, 'message' => 'Tidak ada data yang diperbarui.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Locations  $locations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Locations $locations)
    {
        $locations->delete();
        if($locations){
            return response()->json(['success' => true, 'message' => 'Lokasi berhasil dihapus']);
        }
        return response()->json(['success' => false, 'message' => 'Lokasi gagal dihapus']);
    }
}
