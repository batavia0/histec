<div class="p2">
    <form action="" method="post" id="formEditTiket">
        <div class="form-group">
            <label for="form-label">ID Tiket</label>
            <input type="text" id="ticket_no" class="form-control" value="{{ isset($detail_id->ticket_no) ? $detail_id->ticket_no : '' }}"
                placeholder="Masukkan Id Tiket" disabled>
        </div>
        <div class="form-group">
            <label for="form-label">Judul</label>
            <input type="text" name="ticket_name" id="ticket_name" class="form-control" value="{{ isset($detail_id->name) ? $detail_id->name : '' }}"
                placeholder="Masukkan Judul Tiket">
        </div>
        <div class="form-group">
            <label for="form-label">Deskripsi</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ isset($detail_id->description) ? $detail_id->description : '' }}"
                placeholder="Masukkan Judul Tiket">
        </div>
        <div class="form-group">
            <label for="form-label">Status Tiket</label>
            <select name="status_name" id="status_name" class="form-control">
                {{-- Cek apakah $status_id yang terpilih adalah pilihan dari $ts --}}
                @foreach ($tiket_status as $ts)
                <option value="{{ $ts->status_id}}" {{ $ts->status_id == $detail_id->ticket_status_id ? 'selected' : '' }}>{{ $ts->name }}
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
                onclick="updateBtn({{ $detail_id->ticket_id }})">Save changes</button>
        </div>
    </form>
</div>