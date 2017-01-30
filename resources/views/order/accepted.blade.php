@extends('layouts.master')

@section('title')
    {{ $order->gameserver->game->name }} užsakymas
@stop

@section('content')
    <h1>Paslauga užsakyta</h1>
    <p>Laukiame apmokėjimo patvirtinimo. Užsakymus galite matyti <a href="{{ route('order.user', Auth::user()->id) }}">Mano Užsakymai</a> meniu</p>
    <p>
        <b>Paslauga: </b>{{ $order->gameserver->game->name }}<br>
        <b>Kaina: </b>{{ $order->price }}<br>
        <b>Trukmė: </b>{{ $order->duration }} dienos<br>
    </p>
@stop