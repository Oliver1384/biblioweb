@extends('layouts.app')

@section('content')
    <h1>HOME</h1>
    @if(@Auth::user() !== null)
        @if(@Auth::user()->hasRole('user'))
            <a class="btn btn-sm btn-primary" href="{{ route('manageProfile') }}">Editar perfil</a>
            <a class="btn btn-sm btn-primary"  href="{{ url('userProfile') }}">Libros prestados</a>
        @endif
        @if(@Auth::user()->hasRole('admin'))
            <a class="btn btn-sm btn-primary"  href="{{ route('adminProfile') }}">Panel de administrador</a>
        @endif
    @endif

    <h1>Libros disponibles</h1>
    @if(isset($error))
        <p>{{$error}}</p>
    @endif
    <form action="{{ route('searchHome') }}" method="GET">
        <input type="text" name="search" required/>
        <button type="submit">Search</button>
    </form>
    <table class="table table-bordered">
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Autor</th>
            <th>Editorial</th>
            <th>Categoria</th>
            <th>Documento pdf</th>
        </tr>
    @foreach ($books as $book)
        @php
            $loan = true;
        @endphp
        @foreach ($booksLoan as $bookLoan)
            @if($book->id === $bookLoan->book_loan_id)
                @php
                    $loan = false;
                @endphp
            @endif
        @endforeach

        @if($loan)
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
            </tr>
        @endif
    @endforeach
    </table>

@endsection
