@extends('Layouts.admin')

@section('section_title')Игры @endsection
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
        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use color="green" xlink:href="#check-circle-fill"/></svg>
                <div>
                    {{session('success')}}
                </div>
            </div>
        @endif
        <form action="/admin/store_product" method="post" enctype="multipart/form-data"
              style="border: 1px solid #e2e8f0; border-radius:5px;font-weight: bolder;text-transform: uppercase;">
            <div style="font-size: 30px;background: #dee2e6; ">
                <img  src="/images/static/Logo.svg"  width="40" alt=""> Add new game form
            </div>
            <div style="padding: 10px;">
                @csrf
                <img src="..." class="preview" style="max-width: 600px;max-height: 400px;" alt="preview">
                <div class="mb-3">
                    <input class="form-control" name="image" accept=".png,.jpg,.jpeg" type="file" id="formFile">
                </div>
                <div class="form-group">
                    <input type="text" value="{{ old('title') }}" placeholder="Enter title" name="title" class="form-control @error('name') is-invalid @enderror">
                    @error('title')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <textarea name="body" class="form-control @error('body') is-invalid @enderror" placeholder="Enter body" cols="30" rows="10">{{ old('body') }}</textarea>
                    @error('body')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" step="100" min="0" max="90000" value="{{ old('price') }}" placeholder="Enter price" class="form-control  @error('price') is-invalid @enderror" name="price" id="">
                    @error('price')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>



                <select class="form-select mb-3"  name="category"   class="form-control  @error('category') is-invalid @enderror" aria-label="Default select example">
                    <option selected>Select category</option>
                   @foreach($cat as $element)
                        <option value="{{$element->id}}">{{$element->name}}</option>
                    @endforeach

                </select>
                @error('category')
                <small class="text-danger">{{ $message }}</small>
                @enderror


                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-block" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <table class="my-3 p-3 mx-auto rounded shadow-sm table" style="box-shadow: 0 0 5px rgba(0,0,0,0.3) !important;width: 99%;">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">title</th>
            <th scope="col">body</th>
            <th scope="col">image</th>
            <th scope="col">price</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $el)
            <tr>
                <th scope="row">{{$el->id}}</th>
                <td>{{$el->title}}</td>
                <td>{{mb_substr($el->body,0,70)}}...</td>
                <td><img width="300" class="img-thumbnail"   src="{{asset('/storage/' . $el->image)}}" alt=""></td>
                <td>{{$el->price}} &#8381;</td>
                <td><a href="/admin/delete_product/{{$el->id}}"><i class="fas fa-trash text-danger"></i></a><a href="/admin/edit_product/{{$el->id}}"><i class="fas fa-pen-square text-info"></i></a>
                    <a href="/admin/product_view/{{$el->id}}"><i class="fas fa-eye text-success"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if(!$data)
        <h1 class="text-danger">Users not found</h1>
    @endif

    <div class="text-center mb-3"> {{$data->links()}}</div>
@endsection


@section('scripts')
    <script>
        let e = document.querySelector('#formFile');
        e.onchange = evt => {
            const [file] = e.files
            if (file) {
                document.querySelector('.preview').src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
