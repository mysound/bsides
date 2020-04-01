<div class="sidebar-row">GANRES</div>
<div class="sidebar-line">
	<ul>
		@foreach($ganres as $ganre)
			<li><a href="{{ route('store', ['ganre_id' => $ganre->id]) }}">{{ $ganre->title }}</a></li>
		@endforeach
	</ul>
</div>