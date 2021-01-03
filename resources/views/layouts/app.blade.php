<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="CashProno est un site de pronostics sportifs proposant des pronostics gratuits ou VIP quotidiennement. Inscrivez-vous et bénéficiez de pronostics sportifs de qualité !">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Site de pronostics sportif depuis 2017') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	
	<!-- Favicon -->
	<link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/favicon/apple-icon-57x57.png') }}">
	<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/favicon/apple-icon-60x60.png') }}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/favicon/apple-icon-72x72.png') }}">
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/favicon/apple-icon-76x76.png') }}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/favicon/apple-icon-114x114.png') }}">
	<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/favicon/apple-icon-120x120.png') }}">
	<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/favicon/apple-icon-144x144.png') }}">
	<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/favicon/apple-icon-152x152.png') }}">
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/favicon/apple-icon-180x180.png') }}">
	<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('/favicon/android-icon-192x192.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/favicon/favicon-96x96.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon/favicon-16x16.png') }}">
	<link rel="manifest" href="{{ asset('/favicon/manifest.json') }}">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="{{ asset('/favicon/ms-icon-144x144.png') }}">
	<meta name="theme-color" content="#ffffff">
</head>
<body>
    <div id="app">
		<header>
			<div class="bg-primary d-none d-md-block">
				<div class="container">
					<div class="row">
						<div class="col-md-3 d-md-flex justify-content-center align-items-center center align-self-center">
							<a href="{{ route('homepage') }}" class="text-center d-block"><img src="{{ asset('/img/LogoCashPronoBleu.png') }}" alt="Logo CashProno en bleu" class="img-fluid img-logo"></a>
							<h2 class="text-white h5 text-center text-md-left text-uppercase">Experts
								<br>depuis
								<br>2017</h2>
						</div>
						<div class="col-md-9 py-5">
								@auth
									<div class="mb-3 d-md-flex d-block justify-content-md-end justify-content-center align-items-center">
										<div class="text-white mx-2">Bonjour {{ Auth::user()->username }} </div>
										<a href="{{ route('logout') }}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-secondary mx-2">Se déconnecter</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
											@csrf
										</form>
									</div>
								@else
									<form class="form-inline d-md-flex d-block justify-content-md-end justify-content-center" method="post" action="{{ route('login') }}">
										<div class="form-group mb-2">
											<input name="email" type="email" class="form-control input-bleu" id="email" placeholder="Adresse email" required>
										</div>
										<div class="form-group mx-sm-3 mb-2">
											<input name="password" type="password" class="form-control input-bleu" id="password" placeholder="Mot de passe" required>
										</div>
										@csrf
										<button type="submit" class="btn btn-secondary mb-2">Se connecter</button>
										&nbsp;
										<a href="{{ route('register') }}" class="btn btn-secondary mb-2">S'inscrire</a>
									</form>
								@endif
						</div>
					</div>
				</div>
			</div>
			<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
				<div class="container">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mt-2 mb-2 ml-auto mr-auto">
							<li class="nav-item">
								<a class="nav-link" href="{{ route('homepage') }}">
									<i class="fa fa-home"></i> Accueil</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ route('pronostic_index') }}">
									<i class="fas fa-futbol"></i>
									Pronostics</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ route('subscription_index') }}">
									<i class="fas fa-star"></i>
									Packs VIP</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ url('concours') }}">
									<i class="fas fa-gift"></i>
									Concours</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="{{ route('contact') }}">
									<i class="fa fa-phone"></i>
									Contact</a>
							</li>
							@auth
								<li class="nav-item d-sm-block d-md-none">
									<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Se déconnecter</a>
								</li>
								@if (Auth::user()->admin == 1)
									<li class="nav-item d-sm-block d-md-none">
										<li class="nav-item">
											<a class="nav-link" href="{{ route('admin.index') }}">
												<i class="fa fa-chart-line"></i>
												Administration</a>
										</li>
									</li>
								@endif
							@else
								<li class="nav-item d-sm-block d-md-none">
									<a class="nav-link" href="{{ route('register') }}">S'inscrire</a>
								</li>
								<li class="nav-item d-sm-block d-md-none">
									<a class="nav-link" href="{{ route('login') }}">Se connecter</a>
								</li>
							@endif
						</ul>
					</div>
				</div>
			</nav>
		</header>

		@foreach (['danger', 'warning', 'success', 'info'] as $msg)
				@if(session()->has($msg))
				<div class="container mt-5">
					<p class="alert alert-{{ $msg }}">{{ session($msg) }}</p>
				</div>
			@endif
		@endforeach

		@error('email')
			<div class="container mt-5 w-100">
				<p class="alert alert-danger w-100" role="alert">
					{{ $message }}
				</p>
			</div>
		@enderror

		
		@error('password')
			<div class="container mt-5 w-100">
				<p class="alert alert-danger w-100" role="alert">
					{{ $message }}
				</p>
			</div>
		@enderror

		<div class="mt-5">
			@yield('content')
		</div>

		<footer class="mt-5 mb-0 bg-secondary py-3">
			<div class="container text-white">
				<div class="row mt-4">
					<div class="col-md-4">
						<div class="text-uppercase font-weight-bold mb-4">LIENS RAPIDE</div>
						<a href="{{ route('contact') }}">Nous contacter</a>
						<a href="{{ route('subscription_index') }}">Boutique</a>
						<a href="{{ route('pronostic_index') }}">Liste des pronostics</a>
					</div>
					<div class="col-md-4">
						<div class="text-uppercase font-weight-bold mb-4">INFORMATIONS LÉGALES</div>
						<a href="{{ url('lol') }}">Conditions générales de vente</a>
						<a href="{{ url('lol') }}">Mentions légales</a>
						<a href="{{ url('lol') }}">Politique de confidentialité des donnéees</a>
					</div>
					<div class="col-md-4">
						{{-- <div class="text-uppercase font-weight-bold mb-4">NEWSLETTER</div>
						<form action="#" class="form-inline">
							<input class="form-control" type="email" name="email" id="email" placeholder="Votre adresse email">
							<button class="btn btn-primary">M'inscrire</button>
						</form> --}}
						<div class="text-uppercase font-weight-bold mb-4">NOUS SUIVRE</div>
						<a href="http://instagram.com/cashpronofra" rel="noreferrer" target="_blank" class="d-inline-block px-1">
							<i class="fab fa-instagram fa-2x"></i>
						</a>
						<a href="https://www.snapchat.com/add/cashpronofra" rel="noreferrer" target="_blank" class="d-inline-block px-1">
							<i class="fab fa-snapchat fa-2x"></i>
						</a>
					</div>
					<div class="col-md-12 mt-5">
						<span class="text-center d-block">Jouer comporte des risques : endettement, isolement, dépendance. Pour être aidé, appelez le 09-74-75-13-13 (appel non surtaxé)</span>
					</div>
				</div>
			</div>
		</footer>
	</div>
	
    <!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
	@yield('javascript')
</body>
</html>
