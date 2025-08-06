@extends('templates.main')
@section('content')
    <div id="title-page" data-value="News" data-value2="Beria"></div>
    @livewireStyles
    @livewire('user.berita')
    @livewireScripts
@endsection
