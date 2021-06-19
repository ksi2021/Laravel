@extends('Layouts.main')

@section('content')

<div class="container my-4 login-form">
    <form action="/register" method="post"
          style="border: 1px solid #e2e8f0; border-radius:5px;font-weight: bolder;text-transform: uppercase;">
        <div style="font-size: 30px;background: #dee2e6; ">
            Регистрация
        </div>
        <div style="padding: 10px;">
            @csrf
            <div class="form-group">
                <input type="text" value="{{ old('name') }}" placeholder="Enter username" name="name" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="email" value="{{ old('email') }}" placeholder="Enter email" class="form-control @error('email') is-invalid @enderror" name="email" id="">
                @error('email')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" value="{{ old('password') }}" placeholder="Enter password" class="form-control  @error('password') is-invalid @enderror" name="password" id="">
                @error('password')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" value="{{ old('passwordRepeat') }}" placeholder="Confirm password" class="form-control  @error('passwordRepeat') is-invalid @enderror" name="passwordRepeat" id="">
                @error('passwordRepeat')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-primary btn-block" type="submit">РЕГИСТРАЦИЯ</button>
            </div>
        </div>
    </form>
</div>
@endsection

