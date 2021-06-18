@extends('Layouts.main')
@section('content')
    @php
    $total = 0;
    $data = [];

    @endphp
    <div class="my-3 p-3 bg-white rounded shadow-lg mx-auto" style="width: 98%">
        <h6 class="border-bottom border-gray pb-2 mb-0">Корзина</h6>
        @foreach($items as $item)
            @foreach($products as $product)
                @if($product->id == $item->prod_id)
                    @php
                        $data[] = $product->id;
                        $total += $product->newprice ? $product->newprice:$product->price;
                    @endphp
                    <div class="media text-muted pt-3 d-flex flex-row justify-content-between">
                        <div>
                            <img src="{{asset('/storage/' . $product->image)}}" data-holder-rendered="true"
                                 style="width: 200px; ">
                            <strong style="color: black; font-size: 20px">{{$product->title}}
                                &nbsp;@if($product->newprice) {{$product->newprice}} @else {{$product->price}} @endif &#8381;  </strong>
                        </div>
                        <a href="/user/delete_from_basket/{{$item->id}}"><i class="fas fa-times"></i></a>
                    </div>
                    <hr>
                @endif
            @endforeach
        @endforeach
        @if($items->count() > 0)
       <h3>Total : {{$total}} &#8381;</h3>
            <form action="/user/purchase" method="post">
                @csrf
                <input type="hidden" name="games" value="{{json_encode($data)}}">
                <input type="hidden" name="basket" value="{{json_encode($items)}}">
                <button type="submit" class="btn btn-success">Купить</button>
            </form>
        @endif
    </div>
@endsection
