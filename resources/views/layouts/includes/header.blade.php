<header class="fixed-top text-white border-bottom">
	<div class="container">
		<div class="row">
			<div class="col">
				<nav class="navbar navbar-expand-md navbar-dark d-flex align-items-center py-0">
					<div class="logo">
						<a href="{{ route('index') }}">
							<img src="{{ asset('images/izolda_logo.png') }}" class="img-fluid w-100" />
						</a>
					</div>

					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="navbar-collapse collapse justify-content-end" id="collapsibleNavbar">
						<ul class="navbar-nav nav-pills">
							<li class="nav-item"><a href="{{ route('index') }}" class="nav-link px-2 mx-1 {{ Route::is('index') ? 'active' : '' }}">Главная</a></li>
							<li class="nav-item"><a href="{{ route('crew') }}" class="nav-link px-2 mx-1 {{ Route::is('crew') ? 'active' : '' }}">Экипаж</a></li>
							<li class="nav-item"><a href="{{ route('team') }}" class="nav-link px-2 mx-1 {{ Route::is('team') ? 'active' : '' }}">Команда</a></li>
							<li class="nav-item"><a href="{{ route('activity') }}" class="nav-link px-2 mx-1 {{ Route::is('activity') ? 'active' : '' }}">Деятельность</a></li>
							<li class="nav-item"><a href="{{ route('tech') }}" class="nav-link px-2 mx-1 {{ Route::is('tech') ? 'active' : '' }}">Техника</a></li>
							<li class="nav-item"><a href="{{ route('goals') }}" class="nav-link px-2 mx-1 {{ Route::is('goals') ? 'active' : '' }}">Цели</a></li>
							<li class="nav-item"><a href="{{ route('contacts') }}" class="nav-link px-2 mx-1 {{ Route::is('contacts') ? 'active' : '' }}">Контакты</a></li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</header>