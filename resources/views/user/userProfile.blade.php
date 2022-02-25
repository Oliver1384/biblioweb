@extends('layouts.app')

@section('content')
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    <table class="table table-bordered">
        <h1>Libros en prestamo</h1>
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Autor</th>
            <th>Editorial</th>
            <th>Categoria</th>
            <th>Fecha de fin</th>
        </tr>
        @foreach ($booksLoan as $bookLoan)
            @foreach($books as $book)
                @if($book->id === $bookLoan->book_loan_id && @Auth::user()->id === $bookLoan->user_loan_id)
                    <tr>
                        <td><img src="{{ asset('images/'.$book['image']) }}" width="100px" alt="portada del libro"></td>
                        <td>{{ $book['name']}}</td>
                        <td>{{$book['author']}}</td>
                        <td>{{$book['editorial']}}</td>
                        <td>{{$book['category']}}</td>
                        @if($bookLoan['expiration_date'] < $currentDate)
                            <td>
                                <div class="alert alert-danger">
                                    El libro ha exedido la fecha de devolución
                                    {{$bookLoan['expiration_date']}}
                                </div>
                            </td>
                        @else
                            <td>{{$bookLoan['expiration_date']}}</td>
                        @endif
                        <td>
                            <a href="{{url('/documents/designpatternsphp.pdf')}}" download onclick="return confirm('¿Quieres descargar el archivo?')">
                                <img src="{{url($book['url_pdf'])}}" alt="icono de pdf">
                            </a>
                        </td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    </table>
@endsection
