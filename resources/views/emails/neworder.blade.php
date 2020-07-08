@component('mail::message')
# Новый зака № {{ $order->id }}

Покупатель: {{ $order->user->name }}<br>
E-Mail: {{ $order->user->email }}

@component('mail::panel')
Адрес доставки:<br>
<span style="font-size: 14px; font-weight: bold;">Получатель:</span> {{ $order->address->last_name }} {{ $order->address->first_name }} {{ $order->address->middle_name }}, <br>
<span style="font-size: 14px; font-weight: bold;">Регион:</span> {{ $order->address->state }}, <br>
<span style="font-size: 14px; font-weight: bold;">Город:</span> {{ $order->address->city }}, <br>
<span style="font-size: 14px; font-weight: bold;">Адрес:</span> {{ $order->address->address }}, <br>
<span style="font-size: 14px; font-weight: bold;">Индекс:</span> {{ $order->address->zip_code }}, <br>
<span style="font-size: 14px; font-weight: bold;">Телефон:</span> {{ $order->address->phone }}, <br>
<span style="font-size: 14px; font-weight: bold;">Сумма заказа:</span> {{ $order->total }} руб.
@endcomponent

@component('mail::table')
| Title        | Qty    | Price    |
|:-------------|:------:| --------:|
@foreach($order->products as $product)
| {{ $product->name }} - {{ $product->title }} ({{ $product->category->title }}) <br> {{ $product->sku }} | {{ $product->pivot->quantity }} | {{ $product->price }} руб.|
@endforeach
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
