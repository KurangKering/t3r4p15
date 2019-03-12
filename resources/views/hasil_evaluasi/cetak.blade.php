<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Laporan Hasil Evaluasi</title>
	<link rel="stylesheet" href="{{ asset('css/cetak.css') }}">
</head>
<body>
	
	<div class="header">
		<img src="{{ asset('images/kop-surat.jpg') }}" alt="">

		
	</div>
	<div class="content">
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
		
	</div>
	<div class="footer breakNow">
		
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