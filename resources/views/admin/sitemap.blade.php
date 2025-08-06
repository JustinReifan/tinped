@extends('templates.admin')
@section('content')
    <div id="title-page" data-value="Sitemap" style="padding-top:24px;" data-value2="Site"></div>
    @livewireStyles
    @livewire('admin.sitemap')
    @livewireScripts
@endsection
