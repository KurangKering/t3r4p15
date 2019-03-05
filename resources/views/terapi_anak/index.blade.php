@extends('layouts.zircos_layout')
@section('css')


<style>
th {
	white-space: nowrap;
}
th:last-child {
	text-align: center;
}
</style>
@endsection
@section('page-title')
<div class="row">
	<div class="col-sm-12">
		<div class="page-title-box">
			<div class="btn-group pull-right">
				<a href="{{ route('terapi_anak.create') }}" class="btn btn-primary btn-sm  btn-icon icon-left">
					<i class="entypo-plus"></i>
					Tambah Terapi Anak
				</a>
			</div>
			<h4 class="page-title">Daftar Terapi Anak</h4>
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
				<table class="table table-bordered table-striped hidden table-respon" id="table-pengguna">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Anak</th>
							<th>Jenis Terapi</th>
							<th>Terapis</th>
							<th>Status</th>
							<th>Pertemuan</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@php $no = 1; @endphp
						@foreach($data_terapi_anak as $terapi_anak)
						<tr>
							<td width="1%" style="white-space: nowrap;" class="text-center">{{ $no++ }}</td>
							<td width="15%">{{ $terapi_anak->anak->nama }}</td>
							<td width="15%">{{ $terapi_anak->terapi->jenis }}</td>
							<td width="15%">{{ $terapi_anak->terapis->user->name }}</td>
							<td width="15%">{{ Config::get('enums.status_terapi_anak')[$terapi_anak->status] }}</td>
							<td width="15%">{{ isset($terapi_anak->hasil_terapi) ? count($terapi_anak->hasil_terapi) : '0' }}</td>
							<td width="1%" style="white-space: nowrap">
								<div class="btn-group">
									<button type="button" class="btn btn-purple dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false"> Hasil Terapi <span class="caret"></span> </button>
									<ul class="dropdown-menu">
										<li><a href="{{ route('hasil_terapi.index', ['terapi_anak_id' => $terapi_anak->id]) }}">Lihat</a></li>

										<li><a  href="{{ route('hasil_terapi.create') . '?terapi_anak_id='.$terapi_anak->id }}">Tambah</a></li>
									</ul>
								</div>
							</div>
							<div class="btn-group">
								<button type="button" class="btn btn-brown dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false"> Hasil Evaluasi <span class="caret"></span> </button>
								<ul class="dropdown-menu">
									<li><a href="{{ route('hasil_evaluasi.index', ['terapi_anak_id' => $terapi_anak->id]) }}">Lihat</a></li>
									<li><a href="{{ route('hasil_evaluasi.create') . '?terapi_anak_id='.$terapi_anak->id }}">Tambah</a></li>
								</ul>
							</div>
						</div>


						<button class="btn btn-success" onclick="location.href='{{ route('terapi_anak.edit', $terapi_anak->id) }}'">Edit</button>
						<button class="btn btn-warning" onclick="showDelete({{ $terapi_anak->id }})">Delete</button>
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