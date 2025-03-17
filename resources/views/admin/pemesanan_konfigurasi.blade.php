@extends('templates.admin')
@section('content')
    <div id="title-page" data-value="Konfigurasi" style="margin-top:24px;" data-value2="Pemesanan"></div>
    @livewireStyles
    @livewire('admin.pemesanan.konfigurasi')
    @livewireScripts
@endsection
