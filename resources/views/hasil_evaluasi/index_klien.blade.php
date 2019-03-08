@extends('layouts.zircos_layout')
@section('css')
@parent
@endsection
@section('page-title')
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">
			<div class="btn-group pull-right">
				{{-- <a href="{{ route('terapi.create') }}" class="btn btn-primary btn-sm  btn-icon icon-left">
					<i class="entypo-plus"></i>
					Tambah Terapi
				</a> --}}
			</div>
			<h4 class="page-title">Dasftar Hasil Evaluasi</h4>
		</div>
	</div>
</div>

@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="card-box">

			@if (Session::has('success'))
			<div class="alert alert-success">
				<strong>{{ session('msg') }}</strong>

			</div>
			@endif

			<div class="table-responsive">
				<table class="table table-bordered table-striped hidden" id="table-pengguna">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Terapi</th>
							<th>Jumlah Pertemuan</th>
							<th>Hasil</th>
						</tr>
					</thead>
					<tbody>
						@php $no = 1; @endphp
						@foreach($hasil_evaluasi as $evaluasi)
						<tr>
							<td width="1%" style="white-space: nowrap;" class="text-center">{{ $no++ }}</td>
							<td width="15%">{{ $evaluasi->terapi_anak->anak->nama }}</td>
							<td width="15%">{{ $evaluasi->terapi_anak->terapi->jenis }}</td>
							<td width="1%" >{{ count(($evaluasi->hasil_evaluasi_terapi)) }}</td>
							<td width="1%" class="text-nowrap">
								<button class="btn  btn-info" onclick="show_modal('{{ $evaluasi->id }}')">Lihat</button>
								<button class="btn  btn-danger " onclick="window.open('{{ route('hasil_evaluasi.cetak', $evaluasi->id) }}', '_blank');">PDF</button>
							</td>
							
						</tr>
						@endforeach
					</tbody>

				</table>
			</div>

		</div> <!-- end card-box -->
	</div> <!-- end col -->
</div>

@include('hasil_evaluasi.modal_hasil')

@endsection


@section('js')


<script type="text/javascript">
	jQuery( document ).ready( function( $ ) {
		var $table1 = jQuery( '#table-pengguna' );

			// Initialize DataTable
			$table1.DataTable( {
				"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
				"bStateSave": true,
				initComplete : function() {
					$(this).removeClass('hidden');
				},
			});
			
			
		} );
	</script>

	<script>
		function showDelete(id) 
		{
			swal({
				icon : 'warning',
				text : 'Yakin ingin Menghapus data ?',
				buttons : {
					yes : {
						className : 'btn btn-danger',
					},
					no : {
						className : 'btn btn-warning',

					}
				},
				closeOnClickOutside : false,
			})
			.then(resp => {
				if (resp == 'yes') 
				{
					axios.post('{{ route('hasil_evaluasi.index') }}'+'\/'+id, {
						_method : 'DELETE',
						_token : '{{ csrf_token() }}',
						
					})
					.then(response => {
						resp = response.data;
						if (resp.success) {
							location.reload();
						} else {
							swal('Ada Error');
						}
						
					})
					.catch(err => {

					})
				}

			})
		}
	</script>
	@endsection