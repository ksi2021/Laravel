@extends('Layouts.main')

@section('content')

    <div class="container my-4 login-form">
        @error('message')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <form action="/login" method="post"
              style="border: 1px solid #e2e8f0; border-radius:5px;font-weight: bolder;text-transform: uppercase;">

            <div class="header" style="font-size: 30px;background: #dee2e6; ">
                <img  src="/images/static/Logo.svg"  width="40" alt="">
                ВОЙТИ
            </div>
            <div style="padding: 10px;">
                @csrf
                <div class="form-group mt-3">
                    <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" id=""
                           placeholder="Enter email">
                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" value="{{ old('password') }}" class="form-control  @error('email') is-invalid @enderror" name="password"
                           placeholder="Enter password" id="">
                    @error('password')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">

                    <input type="checkbox" value="{{ old('remember') }}" name="remember" id="cb">
                    <label for="cb">Remember me ?</label>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-block" type="submit">ВОЙТИ</button>
                </div>
            </div>
        </form>
    </div>
@endsection

