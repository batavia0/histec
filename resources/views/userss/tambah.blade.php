<div class="p2">
    <form action="" method="post" id="formTambahUser">
        @csrf
        <div class="form-group">
            <label for="form-label">Tambah User</label>
            <input type="email" name="email" id="email" class="form-control"
            placeholder="Email">
        </div>
        <div class="form-group">
            <label for="form-label">Nama</label>
            <input type="text" name="name" id="email" class="form-control"
            placeholder="Nama User">
        </div>
        <div class="form-group">
            <label for="form-label">Divisi</label>
            <select name="role" id="role" class="form-control">
                @foreach ($role_name as $role)
                <option value="{{ $role->id}}" {{ $role->id == auth()->user()->role_id ? 'selected' : '' }}>{{ $role->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="modal-footer">
            <button type="button"
                class="btn btn-secondary"
                data-dismiss="modal">Close</button>
            <button type="button"
                class="btn btn-primary"
                onclick="store()"
                >Save changes</button>
        </div>
    </form>
</div>