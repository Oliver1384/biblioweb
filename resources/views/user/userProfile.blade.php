@extends('layouts.app')

@section('content')
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
    <h1>Panel de usuario</h1>
    <form action="{{ route('searchUserProfile') }}" method="GET">
        <input type="text" name="search" required/>
        <button type="submit">Search</button>
    </form>
    @if(isset($error))
        <p>{{$error}}</p>
    @endif
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
    <table class="table table-bordered">
        <h1>Libros en prestamo</h1>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Autor</th>
            <th>Editorial</th>
            <th>Categoria</th>
        </tr>
        @foreach ($booksLoan as $bookLoan)
            @foreach($books as $book)
                @if($book->id === $bookLoan->book_loan_id && @Auth::user()->id === $bookLoan->user_loan_id)
                    <tr>
                        <td><img src="{{ $book['image'] }}" width="100px" alt="portada del libro"></td>
                        <td>{{ $book['name']}}</td>
                        <td>{{$book['author']}}</td>
                        <td>{{$book['editorial']}}</td>
                        <td>{{$book['category']}}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    </table>
    {!! $booksLoan->links() !!}

@endsection
