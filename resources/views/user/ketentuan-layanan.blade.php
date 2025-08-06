@extends('templates.main')
@section('content')
    <div id="title-page" data-value="Ketentuan" data-value2="Sitemap"></div>
    <div class="card">
        <div class="card-header fw-bold p-3 text-xss">Ketentuan layanan</div>
        <div class="card-body">
            {!! json_decode($config->sitemap, true)['tos'] !!}
        </div>
    </div>
@endsection
