@include('admin.layouts.errors-admin')

<label for="">Title</label>
<input class="form-control" type="text" name="title" placeholder="Barnd title" value="{{ $brand->title ?? "" }}" required="">

<hr/>

<input class="btn btn-primary" type="submit" value="Save">

<hr>