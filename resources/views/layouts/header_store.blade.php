<header>
	<div class="nav-logo">
		<a href="{{ route('store.index') }}" class="nav-logo-link">
			<span class="nav-logo-img"></span>
		</a>
	</div>
	<div class="nav-search">
		<form class="nav-searchbar" action="{{ route('store') }}" method="GET">
            @csrf
            <input class="nav-input" type="text" name="searchField" placeholder="Поиск" aria-label="Поиск">
            <button class="nav-submit" type="submit"></button>
        </form>
	</div>
	<div class="nav-account">
		@if(Auth::user())
			<a href="{{ route('logout') }}" class="nav-account-link" 
				onclick="event.preventDefault();
					document.getElementById('logout-form').submit();">
				<span class="nav-account-exit"></span>
			</a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				{{ csrf_field() }}
			</form>
		@endif
		<a href="{{ route('login') }}" class="nav-account-link">
			<span class="nav-account-img"></span>
		</a>
	</div>
	<div class="nav-cart">
		@if(Cart::count())
			<a href="{{ route('cart') }}" class="nav-cart-link">
				<span class="nav-cart-img"></span>
				<span class="nav-cart-count">{{ Cart::count() }}</span>
			</a>
		@else
			<span class="nav-cart-link">
				<span class="nav-cart-img"></span>
				<span class="nav-cart-count">{{ Cart::count() }}</span>
			</span>
		@endif
	</div>
</header>
<div class="menu">
	<div class="menu-block allmusic"><a href="{{ route('store') }}">Магазин</a></div>
	<div class="menu-block menu-flyout"><a href="#">Популярные</a></div>
	<div class="nav-flyout">
		<div class="nav-flyout-content">
			<div class="flayout-menu">
				<div class="flayout-menu-column">
					<h3>Artists:</h3>
					<ul>							
						<li><a href="{{ route('porductname', 'doors-the') }}">The Doors</a></li>
						<li><a href="{{ route('porductname', 'gilmour-david') }}">David Gilmour</a></li>
						<li><a href="{{ route('porductname', 'hendrix-jimi') }}">Jimi Hendrix</a></li>
						<li><a href="{{ route('porductname', 'waters-roger') }}">Roger Waters</a></li>
						<li><a href="{{ route('porductname', 'vaughan-stevie-ray') }}">Stevie Ray Vaughan</a></li>
						<li><a href="{{ route('porductname', 'nirvana') }}">Nirvana</a></li>
						<li><a href="{{ route('porductname', 'jackson-michael') }}">Michael Jackson</a></li>
						<li><a href="{{ route('porductname', 'creedence-clearwater-revival') }}">Creedence Clearwater Revival</a></li>
						<li><a href="{{ route('porductname', 'beatles') }}">The Beatles</a></li>
						<li><a href="{{ route('porductname', 'pink-floyd') }}">Pink Floyd</a></li>
						<li><a href="{{ route('porductname', 'deep-purple') }}">Deep Purple</a></li>
						<li><a href="{{ route('porductname', 'led-zeppelin') }}">Led Zeppelin</a></li>
						<li><a href="{{ route('all-artists') }}">See more...</a></li>
					</ul>
				</div>
				<div class="flayout-menu-column">
					<h3>Форматы:</h3>
					<ul>							
						<li><a href="{{ route('category', 'vinyl') }}">Vinyl</a></li>
						<li><a href="{{ route('store', ['category_id' => [3, 4]]) }}">CDs & SACD</a></li>
						<li><a href="{{ route('category', 'dvd-blu-ray') }}">DVD & Blu-Ray</a></li>
						<li><a href="{{ route('boxset') }}">Box Sets</a></li>
					</ul>
					<h3>Релизы:</h3>
					<ul>							
						<li><a href="{{ route('newproducts') }}">Новинки</a></li>
						<li><a href="{{ route('preorder') }}">Предзаказ</a></li>
					</ul>
				</div>
				<div class="flayout-menu-column">
					<a href="{{ route('porductname', 'metallica') }}" class="flayout-imglink">
					<img src="/storage/images/metallica.jpg">
						<h3>Metallica</h3>
					</a>
				</div>
				<div class="flayout-menu-column">
					<a href="{{ route('porductname', 'gilmour-david') }}" class="flayout-imglink">
					<img src="/storage/images/gilmour.jpg">
						<h3>David Gilmour</h3>
					</a>
				</div>
				<div class="flayout-menu-column">
					<a href="{{ route('porductname', 'kravitz-lenny') }}" class="flayout-imglink">
						<img src="/storage/images/kravitz.jpg">
						<h3>Lenny Kravitz</h3>
					</a>
				</div>
			</div>
		</div>
	</div>
	{{-- <div class="menu-block menu-flyout"><a href="#">Оборудование</a></div>
	<div class="nav-flyout">
		<div class="nav-flyout-content">
			<div class="flayout-menu">						
				<div class="flayout-menu-column">
					<a href="#" class="flayout-imglink">
						<h3>Metallica</h3>
					</a>
				</div>
				<div class="flayout-menu-column">
					<a href="#" class="flayout-imglink">
						<h3>David Gilmour</h3>
					</a>
				</div>
				<div class="flayout-menu-column">
					<a href="#" class="flayout-imglink">
						<h3>Lenny Kravitz</h3>
					</a>
				</div>
			</div>
		</div>
	</div> --}}
	<div class="menu-block menu-contacts"><a href="{{ route('about') }}">Контакты</a></div>
</div>