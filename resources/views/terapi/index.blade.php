@extends('layouts.zircos_layout')
@section('css')

@endsection
@section('page-title')
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">
			<div class="btn-group pull-right">
				<a href="{{ route('terapi.create') }}" class="btn btn-primary btn-sm  btn-icon icon-left">
					<i class="entypo-plus"></i>
					Tambah Terapi
				</a>
			</div>
			<h4 class="page-title">Daftar Terapi</h4>
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
				<table class="table table-striped table-bordered hidden" id="table-pengguna">
					<thead>
						<tr>
							<th>No</th>
							<th>Jenis</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@php $no = 1; @endphp
						@foreach($data_terapi as $terapi)
						<tr>
							<td width="1%" style="white-space: nowrap;" class="text-center">{{ $no++ }}</td>
							<td >{{ $terapi->jenis }}</td>
							<td width="1%" style="white-space: nowrap">
								<button class="btn btn-success" onclick="location.href='{{ route('terapi.edit', $terapi->id) }}'">Edit</button>
								<button class="btn btn-warning" onclick="showDelete({{ $terapi->id }})">Delete</button>
							</td>
						</tr>
						@endforeach
					</tbody>

				</table>
			</div>

		</div> <!-- end card-box -->
	</div> <!-- end col -->
</div>


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
					axios.post('{{ route('terapi.index') }}'+'\/'+id, {
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