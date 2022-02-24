@extends('layouts.app')
@section('content')
    <a class="btn btn-sm btn-primary" href="{{route('adminProfile')}}">Panel de administrador</a>
    <table class="table table-bordered">
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Correo</th>
        </tr>
        @foreach ($users as $user)
            @if(count($user->getRoleNames()) != 2)
                <tr>
                    <td>{{ $user['name']}}</td>
                    <td>{{$user['email']}}</td>
                    <td class="text-center">
                        <form method="post" action="{{route('admin.store',['userId'=>$user['id']])}}">
                            @csrf
                            @error('addAdmin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <button type="submit">Agregar</button>
                        </form>
                    </td>
                </tr>
            @endif
    @endforeach
@endsection
