@extends('Layouts.admin')

@section('section_title')Обзор записи @endsection

@section('content')
    <div class="btn-group mb-3" role="group" style="text-align: center; align-items: center; align-content: center;" aria-label="Basic example">
{{--        <a  onclick="GoBack()" class="btn btn-info text-light"><i  class="fas fa-caret-left"></i></a>--}}
        <a href="/admin/edit_product/{{$data->id}}" class="btn btn-primary text-light"><i class="fas fa-pencil-alt"></i></a>
        <a href="/admin/destroy_product/{{$data->id}}"  class="btn btn-danger text-light"><i class="fas fa-trash"></i></a>
    </div>

    <table class="Mytable table table-bordered border-primary" style="">

        <tr>
            <th>#</th>
            <td>{{$data->id}}</td>

        </tr>
        <tr>
            <th>Title</th>
            <td>{{$data->title}}</td>

        </tr>
        <tr >
            <th>Body</th>
            <td style="word-wrap: break-word; /* Перенос слов */ "> <div style="word-wrap: break-word;  white-space: pre-line;max-width: 100vh;">{{$data->body}}</div></td>

        </tr>
        <tr>
            <th>Price</th>
            <td>{{$data->price}}</td>

        </tr>
        <tr >
            <th >Image</th>
            <td ><img src=" {{ asset('/storage/' .$data->image)}}" style="max-width: 100vh"  class="img-thumbnail"  alt=""></td>

        </tr>

    </table>
    </div>
@endsection

@section('scripts')
    <script>
        function GoBack(){
            window.history.back();
        }
    </script>
@endsection
