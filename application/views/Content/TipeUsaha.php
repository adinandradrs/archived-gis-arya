<table width="100%" cellpadding="0" cellspacing="1" class="griddata">
    <tbody>
        <tr>
            <th rowspan="2">Tipe Usaha</th>
            <th colspan="<?php echo $totalRow; ?>">Bulan di Tahun 2012</th>
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
                        <th style="text-align:center;"><?php echo anchor("peta/lokasibulan/id/".$row->BulanIdx."#linkTipeUsaha",$row->Bulan); ?></th>
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
                $resultSet = $this->GISModel->joinData("Perusahaan p", "t.Nama, t.TipeID", $tableJoin, $on, $where, "p.TipeID");
                $totalRow = $resultSet ? $resultSet->num_rows() : 0;
                foreach($resultSet->result() as $row1){
                    $class = alternator("ganjil","genap");
            ?>
                    <tr>
                        <td class="<?php echo $class; ?>"><?php echo anchor("peta/lokasitipe/id/".$row1->TipeID."#linkTipeUsaha",$row1->Nama); ?></td>
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