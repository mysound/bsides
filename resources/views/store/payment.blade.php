@extends('layouts.app_store')

@section('title', 'Условия оплаты | bsides.ru')

@section('description', 'Условия оплаты виниловых пластинок, CD дисков и музыкального оборудования в интернет магазине bsides.ru')

@section('content')

<div class="viewcontent">
	<div class="view-title">
		<h1>Условия оплаты</h1>
	</div>
	<div class="about-content">
		<h2>Общие положения</h2>
		<p>Покупка в интернет-магазине - это наиболее простой, быстрый и удобный способ приобретения товаров.</p>
		<p>Обратите внимание, предоплаченный заказ нельзя редактировать, его можно отменить, только связавшись с менеджером по телефону.</p>
		<p>Если производилась предоплата, получить заказ может только человек, на которого он оформлен или доверенное лицо заказчика. В случае, если требуется доставка Почтой России, EMS, курьерская доставка в пределах г.Армавир, или при Самовывозе заказ необходимо оплатить перед отправкой в 100% размере. При оплате через интернет, обязательно указывайте достоверные адрес электронной почты, ФИО и телефон.</p>
		<p>Приём оплаты предоставлен сервисом <a href="https://payanyway.ru" target="_blank">PayAnyWay</a></p>
		<p>PayAnyWay не передает данные Вашей карты магазину и иным третьим лицам. Безопасность платежей с помощью банковских карт обеспечивается технологиями защищенного соединения HTTPS и двухфакторной аутентификации пользователя 3D Secure.</p>
		<p>Ознакомьтесь с <a href="https://payanyway.ru/info/w/ru/public/w/partnership/oplata/card.pdf" target="_blank">инструкцией (PDF, 496 кб) по оплате.</a></p>
		<h2>Способы оплаты</h2>
		<h3>Банковские карты</h3>
		<div class="about-info">
			<div><img style="width: 130px" src="storage/images/visamaster.jpg"></div>
			<div style="padding: 10px;">
				<p>Мы принимаем к оплате банковские карты: Visa, MasterCard</p>
			</div>
		</div>
		<h3>Безналичная оплата</h3>
		<div class="about-info">
			<div><img style="width: 130px" src="storage/images/kkb.jpg"></div>
			<div style="padding: 0 10px;">
				<ul style="padding: 0; margin: 0;">
					<li>ИП Кузнецова Надежда Тимофеевна</li>
					<li>ИНН 071507675529</li>
					<li>ОГРН 307072130400069</li>
					<li>КБ «КУБАНЬ КРЕДИТ» ООО Г.КРАСНОДАР</li>
					<li>БИК 040349722</li>
					<li>Расчетный счет 40802810800370000006</li>
					<li>Корсчет 30101810200000000722</li>
				</ul>
			</div>
		</div>
		<h3>Другие способы оплаты</h3>
		<div class="about-info">
			<div><img style="width: 130px" src="storage/images/paypal.jpg"></div>
			<div style="padding: 0 10px;">
				<p>Вы можете оплатить свой заказ с помощью PayPal</p>
			</div>
		</div>
	</div>
</div>

@endsection