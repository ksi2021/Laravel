@extends('Layouts.admin')


@section('content')


    <div class="  login-form">
        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use color="green" xlink:href="#check-circle-fill"/></svg>
                <div>
                    {{session('success')}}
                </div>
            </div>
        @endif
        <form action="/admin/product_update" method="post" enctype="multipart/form-data"
              style="border: 1px solid #e2e8f0; border-radius:5px;font-weight: bolder;text-transform: uppercase;">
            <div style="font-size: 30px;background: #dee2e6; ">
                <img  src="/images/static/Logo.svg"  width="60" alt=""> Update record
            </div>
            <div style="padding: 10px;">
                @csrf
                <img src="..." style="max-width: 600px;max-height: 400px;" class="preview mb-3" alt="preview">
                <div class="mb-3">
                    <input class="form-control" onchange="loadFile(event)" name="image" accept=".png,.jpg,.jpeg" type="file" id="formFile">
                </div>
                <div class="form-group">
                    <input type="text" value="{{$data->title}}" placeholder="Enter title" name="title" class="form-control @error('name') is-invalid @enderror">
                    @error('title')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <textarea name="body" class="form-control @error('body') is-invalid @enderror" placeholder="Enter body" cols="30" rows="10">{{$data->body}}</textarea>
                    @error('body')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" step="100" min="0" max="90000" value="{{$data->price}}" placeholder="Enter price" class="form-control  @error('price') is-invalid @enderror" name="price" id="">
                    @error('price')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <input type="hidden" name="id" value="{{$data->id}}">


                <select class="form-select mb-3"  name="category"   class="form-control  @error('category') is-invalid @enderror" aria-label="Default select example">
                    <option value="{{$data->category_id}}" selected>{{\App\Models\Category::query()->where(['id' => $data->category_id])->first()->name}}</option>

                    @foreach($cat as $element)

                        <option value="{{$element->id}}">{{$element->name}}</option>

                    @endforeach

                </select>

                @error('category')
                <small class="text-danger">{{ $message }}</small>
                @enderror


                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-block" type="submit">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        var loadFile = function(event) {
            var output = document.getElementsByClassName('preview')[0];

            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endsection
