<div class="p2">
    <form action="" method="post" id="formProsesTiket" enctype="multipart/form-data">
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
                @foreach($tiket_status as $ts)
                @if (($ts->status_id == 3  || $ts->status_id == 2) || $ts->status_id == $detail_id->ticket_status_id)
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
            <div id="preview-img">
                <img id="frame" src="" class="img-fluid" />
              </div>
            <label for="form-label">Gambar</label>
            <input type="file" name="image" id="file-input" onchange="preview()">
        </div>
        <div class="form-group">
            <label for="form-label">Histori Tiket</label>
            <div class="list-group" style="max-height: 300px; overflow-y: auto;">
                @foreach ($histori_tiket->sortByDesc('created_at') as $item)
                @php
                    $ticketFinishedAt = isset($item->tickets->ticket_finished_at) ? \Carbon\Carbon::parse($item->tickets->ticket_finished_at) : null;
                    $ticketCreatedAt = isset($item->tickets->created_at) ? \Carbon\Carbon::parse($item->tickets->created_at) : null;
                    $diff = $ticketFinishedAt ? $ticketFinishedAt->diffForHumans($ticketCreatedAt) : '-';
                @endphp
                <a href="#" class="list-group-item list-group-item-action {{ $loop->first ? 'active' : '' }}">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $item->name }}</h5>
                    </div>
                    <img class="img-fluid" src="{{ !empty(trim($item->image)) ? asset('storage/' . trim($item->image)) : 'https://i.site.pictures/zN7Jb.th.png' }}" alt="">
                    <p class="mb-1">{{ $item->description ?? '-' }}</p>
                    <small>{{ $item->tickets->locations->name ?? '-' }}</small>
                    <small class="formatDateTime">{{ $item->created_at ?? '-' }}</small>
                    <small>{{ $item->name ?? '-' }}</small>
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
@push('scripts')
<script>

</script>

@endpush