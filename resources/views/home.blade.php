@extends('layouts.app')

@section('content')
    <h1>HOME</h1>
    @if(@Auth::user() !== null)
        @if(@Auth::user()->hasRole('user'))
            <a class="nav-link" href="{{ url('userProfile') }}">Panel de usuario</a>
        @endif
        @if(@Auth::user()->hasRole('admin'))
            <a class="nav-link" href="{{ route('adminProfile') }}">Panel de administrador</a>
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
        </tr>
    @foreach ($books as $book)
        @php
            $loan = true;
            $requested = true;
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
                </tr>
            @endif
        @endforeach
    </table>
    {!! $books->links() !!}
@endsection
