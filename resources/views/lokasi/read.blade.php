<div class="p2">
    <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" name="email" id="email" class="form-control" readonly value="{{ $locations->name ?? '' }}">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>
