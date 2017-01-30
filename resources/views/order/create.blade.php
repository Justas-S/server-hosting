@extends('layouts.master')


@section('title')
    {{ $game->name }} serverio nuomos užsakymas
@stop



@section('content')
    <div class="game-servers" id="game-servers">
        <order-view inline-template _ip="{{ $ip }}" _gameservers="{{ $gameservers->toJson() }}">
            <form method="POST" action="{{ route('order.store') }}">
                @include('includes.csrf')
                <div class="form-group row">
                    <label for="ip" class="col-form-label col-md-4">IP</label>
                    <div class="col-md-6">
                        <select name="ip" id="ip" v-model="ip" class="form-control" @change="updatePrice" required="1">
                            <option v-for="gameserver in gameservers" v-bind:value="gameserver.ip" v-text="gameserver.ip" :selected="gameserver.ip == '{{ $ip }}'"></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="duration" class="col-md-4 col-form-label">Periodas</label>
                    <div class="col-md-6">
                        <select name="duration" id="duration" class="form-control" v-model="duration" v-on:change="updatePrice" required="1">
                            <option value="7">1 savaitė</option>
                            <option value="14">2 savaitės</option>
                            <option value="30">1 mėnesis</option>
                            <option value="60">2 mėnesiai</option>
                            <option value="90">3 mėnesiai</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price" class="col-md-4 col-form-label">Kaina</label>
                    <div class="col-md-6">
                        <input type="text" disabled="true" v-model="price" />
                    </div>
                </div>
                <button type="submit" class="btn">Užsakyti</button>
            </form>
        </order-view>
    </div>
@stop