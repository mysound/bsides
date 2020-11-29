@extends('admin.layouts.app-admin')

@section('content')
	<div class="panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Orders List @endslot
			@slot('parent') Main @endslot
			@slot('active') Orders <span class="badge badge-pill badge-info" ></span> @endslot
		@endcomponent
		<hr>
		<div class="row">
			<div class="col-12">
				<h2>№ Заказа: {{ $order->id }}</h2>
			</div>
			<div class="col-md-6 col-sm-12">
				<br>
				<h4>Сведения о покупке</h4>
				Покупатель: {{ $order->user->name }} <br>
				Электронная почта: {{ $order->user->email }}<br>
				Дата продажи: {{ Carbon\Carbon::parse($order->created_at)->format('d.m.Y - H:m:s') }}<br>
				@if (session('message'))
					<div>
						Способ оплаты: <span class="text-success">{{ session('message') }}</span>
					</div>
				@elseif($order->status && $order->status->id < 4)
					Способ оплаты: <a href="{{ route('admin.order.paymethod', $order) }}">Перевод на карту</a><br>
				@else
					Способ оплаты: <span class="text-success">Перевод на карту</span><br>
				@endif
				<form method="POST" class="form-inline" action="{{ route('admin.order.update', $order) }}" enctype="multipart/form-data">
					@method('PUT')
					@csrf
					<div class="form-group mb-2">
						<label for="statusOrder">Статус:</label>
					</div>
					<div class="form-group mx-sm-3 mb-2">
						<select class="form-control" name="status_id" required="" id="statusOrder">
							<option value="0">-- without status --</option>
							@foreach($statuses as $status)
								<option value="{{ $status->id ?? "" }}"
									@isset($order->status)
										@if($status->id == $order->status->id)
											selected="selected" 
										@endif
									@endisset
									>
									{{ $status->name ?? "" }}
								</option>
							@endforeach
						</select>
					</div>
					<button type="submit" class="btn btn-primary mb-2">Изменить</button>
				</form>
			</div>
			<div class="col-md-6 col-sm-12">
				<br>
				<h4>Сведения о доставке</h4>
				Адрес доставки<br>
				Имя получателя: {{ $order->address->last_name }} {{ $order->address->first_name }} {{ $order->address->middle_name }}<br>
				Регион: {{ $order->address->state }}<br>
				Город: {{ $order->address->city }}<br>
				Адрес: {{ $order->address->address }}<br>
				Индекс: {{ $order->address->zip_code }}<br>
				Телефон: {{ $order->address->phone }}<br><br>
				@if($order->status && $order->status->id < 4)
					Статус: <span class="badge badge-danger">{{ $order->status->name ?? ""}}</span><br>
				@elseif($order->status && $order->status->id < 7)
					Статус: <span class="badge badge-secondary">{{ $order->status->name ?? ""}}</span><br>
				@else
					Статус: <span class="badge badge-success">{{ $order->status->name ?? ""}}</span><br>
				@endif
				Номер отслеживания: {{ $order->shipping_no ?? "" }}
				<form method="POST" class="form-inline" action="{{ route('admin.order.update', $order) }}" enctype="multipart/form-data">
					@method('PUT')
					@csrf
					<div class="form-group mb-2">
						<input type="text" class="form-control" placeholder="Tracking Number" name="shipping_no" value="{{ $order->shipping_no }}">
					</div>
					<button type="submit" class="btn btn-primary mx-sm-3 mb-2">Изменить</button>
				</form>
			</div>
			<div class="col-12">
				<br>
				<h4>Товары:</h4>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Сведения о товаре</th>
							<th scope="col">Кол-во</th>
							<th scope="col">Стоимость</th>
							<th scope="col">Изменить</th>
						</tr>
					</thead>
					<tbody>
						@forelse($order->products as $product)
							<tr>
								<td>
									@foreach($product->images as $image)
										<img class="img" src="{{ asset('storage/images/thumbnails/' . $image->title) }}" width="50">
										@break
									@endforeach
									{{ $product->name }} - {{ $product->title }}
								</td>
								<td>
									{{ $product->pivot->quantity }}
								</td>
								<td>
									{{ $product->pivot->price }} руб.
								</td>
								<td>
									<span class="badge badge-danger">Удалить из заказа</span>
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="4" class="text-center"><h2>Empty</h2></td>
							</tr>
						@endforelse
					</tbody>
				</table>
				<hr>
			</div>

			<div class="col-md-4 offset-md-8">
				<table class="table table-borderless">
					<tbody>
						<tr>
							<td>Итого: </td>
							<td class="text-right">{{ $order->total }} руб.</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection