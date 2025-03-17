@extends('templates.admin')
@section('content')
    <div id="title-page" data-value="Riwayat refill" style="padding-top:24px;" data-value2="Pemesanan"></div>

    @livewireStyles
    @livewire('admin.pemesanan.riwayat-refill')
    @livewireScripts
@endsection
