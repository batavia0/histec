<div class="p2">
    <form action="" method="post" id="formTambahUser">
        @csrf
        <div class="form-group">
            <label for="email">Tambah User</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
            <span id="email_error" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Nama User">
            <span id="name_error" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label for="name">Password</label>
            <input type="password" name="password" id="name" class="form-control" placeholder="Password">
            <span id="password_error" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label for="name">Konfirmasi Password</label>
            <input type="password" name="password_confirm" id="confirm_password" class="form-control" placeholder="Konfirmasi Password">
            <span id="password_error" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label for="role">Divisi</label>
            <select name="role" id="role" class="form-control">
                @foreach ($role_name as $role)
                <option value="{{ $role->id }}" {{ $role->id == auth()->user()->role_id ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="store()">Save changes</button>
        </div>
    </form>
</div>
