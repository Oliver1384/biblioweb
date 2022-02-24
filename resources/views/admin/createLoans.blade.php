@extends('layouts.app')
@section('title','Generar préstamos')
@section('content')
    <a class="nav-link" href="{{route('adminProfile')}}">Panel de administrador</a>
    <p>Panel de prestamos</p>
    <form class="inline-block" action="{{ route('loans.store') }}" method="POST">
        @csrf
        <label>Correo del usuario:
            <input type="text" name="userEmail">
        </label>
        <label>Fecha de fin:
            <input type="date"  min="{{$currentDate}}" name="expiration_date">
        </label>
        <div>
            <p>Selecciona un libro</p>
            <div>
                @foreach($books as $book)
                    @php
                        $occupied = false;
                    @endphp
                    @foreach ($loans as $loan)
                        @if($book->id === $loan->book_loan_id)
                            @php
                                $occupied = true;
                            @endphp
                        @endif
                    @endforeach
                    @if(!$occupied)
                        <label>{{$book["name"]}}
                            <input type="radio" name="book_loan_id" value="{{$book["id"]}}" checked>
                        </label>
                    @endif
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-danger">Guardar</button>
    </form>

    @if(isset($errors))
        @foreach($errors as $error)
            <p>{{$error}}</p>
        @endforeach
    @endif

@endsection
