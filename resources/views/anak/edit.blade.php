@extends('layouts.zircos_layout')
@section('css')
@endsection
@section('page-title')
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">
			<div class="btn-group pull-right">
				
			</div>
			<h4 class="page-title">Ubah Data Anak</h4>
		</div>
	</div>
</div>

@endsection
@section('content')

<div class="row">
	<div class="col-md-12">

		<div class="card-box" >

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
			{!! Form::open(array('route' => ['anak.update', $anak->id],'method'=>'PATCH', 'class' => 'form-horizontal form-groups-bordered' )) !!}
			
			
			
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Nama Anak</label>

				<div class="col-sm-5">
					{!! Form::text('nama', $anak->nama, array('placeholder' => '','class' => 'form-control')) !!}
				</div>
			</div>
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Tempat Lahir Anak</label>

				<div class="col-sm-5">
					{!! Form::text('tempat_lahir', $anak->tempat_lahir, array('placeholder' => '','class' => 'form-control')) !!}
				</div>
			</div>
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Tanggal Lahir Anak</label>

				<div class="col-sm-5">
					{!! Form::date('tanggal_lahir', $anak->tanggal_lahir, array('placeholder' => '','class' => 'form-control')) !!}
				</div>
			</div>
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Anak Ke</label>

				<div class="col-sm-5">
					{!! Form::number('anak_ke', $anak->anak_ke, array('placeholder' => '','class' => 'form-control')) !!}
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-5">
					<button type="submit" class="btn btn-default">Ubah</button>
				</div>
			</div>
			{!! Form::close() !!}

		</div>

	</div>
</div>

@endsection


@section('js')
@endsection