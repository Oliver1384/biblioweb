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
    <form method="POST" action="{{route('books.update',$book)}}">
        @csrf
        @method('PUT')
        <label>Imagen:
            <input type="text"  name="image" value="{{$book['image']}}">
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
        <button type="submit">Aplicar cambios</button>
    </form>
@endsection
