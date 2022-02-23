@extends('layouts.app')
@section('title','Editar perfil')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            A ocurrido un problema<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{route('updateProfile')}}">
        @csrf
        @method('PUT')
        <label>Nombre:
            <input type="text"  name="name" value="{{@Auth::user()["name"]}}">
        </label>
        <label>Correo:
            <input type="text"  name="email" value="{{@Auth::user()["email"]}}">
        </label>
        <label>Contraseña nueva:
            <input type="password"  name="password">
        </label>
        <button type="submit">Aplicar cambios</button>
    </form>
@endsection
