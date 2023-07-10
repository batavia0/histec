<div class="p2">
    <form action="" method="post" id="formProsesTiket">
        <div class="form-group">
            <label for="form-label">ID Tiket</label>
            <input type="text" id="ticket_no" class="form-control" value="{{ isset($detail_id->ticket_no) ? $detail_id->ticket_no : '' }}" readonly>
        </div>
        <div class="form-group">
            <label for="form-label">Judul</label>
            <input type="text" id="ticket_name" class="form-control" value="{{ isset($detail_id->name) ? $detail_id->name : '' }}" readonly>
        </div>
        <div class="form-group">
            <label for="form-label">Status Tiket</label>
            <select name="status_name" id="status_name" class="form-control">
                {{-- Cek apakah $status_id yang terpilih adalah pilihan dari $ts --}}
                @foreach($tiket_status as $ts)
                @if ($ts->status_id == 3  || $ts->status_id == 2 || $ts->status_id == $detail_id->ticket_status_id)
                <option value="{{ $ts->status_id}}" {{ $ts->status_id == $detail_id->ticket_status_id ? 'selected' : '' }}>{{ $ts->name }}
                </option>
                @endif
                @endforeach
            </select>
                <label for="form-label">Detail Pengerjaan Tiket</label>
                <input type="text" name="detail_pengerjaan" id="ticket_name" class="form-control" placeholder="Judul pengerjaan yang dilakukan">
                <div class="form-floating">
                    <textarea class="form-control" name="deskripsi" placeholder="Deskripsi" id="deskripsi"></textarea>
                    <label for="floatingTextarea"></label>
                </div>
        </div>
        <div class="form-group">
            <label for="form-label">Histori Tiket</label>
            <div class="list-group">
                @foreach ($histori_tiket->sortByDesc('created_at') as $item)
                @php
                $diff = \Carbon\Carbon::parse($item->tickets->ticket_finished_at)->diffForHumans($item->tickets->created_at);
            @endphp 
                <a href="#" class="list-group-item list-group-item-action {{ $loop->first ? 'active' : '' }}">
                  <div class="d-flex w-100 justify-cossntent-between">
                    <h5 class="mb-1">{{ $item->name }}</h5>
                    <small>{{ $diff }}</small>
                  </div>
                  <p class="mb-1">{{ $item->description }}</p>
                  <small>{{ $item->tickets->locations->name }}</small>
                  <span>-</span>
                  <small>{{ $item->tickets->category->name }}</small>
                </a>
                @endforeach
        </div>
        </div>
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