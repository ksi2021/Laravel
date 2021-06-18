@extends('Layouts.main')


@section('title') Главная
@endsection


@section('content')




    <h3 class="text-center mt-3">Рекомендуемое</h3>
    <hr style="width: 50%;height: 2px;" class="mx-auto">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators " style="top: 100%">
            @foreach($data as $id => $value)
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$id}}"
                        class=" @if($id == 0)active @endif" aria-current="@if($id == 0)true @endif"
                        aria-label="Slide {{$id+1}}"></button>
            @endforeach
        </div>

        <div class="carousel-inner" style="background: #ababab;">
            @php

                @endphp
            @foreach($data as $id => $value)
                <div class="carousel-item @if($id == 0)active @endif" style="height: 600px;">
                    <a class="a-link" href="/game/{{$value->id}}">

                        <img src="{{asset('/storage/' . $value->image)}}" style="width: 100% ;" class="d-block mx-auto"
                             alt="...">
                        <div class="carousel-caption d-none d-md-block"
                             style="display: flex;flex-direction: row;justify-content: space-between">
                            <span style="text-transform: uppercase; font-size: 50px;font-weight: bold">{{$value->title}}:  <span
                                    class="@if($value["newprice"])  text-decoration-line-through  @endif">{{$value->price}}</span>  @if($value["newprice"])  {{$value["newprice"]}}  @endif &#8381;</span>
{{--                            @if(Auth::check())--}}
{{--                                <button class="btn btn-success">В корзину</button>--}}
{{--                            @endif--}}
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Предыдущий</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Следующий</span>
        </button>
    </div>


    <div style="border-top: 2px solid #5e86ff; border-bottom:2px solid #5e86ff " class="mt-4 mb-3 p-2">
        <h4>Мы - FreeFireStore.com , вместе лучше с коллекцией игр , достпных без DRM. Почувствуйте себя как дома , если
            вы не равнодушны к играм , так же как и мы. </h4>
    </div>
    <h4 class="text-center">Распродажа</h4>
    <hr style="height: 3px; width: 50%;" class="mx-auto">
    <div id="grid" class=" rounded shadow-sm table ">
        @if($sales)
            @foreach($sales as $sale)
                <div class="card">
                    <a href="/game/{{$value->id}}" style="text-decoration: none !important;">
                        <img src="{{asset('/storage/' .$sale->image)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h3>{{$sale->title}}</h3>
                            <div
                                style="display: flex;flex-direction: row;justify-content: space-between ; font-size: 30px">

                                <div><i class="fab fa-windows"></i> <i class="fab fa-ubuntu"></i> <i
                                        class="fab fa-apple"></i></div>
                                <div>
                                    <div style="flex-direction: row; ">
                                        <span style="color: white;background: red; border-radius: 4px;padding: 4px;">{{round(100 - ( $sale['newprice'] / ($sale['price'] / 100)),2)}} %</span>
                                        <span>{{$sale['newprice']}}</span> <sup
                                            class="  text-decoration-line-through">{{$sale->price}}</sup> &#8381;
{{--                                        @if(Auth::check())--}}
{{--                                            <button class="btn btn-success">В корзину</button>--}}
{{--                                        @endif--}}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            Распродажа закончилась  <i class="far fa-grin-beam-sweat"></i>
        @endif

    </div>

    <h4 class="text-center">Бесплатные</h4>
    <hr style="height: 3px; width: 50%;" class="mx-auto">
    <div id="grid" class=" rounded shadow-sm table ">
        @if($sales)
            @foreach($free as $sale)
                <div class="card">
                    <a href="/game/{{$value->id}}" style="text-decoration: none !important;">
                        <img src="{{asset('/storage/' .$sale->image)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h3>{{$sale->title}}</h3>
                            <div
                                style="display: flex;flex-direction: row;justify-content: space-between ; font-size: 30px">

                                <div><i class="fab fa-windows"></i> <i class="fab fa-ubuntu"></i> <i
                                        class="fab fa-apple"></i></div>
                                <div>
                                    <div style="flex-direction: row; ">
                                        {{$sale->price}} &#8381;
                                        {{--                                        @if(Auth::check())--}}
                                        {{--                                            <button class="btn btn-success">В корзину</button>--}}
                                        {{--                                        @endif--}}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            Распродажа закончилась  <i class="far fa-grin-beam-sweat"></i>
        @endif

    </div>
@endsection
