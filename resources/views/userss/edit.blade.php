<div class="p2">
    <form action="" id="formUpdateUser">
        @csrf
        <div class="form-group">
            <label for="email">Edit User</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ $user_data->email }}">
            <span id="email_error" class="text-danger"></span>
        </div>

        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Nama User" value="{{ $user_data->name }}">
            <span id="name_error" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="{{ $user_data->password }}">
            <span id="password_error" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label for="role">Divisi</label>
            <select name="role" id="role" class="form-control">
                @foreach ($role_name as $role)
                <option value="{{ $role->id }}" {{ $role->id == $user_data->role_id ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
                @endforeach
            </select>
            <span id="role_error" class="text-danger"></span>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" onclick="updateBtnUser(event,{{ $user_data->id }})">Simpan</button>
        </div>
    </form>
</div>
