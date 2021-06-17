@extends('Layouts.admin')


@section('content')


    <div class="  login-form">
        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use color="green" xlink:href="#check-circle-fill"/>
                </svg>
                <div>
                    {{session('success')}}
                </div>
            </div>
        @endif
        <form action="/admin/user_update" method="post" enctype="multipart/form-data"
              style="border: 1px solid #e2e8f0; border-radius:5px;font-weight: bolder;text-transform: uppercase;">
            <div style="font-size: 30px;background: #dee2e6; ">
                <img  src="/images/static/Logo.svg"  width="40" alt="">
                Update record
            </div>
            <div style="padding: 10px;">
                @csrf

                <div class="form-group">
                    <input type="text" value="{{$user->username}}" placeholder="Enter username" name="username"
                           class="form-control @error('username') is-invalid @enderror">
                    @error('username')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Enter email" value="{{$user->email}}"
                           class="form-control @error('email') is-invalid @enderror" v id="">
                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Enter password" name="password"
                           class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <select  name="status"
                        class="form-control  @error('status') is-invalid @enderror"
                        aria-label="Default select example">
                    <option selected value="{{$user->status}}">{{$user->status}}</option>
                    <option  value="@if($user->status == 'admin')user @else admin @endif">@if($user->status == 'admin')user @else admin @endif</option>
                </select>
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-block" type="submit">Save</button>
                </div>


            </div>
        </form>
    </div>
@endsection

@section('scripts')

@endsection
