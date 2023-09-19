<div class="p2">
    <form action="" id="formTambahLokasi">
        @csrf
        <div class="form-group">
            <label for="Nama Lokasi">Nama Lokasi</label>
            <input type="text" name="name" id="lokasi" class="form-control" placeholder="Contoh: Gedung Serbaguna">
            <span id="name_error" class="text-danger"></span>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"
            onclick="storeBtnLokasi()"
            >Simpan</button>
        </div>
    </form>
</div>
