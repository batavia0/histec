<div class="p2">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" readonly value="{{ $user_data->email }}">
    </div>
    <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" name="name" id="name" class="form-control" readonly value="{{ $user_data->name }}">
    </div>
    <div class="form-group">
        <label for="role">Divisi</label>
        <input type="text" name="role" id="role" class="form-control" readonly value="{{ $role_name->name }}">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>
