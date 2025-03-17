@extends('templates.main')
@section('content')
    <div id="title-page" data-value="Kontak" data-value2="Sitemap"></div>
    <div class="card">
        <div class="card-header fw-bold p-3 text-xss">Kontak kami</div>
        <div class="card-body">
            {!! json_decode($config->sitemap, true)['kontak'] !!}
        </div>
    </div>
@endsection
