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
		<a href="#" class="nav-cart-link">
			<span class="nav-cart-img"></span>
			<span class="nav-cart-count">0</span>
		</a>
	</div>
</header>
<div class="menu">
	<div class="menu-block allmusic"><a href="{{ route('store') }}">Вся музыка</a></div>
	<div class="menu-block menu-flyout"><a href="#">Популярные</a></div>
	<div class="nav-flyout">
		<div class="nav-flyout-content">
			<div class="flayout-menu">
				<div class="flayout-menu-column">
					<h3>Artists:</h3>
					<ul>							
						<li><a href="#">The Doors</a></li>
						<li><a href="#">David Gilmour</a></li>
						<li><a href="#">Jimi Hendrix</a></li>
						<li><a href="#">Roger Waters</a></li>
						<li><a href="#">Stevie Ray Vaughan</a></li>
						<li><a href="#">Nirvana</a></li>
						<li><a href="#">Michael Jackson</a></li>
						<li><a href="#">Creedence Clearwater Revival</a></li>
						<li><a href="#">The Beatles</a></li>
						<li><a href="#">Pink Floyd</a></li>
						<li><a href="#">Deep Purple</a></li>
						<li><a href="#">Led Zeppelin</a></li>
					</ul>
				</div>
				<div class="flayout-menu-column">
					<h3>Formats:</h3>
					<ul>							
						<li><a href="{{ route('store', ['category_id' => [2]]) }}">Vinyl</a></li>
						<li><a href="{{ route('store', ['category_id' => [3, 4]]) }}">CDs & SACD</a></li>
						<li><a href="{{ route('store', ['category_id' => [6, 7]]) }}">DVD & Blu-Ray</a></li>
						<li><a href="#">Box Sets</a></li>
					</ul>
					<h3>Releases:</h3>
					<ul>							
						<li><a href="#">New Releases</a></li>
						<li><a href="#">Pre-order</a></li>
					</ul>
				</div>
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
	</div>
	<div class="menu-block menu-flyout"><a href="#">Оборудование</a></div>
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
	</div>
	<div class="menu-block"><a href="#">Контакты</a></div>
</div>