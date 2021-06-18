@extends('Layouts.main')

@section('content')

    <div class="my-3 p-3 bg-white rounded shadow-lg mx-auto" style="width: 98%">
        <h4 class="border-bottom border-gray pb-2 mb-0">Моя коллекция</h4>
        @foreach($items as $item)
            @foreach($products as $product)
                @if($product->id == $item->prod_id)
                    <div class="media text-muted pt-3 d-flex flex-row justify-content-between">
                        <div>
                            <img src="{{asset('/storage/' . $product->image)}}" data-holder-rendered="true"
                                 style="width: 100px; ">
                            <strong style="color: black; font-size: 20px;text-transform: uppercase"><a href="/game/{{$product->id}}"> {{$product->title}}</a>
                                </strong>

                        </div>
                        <a download href="{{asset('/storage/' .$product->image)}}"><i class="fas fa-download"></i></a>
                    </div>
                    <hr>
                @endif
            @endforeach
        @endforeach
    </div>
@endsection

