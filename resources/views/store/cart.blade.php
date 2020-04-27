@extends('layouts.app_store')

@section('content')

<div class="cartcontent">
	<div class="cart-caption">
		<h1>Корзина</h1>
		@if (session('message'))
		    <div class="b-alert">
		        {{ session('message') }}
		    </div>
		@endif
		<a href="{{ route('cart.empty') }}">Очистить корзину &#9850;</a>
	</div>
	<div class="cart-block">
		<div class="cart-item-area">
			@foreach(Cart::content() as $product)
				<div class="br-cart cart-item">
					<div class="cart-item-img">
						@forelse($product->model->images as $image)
							<a href="{{ route('view.product', $product->id) }}">
								<img class="img" src="{{ asset('storage/images/thumbnails/' . $image->title) }}" width="60">
							</a>
							@break
						@empty
							<a href="{{ route('view.product', $product->id) }}">
								<img class="img" src="{{ asset('storage/images/thumbnails/noimage.png') }}" width="60">
							</a>
						@endforelse
					</div>
					<div class="cart-item-title">{{ $product->name }} <br>by <a href="{{ route('store', ['searchField' => $product->model->name]) }}">{{ $product->model->name }}</a></div>
					<div class="cart-item-qty">{{ $product->qty }} шт.</div>
					<div class="cart-item-price">{{ $product->price }} &#8381;</div>
					<div class="cart-item-delete">
						<form method="POST" action="{{ route('cart.destroy', $product->rowId) }}">
							@method('DELETE')
							@csrf
							<button type="submit" class="filterButton">
								<span class="">Удалить</span>
							</button>
						</form>
					</div>
				</div>
			@endforeach
			<div class="cart-item-form">
				<form>
					<div class="form-title form-line">
						Доставка: <span class="shipping-title">Почта России</span>
					</div>
					<div class="form-header-title">Получатель</div>						
					<div class="form-part form-line form-flex">
						<div class="form-field form-flex-item">
							<label class="form-field-label"> Фамилия: </label>
							<input class="form-field-input" type="text" name="last_name">
						</div>
						<div class="form-field form-flex-item">
							<label class="form-field-label">Имя: </label>
							<input class="form-field-input" type="text" name="first_name">
						</div>
						<div class="form-field form-flex-item">
							<label class="form-field-label">Отчество: </label>
							<input class="form-field-input" type="text" name="middle_name">
						</div>
						<div class="form-field form-flex-item form-item-50">
							<label class="form-field-label">Телефон: </label>
							<input class="form-field-input" type="text" name="middle_name">
						</div>
						<div class="form-field form-flex-item">
							<label class="form-field-label">E-mail: </label>
							<input class="form-field-input" type="text" name="middle_name">
						</div>				
					</div>
					<div class="form-header-title">Адрес доставки: страна Россия</div>
					<div class="form-part form-line form-flex">
						<div class="form-field form-flex-item">
							<label class="form-field-label"> Индекс: </label>
							<input class="form-field-input" type="text" name="last_name">
						</div>
						<div class="form-field form-flex-item">
							<label class="form-field-label">Регион: </label>
							<input class="form-field-input" type="text" name="first_name">
						</div>
						<div class="form-field form-flex-item">
							<label class="form-field-label">Город: </label>
							<input class="form-field-input" type="text" name="middle_name">
						</div>
						<div class="form-field form-item-100">
							<label class="form-field-label">Адрес: </label>
							<input class="form-field-input" type="text" name="middle_name">
						</div>					
					</div>
					<div class="form-part">
						<div class="form-field form-flex-item">
							<input class="btn btn-success btn-block" type="submit" name="" value="Оформить заказ">
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="cart-total-area">
			<div class="br-cart cart-total">
				<div><h3>Количество товаров: {{ Cart::count() }} шт.</h3></div>
				<div><h2>Итого: {{ Cart::subtotal() }} &#8381;</h2></div>
			</div>
		</div>
	</div>
</div>

@endsection