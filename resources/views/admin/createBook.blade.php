@extends('layouts.app')
@section('content')
    <a class="btn btn-sm btn-primary" href="{{route('adminProfile')}}">Panel de administrador</a>
    <h1>Crear blog</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
             A ocurrido un problema con los campos.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="createBlog" method="POST" action="{{route('books.store')}}" enctype="multipart/form-data">
        @csrf

            <label>Imagen:
                <input type="file" name="image" value="{{old('image')}}">
            </label>
            <label>Nombre:
                <input type="text"  name="name" value="{{old('name')}}">
            </label>
            <label>Autor:
                <input type="text"  name="author" value="{{old('author')}}">
            </label>
            <label>Editorial:
                <input type="text"  name="editorial" value="{{old('editorial')}}">
            </label>
            <label>Categoria:
                <input type="text"  name="category" value="{{old('category')}}">
            </label>
            <label>Isbn:
                <input type="text"  name="isbn" value="{{old('isbn')}}">
            </label>

        <button class="btn btn-sm btn-primary" type="submit">Crear</button>
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
