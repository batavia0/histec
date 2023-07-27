<div class="ticket-header">
    <div class="ticket-detail">
        <div class="ticket-title">
            <h4>{{ $detail_tiket->name }}</h4>
        </div>
        <div class="ticket-info">
            <div class="font-weight-600">{{ $detail_tiket->category->name }}</div>
            <div class="bullet"></div>
            <div class="text-primary font-weight-600">{{ $detail_tiket->ticket_no}}</div>
            <div class="bullet"></div>
            <div id="userDateTime" class="font-weight-600">{{ $detail_tiket->ticket_finished_at}}</div>
        </div>
    </div>
</div>
<div class="ticket-description">
    <p>{{ $detail_tiket->description }}</p>
    <div class="gallery">
        <a href="{{ asset('storage/' . trim($detail_tiket->image)) }}">Gambar</a>
        <button class="btn btn-link" data-toggle="collapse" data-target="#imageCollapse" aria-expanded="true" aria-controls="imageCollapse">
        <i class="fas fa-compress-alt"></i>
        </button>
        <div id="imageCollapse" class="collapse show">
            <img alt="{{ isset($detail_tiket->image) ? $detail_tiket->image : 'No Image' }}"
                src="{{ isset($detail_tiket->image) ? asset('storage/' . trim($detail_tiket->image)) : 'No Image' }}"
                width="200"
                data-toggle="tooltip"
                data-image="{{ asset('storage/' . trim($detail_tiket->image)) }}"
                title="{{ isset($detail_tiket->image) ? $detail_tiket->image : 'No Image' }}"
                loading="lazy">
        </div>
    </div>
    <div class="ticket-divider"></div>
    <div class="ticket-form">
        <form action="{{ route('mailBalasanTiket', ['email' => $detail_tiket->email]) }}" method="POST" id="formReply">
            <div class="d-inline-block">
                <div class="btn badge badge-primary" onclick="copyText(this)">{{ $detail_tiket->email }}</div>
                <div class="btn badge badge-primary" onclick="copyText(this)">{{ $detail_tiket->category->name }}</div>
                <div class="btn badge badge-primary" onclick="copyText(this)">{{ $detail_tiket->name }}</div>
                <div class="btn badge badge-primary" onclick="copyText(this)">{{ $detail_tiket->description }}</div>
            </div>           
            <div class="form-group">
                @csrf
                <textarea style="height: 200px;" name="email_body" class="form-control">Yth, "{{ $detail_tiket->email }}" &#13;&#10;
    Terimakasih telah menghubungi tim UPTTIK Politeknik Negeri Subang.&#13;&#10;Kami ingin memberitahukan bahwa tiket keluhan Anda dengan nomor "{{ $detail_tiket->ticket_no }}" telah berhasil diselesaikan.&#13;&#10;  
    Kami berharap penyelesaian ini memuaskan Anda. Terima kasih atas kesabaran dan kerjasama Anda.&#13;&#10;
Hormat kami,&#13;&#10;UPTTIK Politeknik Negeri Subang
                </textarea>
            </div>
            <div class="form-group text-right">
                <button class="btn btn-primary btn-lg" type="submit">
                Kirim
                </button>
            </div>
        </form>
    </div>
</div>