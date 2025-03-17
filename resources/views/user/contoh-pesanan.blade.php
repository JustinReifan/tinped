@extends('templates.main')
@section('content')
    <div id="title-page" data-value="Contoh pesanan" data-value2="Sitemap"></div>
    <div class="card">
        <div class="card-header fw-bold p-3 text-xss">Contoh pesanan</div>
        <div class="card-body">
            {!! json_decode($config->sitemap, true)['contoh_pesanan'] !!}
        </div>
    </div>
@endsection
