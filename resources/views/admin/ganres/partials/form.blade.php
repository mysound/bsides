@include('admin.layouts.errors-admin')

<label for="">Title</label>
<input class="form-control" type="text" name="title" placeholder="Ganre title" value="{{ $ganre->title ?? "" }}" required="">

<hr/>

<input class="btn btn-primary" type="submit" value="Save">

<hr>