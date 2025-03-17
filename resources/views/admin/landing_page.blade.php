@extends('templates.admin')
@section('content')
    <div id="title-page" data-value="Landing Page" style="padding-top:24px;" data-value2="Konfigurasi"></div>

    @livewireStyles
    @livewire('admin.landing-page')
    @livewireScripts
@endsection
