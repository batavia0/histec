@extends('sivitas_akademika.emails.layout')
@section('content')
<p>
  Yth, "{{ $email ?? 'email' }}" Terimakasih telah menghubungi tim UPTTIK Politeknik Negeri Subang. <br><br>Kami telah menerima permintaan tiket keluhan Anda dengan nomor "{{ $ticket_no ?? 'ID tiket' }}". Kami akan segera menanggapi tiket anda. Silakan <a href="{{ route('indexCekStatusTiket') }}" style="color: #0d6efd;">Cek Status Tiket</a> anda untuk melihat informasi tiket yang telah anda buat. <br><br>
  Terima kasih atas kesabaran dan kerjasama Anda <br><br>
  Hormat kami,<br><br>
  UPTTIK Politeknik Negeri Subang
</p>
@endsection