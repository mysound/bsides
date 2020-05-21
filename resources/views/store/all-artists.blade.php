@extends('layouts.app_store')

@section('content')

	<div class="sidebar">
			<div class="sidebar-row">Категории</div>
			<div class="sidebar-line">
				
			</div>
			<div class="sidebar-row">Цена</div>
			<div class="sidebar-line">
				
			</div>
		</div>
		<div class="content">
			<ul>
				@foreach($artists as $key => $artist)
					<li class="li-key">{{ $key }} </li>
						<ul class="artists-list">
							@foreach($artist as $name)
								{{-- <li><a href="{{ route('store', ['searchField' => $name]) }}">{{ $name }}</a></li> --}}
								<li><a href="{{ route('porductname', Str::slug($name)) }}">{{ $name }}</a></li>
							@endforeach
						</ul>
				@endforeach
			</ul>
		</div>

@endsection