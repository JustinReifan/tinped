@extends('templates.main')
@section('content')
    <div id="title-page" data-value="Pengaturan" data-value2="Account"></div>
    @livewireStyles
    @livewire('user.pengaturan')
    @livewireScripts
@endsection
