<?php 
	class MY_Controller extends CI_Controller{
	
		function __construct(){
			parent::__construct();
		}
		
		public function initiate()
		{
			if (!extension_loaded ("MapScript"))
				dl ('php_mapscript.'.PHP_SHLIB_SUFFIX);
			$arr["map"] = ms_NewMapObj("");
			$arr["clickLocation"] = ms_newPointObj();
			$arr["clickPosition"] = ms_newPointObj();
			$arr["map"]->Set ("name", "Kab");
			$arr["map"]->setSize (1100, 700);
			$arr["map"]->setExtent(110.44, -7.40, 110.55 , -7.28); 
			$arr["map"]->Set("units", MS_DD); // derajat
			$arr["map"]->imagecolor->SetRGB ( 234,234, 234);
			$arr["map"]->Set ("shapepath", "C:/ms4w/Apache/htdocs/GIS/salatigamap/"); 
			$arr["map"]->SetFontSet ("C:/ms4w/Apache/htdocs/GIS/simbol/font/font.lst");
			$arr["map"]->SetSymbolSet("C:/ms4w/Apache/htdocs/sumba/map/simbol/simbol.sym");
			$arr["map"]->web->set("imagepath","c:/ms4w/tmp/ms_tmp/");
			$arr["map"]->web->set("imageurl","/ms_tmp/");
			return $arr;
		}
		
		//layer peta
		function layerMap($arr)
		{
			$layer = ms_newLayerObj($arr["map"]); 
			$layer->set ("name", "Kec");
			$layer->set ("type", MS_LAYER_POLYGON);
			$layer->set ("status", MS_DEFAULT);
			$layer->set ("data","salatiga_kecamatan.shp");
			$layer->set ("labelitem","Kec"); 
			$layer->set ("classitem","Kec_no");
			return $layer;
		}

		//layer argomulyo
		function layerArgomulyo($layer)
		{
			$objClassArgomulyo = ms_newClassObj($layer);
			$objClassArgomulyo->Set ("name", "Argomulyo");
			$objClassArgomulyo->SetExpression ("010"); 
			$objClassArgomulyo->Set ("template", "C:/ms4w/Apache/htdocs/GIS/template/template.html");
			$objStyleArgomulyo = ms_newStyleObj ($objClassArgomulyo); 
			$objStyleArgomulyo->color->setRGB (255,166,166);
			$objStyleArgomulyo->outlinecolor->SetRGB (0,0,0);
			
			$objClassArgomulyo->label->Set ("font", "arial");
			$objClassArgomulyo->label->Set ("type", MS_TRUETYPE);
			$objClassArgomulyo->label->Set ("size", 9);
			$objClassArgomulyo->label->Set ("position", MS_CC);
			$objClassArgomulyo->label->color->SetRGB (0, 0, 0);
		}
		
		//layer sidomukti
		function layerSidomukti($layer)
		{
			$objClassSidomukti = ms_newClassObj ($layer);
			$objClassSidomukti->Set ("name", "Sidomukti");
			$objClassSidomukti->SetExpression ("030"); 
			$objClassSidomukti->Set ("template", "C:/ms4w/Apache/htdocs/GIS/template/template.html");
			$objStyleSidomukti = ms_newStyleObj ($objClassSidomukti); 
			$objStyleSidomukti->color->setRGB (244, 176, 239);
			$objStyleSidomukti->outlinecolor->SetRGB (0,0,0);
			
			$objClassSidomukti->label->Set ("font", "arial");
			$objClassSidomukti->label->Set ("type", MS_TRUETYPE);
			$objClassSidomukti->label->Set ("size", 9);
			$objClassSidomukti->label->Set ("position", MS_CC);
			$objClassSidomukti->label->color->SetRGB (0, 0, 0);
		}

		//layer sidorejo
		function layerSidorejo($layer)
		{
			$objClassSidorejo = ms_newClassObj ($layer);
			$objClassSidorejo->Set ("name", "Sidorejo");
			$objClassSidorejo->SetExpression ("040"); 
			$objClassSidorejo->Set ("template", "C:/ms4w/Apache/htdocs/GIS/template/template.html");
			$objStyleSidorejo = ms_newStyleObj ($objClassSidorejo); 
			$objStyleSidorejo->color->setRGB (193, 125, 238);
			$objStyleSidorejo->outlinecolor->SetRGB (0,0,0);
			$objClassSidorejo->label->Set ("font", "arial");
			$objClassSidorejo->label->Set ("type", MS_TRUETYPE);
			$objClassSidorejo->label->Set ("size", 9);
			$objClassSidorejo->label->Set ("position", MS_CC);
			$objClassSidorejo->label->color->SetRGB (0, 0, 0);
		}
		
		//layer tingkir
		function layerTingkir($layer)
		{
			$objClassTingkir = ms_newClassObj($layer);
			$objClassTingkir->Set ("name", "Tingkir");
			$objClassTingkir->SetExpression ("020"); 
			$objClassTingkir->Set ("template", "C:/ms4w/Apache/htdocs/GIS/template/template.html");
			$objStyleTingkir = ms_newStyleObj ($objClassTingkir); 
			$objStyleTingkir->color->setRGB (132, 232, 157);
			$objStyleTingkir->outlinecolor->SetRGB (0,0,0);
			$objClassTingkir->label->Set ("font", "arial");
			$objClassTingkir->label->Set ("type", MS_TRUETYPE);
			$objClassTingkir->label->Set ("size", 9);
			$objClassTingkir->label->Set ("position", MS_CC);
			$objClassTingkir->label->color->SetRGB (0, 0, 0);
		}
		
		//point by GPS perusahaan 
		function getFromGPS($arr){
			$gpsLayer = ms_newLayerObj($arr["map"]);
			$gpsLayer->set("name","Nama");
			$gpsLayer->set("type",MS_LAYER_POINT);
			$gpsLayer->set("status",MS_ON);
			$gpsLayer->set("data","gpsperusahaan.shp");
			$gpsLayer->set("classitem","Usahaid");
            $gpsLayer->set("labelitem","Nama");
			$resultSet = $this->GISModel->getListOfData("Perusahaan","");
			foreach($resultSet->result() as $row)
			{
   	            $classTag[$row->PerusahaanID] = ms_newClassObj($gpsLayer);
                $classTag[$row->PerusahaanID]->setExpression($row->PerusahaanID);
                $classTag[$row->PerusahaanID]->set("name",$row->Nama);
		        $styleTag[$row->PerusahaanID] = ms_newStyleObj($classTag[$row->PerusahaanID]);
                //$styleTag[$row->PerusahaanID]->color->setRGB(255, 255, 255);
			    $styleTag[$row->PerusahaanID]->outlinecolor->setRGB(0, 0, 0);
				$tipeID = $row->TipeID;
				if($tipeID == 1){
					$styleTag[$row->PerusahaanID]->set("symbolname", "Kotak");
					$styleTag[$row->PerusahaanID]->color->setRGB(255, 190, 100);
				}
				else if($tipeID == 2){
					$styleTag[$row->PerusahaanID]->set("symbolname", "circle");
					$styleTag[$row->PerusahaanID]->color->setRGB(255, 255, 255);
				}
				else if($tipeID == 3){
					$styleTag[$row->PerusahaanID]->set("symbolname", "Segitiga");
					$styleTag[$row->PerusahaanID]->color->setRGB(20, 15, 120);
				}
			    $styleTag[$row->PerusahaanID]->set("size",7);
			}
		}
		
		function getFromGPSbyPlace($arr, $where){
			$gpsLayer = ms_newLayerObj($arr["map"]);
			$gpsLayer->set("name","Nama");
			$gpsLayer->set("type",MS_LAYER_POINT);
			$gpsLayer->set("status",MS_ON);
			$gpsLayer->set("data","gpsperusahaan.shp");
			$gpsLayer->set("classitem","Usahaid");
            $gpsLayer->set("labelitem","Nama");
			$resultSet = $this->GISModel->getListOfData("Perusahaan","","","",$where);
			foreach($resultSet->result() as $row)
			{
   	            $classTag[$row->PerusahaanID] = ms_newClassObj($gpsLayer);
                $classTag[$row->PerusahaanID]->setExpression($row->PerusahaanID);
                $classTag[$row->PerusahaanID]->set("name",$row->Nama);
		        $styleTag[$row->PerusahaanID] = ms_newStyleObj($classTag[$row->PerusahaanID]);
				//$styleTag[$row->PerusahaanID]->color->setRGB(0, 255, 123);
			    $styleTag[$row->PerusahaanID]->outlinecolor->setRGB(0, 0, 0);
		      	//$styleTag[$row->PerusahaanID]->color->setRGB(255, 255, 255);
			    $styleTag[$row->PerusahaanID]->outlinecolor->setRGB(0, 0, 0);
				$tipeID = $row->TipeID;
				if($tipeID == 1){
					$styleTag[$row->PerusahaanID]->set("symbolname", "Kotak");
					$styleTag[$row->PerusahaanID]->color->setRGB(255, 190, 100);
				}
				else if($tipeID == 2){
					$styleTag[$row->PerusahaanID]->set("symbolname", "circle");
					$styleTag[$row->PerusahaanID]->color->setRGB(255, 255, 255);
				}
				else if($tipeID == 3){
					$styleTag[$row->PerusahaanID]->set("symbolname", "Segitiga");
					$styleTag[$row->PerusahaanID]->color->setRGB(20, 15, 120);
				}
			    $styleTag[$row->PerusahaanID]->set("size",7);
			}
		}
		
		function getFromGPSbyKategori($arr, $where,$warna){
			$gpsLayer = ms_newLayerObj($arr["map"]);
			$gpsLayer->set("name","Nama");
			$gpsLayer->set("type",MS_LAYER_POINT);
			$gpsLayer->set("status",MS_ON);
			$gpsLayer->set("data","gpsperusahaan.shp");
			$gpsLayer->set("classitem","Usahaid");
            $gpsLayer->set("labelitem","Nama");
			$resultSet = $this->GISModel->getListOfData("Perusahaan","","","",$where);
			foreach($resultSet->result() as $row)
			{
   	            $classTag[$row->PerusahaanID] = ms_newClassObj($gpsLayer);
                $classTag[$row->PerusahaanID]->setExpression($row->PerusahaanID);
                $classTag[$row->PerusahaanID]->set("name",$row->Nama);
		        $styleTag[$row->PerusahaanID] = ms_newStyleObj($classTag[$row->PerusahaanID]);
				$styleTag[$row->PerusahaanID]->color->setRGB($warna[0], $warna[1], $warna[2]);
			    $styleTag[$row->PerusahaanID]->outlinecolor->setRGB(0, 0, 0);
		      	$styleTag[$row->PerusahaanID]->set("symbolname", "circle");
			    $styleTag[$row->PerusahaanID]->set("size",7);
			}
		}
		
		function layerJalan($arr)
		{
			$layerJalan = ms_newLayerObj($arr["map"]);
			$layerJalan->set("name","Nama");
			$layerJalan->set("type",MS_LAYER_LINE);
			$layerJalan->set("status",MS_ON);
			$layerJalan->set("data","jalan_salatiga.shp");
			
			$classJalan=ms_newClassObj($layerJalan);
			$styleJalan=ms_newStyleObj($classJalan);
			$styleJalan->color->setRGB(255,0,0);
			$styleJalan->set("width",1);
		}
		
		//konfigurasi peta
		function mapConfigure($arr)
		{
			$arr["map"]->scalebar->Set ("status", MS_EMBED);
			$arr["map"]->scalebar->Set ("style", 1);
			$arr["map"]->scalebar->Set ("intervals", 3);
			$arr["map"]->scalebar->Set ("height", 4);
			$arr["map"]->scalebar->Set ("width", 150);
			$arr["map"]->scalebar->color->SetRGB(0,0,0);
			$arr["map"]->scalebar->backgroundcolor->SetRGB (255,255,255);
			$arr["map"]->scalebar->outlinecolor->SetRGB (0,0,0);
			$arr["map"]->scalebar->Set ("units", 4); // 1 feet, 2 mil, 3 meter, 4 km
			$arr["map"]->scalebar->Set ("position", MS_LL); // bawah-kiri
			$arr["map"]->scalebar->Set ("transparent", 1); // 1 true, 0 false
			$arr["map"]->scalebar->label->Set ("font", "arial");
			$arr["map"]->scalebar->label->Set ("size", MS_MEDIUM);
			$arr["map"]->scalebar->label->color->SetRGB (0,0,0);
			
			$strProj = "proj=latlong,ellps=WGS84,datum=WGS84";
			$arr["map"]->SetProjection ($strProj, MS_FALSE);
			
			$arr["map"]->outputformat->Set ("name", "Format GIF");
			$arr["map"]->outputformat->Set ("extension", "gif");
			
			$arr["map"]->legend->Set ("status", MS_DEFAULT); // selalu muncul
			$arr["map"]->legend->Set ("keysizex", 20);
			$arr["map"]->legend->Set ("keysizey", 13);
			$arr["map"]->legend->Set ("keyspacingx", 20);
			$arr["map"]->legend->Set ("keyspacingy", 5);
			$arr["map"]->legend->Set ("postlabelcache", 1); // true
			$arr["map"]->legend->Set ("transparent", 0); // 0 false, 1 true
			$arr["map"]->legend->outlinecolor->SetRGB (0,0,0);
			$arr["map"]->legend->label->Set ("font", "arial");
			$arr["map"]->legend->label->Set ("position", 1); // rata kiri
			$arr["map"]->legend->label->Set ("size", 9);
			$arr["map"]->legend->label->Set ("offsetx", -10);
			$arr["map"]->legend->label->Set ("offsety", -13);
			$arr["map"]->legend->label->Set ("antialias", 50);     
			$arr["map"]->legend->label->Set ("type", MS_TRUETYPE);
			$arr["map"]->legend->label->color->SetRGB (0,0,0);
			
			$layerGrid = ms_newLayerObj($arr["map"]); 
			$layerGrid->Set ("name", "Grid");
			$layerGrid->set ( "type", MS_LAYER_LINE);
			$layerGrid->Set ("status", MS_ON);
			ms_newGridObj ($layerGrid); // layer menjadi layer grid
			$layerGrid->grid->Set ("labelformat", "DDMM");
			$layerGrid->grid->Set ("minsubdivide", 16);
			$layerGrid->grid->Set ("maxsubdivide", 64);
			$layerGrid->grid->Set ("mininterval", 0.10);
			$layerGrid->grid->Set ("maxinterval", 2.0);
			$layerGrid->grid->Set ("minarcs", 2);
			$layerGrid->grid->Set ("maxarcs", 64);
			$objClassGrid = ms_newClassObj ($layerGrid);
			$objClassGrid->Set ("name", "Graticule");
			$objStyleGrid = ms_newStyleObj ($objClassGrid); 
			$objStyleGrid->color->setRGB (0, 0, 0);
			$objClassGrid->label->Set ("font", "arial");
			$objClassGrid->label->Set ("type", MS_TRUETYPE);
			$objClassGrid->label->Set ("size", 8);
			$objClassGrid->label->Set ("position", MS_UR);
			$objClassGrid->label->color->SetRGB (0, 0, 0);
		}
		
		//gambar peta di halaman web
		function drawMap($arr)
		{
			$objectImage = $arr["map"]->Draw();
			return $objectImage->SaveWebImage();
		}
		
		function drawQueryMap($arr)
		{
			$objectImage = $arr["map"]->DrawQuery();
			return $objectImage->SaveWebImage();
		}
		
		//gambar legenda di halaman web
		function drawLegend($arr)
		{
			$objectLegend = $arr["map"]->DrawLegend();
			return $objectLegend-> SaveWebImage();
		}
		
		//ga tau
		function KonvPixToLB ($xPix, $yPix,$arr)
		{ 
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
			$x1Pix = $xPix;
			$y1Pix = $LebarImage - $yPix;
			$AbMap = $xmi + $x1Pix * $RasioX;
			$OrMap = $ymi + $y1Pix * $RasioY;
			$arr["clickLocation"]->SetXY ($AbMap,$OrMap); 
		} 
	
		//fungsi DB
	
		function listOfKecamatan(){
			$resultSet = $this->GISModel->getListOfData("Kecamatan","");
			$arrKecamatan = array();
			foreach($resultSet->result() as $row){
				$arrKecamatan[$row->KecamatanID] = $row->Nama; 
			}
			return $arrKecamatan;
		}
		
		function listOfJenis(){
			$resultSet = $this->GISModel->getListOfData("Jenis","");
			$arrJenis = array();
			foreach($resultSet->result() as $row){
				$arrJenis[$row->JenisID] = $row->Nama; 
			}
			return $arrJenis;
		}
		
		function listOfTipe(){
			$resultSet = $this->GISModel->getListOfdata("Tipe","");
			$arrTipe = array();
			foreach($resultSet->result() as $row){
				$arrTipe[$row->TipeID] = $row->Nama;
			}
			return $arrTipe;
		}
		
		//PDF
		function pdf($header,$title,$width,$subtitle=""){
			$pdf = new FPDF();
			$pdf->SetFont('Arial','',7);
			$pdf->AddPage('L');
			$pdf->Cell(80);
			$pdf->setFont('Arial','B',15);
			$pdf->Cell(120,10,$title,0,0,'C');
			if($subtitle!=""){
				$pdf->setFont('Arial','B',18);
				$pdf->Cell(-120,20,"Usaha Salatiga",0,0,'C');
				$pdf->setFont('Arial','B',8);
				$pdf->Cell(120,30,$subtitle,0,0,'C');
				$pdf->Ln(10);
			}
			$pdf->setFont('Arial','B',7);
			$pdf->Ln(20);
			$pdf->SetFillColor(255,0,0);
			$pdf->SetTextColor(255);
			$pdf->SetDrawColor(128,0,0);
			$pdf->SetLineWidth(.1);
			$pdf->SetFont('','');
			$w = $width;
			for($i=0;$i<count($header);$i++)
				$pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
			$pdf->Ln();
			$pdf->SetFillColor(224,235,255);
			$pdf->SetTextColor(0);
			$pdf->SetFont('');
			return $pdf;
		}
		
		//CHART
		function style()
		{
			$result = "<styles>";
			$result .= "<definition>";
			$result .= "<style name='CanvasAnim' type='animation' param='_xScale' start='0' duration='1' />";
			$result .= "</definition>";
			$result .= "<application>";
			$result .= "<apply toObject='Canvas' styles='CanvasAnim' />";
			$result .= "</application>";
			$result .= "</styles>";
			return $result;
		}
	
		function categories($table,$where,$sort,$group,$field)
		{
			$resultSet = $this->GISModel->getListOfData($table,"",0,0,$where,"","","",$sort,$group,$field);
			$totalRow = $resultSet ? $resultSet->num_rows() :0;
			$result = "<categories>";
			if ($totalRow > 0)
			{
				foreach($resultSet->result() as $row)
				{
					$result .= "<category label='" . $row->$field . "' />";
				}
			}
			$result .= "</categories>";
			return $result;
		}
	
		function dataset($field, $seriesname, $table, $where, $sort, $group)
		{
			$resultSet = $this->GISModel->getListOfData($table,"", 0,0,$where,"","","",$sort,$group,$field);
			$totalRow = $resultSet ? $resultSet->num_rows() :0;
			$result = "<dataset seriesName='" . $seriesname . "'>";
			if ($totalRow > 0)	
				foreach($resultSet->result() as $row)
					$result .= "<set value='" . $row->$field . "' color='".getFCColor()."'/>";
			$result .= "</dataset>";
			return $result;
		}
	}
?>