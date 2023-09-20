<div class="p2">
    <form action="" method="post" id="formMutasiTiket">
        <div class="form-group">
            <label for="form-label">ID Tiket</label>
            <input type="text" id="ticket_no" class="form-control" value="{{ isset($detail_id->ticket_no) ? $detail_id->ticket_no : '' }}" readonly>
        </div>
        <div class="form-group">
            <label for="form-label">Judul</label>
            <input type="text" id="ticket_name" class="form-control" value="{{ isset($detail_id->name) ? $detail_id->name : '' }}" readonly>
        </div>
        <div class="form-group">
            <label for="form-label">Pindahkan Ke Teknisi</label>
            <select name="technician" id="technician" class="form-control">
                @foreach ($all_admin as $admin)
                <option value="{{ $admin->id }}"> {{ $admin->name }}</option>
            @endforeach
            </select>
        </div>
        <div class="modal-footer">
            <button type="button"
                class="btn btn-secondary"
                data-dismiss="modal">Close</button>
            <button type="button"
                class="btn btn-primary"
                onclick="updateMutasiBtn({{ $detail_id->ticket_id }})">Save changes</button>
        </div>
    </form>
</div>