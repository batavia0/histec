<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $validRoles;
     /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->User = new User();
        $this->Roles = new Roles();
        $this->validRoles = Roles::pluck('id')->all();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $this->authorize('viewAny', $user);
        $data['type_menu'] = 'user';
        $data['all_users'] = $this->User->getAllAdminWithRolesIsNotLogged();
        return view('userss.index', $data);
    }

    public function indexTambahUser(Roles $roles)
    {
        $data['role_name'] = $roles->getRoleName();
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
        $user = $request->email;
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|unique:users,email,'.$user,
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'role' => 'required',Rule::in($this->validRoles),
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ],[
            // Custom message validation
            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Silakan masukkan email yang valid.',
            'email.unique' => 'Email tersebut telah terdaftar.',
            'name.required' => 'Kolom nama wajib diisi.',
            'name.regex' => 'Format nama tidak valid. Nama hanya boleh terdiri dari huruf dan spasi.',
            'role.required' => 'Kolom divisi wajib diisi.',
            'role.in' => 'Kolom divisi harus diisi dengan salah satu dari: ' . implode(', ', $this->validRoles),
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
     * @param  \App\Models\Roles $roles
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();
        $this->authorize('view-read-kepala-upttik',$user);
        $data['role_name'] = $this->Roles->getUserRoleById($id)->first();
        $data['user_data'] = User::where('id', $id)->first();
        return view('userss.read',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Roles $roles, User $user)
    {
        $this->authorize('view-read-kepala-upttik',$user);
        $data['role_name'] = $roles->getRoleName();
        $data['user_data'] = User::where('id', $id)->first();
        return view('userss.edit', $data);
    }

    public function editCurrentUser($id)
    {
        return view('user_profile.index');
    }

    public function updateCurrentUser(Request $request, User $user)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updates(Request $request, $id) {
        $user = User::findOrFail($id);
        $loggedInUser = auth()->user();
    
        // Validasi jika pengguna yang sedang login adalah pengguna yang akan diperbarui
        if ($user->id === $loggedInUser->id) {
            // Jika pengguna yang sedang login adalah pengguna yang akan diperbarui, kirim pesan kesalahan
            return response()->json(['message' => 'Anda tidak memiliki izin untuk memperbarui pengguna ini.'], 403);
        }
    
        $validator = Validator::make($request->only([
            'email',
            'name',
            'password',
            'role',
        ]), [
            'email' => 'required|email|unique:users,email,' . $user->id,
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'password' => 'required',
            'role' => 'required|in:' . implode(',', $this->validRoles),
        ], [
            // Pesan validasi kustom
            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Silakan masukkan email yang valid.',
            'email.unique' => 'Email tersebut telah terdaftar.',
            'name.required' => 'Kolom nama wajib diisi.',
            'name.regex' => 'Format nama tidak valid. Nama hanya boleh terdiri dari huruf dan spasi.',
            'role.required' => 'Kolom divisi wajib diisi.',
            'role.in' => 'Kolom divisi harus diisi dengan salah satu dari: ' . implode(', ', $this->validRoles),
            'password.required' => 'Kolom password wajib diisi.',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->toArray()], 400);
        }
    
        // Periksa apakah ada perubahan data
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->password = Hash::make($request->input('password'));
        $user->role_id = $request->input('role');
        $user->updated_at = now();
    
        if ($user->isDirty(['email', 'name', 'password', 'role_id'])) {
            $user->save();
            return response()->json(['success' => true, 'message' => 'Pengguna berhasil diperbarui.'], 200);
        }
    
        return response()->json(['success' => false, 'message' => 'Tidak ada data yang diperbarui.'], 200);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $user = auth()->user();
        $this->authorize('ability-kepala-upttik',$user);
        $user = User::where('id',$id)->delete();
        if($user){
            return response()->json(['success' => true, 'message' => 'User berhasil dihapus']);
        }
        return response()->json(['success' => false, 'message' => 'User gagal dihapus']);
    }
}
