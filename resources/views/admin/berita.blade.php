@extends('templates.admin')
@section('content')
    <div id="title-page" data-value="Berita" style="padding-top:24px;" data-value2="Kelola"></div>
    @livewireStyles
    @livewire('admin.berita')
    @livewireScripts
@endsection
