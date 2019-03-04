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
				<a href="{{ route('pengguna.create') }}" class="btn btn-primary btn-sm  btn-icon icon-left">
					<i class="entypo-plus"></i>
					Tambah Pengguna
				</a>
			</div>
			<h4 class="page-title">Daftar Pengguna</h4>
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
						<th>Email</th>
						<th>Hak Akses</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@php $no = 1; @endphp
					@foreach($users as $user)
					<tr>
						<td width="1%" style="white-space: nowrap;" class="text-center">{{ $no++ }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td width="15%">{{ $user->role }}</td>
						<td width="1%" style="white-space: nowrap">
							<button class="btn btn-success" onclick="location.href='{{ route('pengguna.edit', $user->id) }}'">Edit</button>
							<button class="btn btn-warning">Delete</button>
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
<script src="{{ asset('template/backend/assets/js/neon-chat.js') }}"></script>

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
	@endsection