<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sistem Informasi Geografi Indeks Usaha Masyarakat</title>
	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
		overflow:auto;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Sistem Informasi Geografi Usaha Masyarakat Salatiga !</h1>

	<div id="body">
		
		<div style="float:left;">
			<p>
				<?php echo form_open("admin/queryMap"); ?>
					<input type=image name="mapa" src="<?php echo $mapImage; ?>" />
					<input type=hidden name="extent" value="<?php echo $mapRect; ?>" />
				<?php echo form_close(); ?>
				<img src=<?php echo  $mapLegend ?>><br>
			</p>
		</div>
		
		<div style="float:left;margin-left:20px">
			<li><?php echo anchor("admin/daftarKecamatan","Daftar Kecamatan");?></li>
			<li><?php echo anchor("admin/daftarPerusahaan","Daftar Perusahaan");?></li>
			<li><?php echo anchor("admin/jenisUsaha","Jenis Usaha");?></li>
			<li><?php echo anchor("admin/tipeUsaha","Tipe Usaha");?></li>
			<br />
			<li><?php echo anchor("admin/grafikPerusahaan","Grafik Perusahaan");?></li>
			<li><?php echo anchor("admin/laporanPerusahaan","Laporan Perusahaan");?></li>
			<li><?php echo anchor("admin/persebaranPerusahaan","Persebaran Perusahaan");?></li>
			<br />
			<li><?php echo anchor("admin/logout","Logout");?></li>
		</div>
	</div>
	
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>