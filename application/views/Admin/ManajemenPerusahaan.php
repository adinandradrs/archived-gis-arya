<script type="text/javascript">
	$(document).ready(function(){
		$('#tanggalTextField').datepicker({ dateFormat: 'yy-mm-dd' });
	});
</script>
<?php 
	if($crud == "tambah"){
?>
<?php
	echo form_open("admin/addperusahaan");
?>
	<table>
		<tr>
			<td>Nama Perusahaan</td>
			<td>:</td>
			<td><?php echo form_input(array('name'=> 'namaTextField','id'=> 'namaTextField')); ?></td>
		</tr>
		<tr>
			<td valign="top">Alamat</td>
			<td>:</td>
			<td><?php echo form_textarea(array('name'=> 'alamatTextField','id'=> 'alamatTextField')); ?></td>
		</tr>
		<tr>
			<td>Jenis Usaha</td>
			<td>:</td>
			<td><?php echo form_dropdown('jenisComboBox', $jenis, 'large'); ?></td>
		</tr>
		<tr>
			<td>Tipe Usaha</td>
			<td>:</td>
			<td><?php echo form_dropdown('tipeComboBox', $tipe, 'large'); ?></td>
		</tr>
		<tr>
			<td>Kecamatan</td>
			<td>:</td>
			<td><?php echo form_dropdown('kecamatanComboBox', $kecamatan, 'large'); ?></td>
		</tr>
		<tr>
			<td valign="top">Deskripsi</td>
			<td>:</td>
			<td><?php echo form_textarea(array('name'=> 'deskripsiTextField','id'=> 'deskripsiTextField')); ?></td>
		</tr>
		<tr>
			<td>Tanggal Bergabung</td>
			<td>:</td>
			<td><?php echo form_input(array('name'=> 'tanggalTextField','id'=> 'tanggalTextField'));?></td>
		</tr>
		<tr>
			<td>Southing</td>
			<td>:</td>
			<td><?php echo form_input(array('name'=> 'southingTextField','id'=> 'southingTextField'));?></td>
		</tr>
		<tr>
			<td>Easting</td>
			<td>:</td>
			<td><?php echo form_input(array('name'=> 'eastingTextField','id'=> 'eastingTextField'));?></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><?php echo form_submit('saveButton', 'Simpan'); ?></td>
		</tr>
	</table>
<?php
	echo form_close();
?>
<?php
	}
	else if($crud == "ubah"){
	foreach($resultSet->result() as $row){
		$id = $row->PerusahaanID;
		$nama = $row->Nama;
		$alamat = $row->Alamat;
		$jenisID = $row->JenisID;
		$tipeID = $row->TipeID;
		$kecamatanID = $row->KecamatanID;
		$deskripsi = $row->Deskripsi;
		$tanggal = $row->TanggalBergabung;
		$southing = $row->Southing;
		$easting = $row->Easting;
	}
?>
	<?php
	echo form_open("admin/editperusahaan");
?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#idTextField").attr("readonly",'readonly');
		});
	</script>
	<table>
		<tr>
			<td>ID Perusahaan</td>
			<td>:</td>
			<td><?php echo form_input(array('name'=> 'idTextField','id'=> 'idTextField','value'=>$id)); ?></td>
		</tr>
		<tr>
			<td>Nama Perusahaan</td>
			<td>:</td>
			<td><?php echo form_input(array('name'=> 'namaTextField','id'=> 'namaTextField','value'=>$nama)); ?></td>
		</tr>
		<tr>
			<td valign="top">Alamat</td>
			<td>:</td>
			<td><?php echo form_textarea(array('name'=> 'alamatTextField','id'=> 'alamatTextField','value'=>$alamat)); ?></td>
		</tr>
		<tr>
			<td>Jenis Usaha</td>
			<td>:</td>
			<td><?php echo form_dropdown('jenisComboBox', $jenis, $jenisID); ?></td>
		</tr>
		<tr>
			<td>Tipe Usaha</td>
			<td>:</td>
			<td><?php echo form_dropdown('tipeComboBox', $tipe, $tipeID); ?></td>
		</tr>
		<tr>
			<td>Kecamatan</td>
			<td>:</td>
			<td><?php echo form_dropdown('kecamatanComboBox', $kecamatan, $kecamatanID); ?></td>
		</tr>
		<tr>
			<td valign="top">Deskripsi</td>
			<td>:</td>
			<td><?php echo form_textarea(array('name'=> 'deskripsiTextField','id'=> 'deskripsiTextField','value'=>$deskripsi)); ?></td>
		</tr>
		<tr>
			<td>Tanggal Bergabung</td>
			<td>:</td>
			<td><?php echo form_input(array('name'=> 'tanggalTextField','id'=> 'tanggalTextField', 'value'=>$tanggal));?></td>
		</tr>
		<tr>
			<td>Southing</td>
			<td>:</td>
			<td><?php echo form_input(array('name'=> 'southingTextField','id'=> 'southingTextField','value'=>$southing));?></td>
		</tr>
		<tr>
			<td>Easting</td>
			<td>:</td>
			<td><?php echo form_input(array('name'=> 'eastingTextField','id'=> 'eastingTextField', 'value'=>$easting));?></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><?php echo form_submit('saveButton', 'Simpan'); ?></td>
		</tr>
	</table>
<?php
	echo form_close();
?>
<?php
	}
?>