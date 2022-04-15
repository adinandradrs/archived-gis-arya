<table width="100%" cellpadding="0" cellspacing="1" class="griddata">
    <tbody>
        <tr>
            <th>Jenis Usaha</th>
            <th>Jumlah</th>
        </tr>
        <?php
            if($totalRow > 0){
                foreach($resultSet->result() as $row){
                    $rowClass = alternator("ganjil","genap");
        ?>	
                    <tr class="<?php echo $rowClass; ?>">
                        <td><?php echo anchor("peta/lokasijenis/id/".$row->JenisID."#linkJenisUsaha",$row->Nama); ?></td>
                        <td><?php echo $row->Jumlah; ?></td>
                    </tr>
        <?php
                }
            }
            else{
        ?>
            <tr>
                <td colspan="2" align="center"><i>Tidak ada data</i></td>
            </tr>
        <?php
            }
        ?>
    </tbody>
</table>