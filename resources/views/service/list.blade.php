@extends('layouts.master')


@section('title')
    Paslaugos
@stop

@section('content')
    <table class="services table">
        @foreach($services as $service)
            @include('service.item')
        @endforeach
    </table>
@stop
