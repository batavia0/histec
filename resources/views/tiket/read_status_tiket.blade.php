<div class="p2">
    <div class="form-group">
        <label for="form-label">Nama Status</label>
        <input type="text" id="ticket_no" class="form-control" value="{{ isset($detail_status->status_id) ? $detail_status->name : '' }}" readonly>
    </div>
    
    <div class="modal-footer">
        <button type="button"
            class="btn btn-secondary"
            data-dismiss="modal">Close</button>
    </div>
</div>