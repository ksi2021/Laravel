@extends('Layouts.main')


@section('title') Главная
@endsection


@section('content')




    <h3 class="text-center mt-3">Рекомендуемое</h3>
    <hr style="width: 50%;height: 2px;" class="mx-auto">
    <div id="carouselExampleCaptions" class="carousel slide "  data-bs-ride="carousel">
        <div class="carousel-indicators " style="top: 100%">
            @foreach($data as $id => $value)
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$id}}"
                        class=" @if($id == 0)active @endif" aria-current="@if($id == 0)true @endif"
                        aria-label="Slide {{$id+1}}"></button>
            @endforeach
        </div>

        <div class="carousel-inner" style="background: #ababab">
            @foreach($data as $id => $value)
                <div class="carousel-item @if($id == 0)active @endif" style="height: 600px;">
                    <img src="https://i.pinimg.com/originals/35/82/21/358221b85dc0c666cbd6bf4961a260db.jpg" class="d-block w-auto mx-auto" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Метка первого слайда</h5>
                        <p>Некоторый репрезентативный заполнитель для первого слайда.</p>
                    </div>
                </div>
            @endforeach

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Предыдущий</span>
        </button>
        <button  class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Следующий</span>
        </button>
    </div>
@endsection
