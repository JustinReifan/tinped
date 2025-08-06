@extends('templates.admin')
@section('content')
    <div id="title-page" data-value="Data tiket" style="padding-top:24px;" data-value2="Tiket"></div>
    @livewireStyles
    @livewire('admin.tiket')
    @livewireScripts
@endsection
