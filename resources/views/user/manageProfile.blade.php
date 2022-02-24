@extends('layouts.app')
@section('title','Editar perfil')
@section('content')
    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger">
            A ocurrido un problema<br><br>
            <ul>
                @foreach ($errors as $error)
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
        <label>Contraseña:
            <input type="password"  name="password">
        </label>
        <label>Confirmar:
            <input type="password"  name="password2">
        </label>
        <button class="btn btn-sm btn-primary" type="submit">Aplicar cambios</button>
    </form>
    <style>
        form {
            padding: 1.5rem;
            background-color: #6FC4E8;
            border-radius: 6px 6px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            color:white;
        }
        form > * {
            margin: 0.5rem;
            display:flex;
            justify-content: center;
        }
        input {
            margin-left: 0.5rem;
        }
        button {
            max-width: 150px;
            grid-area: 3 / 1 /  4 / 3;
            justify-self: center;
            margin-top: 1.5rem;
        }
    </style>
@endsection
