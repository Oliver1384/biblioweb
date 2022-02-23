@extends('layouts.app')
@section('title','Administrar préstamos')
@section('content')
    <a class="nav-link" href="{{route('adminProfile')}}">Panel de administrador</a>
    <p>Devolver libros</p>
    <table class="table table-bordered">
        <tr>
            <th>Nombre usuario</th>
            <th>Nombre libro</th>
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
