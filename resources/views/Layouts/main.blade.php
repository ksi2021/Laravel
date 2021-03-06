<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') || Free Fire Store</title>
    <meta charset="keywords" content="Цифровой магазин игр FreeFireStore, магазин игр FreeFireStore,магазин игр в Томске">
    <meta charset="description" content="Онлайн-сервис цифрового распространения компьютерных игр FreeFireStore">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    @yield('links')

    <link rel="shortcut icon" href="/images/static/Logo.png" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
            integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
            crossorigin="anonymous"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="/images/static/Logo.png" alt="" width="50" HEIGHT="50" class="d-inline-block align-text-top">
            {{--            FREE FIRE STORE--}}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Магазин
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="/games?query=new">Новые игры</a></li>
                        <li><a class="dropdown-item" href="/games?query=sale">Со скидкой</a></li>
                        <li><a class="dropdown-item" href="/games">Все игры</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Сообщество
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Vk</a></li>
                        <li><a class="dropdown-item" href="#">Facebook</a></li>
                        <li><a class="dropdown-item" href="#">Twitter</a></li>
                        <li><a class="dropdown-item" href="#">Instagram</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">

                    @if (!Auth::check())
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Войти
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/login">ВОЙТИ</a></li>
                            <li><a class="dropdown-item" href="/register">СОЗДАТЬ УЧЕТНУЮ ЗАПИСЬ</a></li>

                        </ul>
                    @else
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{Auth::user()->username}}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            @if(Auth::user()->status == 'admin')
                                <li><a class="dropdown-item" href="/admin">Admin</a></li>
                            @endif
                                                        <li><a class="dropdown-item" href="/user/profile">Ваш профиль</a></li>
                            <li><a class="dropdown-item" href="/user/games">Игры</a></li>
                            {{--                            <li><a class="dropdown-item" href="#">Чат</a></li>--}}
                            {{--                            <li> <a class="dropdown-item" href="#">Друзья</a></li>--}}
                            <li><a class="dropdown-item" href="/user/logout">Выйти</a></li>
                        </ul>
                    @endif
                </li>
            </ul>
            <div style="display: flex;flex-direction: column; max-width: 240px;margin-bottom: -10px">
                <input class="form-control form-control-dark search" type="text" placeholder="Search"
                       aria-label="Search">
                <ul class="list list-group"
                    style="position: absolute;z-index: 99;top:70px;max-height: 500px;overflow-y: auto;max-width:800px;">

                </ul>
            </div>
            <div style="width: 50px;margin-left: auto;">

                @if(Auth::check())
                    <a href="/user/basket" style="text-decoration: none;margin-right: 10px; color: gray">
                        <i class="fas fa-shopping-cart"></i> {{\App\Models\basket::where('user_id',Auth::user()->id)->count()}}
                    </a>
                @endif
            </div>

        </div>

    </div>
</nav>


@yield('content')
<footer class="page-footer font-small  pt-4 " style="background: #e0e0e0">
    <div class="container">
        <ul class="list-unstyled list-inline text-center">
            <li class="list-inline-item">
                <a class="btn-floating btn-fb mx-1">
                    <i class="fab fa-facebook-f"> </i>
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn-floating btn-tw mx-1">
                    <i class="fab fa-twitter"> </i>
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn-floating btn-gplus mx-1">
                    <i class="fab fa-google-plus-g"> </i>
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn-floating btn-li mx-1">
                    <i class="fab fa-linkedin-in"> </i>
                </a>
            </li>
            <li class="list-inline-item">
                <a class="btn-floating btn-dribbble mx-1">
                    <i class="fab fa-dribbble"> </i>
                </a>
            </li>
        </ul>
    </div>
    <div class="footer-copyright text-center py-3" style="background: darkgrey; color: white;font-size: 25px;">
        © 2020 Copyright:
        <a href="/"> FreeFireStore.com</a>
    </div>
</footer>
<script src="/js/search.js"></script>
@yield('scripts')
</body>
</html>
