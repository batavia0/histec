<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
     /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->User = new User();
        $this->Roles = new Roles();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['type_menu'] = 'user';
        $data['all_users'] = $this->User->getAllAdminWithRoles();
        return view('userss.index', $data);
    }

    public function indexTambahUser()
    {
        $data['role_name'] = $this->Roles->getRoleName();
        return view('userss.tambah',$data); 
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
        // dd($request->getContent());
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'role' => 'required',
            'password' => ['required', 'confirmed'],
'password_confirm' => ['required', 'same:password'],
        ],[
            '*.required' => 'Kolom wajib diisi.',
            'role.required' => 'Divisi wajib diisi.',
            'email.email' => 'Silakan masukkan email valid.',
            'name.regex' => 'Format nama tidak valid. Nama hanya boleh terdiri dari huruf dan spasi.',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toArray()], 400);
        }
        $this->User->email = $request->email;
        $this->User->name = $request->name;
        $this->User->password = Hash::make($request->password);
        $this->User->role_id = $request->role;
        $this->User->remember_token = Str::random(10);
        $this->User->email_verified_at = now();
        $this->User->save();

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
