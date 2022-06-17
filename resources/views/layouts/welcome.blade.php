<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PoliDeport</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

    <script src="{{ mix('js/app.js') }}"></script>

    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *, :after, :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg, video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-white {
            --bg-opacity: 1;
            background-color: #fff;
            background-color: rgba(255, 255, 255, var(--bg-opacity))
        }

        .bg-gray-100 {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity))
        }

        .border-gray-200 {
            --border-opacity: 1;
            border-color: #edf2f7;
            border-color: rgba(237, 242, 247, var(--border-opacity))
        }

        .border-t {
            border-top-width: 1px
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .font-semibold {
            font-weight: 600
        }

        .h-5 {
            height: 1.25rem
        }

        .h-8 {
            height: 2rem
        }

        .h-16 {
            height: 4rem
        }

        .text-sm {
            font-size: .875rem
        }

        .text-lg {
            font-size: 1.125rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .ml-1 {
            margin-left: .25rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-8 {
            margin-top: 2rem
        }

        .ml-12 {
            margin-left: 3rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .overflow-hidden {
            overflow: hidden
        }

        .p-6 {
            padding: 1.5rem
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .fixed {
            position: fixed
        }

        .relative {
            position: relative
        }

        .top-0 {
            top: 0
        }

        .right-0 {
            right: 0
        }

        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)
        }

        .text-center {
            text-align: center
        }

        .text-gray-200 {
            --text-opacity: 1;
            color: #edf2f7;
            color: rgba(237, 242, 247, var(--text-opacity))
        }

        .text-gray-300 {
            --text-opacity: 1;
            color: #e2e8f0;
            color: rgba(226, 232, 240, var(--text-opacity))
        }

        .text-gray-400 {
            --text-opacity: 1;
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--text-opacity))
        }

        .text-gray-500 {
            --text-opacity: 1;
            color: #a0aec0;
            color: rgba(160, 174, 192, var(--text-opacity))
        }

        .text-gray-600 {
            --text-opacity: 1;
            color: #718096;
            color: rgba(113, 128, 150, var(--text-opacity))
        }

        .text-gray-700 {
            --text-opacity: 1;
            color: #4a5568;
            color: rgba(74, 85, 104, var(--text-opacity))
        }

        .text-gray-900 {
            --text-opacity: 1;
            color: #1a202c;
            color: rgba(26, 32, 44, var(--text-opacity))
        }

        .underline {
            text-decoration: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-5 {
            width: 1.25rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .grid-cols-1 {
            grid-template-columns:repeat(1, minmax(0, 1fr))
        }

        @media (min-width: 640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width: 768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns:repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width: 1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme: dark) {
            .dark\:bg-gray-800 {
                --bg-opacity: 1;
                background-color: #2d3748;
                background-color: rgba(45, 55, 72, var(--bg-opacity))
            }

            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }

            .dark\:border-gray-700 {
                --border-opacity: 1;
                border-color: #4a5568;
                border-color: rgba(74, 85, 104, var(--border-opacity))
            }

            .dark\:text-white {
                --text-opacity: 1;
                color: #fff;
                color: rgba(255, 255, 255, var(--text-opacity))
            }

            .dark\:text-gray-400 {
                --text-opacity: 1;
                color: #cbd5e0;
                color: rgba(203, 213, 224, var(--text-opacity))
            }

            .dark\:text-gray-500 {
                --tw-text-opacity: 1;
                color: #6b7280;
                color: rgba(107, 114, 128, var(--tw-text-opacity))
            }
        }
    </style>

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
</head>
<body>
<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <div class="container-logo flex mr-2">
                <a @if(Auth::guest()) href="{{ route('home') }}" @else href="{{ route('home') }}"
                   @endif class="d-flex align-items-center mb-2 mb-lg-0 text-decoration-none">
                    <img src="{{ asset('images/principal-logo.png') }}" class="navbar-logo"
                         alt="{{ __('principal-logo') }}">
                </a>
                <p class="logo-title">POLIDEPORT</p>
            </div>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                @if(Auth::check() && Auth::user()->roles()->first()->name === 'Super Admin')
                    <div class="dropdown mr-2">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle"
                           id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">{{ __('Lists') }}</a>
                        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="{{ route('user.list') }}"><i
                                        class="fa-solid fa-users"></i> {{ __('User list') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('product.list') }}"><i
                                        class="fas fa-stream"></i> {{__('Product list')}}</a></li>
                        </ul>
                    </div>
                    <div class="dropdown mr-2">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle"
                           id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">{{ __('Create') }}</a>
                        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item"
                                   href="{{ route('show.create.user', ['role' => 'admin']) }}"><i
                                        class="fa-solid fa-user"></i> {{ __('Create Admin') }} </a></li>
                            <li><a class="dropdown-item"
                                   href="{{ route('show.create.user', ['role' => 'client']) }}"><i
                                        class="fa-solid fa-user"></i> {{ __('Create Client') }} </a></li>
                            <li><a class="dropdown-item" href="{{ route('show.create.product') }}"><i
                                        class="fa-solid fa-square-plus"></i> {{ __('Create Product') }} </a></li>
                        </ul>
                    </div>
                @elseif(Auth::check() && Auth::user()->roles()->first()->name === 'Admin')
                    <div class="dropdown mr-2">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle"
                           id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">{{ __('Lists') }}</a>
                        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="{{ route('user.list') }}"><i
                                        class="fa-solid fa-users"></i> {{ __('Users list') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('product.list') }}"><i
                                        class="fas fa-stream"></i> {{__('Product list')}}</a></li>
                        </ul>
                    </div>
                    <div class="dropdown mr-2">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle"
                           id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">{{ __('Create') }}</a>
                        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                            <li>
                                <a class="dropdown-item" href="{{ route('show.create.user', ['role' => 'client']) }}"><i class="fa-solid fa-user"></i> {{ __('Create Client') }} </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('show.create.product') }}"><i class="fa-solid fa-square-plus"></i> {{ __('Create Product') }} </a>
                            </li>
                        </ul>
                    </div>
                @elseif(Auth::check() && Auth::user()->roles()->first()->name === 'Client' || Auth::guest())
                    <li class="nav-link px-2 link-secondary mr-2">
                        <a href="{{ route('home') }}"><i class="fa-solid fa-shop"></i> {{ __('Shop') }}</a>
                    </li>
                @endif
            </ul>
            @if(Auth::check() && Auth::user()->roles()->first()->name === 'Client')
                <div class="dropdown text-end mr-2">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownCart1"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('images/shopping_cart.png') }}" class="w2-5">
                    </a>
                    <ul class="dropdown-menu" id="shopping-cart" aria-labelledby="dropdownCart1">
                        <hr>
                        <div class="dropdown-item">
                            Total: <span id="total">0.00</span>€
                        </div>
                    </ul>
                </div>
            @endif
            <div class="dropdown text-end ml-4">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    @if(Auth::guest() || !isset(Auth::user()->getMedia('avatars')[0]))
                        <img src="{{ asset('images/user.png') }}" class="rounded-circle w2-5"
                             alt="{{ __('user_image') }}"/>
                    @else
                        <img src="{{ Auth::user()->getMedia('avatars')->last()->getUrl('thumb') }}"
                             class="rounded-circle w2-5" alt="{{ __('user_image') }}"/>
                    @endif
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                    @guest
                        @if (Route::has('login'))
                            <li>
                                <a href="{{ route('login') }}" class="dropdown-item"><i
                                        class="fa-solid fa-arrow-right-to-bracket"></i> {{ __('Log in') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li>
                                <a href="{{ route('register') }}" class="dropdown-item"><i
                                        class="fa-solid fa-user"></i> {{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li>
                            <a href="{{ route('show.mydata') }}" class="dropdown-item"><i
                                    class="fas fa-user-cog"></i> {{ __('My Data') }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item" onclick="document.getElementById('logout-form').submit();"><i
                                    class="fa-solid fa-arrow-right-from-bracket"></i> {{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</header>
@yield('content')
<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <span class="text-muted">© 2022 PoliDeport</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-muted" href="#"><i class="fa-brands fa-instagram"></i></a></li>
            <li class="ms-3"><a class="text-muted" href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
            <li class="ms-3"><a class="text-muted" href="#"><i class="fa-brands fa-twitter"></i></a></li>
        </ul>
    </footer>
</div>
<!-- Script-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="https://fastly.jsdelivr.net/npm/echarts@5.3.2/dist/echarts.min.js"></script>
<script src="{{ asset('js/components.js') }}"></script>

<!-- DataTables -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.5/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
@stack('scripts')
@stack('alertScripts')
</body>
</html>
