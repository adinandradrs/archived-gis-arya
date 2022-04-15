<?php 
	if($crud == "tambah"){
?>

<?php
	echo form_open("admin/addTipe");
?>
<table>
	<tr>
		<td>Tipe</td>
		<td>:</td>
		<td><?php echo form_input(array("name"=>"namaTextField"));?></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><?php echo form_submit("","Simpan");?></td>
	</tr>
</table>
<?php
	echo form_close();
	}
	
?>

<?php 
	if($crud == "ubah"){
?>

<?php
	echo form_open("admin/editTipe");
	foreach($resultSet->result() as $row){
		$nama = $row->Nama;
		$id = $row->TipeID;
	}
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#idTextField").attr("readonly",'readonly');
	});
</script>
	
<table>
	<tr>
		<td>ID</td>
		<td>:</td>
		<td><?php echo form_input(array("name"=>"idTextField","id"=>"idTextField","value"=>$id));?></td>
	</tr>
	<tr>
		<td>Tipe</td>
		<td>:</td>
		<td><?php echo form_input(array("name"=>"namaTextField","value"=>$nama));?></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><?php echo form_submit("","Simpan");?></td>
	</tr>
</table>
<?php
	echo form_close();
	}
	
?>