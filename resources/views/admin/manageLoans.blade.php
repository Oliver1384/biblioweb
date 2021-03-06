@extends('layouts.app')
@section('title','Administrar préstamos')
@section('content')
    <div class="controls">
        <a class="btn btn-sm btn-primary" href="{{route('adminProfile')}}">Panel de administrador</a>
    </div>
    <h1>Devolver libros</h1>
    <table class="table table-bordered">
        <tr>
            <th>Correo de usuario</th>
            <th>Nombre del libro</th>
            <th>Fecha de expiración</th>
        </tr>
        @foreach ($loans as $loan)
            <tr>
                @foreach($users as $user)
                    @if($user->id === $loan->user_loan_id)
                        <td>{{ $user['email']}}</td>
                    @endif
                @endforeach
                @foreach($books as $book)
                    @if($book->id === $loan->book_loan_id)
                        <td>{{ $book['name']}}</td>
                            @if($loan['expiration_date'] < $currentDate)
                                <td>
                                    <div class="alert alert-danger">
                                        El libro ha exedido la fecha de devolución
                                        {{$loan['expiration_date']}}
                                    </div>
                                </td>
                            @else
                                <td>{{$loan['expiration_date']}}</td>
                            @endif
                    @endif
                @endforeach
                <td class="text-center">
                    <form class="inline-block" action="{{ route('loans.destroy',$loan->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Devolver</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
