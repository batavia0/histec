<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|unique:users,email',
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'role' => 'required',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ],[
            // Custom message validation
            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Silakan masukkan email yang valid.',
            'name.required' => 'Kolom nama wajib diisi.',
            'name.regex' => 'Format nama tidak valid. Nama hanya boleh terdiri dari huruf dan spasi.',
            'role.required' => 'Kolom divisi wajib diisi.',
            'password.required' => 'Kolom password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai dengan password.',
            'password_confirm.required' => 'Kolom konfirmasi password wajib diisi.',
            'password_confirm.same' => 'Konfirmasi password tidak sesuai dengan password.',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toArray()], 400);
        }
        // Model constructed
        $this->User->email = $request->input('email');
        $this->User->name = trim($request->input('name'));
        $this->User->password = Hash::make($request->input('password'));
        $this->User->role_id = $request->input('role');
        $this->User->remember_token = Str::random(10);
        $this->User->email_verified_at = now();
        if($this->User->save()){
            return response()->json(['success' => true, 'message' => 'User berhasil ditambahkan.'], 200);
        } else return response()->json(['success' => false, 'errors' => $validator->errors()], 400);

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
        $user = User::where('id',$id)->delete();
        if($user){
            return response()->json(['success' => true, 'message' => 'User berhasil dihapus']);
        }
        return response()->json(['success' => false, 'message' => 'User gagal dihapus']);
    }
}
