@extends('layouts.zircos_layout')
@section('css')
@endsection
@section('page-title')
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">
			<div class="btn-group pull-right">
				
			</div>
			<h4 class="page-title">Tambah Terapi</h4>
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
			{!! Form::open(array('route' => 'terapi.store','method'=>'POST', 'class' => 'form-horizontal form-groups-bordered' )) !!}
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Jenis</label>

				<div class="col-sm-5">
					{!! Form::text('jenis', null, array('placeholder' => 'Jenis','class' => 'form-control', 'required' => true)) !!}
				</div>
			</div>



			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-5">
					<button type="submit" class="btn btn-default">Tambah</button>
				</div>
			</div>
			{!! Form::close() !!}


		</div>

	</div>
</div>

@endsection


@section('js')
@endsection