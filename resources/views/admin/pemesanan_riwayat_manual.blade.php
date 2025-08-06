@extends('templates.admin')
@section('content')
    <div id="title-page" data-value="Riwayat pesanan manual" data-value2="Pemesanan"></div>
    @livewireStyles
    @livewire('admin.pemesanan.riwayat-manual')
    @livewireScripts
@endsection
