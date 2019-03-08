@extends('layout.layout')
@section('content')
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <h2>Algorithm output here</h2>
@endsection
