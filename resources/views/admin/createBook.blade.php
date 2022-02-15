@extends('layouts.app')
@section('content')
    <div>
        <button type="button" id="inicio" onClick="javascript:window.location.href='/adminProfile'">Perfil</button>
    </div>
    <p>Crear blog</p>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="createBlog" method="POST" action="{{route('books.store')}}">
        @csrf
        <div>
            <label>Imagen:
                <input type="text"  name="image">
            </label>
            <label>Nombre:
                <input type="text"  name="name">
            </label>
            <label>Autor:
                <input type="text"  name="author">
            </label>
            <label>Editorial:
                <input type="text"  name="editorial">
            </label>
            <label>Categoria:
                <input type="text"  name="category">
            </label>
            <label>Isbn:
                <input type="text"  name="isbn">
            </label>
        </div>
        <button type="submit">Crear</button>
    </form>
@endsection
