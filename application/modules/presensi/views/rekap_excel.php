<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=rekap-".date('d-m-Y').".xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	?>
	<center>
		<h2>Rekap Presensi <?= date('d F Y',strtotime($tgl_awal)).' s/d '.date('d F Y',strtotime($tgl_akhir))?></h2>
	</center>
	<table width="100%" border="1">
		<thead>
			<tr>
				<th>
					No
				</th>
				<th>
					Nama Pegawai
				</th>
				<th>
					Jabatan
				</th>
				<th>
					Tanggal
				</th>
				<th>
					Jam Masuk
				</th>
				<th>
					Jam Keluar
				</th>
			</tr>
		</thead>
		<tbody style="text-align: center;">
			<?php 
			$no=0;
			foreach ($list as $key => $value) { ?>
				<tr>
					<th><?= ++$no;?></th>
					<th><?= $value->nama_peg?></th>
					<th><?= $value->jabatan?></th>
					<th><?= date('d F Y',strtotime($value->tanggal))?></th>
					<th><?= $value->jam_masuk?></th>
					<th><?= $value->jam_keluar?></th>
				</tr>
			<?php }?>
		</tbody>
	</table>
</body>
</html>