<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="/css/main.css">
    {{-- rating style --}}
    <style>
        .material-symbols-outlined {
          font-variation-settings:
          'FILL' 1,
          'wght' 400,
          'GRAD' 0,
          'opsz' 40
        }
        .yellow {
            color: #ffc700;
        }
        *{
            margin: 0;
            padding: 0;
        }
        .form-group-star {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .form-group-star:not(:checked) > input {
            position:absolute;
            top:-9999px;
        }
        .form-group-star:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
        }
        /* content (gambar dan warna bintangnya) */
        .form-group-star:not(:checked) > label:before {
            content: '★ ';
        }
        .form-group-star > input:checked ~ label {
            color: #ffc700;
        }
        .form-group-star:not(:checked) > label:hover,
        .form-group-star:not(:checked) > label:hover ~ label {
            color: #deb217;  
        }
        .form-group-star > input:checked + label:hover,
        .form-group-star > input:checked + label:hover ~ label,
        .form-group-star > input:checked ~ label:hover,
        .form-group-star > input:checked ~ label:hover ~ label,
        .form-group-star > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }
    </style>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('index_product') }}"><b>Product List</b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span style="font-size: 0.7rem">Welcome,</span> <b>{{ Auth::user()->name }}</b></>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->is_admin == true)
                                        <a class="dropdown-item" href="{{ route('create_product') }}">Create Product</a>
                                    @else
                                        <a class="dropdown-item" href="{{ route('show_cart') }}">Cart</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('index_order') }}">Order</a>
                                    <a class="dropdown-item" href="{{ route('show_profile') }}">Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer>
            Copyright © 2024 Salsa Nadira Putri
        </footer>
    </div>
</body>
</html>
