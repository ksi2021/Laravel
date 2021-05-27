@extends('Layouts.main')

@section('content')
    <p>Это - содержимое страницы.</p>
    {{$e}}


    <form action="auth" method="post">
        @csrf
        <input type="text" name="name"  class="form-control @error('name') is-invalid @enderror">
        @error('name')
        <small class="text-danger">{{ $message }}</small>
        @enderror
        <input type="text" class="form-control" name="email" id="">
        <input type="text" class="form-control" name="password" id="">
        <button class="btn btn-primary" type="submit">go</button>
    </form>
@stop

