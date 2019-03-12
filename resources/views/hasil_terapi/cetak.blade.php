<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Laporan Hasil Terapi</title>
	<link rel="stylesheet" href="{{ asset('css/cetak.css') }}">
</head>
<body>
	
	<div class="header">
		<img src="{{ asset('images/kop-surat.jpg') }}" alt="">

		
	</div>
	<div class="content">
		<h3 class="text-center">Laporan Hasil Terapi Anak</h3>

		<table class="table-identitas">

			<tr>
				<th>Nama anak</th>
				<td>:</td>
				<td>{{ ($hasil_terapi->terapi_anak->anak->nama) }}</td>
			</tr>
			<tr>
				<th>Nama orang tua</th>
				<td>:</td>
				<td>{{ ($hasil_terapi->terapi_anak->anak->klien->nama_ayah) }}</td>
			</tr>
			<tr>
				<th>Jenis terapi</th>
				<td>:</td>
				<td>{{ ($hasil_terapi->terapi_anak->terapi->jenis) }}</td>
			</tr>
			<tr>
				<th>Tanggal</th>
				<td>:</td>
				<td>{{ indonesian_date($hasil_terapi->tanggal, 'j F Y') }}</td>
			</tr>
			<tr>
				<th>Pertemuan ke</th>
				<td>:</td>
				<td>{{ ($hasil_terapi->pertemuan_ke) }}</td>
			</tr>
		</table>

		{!! $hasil_terapi->hasil !!}
	</div>
	<div class="footer breakNow">
		<p class="keterangan-waktu">{{ 'Pekanbaru,' }}{!! str_repeat('&nbsp;', 4)  !!}{{ indonesian_date(now(), 'F Y') }}</p>
		
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
				<td>{{ $hasil_terapi->terapi_anak->terapis->user->name }}</td>
			</tr>
		</table>
	</div>
</body>
</html>