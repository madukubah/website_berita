<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends User_Controller {

	private $services = null;
    private $name = null;
    private $parent_page = '4dmin';
	private $current_page = '4dmin/gallery/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Gallery_services');
		$this->services = new Gallery_services;
		$this->load->model(array(
			'gallery_model',
		));

	}

	public function index()
	{
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Beranda";
		$this->data["header"] = "Beranda";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "admin/dashboard/content_2" );

		return;
		$this->data[ "page_title" ] = "Beranda";
		$this->data[ "header" ] = "Beranda";
		$this->render( "admin/dashboard/content_2" );
	}
}