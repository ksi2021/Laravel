@extends('Layouts.main')

@section('content')
    <p>Это - содержимое страницы.</p>

    <form action="/register" method="post"
          style="border: 1px solid #e2e8f0; border-radius:5px;font-weight: bolder;text-transform: uppercase;">
        <div style="font-size: 30px;background: #dee2e6; max-width: 1200px;width: 100%;">
            Register form
        </div>
        <div style="padding: 10px;">
            @csrf
            <div class="form-group">
                <input type="text" placeholder="Enter username" name="name" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="email" placeholder="Enter email" class="form-control @error('email') is-invalid @enderror" name="email" id="">
                @error('email')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter password" class="form-control  @error('password') is-invalid @enderror" name="password" id="">
                @error('password')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" placeholder="Confirm password" class="form-control  @error('passwordRepeat') is-invalid @enderror" name="passwordRepeat" id="">
                @error('passwordRepeat')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-primary btn-block" type="submit">Register</button>
        </div>
    </form>
@endsection

