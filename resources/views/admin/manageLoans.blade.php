@extends('layouts.app')
@section('title','Administrar prestamos')
@section('content')
    <p>Solicitudes de prestamo</p>
    <table class="table table-bordered">
        <tr>
            <th>Nombre usuario</th>
            <th>Nombre libro</th>
        </tr>
        @foreach ($requestsLoan as $requestLoan)
            <tr>
            @foreach($users as $user)
                @if($user->id === $requestLoan->user_loan_id)
                    <td>{{ $user['email']}}</td>
                @endif
            @endforeach
            @foreach($books as $book)
                @if($book->id === $requestLoan->book_loan_id)
                        <td>{{ $book['name']}}</td>
                @endif
            @endforeach
                <td class="text-center">
                    <form class="inline-block" action="{{ route('loans.store',['id'=>$requestLoan->id,'book_loan_id'=>$requestLoan->book_loan_id,'user_loan_id'=>$requestLoan->user_loan_id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Aceptar</button>
                    </form>
                    <form class="inline-block" action="{{ route('requestLoans.destroy',$requestLoan->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Rechazar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $requestsLoan->links() !!}

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
    {!! $requestsLoan->links() !!}
@endsection
