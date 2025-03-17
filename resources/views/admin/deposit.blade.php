@extends('templates.admin')
@section('content')
    <div id="title-page" data-value="Deposit" data-value2="Kelola"></div>
    @livewireStyles
    @livewire('admin.deposit')
    @livewireStyles
@endsection
