@extends('layouts.front.app')
@section('css')
<title>Pay-Now</title>
@stop
@section('content')
<form method="post" action="{{ $payuEndpoint }}">
    @csrf
    @foreach ($params as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
    <button type="submit">Pay Now</button>
</form>

@stop
@section('js')
@stop