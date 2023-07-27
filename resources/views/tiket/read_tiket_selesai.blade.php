<div class="p2">
    <div class="form-group">
        <label for="form-label">ID Tiket</label>
        <input type="text" id="ticket_no" class="form-control" value="{{ isset($detail_tiket->ticket_no) ? $detail_tiket->ticket_no : '' }}" readonly>
    </div>
    <div class="form-group">
        <label for="form-label">Status Tiket</label>
        <input type="text" id="status_tiket" class="form-control" value="{{ isset($detail_tiket->ticket_status_id) ? $detail_tiket->ticket_status->name : '' }}" readonly>
    </div>
    <div class="form-group">
        <label for="form-label">Judul</label>
        <input type="text" id="ticket_name" class="form-control" value="{{ isset($detail_tiket->name) ? $detail_tiket->name : '' }}" readonly>
    </div>
    <div class="form-group">
        <label for="form-label">Dari Tanggal</label>
    <input type="text" class="userDateTime" class="form-control" value="{{ isset($detail_tiket->created_at) ? $detail_tiket->created_at : '' }}" readonly>
    </div>
    <div class="form-group">
        <label for="form-label">Tanggal Selesai</label>
    <input type="text" class="userDateTime" class="form-control" value="{{ isset($detail_tiket->ticket_finished_at) ? $detail_tiket->ticket_finished_at : '--|--' }}" readonly>
    </div>
    <div class="form-group">
        <label for="form-label">Description</label>
    <textarea id="description" class="form-control" readonly>{{ isset($detail_tiket->description) ? $detail_tiket->description : '--|--' }}
    </textarea>
    </div>
    <div class="form-group">
        <div class="list-group">
            @foreach ($histori_tiket->sortByDesc('created_at') as $item)
            @php
            $diff = \Carbon\Carbon::parse($item->tickets->ticket_finished_at)->diffForHumans($item->tickets->created_at);
        @endphp 
            <a href="#" class="list-group-item list-group-item-action {{ $loop->first ? 'active' : '' }}">
              <div class="d-flex w-100 justify-content-between">
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
    <div class="card">
        <div class="card-body">
            <img class="card-img-top" alt="{{ isset($detail_tiket->image) ? $detail_tiket->image : 'No Image' }}" src="{{ isset($detail_tiket->image) ? asset('storage/' . trim($detail_tiket->image)) : 'No Image' }}"width="200"data-toggle="tooltip"title="{{ isset($detail_tiket->image) ? $detail_tiket->image : 'No Image' }}"loading="lazy">
            <h5 class="card-title">{{ isset($detail_tiket->image) ? $detail_tiket->image : 'No Image' }}</h5>
        </div>
    </div>
    
    <div class="modal-footer">
        <button type="button"
            class="btn btn-secondary"
            data-dismiss="modal">Close</button>
    </div>
</div>