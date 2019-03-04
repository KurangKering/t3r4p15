@extends('layouts.zircos_layout')
@section('css')
<link href="{{ asset('plugins/summernote/dist/summernote-lite.css') }}" rel="stylesheet" type="text/css" />


@endsection
@section('page-title')
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">
			<div class="btn-group pull-right">
				
			</div>
			<h4 class="page-title">Edit Hasil Terapi Anak</h4>
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
			{!! Form::open(array('route' => ['hasil_terapi.update', $hasil_terapi],'method'=>'PATCH', 'class' => 'form-horizontal form-groups-bordered' )) !!}
			<div class="form-group">
				<label for="field-1" class="col-sm-2 control-label">Pertemuan Ke</label>
				<div class="col-sm-10">
					{!! Form::text('pertemuan_ke', $hasil_terapi->pertemuan_ke, array('placeholder' => '','class' => 'form-control', 'readonly' => true)) !!}
				</div>
			</div>
			<div class="form-group">
				<label for="field-1" class="col-sm-2 control-label">Tanggal</label>
				<div class="col-sm-10">
					{!! Form::date('tanggal', $hasil_terapi->tanggal,  array('placeholder' => '','class' => 'form-control', 'required' => true)) !!}
				</div>
			</div>
			<div class="form-group">
				<label for="field-1" class="col-sm-2 control-label">Hasil Terapi</label>
				<div class="col-sm-10">
					{!! Form::textarea('hasil', null, array('placeholder' => '','class' => 'summernote', 'required' => true)) !!}
				</div>
			</div>



			<div class="form-group">
				<div class="col-sm-offset-6 col-sm-4">
					<button type="submit" class="btn btn-primary">Tambah</button>
				</div>
			</div>
			{!! Form::close() !!}


		</div>

	</div>
</div>

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

		$("a[data-value='A4']").trigger('click')

		var content = {!! json_encode($hasil_terapi->hasil) !!};
            //set the content to summernote using `code` attribute.
            $('.summernote').summernote('code', content);
        });
    </script>
    @endsection