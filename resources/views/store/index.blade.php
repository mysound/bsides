@extends('layouts.app_store')

@section('content')
	<div class="sidebar">
		<div class="sidebar-row">GANRES</div>
		<div class="sidebar-line">
			<ul>
				<li><a href="#">Blues</a></li>
				<li><a href="#">Classical</a></li>
				<li><a href="#">Jazz</a></li>
				<li><a href="#">Rock</a></li>
				<li><a href="#">Electronic</a></li>
				<li><a href="#">Rap & Hip Hop</a></li>
				<li><a href="#">Soul, R&B, Funk</a></li>
			</ul>
		</div>
		<div class="sidebar-line">
			<ul>
				<li><a href="#">Rolling Stone Top</a></li>
			</ul>
		</div>
		<div class="sidebar-row sidebar-row-top">ARTIST</div>
		<div class="sidebar-line">
			<ul>
				<li><a href="#">Queen</a></li>
				<li><a href="#">Michael Jackson</a></li>
				<li><a href="#">Pink Floyd</a></li>
				<li><a href="#">David Gilmour</a></li>
				<li><a href="#">Nirvana</a></li>
				<li><a href="#">Deep Purple</a></li>
				<li><a href="#">Metallica</a></li>
				<li><a href="#">The Beatles</a></li>
				<li><a href="#">Led Zeppelin</a></li>
				<li><a href="#">The Rolling Stones</a></li>
				<li><a href="#">See more...</a></li>
			</ul>
		</div>
	</div>
	<div class="content">
		<div class="content-gmain">
			<div class="content-blk content-blk-first"><a href="{{ route('store', ['category_id' => [2]]) }}"><span>VINYL RECORDS</span></a></div>
			<div class="content-blk content-blk-second"><a href="{{ route('store', ['category_id' => [3, 4]]) }}"><span>CD & SACD</span></a></div>
			<div class="content-blk content-blk-third"><a href="{{ route('store', ['category_id' => [6, 7]]) }}"><span>DVD & Blu-Ray</span></a></div>
			{{-- <div class="content-blk-mm content4"><img class="content-img" src="9.jpg"></div>
			<div class="content-blk-mm content5"><img class="content-img" src="62.jpg"></div>
			<div class="content-blk-mm content6"><img class="content-img" src="82.jpg"></div>
			<div class="content-blk-mm content7"><img class="content-img" src="22.jpg"></div>
			<div class="content-blk-mm content8"><img class="content-img" src="box2.jpg"></div>
			<div class="content-blk-mm content9"><img class="content-img" src="t.jpg"></div>
			<div class="content-blk-mm content10"><img class="content-img" src="32.png"></div> --}}
		</div>
	</div>
@endsection