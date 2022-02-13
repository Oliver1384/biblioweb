@extends('layouts.app')

@section('content')
    <h1>HOME</h1>
    @if(@Auth::user() !== null)
        @if(@Auth::user()->hasRole('user'))
            <a class="nav-link" href="{{ route('userProfile') }}">Cuenta</a>
        @elseif(@Auth::user()->hasRole('admin'))
            <a class="nav-link" href="{{ route('adminProfile') }}">Cuenta</a>
        @endif
    @endif
@endsection
