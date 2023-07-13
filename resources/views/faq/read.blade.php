<div class="card">
    <div class="card-header">
        <h4>FAQ</h4>
        <div class="card-header-form">
            <form>
                <div class="input-group">
                    <input type="text"
                        class="form-control"
                        id="search-input"
                        placeholder="Search">
                    <div class="input-group-btn">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body p-0">
        
    </div>
    {{-- Pagination --}}
    <div class="card-footer text-right">
        {{ $all_faq->links() }}
        @if ($all_faq['links'])
        <nav class="d-inline-block">
            <ul class="pagination mb-0">
                @foreach ($all_faq['links'] as $item)
                <li class="page-item {{ $item['active']?'active':'' }}"><a class="page-link"
                    href="{{ $item['url'] }}">{!! $item['label'] !!}</a></li>
                @endforeach                                        
            </ul>
        </nav>
        @endif
    </div>
</div>