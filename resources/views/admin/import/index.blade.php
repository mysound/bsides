@extends('admin.layouts.app-admin')

@section('content')
	<div class="panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Import List @endslot
			@slot('parent') Main @endslot
			@slot('active') Import @endslot
		@endcomponent
		<div class="row">
			<div class="col-sm-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Добавление каталога</h5>
						<a href="{{ route('admin.import.create', ['sku' => 'BSC-']) }}" class="btn btn-info btn-block">B-Sides Catalog</a>
						<a href="{{ route('admin.import.create', ['sku' => 'WMR-']) }}" class="btn btn-info btn-block">Warner Music</a>
						<a href="{{ route('admin.import.create', ['sku' => 'UMG-']) }}" class="btn btn-info btn-block">Universal Music</a>
						<a href="{{ route('admin.import.create', ['sku' => 'UMRU-']) }}" class="btn btn-info btn-block">Universal Music CYR</a>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Импорт картинок</h5>
						<a href="{{ route('admin.import.imgcreate') }}" class="btn btn-warning btn-block">Import Images</a><br>
						<h5 class="card-title">Предзаказ</h5>
						<a href="{{ route('admin.import.preorder') }}" class="btn btn-success btn-block">Warner Music Pre-Order - Import File</a><br>
						<h5 class="card-title">eBay File Exchange</h5>
						<a href="{{ route('admin.import.create', ['sku' => 'ebay']) }}" class="btn btn-success btn-block">Import ebay File Exchange</a>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Обновление количества</h5>
						<p class="card-text">Обновление количества и цены в базе данных</p>
						<a href="{{ route('admin.import.quantity') }}" class="btn btn-success btn-block">Warner Music - WMR</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection