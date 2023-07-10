<div class="p2">
    <form action="" method="post" id="formEditTiket">
        <div class="form-group">
            <label for="form-label">ID Tiket</label>
            <input type="text" id="ticket_no" class="form-control" value="{{ isset($detail_id->ticket_no) ? $detail_id->ticket_no : '' }}" readonly>
        </div>
        <div class="form-group">
            <label for="form-label">Judul</label>
            <input type="text" name="ticket_name" id="ticket_name" class="form-control" value="{{ isset($detail_id->name) ? $detail_id->name : '' }}" readonly>
        </div>
        <div class="form-group">
            <label for="form-label">Status Tiket</label>
            <select name="status_name" id="status_name" class="form-control">
                {{-- Cek apakah $status_id yang terpilih adalah pilihan dari $ts --}}
                @foreach($tiket_status as $ts)
                @if ($ts->status_id == 4 || $ts->status_id == $detail_id->ticket_status_id)
                <option value="{{ $ts->status_id}} {{ $ts->status_id == $detail_id->ticket_status_id ? 'selected' : '' }}">{{ $ts->name }}
                </option>
                @endif
                @endforeach
            </select>
                <label for="form-label">Detail Pengerjaan Tiket</label>
                <input type="text" name="detail_pengerjaan" id="ticket_name" class="form-control" placeholder="Judul pengerjaan yang dilakukan">
                <div class="form-floating">
                    <textarea class="form-control" name="deskripsi" placeholder="Deskripsi" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea"></label>
                </div>
        </div>
        {{-- <div class="form-group">
            <label for="form-label">Histori Tiket</label>
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">List group item heading</h5>
                    <small>3 days ago</small>
                  </div>
                  <p class="mb-1">Some placeholder content in a paragraph.</p>
                  <small>10 Juni 2023.</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">List group item heading</h5>
                    <small class="text-body-secondary">3 days ago</small>
                  </div>
                  <p class="mb-1">Some placeholder content in a paragraph.</p>
                  <small class="text-body-secondary">And some muted small print.</small>
                </a>
              </div>
        </div> --}}
        <div class="modal-footer">
            <button type="button"
                class="btn btn-secondary"
                data-dismiss="modal">Tutup</button>
            <button type="button"
                class="btn btn-primary"
                onclick="updateBtn({{ $detail_id->ticket_id }})">Simpan</button>
        </div>
    </form>
</div>