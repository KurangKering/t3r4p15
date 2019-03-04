@extends('layouts.zircos_layout')
@section('css')
@endsection
@section('page-title')
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">
			<div class="btn-group pull-right">
				
			</div>
			<h4 class="page-title">Ubah Terapi Anak</h4>
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
			{!! Form::open(array('route' => ['terapi_anak.update', $terapi_anak->id],'method'=>'PATCH', 'class' => 'form-horizontal form-groups-bordered' )) !!}
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Nama Anak</label>

				<div class="col-sm-5">
					{!! Form::select('anak_id', $data_anak, $terapi_anak->anak_id, array('class' => 'form-control', 'required' => true)) !!}
				</div>
			</div>
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Terapis</label>

				<div class="col-sm-5">
					{!! Form::select('terapis_id',$terapis, $terapi_anak->terapis_id, array('class' => 'form-control', 'required' => true)) !!}
					
				</div>
			</div>
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Jenis Terapi</label>

				<div class="col-sm-5">
					{!! Form::select('terapi_id',$jenis_terapi, $terapi_anak->terapi_id, array('class' => 'form-control', 'required' => true)) !!}
					
				</div>
			</div>
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Status</label>
				@php
				$status = ['N' => 'Belum Selesai', 'Y' => 'Selesai'];
				@endphp
				<div class="col-sm-5">
				{!! Form::select('status',Config::get('enums.status_terapi_anak'), $terapi_anak->status, array('class' => 'form-control', 'required' => true)) !!}

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