<div class="p2">
        <div class="form-group">
            <label for="form-label">ID Tiket</label>
            <input type="text" id="ticket_no" class="form-control" value="{{ isset($detail_tiket->ticket_no) ? $detail_tiket->ticket_no : '' }}" readonly>
        </div>
        <div class="form-group">
            <label for="form-label">Judul</label>
            <input type="text" id="ticket_name" class="form-control" value="{{ isset($detail_tiket->name) ? $detail_tiket->name : '' }}" readonly>
        </div>
        <div class="form-group">
            <label for="form-label">Status Tiket</label>
            <input type="text" id="status_tiket" class="form-control" value="{{ isset($detail_tiket->ticket_status_id) ? $detail_tiket->ticket_status->name : '' }}" readonly>
        </div>
        <div class="form-group">
            <label for="form-label">Dari Tanggal</label>
        <input type="text" id="ticket_date" class="form-control" value="{{ isset($detail_tiket->created_at) ? $detail_tiket->created_at : '' }}" readonly>
        </div>
        <div class="form-group">
            <label for="form-label">Tanggal Selesai</label>
        <input type="text" id="ticket_date" class="form-control" value="{{ isset($detail_tiket->ticket_finished_at) ? $detail_tiket->ticket_finished_at : '--|--' }}" readonly>
        </div>
        <div class="form-group">
            <label for="form-label">Description</label>
        <textarea id="description" class="form-control" readonly>{{ isset($detail_tiket->description) ? $detail_tiket->description : '--|--' }}
        </textarea>
        </div>
        <div class="card">
            <div class="card-body">
                <img src="{{ $detail_tiket->image }}" class="card-img-top" alt="Image">
                <h5 class="card-title">Image</h5>
            </div>
        </div>
        
        <div class="modal-footer">
            <button type="button"
                class="btn btn-secondary"
                data-dismiss="modal">Close</button>
        </div>
</div>