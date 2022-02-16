@extends('layouts.app')

@section('content')
    <h1>Desde vista de usuario</h1>
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
                    <form class="solicitar" method="post" action="{{route('loans.store',['book'=>$book,'user'=>@Auth::user()])}}">
                        @csrf
                        <button type="submit">solicitar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
