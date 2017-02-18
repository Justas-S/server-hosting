@extends('layouts.master')


@section('content')
<div class="row" id="app">
    <div class="col-md-3">
        @include('user.sidebar')
    </div>
    <div class="col-md-9">
        <div class="row form-group">
            <label class="col-form-label col-md-3">Serverio statusas</label>
            <div class="col-md-4">
                <input type="checkbox" checked data-toggle="toggle" name="is_online" data-on="Įjungtas" data-off="Išjungtas" class="form-check">
            </div>
        </div>
        <hr>
        <gameserver-management-form gameserver-id="{{ $gameserver->id }}"></gameserver-management-form>
        <!-- <div class="gameserver-general-container">
            <form>
                <div class="row form-group">
                    <label class="col-form-label col-md-3" for="version">Versija</label>    
                    <div class="col-md-4">
                        <input type="text" name="version" disabled="1" id="version" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <a href="#">Keisti</a>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-form-label col-md-3" for="lang">Kalba</label>
                    <div class="col-md-4">
                        <input type="text" name="lang" id="lang" value="kalba" class="form-control" />
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-form-label col-md-3" for="map">Žemėlapis</label>
                    <div class="col-md-4">
                        <input type="text" name="map" id="map" class="form-control" />
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-form-label col-md-3" for="maxnpc">Max. NPC</label>
                    <div class="col-md-4">
                        <input type="number" id="maxnpc" name="maxnpc" class="form-control" />
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-form-label col-md-3" for="rcon">RCON slaptažodis</label>
                    <div class="col-md-4">
                        <input type="password" name="rcon" id="password" class="form-control" />
                    </div>
                    <a href="#" class="col-md-2">Rodyti</a>
                </div>
                <div class="row form-group">
                    <div class="col-md-2 offset-md-6">
                        <button type="submit" class="btn btn-primary">Atnaujinti</button>
                    </div>
                </div>
            </form> 
        </div> -->
    </div>
</div>
@stop