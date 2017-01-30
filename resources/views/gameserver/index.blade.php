@extends('layouts.master')

@section('title')
    Paslaugos
@stop

@section('content')
    <div class="game-servers">
    @foreach($gameservers as $gameserver)
        @include('gameserver.item')
    @endforeach 
    </div>
@stop