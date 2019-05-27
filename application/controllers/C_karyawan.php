<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_karyawan extends CI_Controller {

	var $API ="";

	function __construct() {
		parent::__construct();
		$this->API="http://api.akhmad.id/uaspromnet";
	}

	// proses yang akan di buka saat pertama masuk ke controller
	public function index()
	{
		$this->load->view('V_pilihan');
	}

		function getUser(){
		$this->curl->http_header("X-Nim","1700964");
		$this->curl->simple_get($this->API.'/user');
		$this->curl->debug();
			
		}
		function getMotor(){
		$this->curl->http_header("X-Nim","1700964");
		$this->curl->simple_get($this->API.'/motor');
		$this->curl->debug();
			
		}
		function getCicilan(){
		$this->curl->http_header("X-Nim","1700964");
		$this->curl->simple_get($this->API.'/cicil');
		$this->curl->debug();
			
		}
		function getUangMuka(){
		$this->curl->http_header("X-Nim","1700964");
		$this->curl->simple_get($this->API.'/uangmuka');
		$this->curl->debug();
			
		}
		function getPenjualan(){
		$this->curl->http_header("X-Nim","1700964");
		$this->curl->simple_get($this->API.'/penjualan');
		$this->curl->debug();
			
		}
	// proses untuk menambah data
	// insert data kontak
	function addPenjualan(){

		$data = array(
			'id_motor'      =>  $this->input->post('id_motor'),
			'id_cicil'    =>  $this->input->post('id_cicil'),
			'id_uang_muka'	  =>  $this->input->post('id_uang_muka'),
			'cicilan_pokok' =>  $this->input->post('cicilan_pokok'),
			'cicilan_bunga'	  =>  $this->input->post('cicilan_bunga'),
			'cicilan_total' =>  $this->input->post('cicilan_total'));
		$this->curl->http_header("X-Nim","1700964");
		$insert =  $this->curl->simple_post($this->API.'/penjualan', $data, array(CURLOPT_BUFFERSIZE => 0));
		$this->curl->debug();
		if($insert)
		{
			$this->session->set_flashdata('hasil','Insert Data Berhasil');
		}else
		{
			$this->session->set_flashdata('hasil','Insert Data Gagal');
		}

		redirect('C_karyawan');

	}


	// proses untuk menghapus data pada database
	function delete($id){
		if(empty($id)){
			redirect('C_karyawan');
		}else{
			$this->curl->http_header("X-Nim","1700964");
			$delete =  $this->curl->simple_delete($this->API.'/penjualan', array('id'=>$id), array(CURLOPT_BUFFERSIZE => 10));
			$this->curl->debug();
			if($delete)
			{
				$this->session->set_flashdata('hasil','Delete Data Berhasil');
			}else
			{
				$this->session->set_flashdata('hasil','Delete Data Gagal');
			}

			redirect('C_karyawan');
		}
	}


	//proses mengupdate data
	function update(){

		$data = array(
			'id_motor'      =>  $this->input->post('id_motor'),
			'id_cicil'    =>  $this->input->post('id_cicil'),
			'id_uang_muka'	  =>  $this->input->post('id_uang_muka'),
			'cicilan_pokok' =>  $this->input->post('cicilan_pokok'),
			'cicilan_bunga'	  =>  $this->input->post('cicilan_bunga'),
			'cicilan_total' =>  $this->input->post('cicilan_total'));
		$this->curl->http_header("X-Nim","1700964");
		$update =  $this->curl->simple_put($this->API.'/penjualan', $data, array(CURLOPT_BUFFERSIZE => 0));
		$this->curl->debug();

		if($update)
		{
			$this->session->set_flashdata('hasil','Update Data Berhasil');
		}else
		{
			$this->session->set_flashdata('hasil','Update Data Gagal');
		}

		redirect('C_karyawan');

	}
}
