<?php
	class Grafik extends MY_Controller{
		
		function __construct(){
			parent::__construct();	
		}
		
		function grafikJumlahUsaha(){
			//QUERY 1
			$tableJoin = array(
				0 => "Kecamatan k" 				   
			);
			$on = array(
				0 => "k.KecamatanID = p.KecamatanID"
			);
			$resultSet = $this->GISModel->joinData("perusahaan p", "COUNT(p.PerusahaanID) as Jumlah, k.Nama", $tableJoin, $on, "", "k.KecamatanID", "", 0);
			
			//GRAFIK 1
			$graph_swfFile      = base_url().'FusionChart/swf/Column3D.swf' ;
			$graph_caption      = 'Jumlah Usaha (SIUP) / Wilayah' ;
			$graph_numberPrefix = '' ;
			$graph_title        = '' ;
			$graph_width        = 850 ;
			$graph_height       = 300 ;	
        	$strXML = "<graph caption='".$graph_caption."' numberPrefix='".$graph_numberPrefix."' formatNumberScale='0' decimalPrecision='0'>";
			foreach ($resultSet->result() as $row)
				$strXML .= "<set name='" . $row->Nama . "' value='" . $row->Jumlah . "' color='".getFCColor()."' />";
			$strXML .= "<styles><definition><style name='CanvasAnim' type='animation' param='_xScale' start='0' duration='1' /></definition><application><apply toObject='Canvas' styles='CanvasAnim' /></application></styles></graph>";
			$data['response']  = renderChart($graph_swfFile, $graph_title, $strXML, "div" , $graph_width, $graph_height);
			//JSON ENCODE
			echo json_encode($data);
		}
		
		function grafikJenisUsaha(){
			//QUERY 2
			$resultSet1 = $this->GISModel->getListOfData("Kecamatan","");		
			$resultSet2 = $this->GISModel->getListOfData("Jenis","");
			
			//GRAFIK 2
			$graph_swfFile      = base_url().'FusionChart/swf/MSColumn3D.swf';
			$graph_caption      = 'Jenis Usaha / Wilayah' ;
			$graph_numberPrefix = '' ;
			$graph_title        = '' ;
			$graph_width        = 850 ;
			$graph_height       = 300 ;	

			$strXML = "<graph caption='".$graph_caption."' numberPrefix='".$graph_numberPrefix."' formatNumberScale='0' decimalPrecision='0'>";
			$strXML .= "<categories>";
			foreach($resultSet1->result() as $row)
				$strXML .= "<category label='".$row->Nama."' />";
			$strXML .= "</categories>";
			
			foreach($resultSet2->result() as $row2){
				$strXML .= "<dataset seriesName='".$row2->Nama."'>";
				foreach($resultSet1->result() as $row1){
					$where = array("KecamatanID"=>$row1->KecamatanID, "JenisID"=>$row2->JenisID);
					$resultSet3 = $this->GISModel->getListOfData("Perusahaan","count(PerusahaanID) as Jumlah",0,0,$where);
					foreach($resultSet3->result() as $row3){
						$strXML .= "<set value='".$row3->Jumlah."'/>";
					}
				}
				$strXML .= "</dataset>";
			}
			$strXML .= "<styles><definition><style name='CanvasAnim' type='animation' param='_xScale' start='0' duration='1' /></definition><application><apply toObject='Canvas' styles='CanvasAnim' /></application></styles></graph>";

			$data['response'] = renderChart($graph_swfFile, $graph_title, $strXML, "asd" , $graph_width, $graph_height);
			echo json_encode($data);
			//JSON ENCODE
		}
		
	}
?>