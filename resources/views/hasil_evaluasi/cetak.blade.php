<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Laporan Perkembangan Anak</title>
	<link rel="stylesheet" href="">
	<style>
	@page {
		margin-left: 3cm ;
		margin-right: 3cm ;
		margin-top: 1cm ;
		margin-bottom: 3cm ;
		padding: 0px;
	}
	.text-justify {
		text-align: justify !important;
	}

	.text-nowrap {
		white-space: nowrap !important;
	}

	.text-truncate {
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}

	.text-left {
		text-align: left !important;
	}

	.text-right {
		text-align: right !important;
	}

	.text-center {
		text-align: center !important;
	}


	.table {
		width: 100%;
		margin-bottom: 1rem;
		background-color: transparent;
	}
	.table {
		border-collapse: collapse !important;
	}


	.table-bordered {
		border: 1px solid #000;
	}


	.table-bordered th,
	.table-bordered td {
		border: 1px solid #000;
	}

	.table-bordered thead th,
	.table-bordered thead td {
		border-bottom-width: 2px;
	}


	#table-detail th, #table-detail td {
		padding: 10px;
	}

	#table-data th {
		text-align: left;

	}
	#table-data th, #table-data td {
		padding: 5px;
	}

	.heading-title {
		font-weight: bold;
		text-align: center;
		font-size: 18px;
	}
	.table-identitas {
		width: 100%;
		margin-bottom: 1rem;
		background-color: transparent;
		border-collapse: collapse !important;

	}
	.table-identitas tr td {
		padding: 3px;
	}
	.table-identitas tr th {
		font-weight: normal;
		width: 40%;
		text-align: left;
	}
	.table-identitas tr td:nth-child(2) {
		width: 2%;
		text-align: left;
	}
	.ttd-area {
		margin-top: 40px;
	}

	.keterangan {
		margin-bottom: 30px;
	}
	.table-ttd tr td:nth-child(1){
		width: 65%;
		white-space: nowrap;
	}
	.table-ttd tr td:nth-child(2){
		text-align: center;
	}
	.breakNow { page-break-inside:avoid; }
}
</style>
</head>
<body>
	<h3 class="text-center">Laporan Perkembangan Anak</h3>
	<table class="table-identitas">

		<tr>
			<th>Nama anak</th>
			<td>:</td>
			<td>{{ ($hasil_evaluasi->terapi_anak->anak->nama) }}</td>
		</tr>
		<tr>
			<th>Nama orang tua</th>
			<td>:</td>
			<td>{{ ($hasil_evaluasi->terapi_anak->anak->klien->nama_ayah) }}</td>
		</tr>
		<tr>
			<th>Jenis terapi</th>
			<td>:</td>
			<td>{{ ($hasil_evaluasi->terapi_anak->terapi->jenis) }}</td>
		</tr>
		<tr>
			<th>Periode</th>
			<td>:</td>
			<td>{{ ($periode) }}</td>
		</tr>
		<tr>
			<th>Pertemuan</th>
			<td>:</td>
			<td>{{ ($hasil_evaluasi->hasil_evaluasi_terapi->count() . ' kali pertemuan') }}</td>
		</tr>
	</table>
	{!! $hasil_evaluasi->hasil !!}
	<div class="ttd-area breakNow">
		<p class="keterangan">{{ 'Pekanbaru,' }}{!! str_repeat('&nbsp;', 4)  !!}{{ indonesian_date(now(), 'F Y') }}</p>

		<table width="100%" class="table-ttd">
			<tr>
				<td>Mengetahui</td>
				<td></td>
			</tr>
			<tr>
				<td>Pimpinan</td>
				<td>Terapis</td>
			</tr>
			<tr >
				<td style="height: 80px;"></td>
				<td></td>
			</tr>
			<tr>
				<td>{{ Config::get('enums.nama_pimpinan') }}</td>
				<td>{{ $hasil_evaluasi->terapi_anak->terapis->user->name }}</td>
			</tr>
		</table>
	</div>
</body>
</html>