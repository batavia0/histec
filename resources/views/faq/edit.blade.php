<div class="row">
    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <form
            class="needs-validation"
            novalidate=""
            id="formEditFaq"
            method="POST"
            action="#">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h4 id="label">Edit FAQ</h4>
                </div>
                <div class="card-body pb-0">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text"
                            name="title" 
                            class="form-control"
                            required
                            value="{{ $detail_faq->title }}">
                        <div class="invalid-feedback">
                            Isi judul
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Kategori</label>
                            <select class="form-control selectric" name="category">
                                @foreach ($all_category as $item)  
                                <option value="{{ $detail_faq->category->category_id }}" {{ $detail_faq->category->category_id == $item->category_id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="content" id="summernote" class="summernote-simple">{{ $detail_faq->answer }}</textarea>
                    </div>
                    <div class="invalid-feedback">
                        Anda harus mengisi konten
                    </div>
                </div>
                <div class="card-footer pt-0">
                    <button class="btn btn-primary" onclick="updateBtn({{ $detail_faq->faq_id }})">Perbarui</button>
                </div>
            </div>
        </form>
    </div>
</div>