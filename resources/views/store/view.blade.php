@extends('layouts.app_store')

@section('title', $product->name . ' - ' . $product->title . ' ' . $product->category->ru_title . ' купить ' . $product->category->title . ' | bsides.ru')

@section('description', $product->title . ' - ' . $product->name . ' (' . $product->category->title . ' ' . $product->category->ru_title . '). Купить в интернет-магазине bsides. Доставка по России' )

@section('content')
	<div class="viewcontent">
		<div class="view-title">
			<h1>{{ $product->title }} от <a href="{{ route('porductname', Str::slug($product->name)) }}">{{ $product->name }}</a></h1>
		</div>
		<div class="view-item">
			<div class="view-item-image">
				<div class="item-image">
					@if($product->images->first())
						<img src="{{ asset('storage/images/' . ($product->images->first()["title"])) }}" id="largeImage">
					@else
						<img src="{{ asset('storage/images/noimage.png') }}" id="largeImage">
					@endif
				</div>
				<div class="item-gallery" id="thumbs">
					@foreach($product->images as $image)
						<img src="{{ asset('storage/images/' . $image->title) }}" width="60" class="gallery-img">
					@endforeach
				</div>
			</div>
			<div class="view-item-short">
				<ul class="item-short-list">
					@if(isset($product->brand->title))
						<li><span>Лейбл:</span> {{ $product->brand->title ?? "" }}</li>
					@endif
					@if(isset($product->ganre->title))
						<li><span>Жанр:</span> {{ $product->ganre->title ?? "" }} </li>
					@endif
					<li><span>Состояние:</span> Новое </li>
					<li><span>Формат:</span> {{ $product->category->title }} </li>
					<li><span>Описание:</span> {{ $product->short_description ?? "" }} </li>
					<li><span>Количество дисков:</span> {{ $product->item_qty ?? "" }} </li>
					<li><span>Страна:</span> Евросоюз </li>
					<li><span>Год:</span> {{ $product->release_date ?? "" }}</li> 
					<li><span>UPC:</span> {{ $product->upc ?? "" }}</li> 
					<li class="instock"><span>В наличии</span></li>
					@if(Auth::user() && Auth::user()->admin)
						<li><a href="{{ route('admin.product.edit', $product->id) }}"><span class="view-item-edit">&#9998; Revise this item</span></a></li>
					@endif
				</ul>
			</div>
			<div class="view-item-price">
				<div class="item-price">
					<div class="item-price-title">{{ round($product->price) }} руб.</div>
					<div class="item-price-form">
						<form method="POST" action="{{ route('cart.store') }}">
							@csrf
							<input type="hidden" name="product_id" value="{{ $product->id }}">
							<input class="item-price-btn" type="submit" name="" value="Купить">
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="view-description">
			<div class="description-menu">
				<ul class="description-tabs">
					<li><span>Description</span></li>
				</ul>
			</div>
			<div class="description-content">
				<p>{{ $product->description ?? $product->name . ' - ' . $product->title . ' (' . $product->category->title . ')'}}</p>
			</div>
		</div>
		<div class="view-also">
			<h3>Посмотрите также:</h3>
			<div class="vuew-also-items">
				@foreach($items as $item)
					<div class="content-store-item">
						<div class="store-item">
							<div class="store-item-img">
								{{-- <a href="{{ route('view.product', $item->id) }}"> --}}
								<a href="{{ $item->slugurl() }}">
									@if($item->images->first())
										<img src="{{ asset('storage/images/thumbnails/' . ($item->images->first()["title"])) }}">
									@else
										<img src="{{ asset('storage/images/thumbnails/noimage.png') }}">
									@endif
									<h2 class="a-medium">{{ Str::limit($item->name, 28) }}</h2>
								</a>
							</div>
							<span class="store-item-name">{{ Str::limit($item->title, 28) }}</span>
							<div class="store-item-price">{{ round($item->price) }} руб.</div>
							<div class="store-item-short">{{ Str::limit($item->short_description, 32) }}</div>
							<div class="store-item-buy">
								<form method="POST" action="{{ route('cart.store') }}">
									@csrf
									<input type="hidden" name="product_id" value="{{ $item->id }}">
									<button>Купить</button>
								</form>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endsection

@section('script')
	<script type="text/javascript">
		$("#thumbs").delegate("img", "click", function(){
		    $("#largeImage").attr("src",$(this).attr("src").replace("thumb","large"));
		});
	</script>
@endsection