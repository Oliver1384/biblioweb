@extends('layouts.app')
@section('title','Generar préstamos')
@section('content')
    @if(isset($errors))
        @foreach($errors as $error)
            <div class="alert alert-danger">
                {{$error}}
            </div>
        @endforeach
    @endif
    <a class="btn btn-sm btn-primary" href="{{route('adminProfile')}}">Panel de administrador</a>
    <h1>Panel de prestamos</h1>
    <form class="inline-block" action="{{ route('loans.store') }}" method="POST">
        @csrf
        <div class="selectBooks">
            <div>
                @foreach ($loans as $loan)
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
                                <input type="radio" name="book_loan_id" value="{{$book["id"]}}">
                            </label>
                        @endif
                    @endforeach
                @endforeach
            </div>
            {{$books->links()}}
        </div>
        <label>Correo del usuario:
            <input type="text" name="userEmail" value="{{old('userEmail')}}">
        </label>
        <label>Fecha de fin:
            <input type="date"  min="{{$currentDate}}" name="expiration_date">
        </label>
        <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
    </form>
    <style>
        form {
            padding: 1.5rem;
            background-color: #6FC4E8;
            border-radius: 6px 6px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            color:white;
        }
        form > * {
            margin: 0.5rem;
            display:flex;
            justify-content: center;
        }
        input {
            margin-left: 0.5rem;
        }
        button {
            max-width: 150px;
            grid-area: 3 / 1 /  4 / 3;
            justify-self: center;
            margin-top: 1.5rem;
        }

        .selectBooks {
            border-radius: 6px 6px;
            border: 2px solid #6FE8CA;
            display: flex;
            flex-direction: column;
            grid-area: 1 / 1 /  2 / 3;
        }
        .selectBooks > * {
            text-align: center;
        }

        .selectBooks label {
            border: 2px solid #6FE8CA;
            padding: 0.5rem;
            border-radius: 6px 6px;
            margin: 0.5rem;
        }
    </style>
@endsection
