<div class="sidebar-row">Жанры</div>
<div class="sidebar-line">
	<ul>
		@foreach($ganres as $ganre)
			<li><a href="{{ route('store.ganre', $ganre->slug) }}">{{ $ganre->title }}</a></li>
		@endforeach
	</ul>
</div>