@extends('layouts.master')


@section('content')
    {{ Auth::user() }}
@stop