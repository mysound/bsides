@extends('admin.layouts.app-admin')

@section('content')
	<div class="panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Orders List @endslot
			@slot('parent') Main @endslot
			@slot('active') Orders <span class="badge badge-pill badge-info" ></span> @endslot
		@endcomponent
		@if (session('message'))
		    <div class="alert alert-success" role="alert">
		        {{ session('message') }}
		    </div>
		@endif
		<table class="table">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Покупатель</th>
					<th scope="col">Сумма</th>
					<th scope="col">Статус заказа</th>
					<th scope="col">Номер отслеживания</th>
					<th scope="col">Дата заказа</th>
					<th scope="col">Удалить</th>
				</tr>
			</thead>
			<tbody>
				@forelse($orders as $order)
					<tr>
						<th scope="row"><a href="{{ route('admin.order.show', $order->id) }}">{{ $order->id }}</a></th>
						<td>{{ $order->user->name }}</td>
						<td>{{ $order->total }}</td>
						<td>
							@if($order->status && $order->status->id < 4)
								<span class="badge badge-danger">{{ $order->status->name ?? ""}}</span><br>
							@elseif($order->status && $order->status->id < 7)
								<span class="badge badge-secondary">{{ $order->status->name ?? ""}}</span><br>
							@else
								<span class="badge badge-success">{{ $order->status->name ?? ""}}</span><br>
							@endif
						</td>
						<td>{{ $order->shipping_no }}</td>
						<td>{{ Carbon\Carbon::parse($order->created_at)->format('d.m.Y - H:m') }}</td>
						<td>
							<form method="POST" action="{{ route('admin.order.destroy', $order) }}" onsubmit="if(confirm('Удалить заказ?')){ return true }else{ return false }">
								@method('DELETE')
								@csrf
								<button type="submit" class="badge badge-danger" style="border:none;">Удалить</button>
							</form>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="7" class="text-center"><h2>Empty</h2></td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>
@endsection