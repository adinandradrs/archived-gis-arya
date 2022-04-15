<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('hasLogin') != TRUE)
			redirect("home");
	}
	
	public function index()
	{
		$data["title"] = "Administrator";
		$data["resultSet1"] = $this->GISModel->getListOfData("Jenis","",0,0);
		$data["resultSet2"] = $this->GISModel->getListOfData("Tipe","",0,0);
		$data["content"] = $this->load->view("admin/Default.php",$data,true);
		$this->load->view("Layout/Template.php",$data);
	}
	
	public function logout(){
		$this->session->unset_userdata('hasLogin');
		redirect("home/index");
	}
	
	public function crudPerusahaan(){
		$data["title"] = "Manajemen Perusahaan";
		$uri = $this->uri->uri_to_assoc(3);	
		if($uri["tipe"] == "tambah"){
			$data["jenis"] = $this->listOfJenis();
			$data["tipe"] = $this->listOfTipe();
			$data["kecamatan"] = $this->listOfKecamatan();
			$data["crud"] = $uri["tipe"];
			$data["content"] = $this->load->view("admin/ManajemenPerusahaan.php",$data,true);
			$this->load->view("Layout/Template.php",$data);
		}
		else if($uri["tipe"] == "hapus"){
			$id = $uri["id"];
			$where = array("PerusahaanID"=>$id);
			$this->GISModel->deleteData("Perusahaan", $where);
			redirect("home/perusahaan");
		}
		else if($uri["tipe"] == "ubah"){
			$data["jenis"] = $this->listOfJenis();
			$data["tipe"] = $this->listOfTipe();
			$data["kecamatan"] = $this->listOfKecamatan();
			$data["crud"] = $uri["tipe"];
			$id = $uri["id"];
			$where = array("PerusahaanID"=>$id);
			$data["resultSet"] = $this->GISModel->getListOfData("Perusahaan","",0,0,$where);
			$data["content"] = $this->load->view("admin/ManajemenPerusahaan.php",$data,true);
			$this->load->view("Layout/Template.php",$data);
		}
	}
	
	public function addPerusahaan(){
		$nama = $this->input->post("namaTextField");
		$alamat = $this->input->post("alamatTextField");
		$jenisID = $this->input->post("jenisComboBox");
		$tipeID = $this->input->post("tipeComboBox");
		$kecamatanID = $this->input->post("kecamatanComboBox");
		$deskripsi = $this->input->post("deskripsiTextField");
		$tanggalBergabung = $this->input->post("tanggalTextField");
		$southing = $this->input->post("southingTextField");
		$easting = $this->input->post("eastingTextField");
		$array = array(
			"nama" => $nama,
			"alamat" => $alamat,
			"jenisID" => $jenisID,
			"tipeID" => $tipeID,
			"kecamatanID" => $kecamatanID,
			"deskripsi" => $deskripsi,
			"tanggalBergabung" => $tanggalBergabung,
			"southing" => $southing,
			"easting" => $easting
		);
		$this->GISModel->saveData("Perusahaan",$array);
		redirect("home/perusahaan");
	}
	
	public function editPerusahaan(){
		$id = $this->input->post("idTextField");
		$nama = $this->input->post("namaTextField");
		$alamat = $this->input->post("alamatTextField");
		$jenisID = $this->input->post("jenisComboBox");
		$tipeID = $this->input->post("tipeComboBox");
		$kecamatanID = $this->input->post("kecamatanComboBox");
		$deskripsi = $this->input->post("deskripsiTextField");
		$tanggalBergabung = $this->input->post("tanggalTextField");		
		$southing = $this->input->post("southingTextField");
		$easting = $this->input->post("eastingTextField");
		$where = array('PerusahaanID'=>$id);
		$array = array(
			"nama" => $nama,
			"alamat" => $alamat,
			"jenisID" => $jenisID,
			"tipeID" => $tipeID,
			"kecamatanID" => $kecamatanID,
			"deskripsi" => $deskripsi,
			"tanggalBergabung" => $tanggalBergabung,
			"southing" => $southing,
			"easting" => $easting
		);
		$this->GISModel->updateData("Perusahaan",$where,$array);
		redirect("home/perusahaan");
	}
	
	public function crudTipe(){
		$data["title"] = "Manajemen Tipe";
		$uri = $this->uri->uri_to_assoc(3);	
		if($uri["tipe"] == "tambah"){
			$data["crud"] = $uri["tipe"];
			$data["content"] = $this->load->view("admin/ManajemenTipe.php",$data,true);
			$this->load->view("Layout/Template.php",$data);
		}
		else if($uri["tipe"] == "hapus"){
			$id = $uri["id"];
			$where = array("TipeID"=>$id);
			$this->GISModel->deleteData("Tipe", $where);
			redirect("admin/index");
		}
		else if($uri["tipe"] == "ubah"){
			$data["crud"] = $uri["tipe"];
			$id = $uri["id"];
			$where = array("TipeID"=>$id);
			$data["resultSet"] = $this->GISModel->getListOfData("Tipe","",0,0,$where);
			$data["content"] = $this->load->view("admin/ManajemenTipe.php",$data,true);
			$this->load->view("Layout/Template.php",$data);
		}
	}
	
	public function addTipe(){
		$nama = $this->input->post("namaTextField");
		$array = array("nama"=>$nama);
		$this->GISModel->saveData("Tipe",$array);
		redirect("admin/index");
	}
	
	public function editTipe(){
		$id = $this->input->post("idTextField");
		$nama = $this->input->post("namaTextField");
		$where = array('TipeID'=>$id);
		$array = array(
			"nama" => $nama
		);
		$this->GISModel->updateData("Tipe",$where,$array);
		redirect("admin/index");
	}
	
	public function crudJenis(){
		$data["title"] = "Manajemen Jenis";
		$uri = $this->uri->uri_to_assoc(3);	
		if($uri["tipe"] == "tambah"){
			$data["crud"] = $uri["tipe"];
			$data["content"] = $this->load->view("admin/ManajemenJenis.php",$data,true);
			$this->load->view("Layout/Template.php",$data);
		}
		else if($uri["tipe"] == "hapus"){
			$id = $uri["id"];
			$where = array("JenisID"=>$id);
			$this->GISModel->deleteData("Jenis", $where);
			redirect("admin/index");
		}
		else if($uri["tipe"] == "ubah"){
			$data["crud"] = $uri["tipe"];
			$id = $uri["id"];
			$where = array("JenisID"=>$id);
			$data["resultSet"] = $this->GISModel->getListOfData("Jenis","",0,0,$where);
			$data["content"] = $this->load->view("admin/ManajemenJenis.php",$data,true);
			$this->load->view("Layout/Template.php",$data);
		}
	}
	
	public function addJenis(){
		$nama = $this->input->post("namaTextField");
		$array = array("nama"=>$nama);
		$this->GISModel->saveData("Jenis",$array);
		redirect("admin/index");
	}
	
	public function editJenis(){
		$id = $this->input->post("idTextField");
		$nama = $this->input->post("namaTextField");
		$where = array('JenisID'=>$id);
		$array = array(
			"nama" => $nama
		);
		$this->GISModel->updateData("Jenis",$where,$array);
		redirect("admin/index");
	}
	
	//do eksport excel or pdf
	public function doExport(){
		$extension = $this->input->post("exportComboBox");
		if($extension == "xls"){
			$resultSet = $this->GISModel->getListOfData("Perusahaan","PerusahaanID, Nama, Alamat, Southing, Easting",0,0);
			$array = array(
				array("usahaid","nama","alamat","southing","easting")
			);
			
			foreach($resultSet->result() as $row){
				$myArray = array($row->PerusahaanID, $row->Nama, $row->Alamat, $row->Southing, $row->Easting);
				array_push($array,$myArray);
			}
			//print_r($array);
			array_to_xls($array,'coba.xls');
			//redirect("home/perusahaan");
		}
		else if($extension == "pdf"){
			$header = array("Nama","Alamat","Southing","Easting");
			$w = array(50, 150, 30,30);
			$title = "Daftar Perusahaan";
			$subtitle = "Jalan Pemuda No. 2 Salatiga";
			$resultSet = $this->GISModel->getListOfData("Perusahaan","",0,0);
			$pdf = $this->pdf($header,$title,$w,$subtitle);
			$fill = false;
			foreach($resultSet->result() as $row)
			{
				$pdf->Cell($w[0],6,$row->Nama,'LR',0,'L',$fill);
				$pdf->Cell($w[1],6,$row->Alamat,'LR',0,'L',$fill);
				$pdf->Cell($w[2],6,$row->Southing,'LR',0,'R',$fill);
				$pdf->Cell($w[3],6,$row->Easting,'LR',0,'R',$fill);
				$pdf->Ln();
				$fill = !$fill;
			}
			$pdf->Cell(array_sum($w),0,'','T');
			$pdf->Output();
		}
	}
}
