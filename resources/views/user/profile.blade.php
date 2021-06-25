@extends('Layouts.main')


@section('content')
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
    </svg>

    <div class="container">
    <table class="Mytable table table-bordered border-primary" >

        <tr>
            <th style="background: blue; color:white;">#</th>
            <td>{{Auth::user()->id}}</td>

        </tr>
        <tr >
            <th style="background: blue; color:white;">Username</th>
            <td>{{Auth::user()->username}}</td>

        </tr>
        <tr >
            <th style="background: blue; color:white;">Email</th>
            <td style="word-wrap: break-word; /* Перенос слов */ "> <div style="word-wrap: break-word;  white-space: pre-line;max-width: 100vh;">{{Auth::user()->email}}</div></td>

        </tr>
        <tr>
            <th style="background: blue; color:white;">Role</th>
            <td>{{Auth::user()->status}}</td>

        </tr>


    </table>

        @if(session('success'))

        @endif
        <div class="container my-4 login-form">
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use color="green" xlink:href="#check-circle-fill"/></svg>
                    <div>
                        {{session('success')}}
                    </div>
                </div>
            @endif

               @error('state_')
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use color="red" xlink:href="#exclamation-triangle-fill"/></svg>
                        <div>
                            {{$message}}
                        </div>
                    </div>
                @enderror
            <form action="/user/edit" method="post"
                  style="border: 1px solid #e2e8f0; border-radius:5px;font-weight: bolder;text-transform: uppercase;">
                <div style="font-size: 30px;background: #dee2e6; ">
                    Обновление данных
                </div>
                <div style="padding: 10px;">
                    @csrf
                    <div class="form-group">
                        <input type="text"placeholder="Enter new username" name="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="email"  placeholder="Enter new email" class="form-control @error('email') is-invalid @enderror" name="email" id="">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" value="" placeholder="Enter new password" class="form-control  @error('password') is-invalid @enderror" name="password" id="">
                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" value="" placeholder="Enter current password" class="form-control  @error('current_pass') is-invalid @enderror" name="current_pass" id="">
                        @error('current_pass')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-block" type="submit">Cохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
