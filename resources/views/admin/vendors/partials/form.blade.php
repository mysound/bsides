@include('admin.layouts.errors-admin')

<label for="">Title</label>
<input class="form-control" type="text" name="title" placeholder="Vendor title" value="{{ $vendor->title ?? "" }}" required="">

<label for="">SKU</label>
<input class="form-control" type="text" name="vendor_sku" placeholder="Vendor SKU" value="{{ $vendor->vendor_sku ?? "" }}">

<hr/>

<input class="btn btn-primary" type="submit" value="Save">

<hr>