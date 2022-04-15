<table width="100%" cellpadding="0" cellspacing="1" class="griddata">
    <tbody>
        <tr>
            <th>Nama Perusahaan</th>
            <th>Alamat Perusahaan</th>
            <th>Deskripsi</th>
        </tr>
		<?php
			foreach($resultSet->result() as $row){
				$rowClass = alternator("ganjil","genap");
		?>
                <tr class="<?php echo $rowClass; ?>">
                    <td><?php echo anchor("peta/lokasiperusahaan/id/".$row->PerusahaanID,$row->Nama); ?></td>
                    <td><?php echo $row->Alamat; ?></td>
                    <td><?php echo $row->Deskripsi; ?></td>
                </tr>
        <?php	
			}
        ?>
    </tbody>
</table>