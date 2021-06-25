@extends('Layouts.main')
@section('links')
    <link rel="stylesheet" href="/css/card-js.min.css">
@endsection
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
                <a data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-success">Оформить заказ</a>

        @endif
    </div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Оплата заказа: {{$total}} &#8381;</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-js" id="my-card" data-capture-name="true">
                        <input class="e card-number my-custom-class" name="card-number">
                        <input class="e name" id="the-card-name-id" name="card-holders-name" placeholder="Name on card">
                        <input class="e expiry-month" name="expiry-month">
                        <input class="e expiry-year" name="expiry-year">
                        <input class="e cvc" name="cvc">
                    </div>
                    <form action="/user/purchase" class="mt-4" method="post">
                        @csrf
                        <input type="hidden" name="card_info">
                        <input type="hidden" name="games" value="{{json_encode($data)}}">
                        <input type="hidden" name="basket" value="{{json_encode($items)}}">
                        <button type="submit" class="btn btn-success btn-lg w-100 pay">Оплатить</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/card-js.min.js"></script>
    <script>

        $('.pay').on('click',function(e){
            let cvc = $("input[name='cvc']")[0].value;
            let name = $("input[name='card-holders-name']")[0].value;
            let card_number = $("input[name='card-number']")[0].value;
            let expiry_month = $("input[name='expiry-month']")[0].value;
            let expiry_year = $("input[name='expiry-year']")[0].value;
            if(cvc.length >= 3 && name.length > 0 && card_number.length >= 11 && expiry_month.length >= 1 && expiry_year.length == 2){

            }
           else{
               console.log(cvc.length);
               console.log(name.length);
               console.log(card_number.length);
               console.log(expiry_month.length);
               console.log(expiry_year.length);
               e.preventDefault();
            }

        });

      // console.log(e.toArray());



    </script>
@endsection
