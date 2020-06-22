@extends('layouts.app_store')

@section('title', 'Виниловые пластинки и компакт диски купить в интернет-магазине B-Sides')

@section('description', 'B-Sides - интернет-магазин виниловых пластинок и компакт дисков, а также музыкального оборудования для прослушивания музыки')

@section('content')
	<div class="sidebar">
		@include('store.partials.ganres')
		<div class="sidebar-line">
			<ul>
				<li><a href="{{ route('store', ['top_rs' => true]) }}">Rolling Stone Top 500</a></li>
			</ul>
		</div>
		<div class="sidebar-row sidebar-row-top">ARTIST</div>
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
	</div>
	<div class="content">
		<div class="content-gmain">
			<div class="content-blk content-blk-first"><a href="{{ route('category', 'vinyl') }}"><span>VINYL RECORDS</span></a></div>
			<div class="content-blk content-blk-second"><a href="{{ route('store', ['category_id' => [3, 4]]) }}"><span>CD & SACD</span></a></div>
			<div class="content-blk content-blk-third"><a href="{{ route('category', 'dvd-blu-ray') }}"><span>DVD & Blu-Ray</span></a></div>
			<div class="content-blk-mm content4"><a href="{{ route('category', 'vinyl') }}"><img class="content-img" src="storage/images/1.jpg"></a></div>
			<div class="content-blk-mm content6"><a href="{{ route('newproducts') }}"><img class="content-img" src="storage/images/2.jpg"></a></div>
			<div class="content-blk-mm content7"><a href="{{ route('preorder') }}"><img class="content-img" src="storage/images/3.jpg"></a></div>
			<div class="content-blk-mm content8"><a href="{{ route('boxset') }}"><img class="content-img" src="storage/images/4.jpg"></a></div>
			<div class="content-blk-mm content9"><img class="content-img" src="storage/images/5.jpg"></div>
			<div class="content-blk-mm content10"><img class="content-img" src="storage/images/6.jpg"></div>
		</div>
	<div class="indexh1">
		<h1>B-Sides Интернет-Магазин виниловых пластинок из США и Европы</h1>
	</div>
	</div>
@endsection