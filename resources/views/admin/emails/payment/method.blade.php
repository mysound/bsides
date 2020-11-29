@component('mail::message')
# Здравствуйте, {{ $order->user->name }}!

Ваш заказ в обработке, ожидает оплаты

Заказ № {{ $order->id }}

@component('mail::table')
| Название        | Кол     | Цена    |
|:----------------|:-------:| -------:|
@foreach($order->products as $product)
| {{ $product->name }} - {{ $product->title }} ({{ $product->category->title }}) <br> {{ $product->upc }} | {{ $product->pivot->quantity }} шт. | {{ $product->price }} руб.|
@endforeach
@endcomponent

Доставка: {{ $shippingPrice }} руб.

<span style="font-weight: bold;">Итого:</span> {{ $order->total + $shippingPrice }} руб.

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
<span style="font-size: 14px; font-weight: bold;">Сумма заказа:</span> {{ $order->total + $shippingPrice }} руб. <br><br>
<span style="font-size: 14px; font-weight: bold; font-style: italic">Комментарий:</span> {{ $order->comment }}
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
