<?php
	class Perusahaan extends MY_Controller{
		
		function __construct(){
			parent::__construct();
		}
		
		function jenisUsaha(){
			if($this->session->userdata("kecamatanID") != NULL){
				$joinTable = array(0=>"Jenis j");
				$on = array(0=>"p.JenisID = j.JenisID");
				$where = array("p.KecamatanID" => $this->session->userdata('kecamatanID'));
				$data["resultSet"] = $this->GISModel->joinData("Perusahaan p","j.Nama, count(j.Nama) as 'Jumlah', j.JenisID",$joinTable, $on, $where,'j.Nama');
				$data["totalRow"] = $data["resultSet"] ? $data["resultSet"]->num_rows() : 0;
				$kecamatan = $this->GISModel->getDetailOfData("Kecamatan as p","Nama",$where);
				$jsonResponse = array(
									  "response" => $this->load->view("Content/JenisUsaha",$data,true),
									  "kecamatan" => $kecamatan
								);
				echo json_encode($jsonResponse);
			}	
		}
		
		function tipeUsaha(){
			if($this->session->userdata("kecamatanID") != NULL){
				$data["kecamatanID"] =  $this->session->userdata('kecamatanID');
				$data["tahun"] = date('Y'); 
				$where = array(
					"KecamatanID" => $data["kecamatanID"],
					"YEAR(TanggalBergabung)" => $data["tahun"]
				);
				$data["resultSet"] = $this->GISModel->getListOfData("Perusahaan","MONTHNAME(TanggalBergabung) as Bulan, MONTH(TanggalBergabung) as BulanIdx",0,0,$where,"","","","","MONTH(TanggalBergabung)");
				$data["totalRow"] = $data["resultSet"] ? $data["resultSet"]->num_rows() : 0;
				$where = array("KecamatanID" => $data["kecamatanID"]);
				$kecamatan = $this->GISModel->getDetailOfData("Kecamatan","Nama",$where);
				$jsonResponse = array(
									  "response" => $this->load->view("Content/TipeUsaha",$data,true),
									  "kecamatan" => $kecamatan
								);
				echo json_encode($jsonResponse);
			}
		}
		
		function dataPerusahaan(){
			if($this->session->userdata("kecamatanID") != NULL){
				$data["kecamatanID"] =  $this->session->userdata('kecamatanID');
				$where = array(
					"KecamatanID" => $data["kecamatanID"]
				);
				$data["resultSet"] = $this->GISModel->getListOfData("Perusahaan","",0,0,$where);
				$kecamatan = $this->GISModel->getDetailOfData("Kecamatan","Nama",$where);
				$jsonResponse = array(
									  "response" => $this->load->view("Content/Perusahaan",$data,true),
									  "kecamatan" => $kecamatan
								);
				echo json_encode($jsonResponse);
			}
		}
		

	}

?>