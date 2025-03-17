@extends('templates.admin')
@section('content')
    <div id="title-page" data-value="Berita" style="padding-top:24px;" data-value2="Tambah"></div>
    @livewireStyles
    @livewire('admin.tambah-berita')
    @livewireScripts
@endsection
