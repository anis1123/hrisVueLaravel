@extends('install.layout')

@section('content')
<div class="card card-default">
  <div class="card-header text-center">System Settings</div>
	<div class="card-body">

		<form action="{{ url('install/finish') }}" method="post" autocomplete="off">
			{{ csrf_field() }}

			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">Company Name</label>
				<input type="text" class="form-control" name="company_name" required>
			  </div>
			</div>

			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">Short Name</label>
				<input type="text" class="form-control" name="short_name" required>
			  </div>
			</div>

			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">Phone</label>
				<input type="text" class="form-control" name="phone" required>
			  </div>
			</div>

			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">Email</label>
				<input type="text" class="form-control" name="email" required>
			  </div>
			</div>

			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label">Pan No.</label>
					<input type="text" class="form-control" name="pan_no" required>
				</div>
			</div>
			<div class="col-md-12">
			  <div class="form-group">
				<label class="control-label">Currency Symbol</label>
				<input type="text" class="form-control" name="currency" required>
			  </div>
			</div>

			<div class="col-md-12">
				<button type="submit" id="next-button" class="btn btn-install">Finish</button>
		    </div>
		</form>

	</div>
</div>
@endsection

