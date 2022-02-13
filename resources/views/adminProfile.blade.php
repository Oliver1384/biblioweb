@extends('layouts.app')
@section('content')
    <h1>Desde vista de administrador</h1>
    <a class="nav-link" href="{{route('createBook')}}">Agregar libro</a>
    <table class="table table-bordered">
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Autor</th>
            <th>Editorial</th>
            <th>Categoria</th>
        </tr>
        @foreach ($books as $book)
            <tr>
                <td><img src="{{ $book['image'] }}" width="100px" alt="portada del libro"></td>
                <td>{{ $book['name']}}</td>
                <td>{{$book['author']}}</td>
                <td>{{$book['editorial']}}</td>
                <td>{{$book['category']}}</td>
                <td class="text-center">
                    <a class="btn btn-sm btn-info" href="">Mostrar</a>
                    <a class="btn btn-sm btn-primary" href="">Editar</a>
                    <form class="inline-block" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
