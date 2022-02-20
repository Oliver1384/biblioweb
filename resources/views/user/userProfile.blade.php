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
            @foreach($requestsLoan as $requestLoan)
                @if($book->id === $requestLoan->book_loan_id)
                    @php
                        $loan = false;
                    @endphp
                @endif
            @endforeach
            <tr>
                <td><img src="{{ $book['image'] }}" width="100px" alt="portada del libro"></td>
                <td>{{ $book['name']}}</td>
                <td>{{$book['author']}}</td>
                <td>{{$book['editorial']}}</td>
                <td>{{$book['category']}}</td>
                @if($loan)
                    <td class="text-center">
                        <form class="solicitar" method="post" action="{{route('requestLoans.store',['book_loan_id'=> $book->id,'user_loan_id'=>@Auth::user()->id])}}">
                            @csrf
                            @error('loan')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                            <button type="submit">solicitar</button>
                        </form>
                    </td>
                @else
                    <td class="text-center">
                       Solicitado
                    </td>
                @endif
            </tr>
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
