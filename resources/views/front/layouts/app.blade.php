
    <!-- <a href="{{ ENV('APP_URL') }}/login">Войти</a> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Фронт</title>
    <link rel="stylesheet" href="{{ ENV('APP_URL') }}/design/libs/swiper/style.css">
    <link rel="stylesheet" href="{{ ENV('APP_URL') }}/design/libs/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{ ENV('APP_URL') }}/design/css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.4.95/css/materialdesignicons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


	<link rel="stylesheet" type="text/css" href="{{ ENV('APP_URL') }}/admin_files/css/normalize.css" media="screen">
	<link rel="stylesheet" type="text/css" href="{{ ENV('APP_URL') }}/admin_files/libs/bootstrap5/bootstrap.min.css" media="screen">
	<link rel="stylesheet icon" type="text/css" href="{{ ENV('APP_URL') }}/admin_files/css/style.css" media="screen">

    <script src="{{ ENV('APP_URL') }}/admin_files/js/ckeditor/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="{{ ENV('APP_URL') }}/admin_files/js/jquery.maskedinput.min.js"></script>
	<script src="{{ ENV('APP_URL') }}/admin_files/libs/bootstrap5/bootstrap.min.js"></script>
	<script src="{{ ENV('APP_URL') }}/admin_files/js/script.js"></script>
</head>
<body>
    <input type="hidden" id="app_url" name="app_url" value="{{ ENV('APP_URL') }}">
    <input type="hidden" id="current_url" name="current_url" value="{{ url()->current() }}">

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container container-full">
                    <a class="navbar-brand" href="{{ ENV('APP_URL') }}">
                        <p class="text-primary h4 text-uppercase">Testcase1002</p>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ ENV('APP_URL') }}/login">Войти</a>
                                </li>
                            @endguest

                            @auth
                                <li class="nav-item dropdown">
                                    <a href="#user" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                                        {{ $user->name }}
                                    </a>

                                    <ul class="list-unstyled collapse" id="user" style="">
                                        <a class="dropdown-item" href="{{ ENV('APP_URL') }}/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="mdi mdi-exit-to-app pr-1"></i>
                                            Выйти
                                        </a>
                                        <form id="logout-form" action="{{ ENV('APP_URL') }}/logout" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </ul>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
        </nav>


        <main class="d-flex align-items-center justify-content-center">
            @yield('content')
        </main>


        <footer>
        </footer>
    </div>
</body>
</html>
