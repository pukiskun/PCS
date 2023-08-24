@extends('layouts.app')

@section('content')
    <p>{{ $code }}</p>
    <a href="{{ url('download/' . $key) }}">download</a>
    <img src="data:image/png;base64, {{ base64_encode($code) }} ">
@endsection
