<?php
	if($this->session->userdata("hasLogin") == TRUE){
		$options = array(
			"pdf" => "*.pdf",
			"xls" => "*.xls"
		);
		echo form_open("Admin/doExport");
		echo "EXPORT : ". form_dropdown("exportComboBox",$options)." ";
		echo form_submit("","Download");
		echo form_close();
	}
?>
<table width="100%" cellpadding="0" cellspacing="1" class="griddata">
    <tbody>
        <tr>
            <th>Nama Perusahaan</th>
            <th>Alamat Perusahaan</th>
            <th>Deskripsi</th>
			<?php
				if($this->session->userdata("hasLogin") == TRUE)
				{
			?>
					<th>Aksi</th>
			<?php
				}
			?>
        </tr>
		<?php
			foreach($resultSet->result() as $row){
				$rowClass = alternator("ganjil","genap");
		?>
                <tr class="<?php echo $rowClass; ?>">
                    <td><?php echo $row->Nama; ?></td>
                    <td><?php echo $row->Alamat; ?></td>
                    <td><?php echo $row->Deskripsi; ?></td>
					<?php
						if($this->session->userdata("hasLogin") == TRUE)
						{
					?>
							<td><?php echo anchor("admin/crudperusahaan/tipe/tambah","Tambah");?><br/><?php echo anchor("admin/crudperusahaan/tipe/hapus/id/".$row->PerusahaanID,"Hapus");?><br/><?php echo anchor("admin/crudperusahaan/tipe/ubah/id/".$row->PerusahaanID,"Ubah");?></td>
					<?php
						}
					?>
                </tr>
        <?php	
			}
        ?>
    </tbody>
</table>
<?php echo $this->pagination->create_links(); ?>