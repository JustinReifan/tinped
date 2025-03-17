@extends('templates.admin')
@section('content')
    <div id="title-page" data-value="Level user" style="padding-top:24px;" data-value2="Konfigurasi"></div>
    @livewireStyles
    @livewire('admin.konfigurasi.level-user')
    @livewireScripts
@endsection
