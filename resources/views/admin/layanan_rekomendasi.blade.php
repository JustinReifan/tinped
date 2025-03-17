@extends('templates.admin')
@section('content')
    <div id="title-page" data-value="Layanan rekomendasi" style="padding-top:24px;" data-value2="Konfigurasi"></div>

    @livewireStyles
    @livewire('admin.layanan.rekomendasi')
    @livewireScripts
@endsection
