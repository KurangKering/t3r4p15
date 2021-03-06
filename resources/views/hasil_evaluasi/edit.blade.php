@extends('layouts.zircos_layout')
@section('css')
<link href="{{ asset('plugins/summernote/dist/summernote-lite.css') }}" rel="stylesheet" type="text/css" />
@parent

@endsection
@section('page-title')
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">
			<div class="btn-group pull-right">
				
			</div>
			<h4 class="page-title">Ubah Hasil Evaluasi </h4>
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
			{!! Form::open(array('route' => ['hasil_evaluasi.update', $hasil_evaluasi->id],'method'=>'PATCH', 'class' => 'form-horizontal form-groups-bordered' )) !!}

			<div class="form-group">
				<label for="field-1" class="col-sm-2 control-label">Nama Anak</label>
				<div class="col-sm-10">
					{!! Form::text(null,$terapi_anak->anak->nama , array('placeholder' => '','class' => 'form-control',  'disabled' => true)) !!}
				</div>
			</div>
			<div class="form-group">
				<label for="field-1" class="col-sm-2 control-label">Terapi</label>
				<div class="col-sm-10">
					{!! Form::text(null,$terapi_anak->terapi->jenis , array('placeholder' => '','class' => 'form-control', 'disabled' => true)) !!}
				</div>
			</div>
			
			<div class="form-group">
				<label for="field-1" class="col-sm-2 control-label">Tanggal</label>
				<div class="col-sm-10">
					{!! Form::date('tanggal', $hasil_evaluasi->tanggal,  array('placeholder' => '','class' => 'form-control', 'required' => true)) !!}
				</div>
			</div>
			

			<div class="form-group">
				<label for="field-1" class="col-sm-2 control-label">Hasil Terapi</label>

				<div class="col-sm-10">
					@forelse ($data_hasil_terapi as $hasil_terapi)
					<div class="checkbox checkbox-primary">
						<input 
						{{ in_array($hasil_terapi->id, $hasil_evaluasi->hasil_evaluasi_terapi->pluck('hasil_terapi_id')->toArray()) ? 'checked' : '' }}

						value="{{ $hasil_terapi->id }}" name="hasil_terapi_ids[]" id="{{ $hasil_terapi->id }}" type="checkbox">
						<label for="{{ $hasil_terapi->id }}">
							{{ 'Pertemuan ke ' . $hasil_terapi->pertemuan_ke . ' Tanggal ' . indonesian_date($hasil_terapi->tanggal, 'j F Y') }}
						</label>

						<button type="button" onclick="show_modal('{{ $hasil_terapi->id }}')" class="btn btn-info btn-xs" style="margin-left: 20px;">Lihat</button>
						<button type="button" onclick="window.open('{{ route('hasil_terapi.cetak', $hasil_terapi->id) }}', '_blank');"  class="btn btn-danger btn-xs" style="margin-left: 20px;">PDF</button>
					</div>
					&nbsp;
					@empty
					<p class="form-control ">Tidak Ada Hasil Terapi</p>
					@endforelse
					
					
					
				</div>
			</div>
			<div class="form-group">
				<label for="field-1" class="col-sm-2 control-label">Hasil Evaluasi</label>
				<div class="col-sm-10">
					{!! Form::textarea('hasil', null, array('placeholder' => 'Jenis','class' => 'summernote', 'required' => true)) !!}
				</div>
			</div>



			<div class="form-group">
				<div class="col-sm-offset-6 col-sm-4">
					<button type="submit" class="btn btn-primary">Ubah</button>
				</div>
			</div>
			{!! Form::close() !!}


		</div>

	</div>
</div>
@include('hasil_terapi.modal_hasil')

@endsection


@section('js')
<script src="{{ asset('plugins/summernote/dist/summernote-lite.min.js') }}"></script>
<script src="{{ asset('plugins/summernote-paper-size/summernote-paper-size.js') }}"></script>



<script>
	$(document).ready(function() {
		$('.summernote').summernote({
			height : '842px',
			toolbar : [
			['style', ['style']],
			['font', ['bold', 'italic', 'underline', 'clear']],
			['fontname', ['fontname']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			['table', ['table']],
			['insert', ['media', 'link', 'hr']],
			['views', ['fullscreen', 'codeview']],
			['help', ['help']],
			['paperSize', ['paperSize']],

			]
		});

		$("a[data-value='A4']").trigger('click');
		var content = {!! json_encode($hasil_evaluasi->hasil) !!};
		$('.summernote').summernote('code', content);
	});


</script>
@endsection