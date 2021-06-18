@extends('Layouts.main')


@section('content')
    <div class="card mb-3 mt-4 mx-auto" style="width: 98%">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{asset('/storage/' . $game->image)}}"  style="width: 100%" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">{{$game->title}}</h5>
                    <p class="card-text">{{$game->body}}</p>
                    <p class="card-text "> <strong>Рейтинг: {{$rait}}/5</strong></p>
                    @if($vote)
                    <p class="card-text "> <strong>Ваша оценка: {{$vote}}</strong></p>
                    @else
                    <p class="card-text"><strong> Оцените от 1 до 5 : </strong>
                        <a href="/user/assessment/{{$game->id}}/1" class="btn btn-dark" >1</a>
                        <a href="/user/assessment/{{$game->id}}/2" class="btn btn-dark">2</a>
                        <a href="/user/assessment/{{$game->id}}/3" class="btn btn-dark">3</a>
                        <a href="/user/assessment/{{$game->id}}/4" class="btn btn-dark">4</a>
                        <a href="/user/assessment/{{$game->id}}/5" class="btn btn-dark">5</a>
                    </p>
                    @endif
                    <p>Цена:    @if($game->newprice) <small class="text-decoration-line-through">{{$game->price}}</small> <strong>{{$game->newprice}} &#8381;</strong> @else  <strong>{{$game->price}} &#8381;</strong> @endif</p>
                    @if(Auth::check()) @if($bought) <span class="text-success" style="font-weight: bold">Добавлено в корзину</span> @else  @if($sold) <span class="text-success" style="font-weight: bold">Куплено</span> @else<a href="/user/add_to_basket/{{$game->id}}" class="btn btn-success">В корзину</a>@endif @endif @endif
                </div>
            </div>
        </div>
    </div>
@endsection
