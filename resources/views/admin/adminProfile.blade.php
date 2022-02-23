@extends('layouts.app')
@section('content')
    <h1>Desde vista de administrador</h1>
    <a class="nav-link" href="{{route('createBook')}}">Agregar libro</a>
    <a class="nav-link" href="{{route('addAdmin')}}">Agregar administrador</a>
    <a class="nav-link" href="{{route('createLoans')}}">Generar préstamos</a>
    <a class="nav-link" href="{{route('manageLoans')}}">Administrar préstamos</a>

    <table class="table table-bordered">
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Autor</th>
            <th>Editorial</th>
            <th>Categoria</th>
            <th>Documento</th>
        </tr>
        @foreach ($books as $book)
            <tr>
                <td><img src="{{ $book['image'] }}" width="100px" alt="portada del libro"></td>
                <td>{{ $book['name']}}</td>
                <td>{{$book['author']}}</td>
                <td>{{$book['editorial']}}</td>
                <td>{{$book['category']}}</td>
                <td>
                    <a href="{{url('/documents/designpatternsphp.pdf')}}" download onclick="return confirm('¿Quieres descargar el archivo?')">
                        <img src="{{url($book['url_pdf'])}}" alt="icono de pdf">
                    </a>
                </td>
                <td class="text-center">
                    <a class="btn btn-sm btn-primary" href="{{ route('books.edit',$book->id) }}">Editar</a>
                    <form class="inline-block" action="{{ route('books.destroy',$book->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('¿Estás seguro de querer eliminar el libro?')" type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $books->links() !!}
@endsection
