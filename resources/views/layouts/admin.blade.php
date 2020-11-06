<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>后台系统管理</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/tinymce/tinymce.min.js"></script>
    {{-- <script src="/js/lin_search.js"></script> --}}
    {{-- <script src="/js/admin.js"></script> --}}
    <script src="/js/article.js"></script>
    <script src="/js/product.js"></script>
    <script src="/js/attribute.js"></script>
    <script src="/js/detail.js"></script>
    <script src="/js/category.js"></script>
    <script src="/js/ad.js"></script>
    <script src="/js/manager.js"></script>
    <script src="/js/order.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top flex-md-nowrap shadow">
            <div class="container">
                <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="{{ route('admin.home') }}">后台系统管理</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
                            </li>
                            {{-- <li class="nav-item">
                                @if (Route::has('admin.register'))
                                    <a class="nav-link" href="{{ route('admin.register') }}">{{ __('Register') }}</a>
                                @endif
                            </li> --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user('admin')->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>