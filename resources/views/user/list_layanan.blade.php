@extends('templates.main')
@section('content')
    <div id="title-page" data-value="Daftar harga" data-value2="Page"></div>
    @livewireStyles
    @livewire('user.list-layanan', ['kate' => $category])
    @livewireScripts
@endsection
