<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel</title>
    <link rel="stylesheet" href="{{ ENV('APP_URL') }}/design/libs/swiper/style.css">
    <link rel="stylesheet" href="{{ ENV('APP_URL') }}/design/libs/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="{{ ENV('APP_URL') }}/design/css/style.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.4.95/css/materialdesignicons.css">
	<link rel="stylesheet" type="text/css" href="{{ ENV('APP_URL') }}/css/style.css" media="screen">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



	<link rel="stylesheet" type="text/css" href="{{ ENV('APP_URL') }}/admin_files/css/normalize.css" media="screen">
	<link rel="stylesheet" type="text/css" href="{{ ENV('APP_URL') }}/admin_files/libs/bootstrap5/bootstrap.min.css" media="screen">
	<link rel="stylesheet icon" type="text/css" href="{{ ENV('APP_URL') }}/admin_files/css/style.css" media="screen">

    <script src="{{ ENV('APP_URL') }}/admin_files/js/ckeditor/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="{{ ENV('APP_URL') }}/admin_files/js/jquery-3.7.0.min.js"></script>
	<script src="{{ ENV('APP_URL') }}/admin_files/js/jquery.maskedinput.min.js"></script>
	<script src="{{ ENV('APP_URL') }}/admin_files/libs/bootstrap5/bootstrap.min.js"></script>
	<script src="{{ ENV('APP_URL') }}/admin_files/js/script.js?v=2"></script>

</head>

<body>

<div class="container">

	<div class="row mt-lg-5">
		<div class="col-12 col-lg-4 mx-auto">

			<div class="card bg-white bg-white py-lg-4 py-2" style="border: 0px;">

				<div class="card-body bg-white px-lg-4">


					<div class="row">

						<div class="col-12 text-center">
							<p class="h5 font-weight-bold mb-4">Авторизация в CRM</p>
						</div>

					</div>

					<form method="POST" action="{{ route('login') }}">
						@csrf

						<div class="form-group row mb-3">
							<label for="login" class="col-md-3- col-12 col-form-label text-md-right- d-lg-block- d-none">Login</label>

							<div class="col-md-9- col-12">
								<input id="login" class="form-control form-border-black @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="login" autofocus placeholder="your login" >

								@error('login')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="password" class="col-md-3- col-12 col-form-label text-md-right- d-lg-block- d-none">Password</label>

							<div class="col-md-9- col-12">
								<input id="password" type="password" class="form-control form-border-black @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="your password">

								@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-group row mb-0 mt-4 pt-2">


							<div class="col-lg-8- col-7- col-12 text-center">
                                <button type="button" style="width: 60%" class="btn btn-outline-info btn-block py-1 px-5">
                                    <i class="fas fa-info-circle"></i>
                                    <a href="{{ ENV('APP_URL') }}/register" style="color: #333; text-decoration: none;">Register</a>
                                </button>
								<button type="submit" class="btn btn-primary text-light btn-block py-1 px-5">
									Войти
								</button>

								@if (Route::has('password.request'))
									<a class="btn btn-link d-none" href="{{ route('password.request') }}">
										{{ __('Forgot Your Password?') }}
									</a>
								@endif
							</div>


						</div>


					</form>
				</div>
			</div>

		</div>
	</div>

</div>

<!-- footer start -->
<footer>

</footer>

</div>

</body>

</html>
