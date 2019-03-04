@extends('layouts.zircos_layout')
@section('css')
@endsection
@section('page-title')
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">
			<div class="btn-group pull-right">
				
			</div>
			<h4 class="page-title">Ubah Pengguna</h4>
		</div>
	</div>
</div>
@endsection
@section('content')

<div class="row">
	<div class="col-md-12">

		<div class="card-box">
			@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Terdapat Error !!!</strong><br><br>
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			{!! Form::open(array('route' => ['pengguna.update', $pengguna->id],'method'=>'POST', 'class' => 'form-horizontal form-groups-bordered' )) !!}
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Nama</label>

				<div class="col-sm-5">
					{!! Form::text('name', $pengguna->name, array('placeholder' => 'Nama','class' => 'form-control')) !!}
				</div>
			</div>
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Email</label>

				<div class="col-sm-5">
					{!! Form::email('email', $pengguna->email, array('placeholder' => 'Email','class' => 'form-control')) !!}
				</div>
			</div>
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Password</label>

				<div class="col-sm-5">
					{!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}

				</div>
			</div>
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Confirm Password</label>

				<div class="col-sm-5">
					{!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}

				</div>
			</div>


			<div class="form-group">
				<label class="col-sm-3 control-label">Hak Akses</label>

				<div class="col-sm-5">
					<select class="form-control" name="role">
						@foreach(\Config::get('enums.roles') as $index => $role)
						<option {{ $pengguna->role == $index ? 'selected' : '' }} value="{{ $index }}">{{ $role }}
						</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-5">
					<button type="submit" class="btn btn-default">Sign in</button>
				</div>
			</div>
			{!! Form::close() !!}

		</div>

	</div>
</div>

@endsection


@section('js')
@endsection