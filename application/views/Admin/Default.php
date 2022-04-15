<h2>Master Data Jenis Usaha</h2>
<table width="100%" cellpadding="0" cellspacing="1" class="griddata">
    <tbody>
        <tr>
            <th>Jenis</th>
			<th>Aksi</th>
        </tr>
		<?php
			foreach($resultSet1->result() as $row){
				$rowClass = alternator("ganjil","genap");
		?>
                <tr class="<?php echo $rowClass; ?>">
                    <td><?php echo $row->Nama; ?></td>
					<td><?php echo anchor("admin/crudjenis/tipe/tambah","Tambah");?><br/><?php echo anchor("admin/crudjenis/tipe/hapus/id/".$row->JenisID,"Hapus");?><br/><?php echo anchor("admin/crudjenis/tipe/ubah/id/".$row->JenisID,"Ubah");?></td>
                </tr>
        <?php	
			}
        ?>
    </tbody>
</table>
<br/>
<h2>Master Data Tipe Usaha</h2>
<table width="100%" cellpadding="0" cellspacing="1" class="griddata">
    <tbody>
        <tr>
            <th>Tipe</th>
			<th>Aksi</th>
        </tr>
		<?php
			foreach($resultSet2->result() as $row){
				$rowClass = alternator("ganjil","genap");
		?>
                <tr class="<?php echo $rowClass; ?>">
                    <td><?php echo $row->Nama; ?></td>
					<td><?php echo anchor("admin/crudtipe/tipe/tambah","Tambah");?><br/><?php echo anchor("admin/crudtipe/tipe/hapus/id/".$row->TipeID,"Hapus");?><br/><?php echo anchor("admin/crudtipe/tipe/ubah/id/".$row->TipeID,"Ubah");?></td>
                </tr>
        <?php	
			}
        ?>
    </tbody>
</table>