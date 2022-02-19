@extends('layouts.app')

@section('content')
    <h1>HOME</h1>
    @if(@Auth::user() !== null)
        @if(@Auth::user()->hasRole('user'))
            <a class="nav-link" href="{{ url('userProfile') }}">Panel de usuario</a>
        @endif
        @if(@Auth::user()->hasRole('admin'))
            <a class="nav-link" href="{{ route('adminProfile') }}">Panel de administrador</a>
        @endif
    @endif
@endsection
