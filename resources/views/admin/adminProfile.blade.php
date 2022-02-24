@extends('layouts.app')
@section('content')
    <div class="controls">
        <a class="btn btn-sm btn-primary" href="{{route('createBook')}}">Agregar libro</a>
        <a class="btn btn-sm btn-primary" href="{{route('addAdmin')}}">Agregar administrador</a>
        <a class="btn btn-sm btn-primary" href="{{route('createLoans')}}">Generar préstamos</a>
        <a class="btn btn-sm btn-primary" href="{{route('manageLoans')}}">Devolver préstamos</a>
    </div>
    <h1>Libros</h1>
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
                <td><img src="{{ asset('images/'.$book['image']) }}" width="100px" alt="portada del libro"></td>
                <td>{{ $book['name']}}</td>
                <td>{{$book['author']}}</td>
                <td>{{$book['editorial']}}</td>
                <td>{{$book['category']}}</td>
                <td>
                    <a href="{{url('/documents/designpatternsphp.pdf')}}" download onclick="return confirm('¿Quieres descargar el archivo?')">
                        <img src="{{url($book['url_pdf'])}}" alt="icono de pdf">
                    </a>
                </td>
                <td class="controlsBook text-center">
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
    <style>
        .controlsBook{
            display: flex;
        }
        .controlsBook > * {
            margin: 0.5rem;
        }
    </style>
@endsection
