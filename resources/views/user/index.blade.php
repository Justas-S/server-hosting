@extends('layouts.master')


@section('content')
<div class="row">
    <div class="col-md-3">
        @include('user.sidebar')
    </div>
    <div class="col-md-9">
        @foreach($orders as $order)
            <div class="row">
                <div class="col-md-2">
                    {{ $order->gameserver->ip }}
                </div>
                <div class="col-md-2">
                    {{ $order->gameserver->is_online ? 'Įjungtas' : 'Išjungtas' }}
                </div>
                <div class="col-md-2">
                    <a href="{{ route('gameserver.management', $order->id) }}">Valdymas</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@stop