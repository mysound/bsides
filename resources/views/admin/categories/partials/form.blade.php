<label for="">Title</label>
@if(empty($category))
	<input class="form-control" type="text" name="title" placeholder="Category title" value="" required="">
@else
	<input class="form-control" type="text" name="title" placeholder="Category title" value="{{ $category->title }}" required="">
@endif

<label for="">Slug</label>
@if(empty($category))
	<input class="form-control" type="text" name="slug" placeholder="Automatically created" value="" readonly="">
@else
	<input class="form-control" type="text" name="slug" placeholder="Automatically created" value="{{ $category->slug }}" readonly="">
@endif

<label for="">Parent category</label>
<select class="form-control" name="parent_id">
	<option value="0">-- without parent category --</option>
	@include('admin.categories.partials.categories', ['categories' => $categories])
</select>

<hr/>

<input class="btn btn-primary" type="submit" value="Save">

<hr>