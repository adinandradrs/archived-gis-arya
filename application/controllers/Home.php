<?php
	
	class Home extends MY_Controller{
		
		function __construct(){
			parent::__construct();	
		}
		
		function index(){
			$data["title"] = "SIG Penyebaran Jenis-Jenis Usaha";
			$data["content"] = $this->load->view("Content/Home.php","",TRUE);
			$this->load->view("Layout/Template",$data);
		}
		
		//fungsi awal gambar peta
		function peta(){
			$data["title"] = "Peta Salatiga";	
			#1
			$arr = $this->initiate();
			#2
			$layer = $this->layerMap($arr);
			#3
			$this->getFromGPS($arr);
			#4
			$this->layerArgomulyo($layer);
			#dst.....
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
		
		
		
		function perusahaan(){
			$data["title"] = "Daftar Perusahaan";
			$config['base_url'] = site_url("home/perusahaan");
			$config['per_page'] = 10; 
			$config["total_rows"] = $this->GISModel->countData("Perusahaan");
			$this->pagination->initialize($config);
			$data["resultSet"] = $this->GISModel->getListOfData("Perusahaan","",$config["per_page"],$this->uri->segment(3),"");
			$data["content"] = $this->load->view("Content/RekapPerusahaan.php",$data,true);
			$this->load->view("Layout/Template",$data);
		}
		
		function grafik(){
			$data["title"] = "Grafik";
			$data["content"] = $this->load->view("Content/Grafik",$data,true);
			$this->load->view("Layout/Template",$data);
		}
		
		function login(){
			$data["title"] = "Login Administrator";
			$data["content"] = $this->load->view("Content/Login",$data,true);
			$this->load->view("Layout/Template",$data);
		}
		
		function doLogin(){
			$username = $this->input->post('txtUsername');
			$password = $this->input->post('txtPassword');
			if($username == "admin" && $password == "admin"){
				$sessData = array('hasLogin' => TRUE);
				$this->session->set_userdata($sessData);
				redirect("admin");
			}
		}
		
		function link(){
			$data["title"] = "Link";
			$data["content"] = $this->load->view("Content/Link.php",$data,true);
			$this->load->view("Layout/Template.php",$data);
		}
		
	}
	
?>