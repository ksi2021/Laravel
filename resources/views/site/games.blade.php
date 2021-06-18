@extends('Layouts.main')


@section('content')

    <aside>23423</aside>
    <main style="max-width: 85%;">
        <h1 class="text-center">Игры</h1>
        <div id="grid" class=" rounded shadow-sm table ">

            @foreach($games as $game)
                <div class="card">
                    <a href="/game/{{$game->id}}" style="text-decoration: none !important;">
                        <img src="{{asset('/storage/' .$game->image)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h3>{{$game->title}}</h3>
                            <div
                                style="display: flex;flex-direction: row;justify-content: space-between ; font-size: 30px">

                                <div><i class="fab fa-windows"></i> <i class="fab fa-ubuntu"></i> <i
                                        class="fab fa-apple"></i></div>
                                <div>
                                    <div style="flex-direction: row; ">

                                        @if($game->newprice)
                                            <span
                                                style="color: white;background: red; border-radius: 4px;padding: 4px;">{{round(100 - ( $game->newprice / ($game->price / 100)),2)}} %</span>
                                            <span>{{$game->newprice}}</span> <sup
                                                class="  text-decoration-line-through">{{$game->price}}</sup> &#8381;
{{--                                                                                    @if(Auth::check())--}}
{{--                                                                                        <button class="btn btn-success">В корзину</button>--}}
{{--                                                                                    @endif--}}
                                        @else
                                            {{$game->price}} &#8381;
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </a>
                </div>
        @endforeach
        {{--            <div class="text-center mb-3 mt-2"> {{$games->links()}}</div>--}}

    </main>
    <div class="pagination">
        @if($c)
            {{ $games->appends(['query' => $c])->links()}}
        @else
            {{ $games->links()}}
        @endif
    </div>
@endsection
