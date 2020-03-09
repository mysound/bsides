@extends('admin.layouts.app-admin')

@section('content')
	<div class="panel panel-default">
		@component('admin.components.breadcrumb')
			@slot('title') Ganres List @endslot
			@slot('parent') Main @endslot
			@slot('active') Ganres @endslot
		@endcomponent
		<div class="row">
			<div class="col-md-4">
				<a href="{{ route('admin.ganre.create') }}" class="btn btn-primary pull-right">+ Add Ganre</a>
			</div>
		</div>
		<br>
		<table class="table table-striped">
			<thead>
				<th>Title</th>
				<th>Edit</th>
				<th class="text-right">Delete</th>
			</thead>
			<tbody>
				@forelse($ganres as $ganre)
					<tr>
						<td>{{ $ganre->title }}</td>
						<td><a href="{{ route('admin.ganre.edit', $ganre->id) }}" class="btn btn-primary btn-sm">Edit</a></td>
						<td class="text-right">
							<form method="POST" action="{{ route('admin.ganre.destroy', $ganre) }}" onsubmit="if(confirm('Delete?')){ return true }else{ return false }">
								@method('DELETE')
								@csrf
								<button type="submit" class="btn btn-danger btn-sm">Delete</button>
							</form>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="3" class="text-center"><h2>Empty</h2></td>
					</tr>
				@endforelse
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3">
						<ul class="pagination pull-right">{{ $ganres->links() }}</ul>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
@endsection