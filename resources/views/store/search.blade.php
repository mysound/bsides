@extends('layouts.app_store')

@section('content')

	<div class="sidebar">
			<div class="sidebar-row">Категории</div>
			<div class="sidebar-line">
				@include('store.partials.categories')
			</div>
			<div class="sidebar-row">Цена</div>
			<div class="sidebar-line">
				<form class="filterForm" action="{{ route('store') }}" method="GET">
		            @csrf
		            <div>
						<input class="priceField" type="text" name="min_price" value="{{ $min_price ?? "" }}">&nbsp;&nbsp;–&nbsp;
						<input class="priceField" type="text" name="max_price" value="{{ $max_price ?? "" }}">
					</div>
					<div class="b-filterButton">
						<input class="filterButton" type="submit" name="" value="Показать">
					</div>
		        </form>
			</div>
			<div class="sidebar-row">Artists</div>
			<div class="sidebar-line">
				<ul>
					<li><a href="{{ route('porductname', 'queen') }}">Queen</a></li>
					<li><a href="{{ route('porductname', 'jackson-michael') }}">Michael Jackson</a></li>
					<li><a href="{{ route('porductname', 'pink-floyd') }}">Pink Floyd</a></li>
					<li><a href="{{ route('porductname', 'gilmour-david') }}">David Gilmour</a></li>
					<li><a href="{{ route('porductname', 'nirvana') }}">Nirvana</a></li>
					<li><a href="{{ route('porductname', 'deep-purple') }}">Deep Purple</a></li>
					<li><a href="{{ route('porductname', 'metallica') }}">Metallica</a></li>
					<li><a href="{{ route('porductname', 'beatles') }}">The Beatles</a></li>
					<li><a href="{{ route('porductname', 'led-zeppelin') }}">Led Zeppelin</a></li>
					<li><a href="{{ route('porductname', 'rolling-stones') }}">The Rolling Stones</a></li>
					<li><a href="{{ route('all-artists') }}">See more...</a></li>
				</ul>
			</div>
			@include('store.partials.ganres')
		</div>
		<div class="content">
			<div class="content-pagination">
				<div class="content-filter">Фильтр: 
					@if($sortType == 'ASC')
						<a href="{{ route('store', ['sortType' => 'DESC', 'searchField' => $searchField, 'category_id' => [$category_id], 'top_rs' => $top_rs]) }}">По цене <span class="fullver">(дешевле - дороже)</span> &#9650;</a>
					@elseif($sortType == 'DESC' or $sortType == '')
						<a href="{{ route('store', ['sortType' => 'ASC', 'searchField' => $searchField, 'category_id' => [$category_id], 'top_rs' => $top_rs]) }}">По цене <span class="fullver">@if(!$sortType == '')(дороже - дешевле)</span> &#9660;@endif</a>
					@endif
				</div>
				{{ $products->links('store.partials.pagination') }}
			</div>
			@if (session('message'))
			    <div class="b-alert">
			        {{ session('message') }}
			    </div>
			@endif
			<div class="content-store">
				@foreach($products as $product)
					<div class="content-store-item">
						<div class="store-item">
							<div class="store-item-img">
								{{-- <a href="{{ route('view.product', $product->id) }}"> --}}
								<a href="{{ $product->slugurl() }}">
									@if($product->images->first())
										@foreach($product->images as $image)
											<img src="{{ asset('storage/images/thumbnails/' . $image->title) }}">
											@break
										@endforeach
									@else
										<img src="{{ asset('storage/images/thumbnails/noimage.png') }}">
									@endif
									<h2 class="a-medium">{{ Str::limit($product->title, 28) }}</h2>
								</a>
							</div>
							<span class="store-item-name">{{ Str::limit($product->name, 28) }}</span>
							<div class="store-item-price">{{ round($product->price) }} руб.</div>
							<div class="store-item-short">{{ Str::limit($product->short_description, 32) }}</div>
							<div class="store-item-buy">
								<form method="POST" action="{{ route('cart.store') }}">
									@csrf
									<input type="hidden" name="product_id" value="{{ $product->id }}">
									<button>Купить</button>
								</form>
							</div>
						</div>
					</div>
				@endforeach
			</div>
			<div class="content-pagination" style="float: right;">
				{{ $products->links('store.partials.pagination') }}
			</div>
		</div>

@endsection