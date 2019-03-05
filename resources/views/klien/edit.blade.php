@extends('layouts.zircos_layout')
@section('css')
@endsection
@section('page-title')
<h3>
	Ubah Klien
</h3>
@endsection
@section('content')

<div class="row">
	<div class="col-md-12">

		<div class="panel panel-primary" data-collapsed="0">

			<div class="panel-body">
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
				{!! Form::open(array('route' => ['klien.update', $klien->id],'method'=>'PATCH', 'class' => 'form-horizontal form-groups-bordered' )) !!}
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Nama Pengguna</label>

					<div class="col-sm-5">
						{!! Form::text('nama_pengguna', $klien->user->name, array('placeholder' => '','class' => 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Email Login</label>

					<div class="col-sm-5">
						{!! Form::email('email', $klien->user->email, array('placeholder' => '','class' => 'form-control')) !!}
					</div>
				</div>
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Password</label>

					<div class="col-sm-5">
						{!! Form::password('password', array('placeholder' => 'Isi Jika Ingin Mengubah Password','class' => 'form-control')) !!}

					</div>
				</div>
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Confirm Password</label>

					<div class="col-sm-5">
						{!! Form::password('confirm-password', array('placeholder' => 'Samakan Dengan Field Password','class' => 'form-control')) !!}

					</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Nama Ayah</label>

					<div class="col-sm-5">
						{!! Form::text('nama_ayah', $klien->nama_ayah, array('placeholder' => '','class' => 'form-control')) !!}
					</div>
				</div>
				

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">No HP Ayah</label>

					<div class="col-sm-5">
						{!! Form::number('hp_ayah', $klien->hp_ayah, array('placeholder' => '','class' => 'form-control')) !!}
					</div>
				</div>

				
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Email Ayah</label>

					<div class="col-sm-5">
						{!! Form::email('email_ayah', $klien->email_ayah, array('placeholder' => '','class' => 'form-control')) !!}
					</div>
				</div>


				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Nama Ibu</label>

					<div class="col-sm-5">
						{!! Form::text('nama_ibu', $klien->nama_ibu, array('placeholder' => '','class' => 'form-control')) !!}
					</div>
				</div>
				

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">No HP Ibu</label>

					<div class="col-sm-5">
						{!! Form::number('hp_ibu', $klien->hp_ibu, array('placeholder' => '','class' => 'form-control')) !!}
					</div>
				</div>

				
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Email Ibu</label>

					<div class="col-sm-5">
						{!! Form::email('email_ibu', $klien->email_ibu, array('placeholder' => '','class' => 'form-control')) !!}
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
</div>

@endsection


@section('js')
@endsection