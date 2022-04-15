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
	
	table.griddata {
		margin: 0 0 0 0;
		padding: 0 0 0 0;
		background: #B4C7DA;
	}
	table.griddata a:visited{
		color:blue;
	}
	table.griddata th {
		background: #E1E9F0;
		font-size: 13px;
	}

	table.griddata th, table.griddata td {
		padding: 5px 10px;
	}

	.ganjil {
		background: white;
	}

	.genap {
		background: #F8F8F8;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Tipe Usaha - <?php echo $this->session->userdata('NAMA'). " Tahun ".$tahun; ?></h1>

	<div id="body">
		<table width="100%" cellpadding="0" cellspacing="1" class="griddata">
			<tbody>
				<tr>
					<th rowspan="2">Tipe Usaha</th>
					<th colspan="<?php echo $totalRow; ?>">Bulan</th>
				</tr>
				<tr>
					<?php
						$monthArr = array();
						$i = 0;
						if($totalRow > 0){
							foreach($resultSet->result() as $row){
								$monthArr[$i] = $row->Bulan;
								$i++;
								
				?>
								<th style="text-align:center;"><?php echo $row->Bulan; ?></th>
				<?php
							}
						}
				?>
				</tr>
				<tr>
					<?php
						$where = array(
							"YEAR(p.Tanggalbergabung)" => $tahun,
							"p.KecamatanID" => $kecamatanID
						);
						$tableJoin = array(
							0 => "tipe t"
						);
						$on = array(
							0 => "p.TipeID = t.TipeID"
						);
						$resultSet = $this->GISModel->joinData("Perusahaan p", "t.Nama", $tableJoin, $on, $where, "p.TipeID");
						$totalRow = $resultSet ? $resultSet->num_rows() : 0;
						foreach($resultSet->result() as $row1){
							$class = alternator("ganjil","genap");
					?>
							<tr>
								<td class="<?php echo $class; ?>"><?php echo $row1->Nama; ?></td>
								<?php
									foreach($monthArr as $m){
										$where = array(
											"YEAR(p.Tanggalbergabung)" => $tahun,
											"t.Nama" => $row1->Nama,
											"MONTHNAME(p.TanggalBergabung)" => $m,
											"p.KecamatanID" => $kecamatanID
										);
										$tableJoin = array(
											0 => "tipe t"
										);
										$on = array(
											0 => "p.TipeID = t.TipeID"
										);
										$resultSet2 = $this->GISModel->joinData("Perusahaan p", "t.Nama, count(t.TipeID) as Jumlah", $tableJoin, $on, $where, "p.TipeID");
										$totalRow2 = $resultSet2 ? $resultSet2->num_rows() : 0;
										if($totalRow2 > 0){
											foreach($resultSet2->result() as $row2)
											{
												
								?>
												<td class="<?php echo $class; ?>"><?php  echo $row2->Jumlah; ?></td>
								<?php
												
											}
										}
										else{
								?>
											<td class="<?php echo $class; ?>">0</td>
								<?php
										}
									}
								?>
							</tr>
					<?php
						}
					?>
					 
				</tr>
			</tbody>
		</table>
	</div>
	
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>