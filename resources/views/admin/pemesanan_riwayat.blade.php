@extends('templates.admin')
@section('content')
    <div id="title-page" data-value="Riwayat pesanan" data-value2="Pemesanan"></div>
    @livewireStyles
    @livewire('admin.pemesanan.riwayat')
    @livewireScripts
@endsection
