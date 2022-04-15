<?php
	echo form_open("Perusahaan/addPerusahaan");
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
			<td>Telepon</td>
			<td>:</td>
			<td><?php echo form_input(array('name'=> 'teleponTextField','id'=> 'teleponTextField')); ?></td>
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
			<td></td>
			<td></td>
			<td><?php echo form_submit('saveButton', 'Simpan'); ?></td>
		</tr>
	</table>
<?php
	echo form_close();
?>