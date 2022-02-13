@extends('layouts.app')

@section('content')
    <h1>HOME</h1>
    @if(@Auth::user() !== null)
        @if(@Auth::user()->hasRole('user'))
            <h2>Eres un usuario</h2>
        @elseif(@Auth::user()->hasRole('admin'))
            <h2>Eres un administrador</h2>
        @endif
    @endif
@endsection
