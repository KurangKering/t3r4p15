@extends('layouts.zircos_layout')
@section('css')
<link rel="stylesheet" href="{{ asset('template/backend/assets/js/datatables/datatables.css') }}">
<link rel="stylesheet" href="{{ asset('template/backend/assets/js/select2/select2-bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('template/backend/assets/js/select2/select2.css') }}">
@endsection
@section('page-title')
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">
			<div class="btn-group pull-right">
				<a href="{{ route('anak.create') }}" class="btn btn-primary btn-sm  btn-icon icon-left">
					<i class="entypo-plus"></i>
					Tambah Anak
				</a>
			</div>
			<h4 class="page-title">	Daftar Anak</h4>
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

			<table class="table table-bordered datatable hidden" id="table-pengguna">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Tempat Lahir</th>
						<th>Tanggal Lahir</th>
						<th>Anak Ke</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@php $no = 1; @endphp
					@foreach($data_anak as $anak)
					<tr>
						<td width="1%" style="white-space: nowrap;" class="text-center">{{ $no++ }}</td>
						<td width="15%">{{ $anak->nama }}</td>
						<td width="15%">{{ $anak->tempat_lahir }}</td>
						<td width="15%">{{ indonesian_date($anak->tanggal_lahir, 'd M Y') }}</td>
						<td width="15%">
							{{ $anak->anak_ke . ' ' }} 
							@if ($anak->klien->nama_ayah)

							{{ 'Mr '.$anak->klien->nama_ayah }}

							@elseif($anak->klien->nama_ibu)

							{{ 'Mrs '.$anak->klien->nama_ibu }}

							@else
							{{ '-' }}
							@endif
						</td>
						<td width="1%" style="white-space: nowrap">
							<button class="btn btn-success" onclick="location.href='{{ route('anak.edit', $anak->id) }}'">Edit</button>
							<button class="btn btn-warning" onclick="showDelete({{ $anak->id }})">Delete</button>
						</td>
					</tr>
					@endforeach
				</tbody>

			</table>

		</div> <!-- end card-box -->
	</div> <!-- end col -->
</div>

@endsection


@section('js')
<script src="{{ asset('template/backend/assets/js/datatables/datatables.js') }}"></script>
<script src="{{ asset('template/backend/assets/js/select2/select2.min.js') }}"></script>

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
			
			// Initalize Select Dropdown after DataTables is created
			$table1.closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
				minimumResultsForSearch: -1
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
					axios.post('{{ route('anak.index') }}'+'\/'+id, {
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