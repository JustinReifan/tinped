@extends('templates.admin')
@section('content')
    <div id="title-page" data-value="Bot" style="padding-top:24px;" data-value2="Konfigurasi"></div>
    @livewireStyles
    @livewire('admin.konfigurasi.bot')
    @livewireScripts
@endsection
