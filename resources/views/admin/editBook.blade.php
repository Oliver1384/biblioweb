@extends('layouts.app')
@section('title','Modificar libro')
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
    <form method="POST" action="{{route('books.update',$book)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label>Imagen:
            <input type="file" name="image">
        </label>
        <label>Nombre:
            <input type="text"  name="name" value="{{$book['name']}}">
        </label>
        <label>Autor:
            <input type="text"  name="author" value="{{$book['author']}}">
        </label>
        <label>Editorial:
            <input type="text"  name="editorial" value="{{$book['editorial']}}">
        </label>
        <label>Categoria:
            <input type="text"  name="category" value="{{$book["category"]}}">
        </label>
        <label>Isbn:
            <input type="text"  name="isbn" value="{{$book["isbn"]}}">
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
            grid-area: 4 / 1 /  5 / 3;
            justify-self: center;
            margin-top: 1.5rem;
        }
    </style>
@endsection
