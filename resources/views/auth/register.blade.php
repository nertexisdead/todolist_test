<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel</title>
    <link rel="stylesheet" href="{{ ENV('APP_URL') }}/admin_files/libs/bootstrap5/bootstrap.min.css">
    <link rel="stylesheet" href="{{ ENV('APP_URL') }}/admin_files/css/style.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.4.95/css/materialdesignicons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



	<link rel="stylesheet" type="text/css" href="{{ ENV('APP_URL') }}/admin_files/css/normalize.css" media="screen">
	<link rel="stylesheet" type="text/css" href="{{ ENV('APP_URL') }}/admin_files/libs/bootstrap5/bootstrap.min.css" media="screen">

    <script src="{{ ENV('APP_URL') }}/admin_files/js/ckeditor/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
	<script src="{{ ENV('APP_URL') }}/admin_files/js/jquery-3.7.0.min.js"></script>
	<script src="{{ ENV('APP_URL') }}/admin_files/js/jquery.maskedinput.min.js"></script>
	<script src="{{ ENV('APP_URL') }}/admin_files/libs/bootstrap5/bootstrap.min.js"></script>
	<script src="{{ ENV('APP_URL') }}/admin_files/js/script.js?v=2"></script>

</head>

<body>

<div class="container">


		<div class="py-lg-5 bg-lgrey">
			<div class="row">


				<div class="col-xl-4 offset-xl-4 col-lg-6 offset-lg-3 px-0">

					<div class="card bg-white py-lg-4 py-2" style="border: 0px;">

						<div class="card-body bg-white px-lg-2 px-0">

							<form method="POST" action="{{env('APP_URL')}}/registration" id="reg-form" >
								@csrf

								<div class="form-group row">
									<label for="name" class="col-md-3-  col-12 col-form-label text-md-right- font-weight-bold little">Имя <span class="ml-1">*</span></label>

									<div class="col-lg-9- col-12">
										<input id="name" type="text" class="form-control form-border-black form-custom" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Ваше Имя" >

									</div>
								</div>

								<div class="form-group row">
									<label for="login" class="col-md-3-  col-12 col-form-label text-md-right- font-weight-bold little">Login <span class="ml-1">*</span></label>

									<div class="col-lg-9- col-12">
										<input id="login" type="text" class="form-control form-border-black form-custom @error('password') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="login" placeholder="Ваш login" >
                                        @error('login')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>


								<div class="form-group row">
									<label for="password" class="col-md-3-  col-12 col-form-label text-md-right- font-weight-bold little">Придумайте пароль <span class="ml-1">*</span></label>

									<div class="col-lg-9- col-12">
										<input id="password" type="password" class="form-control form-border-black form-custom @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

										@error('password')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>

								<div class="form-group row">
									<label for="password-confirm" class="col-md-3-  col-12 col-form-label text-md-right- font-weight-bold little">Подтвердите пароль <span class="ml-1">*</span></label>

									<div class="col-lg-9- col-12">
										<input id="password-confirm" type="password" class="form-control form-border-black form-custom" name="password_confirmation" required autocomplete="new-password">
									</div>
								</div>


								<div class="form-group row mb-0">
									<div class="col-lg-9- col-12 offset-md-3-">
										<button type="submit" class="btn btn-primary text-light btn-block py-3">
											Зарегистрироваться
										</button>
									</div>
								</div>

								<div class="form-group row mb-0 my-4">
									<div class="col-12 text-center px-0">
										<span class="b-sides px-1">уже зарегистрированы?</span>
									</div>
								</div>

								 <div class="form-group row mb-0 mt-3">

									<div class="col-12">
										<a href="{{env('APP_URL')}}/login" class="btn btn-outline-dark btn-block f-18 py-3">Войти</a>
									</div>

								</div>

							</form>
						</div>

					</div>

				</div>

			</div>

		</div>
	</div>

</footer>

</div>

</body>

</html>
