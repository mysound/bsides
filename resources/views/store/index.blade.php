@extends('layouts.app_store')

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
			<div class="content-blk-mm content4"><img class="content-img" src="storage/images/i1.jpg"></div>
			{{-- <div class="content-blk-mm content5"><img class="content-img" src="storage/images/62.jpg"></div> --}}
			<div class="content-blk-mm content6"><img class="content-img" src="storage/images/i2.jpg"></div>
			<div class="content-blk-mm content7"><img class="content-img" src="storage/images/i3.jpg"></div>
			<div class="content-blk-mm content8"><img class="content-img" src="storage/images/box2.jpg"></div>
			<div class="content-blk-mm content9"><img class="content-img" src="storage/images/t.jpg"></div>
			<div class="content-blk-mm content10"><img class="content-img" src="storage/images/32.png"></div>
		</div>
	</div>
@endsection