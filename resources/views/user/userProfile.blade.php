@extends('layouts.app')

@section('content')
    <h1>Desde vista de usuario</h1>
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
            @endphp

            @foreach($booksLoan as $bookLoan)
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
                    <td class="text-center">
                        <form class="solicitar" method="post" action="{{route('loans.store',['book_loan_id'=> $book->id,'user_loan_id'=>@Auth::user()->id])}}">
                            @csrf
                            @error('loan')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                            <button type="submit">solicitar</button>
                        </form>
                    </td>
                </tr>
            @endif
        @endforeach
    </table>
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
                @if($book->id === $bookLoan->book_loan_id)
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
@endsection
