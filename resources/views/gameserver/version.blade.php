@extends('layouts.master')


@section('content')
<div class="row" id="app">
    <div class="col-md-3">
        @include('user.sidebar')
    </div>
    <div class="col-md-9">
        <div class="row">
            <h2>Versijos keitimas</h2>
            <p class="bg-danger">Keičiant versiją bus pašalinti visi įrašyti plugin, pašalinta modifikacija bei filterscritpai.</p>
            <form method="POST" action="{{ route('gameserver.management.version.post', $gameserver->id) }}" class="form-inline">
                @include('includes.csrf')
                <label for="package" class="col-form-label">Versija</label>
                <select name="server_package_id" id="package" class="form-control">
                    @foreach($gameserver->game->server_packages as $package)
                    <option value="{{ $package->id }}">{{ $package->name }}:{{ $package->version }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Keisti</button>
            </form>
        </div>
    </div>
</div>
@stop