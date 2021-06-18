@extends('Layouts.admin')

@section('section_title')Покупки @endsection
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
    <div class="  login-form">

    </div>
    <table class="my-3 p-3 mx-auto rounded shadow-sm table" style="box-shadow: 0 0 5px rgba(0,0,0,0.3) !important;width: 99%;">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">product</th>
            <th scope="col">buyer</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($data as $el)
            <tr>
                <th scope="row">{{$el->id}}</th>
                <th scope="row"><a href="/game/{{$el->id}}">{{\App\Models\Product::where('id',$el->prod_id)->first()['title']}}</a> </th>
                <th scope="row">{{\App\Models\User::where('id' , $el->user_id)->first()['username']}}</th>
                <td><a href="/admin/delete_order/{{$el->id}}"><i class="fas fa-trash text-danger"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if(!$data)
        <h1 class="text-danger">Users not found</h1>
    @endif

    <div class="text-center mb-3"> {{$data->links()}}</div>
@endsection