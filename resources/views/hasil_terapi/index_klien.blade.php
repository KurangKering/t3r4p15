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
			<h4 class="page-title">Daftar Hasil Terapi</h4>
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
							<th>Nama Anak</th>
							<th>Terapi</th>
							<th width="1%" class="text-nowrap">Pertemuan Ke</th>
							<th width="1%" class="text-nowrap">Tanggal</th>
							<th>Hasil</th>
						</tr>
					</thead>
					<tbody>
						@php $no = 1; @endphp
						@foreach($hasil_terapi as $hasil)
						<tr>
							<td width="1%"  class="text-center text-nowrap">{{ $no++ }}</td>
							<td width="15%">{{ $hasil->terapi_anak->anak->nama }}</td>
							<td width="15%">{{ $hasil->terapi_anak->terapi->jenis }}</td>
							<td width="1%">{{ $hasil->pertemuan_ke }}</td>
							<td width="1%">{{ indonesian_date($hasil->tanggal, 'j F Y') }}</td>
							<td width="1%" nowrap>

								
								<button class="btn  btn-info" onclick="show_modal('{{ $hasil->id }}')">Lihat</button>
								<button class="btn  btn-danger" onclick="window.open('{{ route('hasil_terapi.cetak', $hasil->id) }}', '_blank');">PDF</button>

							</td>
							
						</tr>
						@endforeach
					</tbody>

				</table>
			</div>

		</div> <!-- end card-box -->
	</div> <!-- end col -->
</div>

@include('hasil_terapi.modal_hasil')
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
					axios.post('{{ route('hasil_terapi.index') }}'+'\/'+id, {
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
						errors = err.response;
						swal({
							icon : 'error',
							closeOnClickOutside: false,
							text : 'Data Sedang Digunakan',
						});
						
					})
				}

			})
		}
	</script>
	@endsection