<div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div id="detailShow" class="card">
            <div class="card-header">
                <h4>Detail FAQ</h4>
            </div>
            <div class="card-body pb-0">
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text"
                        class="form-control"
                        readonly
                        value="{{ $detail_faq->title }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <input type="text"
                        class="form-control"
                        readonly
                        value="{{ $detail_faq->category->name }}">
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea id="summernote" class="summernote-simple">{{ $detail_faq->answer }}</textarea>
                </div>
            </div>
            {{-- <div class="card-footer pt-0">
                <button class="btn btn-primary" id="btnClose">Tutup</button>
            </div> --}}
        </div>
    </div>
</div>