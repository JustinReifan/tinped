@extends('templates.admin')
@section('content')
    <div id="title-page" data-value="Riwayat order" style="padding-top:24px;" data-value2="Pemesanan"></div>

    @livewireStyles
    @livewire('admin.nologin')
    @livewireScripts
@endsection
