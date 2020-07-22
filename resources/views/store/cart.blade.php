@extends('layouts.app_store')

@section('title', 'Корзина | bsides.ru')

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
							<a href="{{ $product->model->slugurl() }}">
								<img class="img" src="{{ asset('storage/images/thumbnails/' . $image->title) }}" width="60">
							</a>
							@break
						@empty
							<a href="{{ $product->model->slugurl() }}">
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

			@if (count($errors))
				<div class="cart-item-form form-alert">
					Ошибка заполнения формы
				</div>
			@endif

			<div class="cart-item-form">
				<form method="POST" action="{{ route('order.store') }}">
					@csrf
					<div class="form-title form-line">
						Доставка: <span class="shipping-title">Почта России</span> 200руб.
					</div>
					<div class="form-header-title">Получатель</div>						
					<div class="form-part form-line form-flex">
						<div class="form-field form-flex-item">
							<label class="form-field-label"> Фамилия: </label>
							<input class="form-field-input @error('last_name') input-error @enderror" type="text" name="last_name" value="{{ old('last_name') }}">
							@error('last_name')
								<span class="text-alert">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-field form-flex-item">
							<label class="form-field-label">Имя: </label>
							<input class="form-field-input @error('first_name') input-error @enderror" type="text" name="first_name" value="{{ old('first_name') }}">
							@error('first_name')
								<span class="text-alert">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-field form-flex-item">
							<label class="form-field-label">Отчество: </label>
							<input class="form-field-input" type="text" name="middle_name" value="{{ old('middle_name') }}">
						</div>
						<div class="form-field form-flex-item form-item-50">
							<label class="form-field-label">Телефон: </label>
							<input class="form-field-input @error('phone') input-error @enderror" type="text" name="phone" value="{{ old('phone') }}">
							@error('phone')
								<span class="text-alert">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-field form-flex-item">
							<label class="form-field-label">E-mail: </label>
							<input class="form-field-input @error('email') input-error @enderror" type="text" name="email" value="{{ old('email') }}">
							@error('email')
								<div class="text-alert">{{ $message }}</div>
							@enderror
						</div>				
					</div>
					<div class="form-header-title">Адрес доставки: страна Россия</div>
					<div class="form-part form-line form-flex">
						<div class="form-field form-flex-item">
							<label class="form-field-label"> Индекс: </label>
							<input class="form-field-input @error('zip_code') input-error @enderror" type="text" name="zip_code" value="{{ old('zip_code') }}">
							@error('zip_code')
								<span class="text-alert">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-field form-flex-item">
							<label class="form-field-label">Регион: </label>
							<input class="form-field-input @error('state') input-error @enderror" type="text" name="state" value="{{ old('state') }}">
							@error('state')
								<span class="text-alert">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-field form-flex-item">
							<label class="form-field-label">Город: </label>
							<input class="form-field-input @error('city') input-error @enderror" type="text" name="city" value="{{ old('city') }}">
							@error('city')
								<span class="text-alert">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-field form-item-100">
							<label class="form-field-label">Адрес: </label>
							<input class="form-field-input @error('address') input-error @enderror" type="text" name="address" value="{{ old('address') }}">
							@error('address')
								<span class="text-alert">{{ $message }}</span>
							@enderror
						</div>
					</div>
					<div class="form-header-title">Комментарий: </div>
					<div class="form-part form-line">
						<div class="form-field form-item-100">
							<textarea class="form-textarea @error('comment') input-error @enderror" rows="3" name="comment" maxlength
="255">{{ old('comment') }}</textarea>
							@error('comment')
								<span class="text-alert">{{ $message }}</span>
							@enderror
						</div>
					</div>
					<div class="form-captcha">
						{!! NoCaptcha::display() !!}
						@error('g-recaptcha-response')
							<div class="text-alert">{{ $message }}</div>
						@enderror
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
				<div><h3>Доставка: 200 &#8381;</h3></div>
				<div><h2>Итого: {{ Cart::subtotal(2,'.','')+200 }} &#8381;</h2></div>
			</div>
		</div>
	</div>
</div>

@endsection