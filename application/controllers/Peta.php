<?php
	class Peta extends MY_Controller{
		
		function __construct(){
			parent::__construct();
		}
		
		//susun peta di halaman peta setelah diklik
		function queryMap(){
			$arr = $this->initiate();
			$layer = $this->layerMap($arr);
			$this->layerArgomulyo($layer);
			$this->layerSidomukti($layer);
			$this->layerTingkir($layer);
			$this->layerSidorejo($layer);
			$this->layerJalan($arr);
			$this->mapConfigure($arr);
			
			$objExtent = explode (" ",$this->input->post("extent")); 
			$PosisiKlik = ms_newPointObj();
			$PosisiKlikX = $this->input->post("mapa_x");
			$PosisiKlikY = $this->input->post("mapa_y"); 
			$PosisiKlik->SetXY ($PosisiKlikX, $PosisiKlikY);
			$MinX = $objExtent[0];
			$MinY = $objExtent[1];
			$MaxX = $objExtent[2];
			$MaxY = $objExtent[3];
			$objKotak = ms_newRectObj();
			$objKotak->SetExtent ($MinX, $MinY, $MaxX, $MaxY);
			
			$xmi = $arr["map"]->extent->minx;
			$ymi = $arr["map"]->extent->miny;
			$xma = $arr["map"]->extent->maxx;
			$yma = $arr["map"]->extent->maxy;
			$PanjangPeta = $xma - $xmi;
			$LebarPeta = $yma - $ymi;
			$PanjangImage = $arr["map"]->width;
			$LebarImage = $arr["map"]->height;
			$RasioX = $PanjangPeta / $PanjangImage;
			$RasioY = $LebarPeta / $LebarImage;
			$x1Pix = $PosisiKlik->x;
			$y1Pix = $LebarImage - $PosisiKlik->y;
			$AbMap = $xmi + $x1Pix * $RasioX;
			$OrMap = $ymi + $y1Pix * $RasioY;
			$arr["clickLocation"]->SetXY ($AbMap,$OrMap); 
			if (@$layer->QueryByPoint($arr["clickLocation"], MS_SINGLE, 0)==MS_SUCCESS) 
			{
				$hasil = $layer->GetResult(0);
				$layer->Open();
				$oShape = $layer->GetShape ($hasil->tileindex, $hasil->shapeindex);
				$sessData = array(
					'nama' => $oShape->values["KEC"],
					'kecamatanID' => $oShape->values["KEC_NO"]
				);
				
				$where = array("kecamatanID" => $oShape->values["KEC_NO"]);
				$this->getFromGPSbyPlace($arr,$where);
				$this->session->set_userdata($sessData);
				$layer->Close();
			}
			
			$data["mapImage"] = $this->drawQueryMap($arr);
			$data["mapLegend"] = $this->drawLegend($arr);
			$sessPeta = array("gambarPeta" => "C:/ms4w/tmp".$data["mapImage"], "gambarLegend" => "C:/ms4w/tmp".$data["mapLegend"]);
			$this->session->set_userdata($sessPeta);
			$data["mapRect"] = $arr["map"]->extent->minx." ".$arr["map"]->extent->miny." ".$arr["map"]->extent->maxx." ".$arr["map"]->extent->maxy;  			
			$data["title"] = "Peta Salatiga";
			$data["content"] = $this->load->view("Content/Peta.php",$data,TRUE);
			$this->load->view("Layout/Template",$data);
		}
		
		function lokasiJenis(){
			$uri = $this->uri->uri_to_assoc(3);	
			$kecamatanID =  $this->session->userdata('kecamatanID');
			$where = array(
				"KecamatanID" => $kecamatanID,
				"JenisID" => $uri["id"]
			);
			
			$data["title"] = "Peta Salatiga";	
			$arr = $this->initiate();
			$layer = $this->layerMap($arr);
			$warna = array(0=>238,1=>232,2=>170);
			$this->getFromGPSbyKategori($arr,$where,$warna);
			$this->layerArgomulyo($layer);
			$this->layerSidomukti($layer);
			$this->layerTingkir($layer);
			$this->layerSidorejo($layer);
			$this->layerJalan($arr);
			$this->mapConfigure($arr);
			$data["mapImage"] = $this->drawMap($arr);
			$data["mapLegend"] = $this->drawLegend($arr);
			$sessPeta = array("gambarPeta" => "C:/ms4w/tmp".$data["mapImage"], "gambarLegend" => "C:/ms4w/tmp".$data["mapLegend"]);
			$this->session->set_userdata($sessPeta);
			$data["mapRect"] = $arr["map"]->extent->minx." ".$arr["map"]->extent->miny." ".$arr["map"]->extent->maxx." ".$arr["map"]->extent->maxy;
			$data["content"] = $this->load->view("Content/Peta.php",$data,TRUE);
			$this->load->view("Layout/Template",$data);
		}

		//fungsi lokasi berdasarkan tipe
		function lokasiTipe(){
			$uri = $this->uri->uri_to_assoc(3);	
			$kecamatanID =  $this->session->userdata('kecamatanID');
			$where = array(
				"KecamatanID" => $kecamatanID,
				"TipeID" => $uri["id"]
			);
			
			$data["title"] = "Peta Salatiga";	
			$arr = $this->initiate();
			$layer = $this->layerMap($arr);
			$warna = array(0=>4,1=>28,2=>10);
			$this->getFromGPSbyKategori($arr,$where,$warna);
			$this->layerArgomulyo($layer);
			$this->layerSidomukti($layer);
			$this->layerTingkir($layer);
			$this->layerSidorejo($layer);
			$this->layerJalan($arr);
			$this->mapConfigure($arr);
			$data["mapImage"] = $this->drawMap($arr);
			$data["mapLegend"] = $this->drawLegend($arr);
			
			$sessPeta = array("gambarPeta" => "C:/ms4w/tmp".$data["mapImage"], "gambarLegend" => "C:/ms4w/tmp".$data["mapLegend"]);
			$this->session->set_userdata($sessPeta);
			$data["mapRect"] = $arr["map"]->extent->minx." ".$arr["map"]->extent->miny." ".$arr["map"]->extent->maxx." ".$arr["map"]->extent->maxy;
			$data["content"] = $this->load->view("Content/Peta.php",$data,TRUE);
			$this->load->view("Layout/Template",$data);	
		}
		
		//fungsi lokasi berdasarkan tipe
		function lokasiPerusahaan(){
			$uri = $this->uri->uri_to_assoc(3);	
			$kecamatanID =  $this->session->userdata('kecamatanID');
			$where = array(
				"KecamatanID" => $kecamatanID,
				"PerusahaanID" => $uri["id"]
			);
			
			$data["title"] = "Peta Salatiga";	
			$arr = $this->initiate();
			$layer = $this->layerMap($arr);
			$warna = array(0=>72,1=>61,2=>139);
			$this->getFromGPSbyKategori($arr,$where,$warna);
			$this->layerArgomulyo($layer);
			$this->layerSidomukti($layer);
			$this->layerTingkir($layer);
			$this->layerSidorejo($layer);
			$this->layerJalan($arr);
			$this->mapConfigure($arr);
			$data["mapImage"] = $this->drawMap($arr);
			$data["mapLegend"] = $this->drawLegend($arr);
			
			$sessPeta = array("gambarPeta" => "C:/ms4w/tmp".$data["mapImage"], "gambarLegend" => "C:/ms4w/tmp".$data["mapLegend"]);
			$this->session->set_userdata($sessPeta);
			$data["mapRect"] = $arr["map"]->extent->minx." ".$arr["map"]->extent->miny." ".$arr["map"]->extent->maxx." ".$arr["map"]->extent->maxy;
			$data["content"] = $this->load->view("Content/Peta.php",$data,TRUE);
			$this->load->view("Layout/Template",$data);	
		}
		
		//fungsi lokasi berdasarkan bulan
		function lokasiBulan(){
			$uri = $this->uri->uri_to_assoc(3);	
			$kecamatanID =  $this->session->userdata('kecamatanID');
			$where = array(
				"KecamatanID" => $kecamatanID,
				"MONTH(TanggalBergabung)" => $uri["id"]
			);
			
			$data["title"] = "Peta Salatiga";	
			$arr = $this->initiate();
			$layer = $this->layerMap($arr);
			$warna = array(0=>4,1=>28,2=>10);
			$this->getFromGPSbyKategori($arr,$where,$warna);
			$this->layerArgomulyo($layer);
			$this->layerSidomukti($layer);
			$this->layerTingkir($layer);
			$this->layerSidorejo($layer);
			$this->layerJalan($arr);
			$this->mapConfigure($arr);
			$data["mapImage"] = $this->drawMap($arr);
			$data["mapLegend"] = $this->drawLegend($arr);
			
			$sessPeta = array("gambarPeta" => "C:/ms4w/tmp".$data["mapImage"], "gambarLegend" => "C:/ms4w/tmp".$data["mapLegend"]);
			$this->session->set_userdata($sessPeta);
			$data["mapRect"] = $arr["map"]->extent->minx." ".$arr["map"]->extent->miny." ".$arr["map"]->extent->maxx." ".$arr["map"]->extent->maxy;
			$data["content"] = $this->load->view("Content/Peta.php",$data,TRUE);
			$this->load->view("Layout/Template",$data);	
		}
		
		//eksport peta
		function exportPeta(){
			$gambarPeta = $this->session->userdata("gambarPeta");
			$gambarLegend = $this->session->userdata("gambarLegend");
			$pdf = new FPDF('L','cm',array(31,22));
			$pdf->SetFont('Arial','',7);
			$pdf->AddPage();
			$pdf->Image($gambarPeta);
			$pdf->Image($gambarLegend);
			$pdf->Output();
		}
		
	}
?>