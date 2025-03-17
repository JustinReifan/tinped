@extends('templates.admin')
@section('content')
    <div id="title-page" data-value="Website" style="padding-top:24px;" data-value2="Konfigurasi"></div>
    @livewireStyles
    @livewire('admin.konfigurasi.website')
    @livewireScripts
@endsection
