@extends('layouts.app')
@section('content')
    <a class="nav-link" href="{{route('adminProfile')}}">Panel de administrador</a>
    <p>Crear blog</p>
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
        <div>
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
        </div>
        <button type="submit">Crear</button>
    </form>
@endsection
