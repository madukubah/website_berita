<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Caretaker extends User_Controller {
	const IMAGE_TYPE = 5;
	private $services = null;
    private $name = null;
    private $parent_page = '4dmin';
	private $current_page = '4dmin/caretaker/';
	
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
		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) -  1 ) : 0;
		// echo $page; return;
        //pagination parameter
        $pagination['base_url'] = base_url( $this->current_page ) .'/index';
        $pagination['total_records'] = $this->gallery_model->record_count() ;
        $pagination['limit_per_page'] = 10;
        $pagination['start_record'] = $page*$pagination['limit_per_page'];
        $pagination['uri_segment'] = 4;
		//set pagination
		if ($pagination['total_records'] > 0 ) $this->data['pagination_links'] = $this->setPagination($pagination);
		#################################################################3
		$table = $this->services->get_table_config( $this->current_page );
		$table[ "rows" ] = $this->gallery_model->galleries( Caretaker::IMAGE_TYPE, $pagination['start_record'], $pagination['limit_per_page'] )->result();

		$table = $this->load->view('templates/tables/plain_table_image', $table, true);
		$this->data[ "contents" ] = $table;
		$add_menu = array(
			"name" => "Tambah",
			"modal_id" => "add_gallery_",
			"button_color" => "primary",
			"url" => site_url( $this->current_page."add/"),
			"form_data" => array(
				"type" => array(
					'type' => 'hidden',
					'label' => "Nama Group",
					'value' => Caretaker::IMAGE_TYPE,
				),
				"name" => array(
					'type' => 'text',
					'label' => "Nama",
					'value' => "",
				),
				"description" => array(
					'type' => 'text',
					'label' => "Jabatan",
					'value' => "-",
				),
				"file_image" => array(
					'type' => 'file',
					'label' => "Gambar",
					'value' => "-",
				),
			),
			'data' => NULL
		);

		$add_menu= $this->load->view('templates/actions/modal_form_multipart', $add_menu, true ); 

		$this->data[ "header_button" ] = $add_menu;
		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Pengurus Himpunan";
		$this->data["header"] = "Pengurus Himpunan";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "templates/contents/plain_content" );
	}

	public function add(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( $this->services->validation_config() );
        if ($this->form_validation->run() === TRUE )
        {
			$data['name'] = $this->input->post( 'name' );
			$data['description'] = $this->input->post( 'description' );
			$data['type'] = $this->input->post( 'type' );

			$this->load->library('upload'); // Load librari upload
			$name = str_replace( ".", "_",$data['name'] );			
			$filename = "Gallery_"."_".time();
			// echo $filename;return;
			$filename = "Gallery_".$name."_".time();
			$upload_path = 'uploads/gallery/';

			$config['upload_path'] = './'.$upload_path;
			$config['allowed_types'] = "gif|jpg|png|jpeg";
			$config['overwrite']="true";
			$config['max_size']="2048";
			$config['file_name'] = ''.$filename;

			$this->upload->initialize($config);
			// echo var_dump( $_FILES ); return;
			if( $_FILES['file_image']['name'] != "" )
			if( $this->upload->do_upload("file_image") )
			{
				$data['file'] = $this->upload->data()["file_name"];
			}
			else
			{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->upload->display_errors() ) );
				redirect( site_url($this->current_page)  );				
			}


			// echo var_dump( $data );return;
			if( $this->gallery_model->create( $data ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->gallery_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->gallery_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->gallery_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->gallery_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page)  );
	}

	public function edit(  )
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( $this->services->validation_config() );
        if ($this->form_validation->run() === TRUE )
        {
			$data['name'] = $this->input->post( 'name' );
			$data['description'] = $this->input->post( 'description' );

			$this->load->library('upload'); // Load librari upload
			$name = str_replace( ".", "_",$data['name'] );
			// $filename = "Gallery_"."_".time();
			$filename = "Gallery_".$name."_".time();
			$upload_path = 'uploads/gallery/';

			$config['upload_path'] = './'.$upload_path;
			$config['allowed_types'] = "gif|jpg|png|jpeg";
			$config['overwrite']="true";
			$config['max_size']="2048";
			$config['file_name'] = ''.$filename;

			$this->upload->initialize($config);
			// echo var_dump( $_FILES ); return;
			if( $_FILES['file_image']['name'] != "" )
			if( $this->upload->do_upload("file_image") )
			{
				$data['file'] = $this->upload->data()["file_name"];
				
				if( !@unlink( $config['upload_path'].$this->input->post( 'file' ) ) );
			}
			else
			{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->upload->display_errors() ) );
				redirect( site_url($this->current_page)  );				
			}


			// echo var_dump( $data );return;

			$data_param['id'] = $this->input->post( 'id' );


			if( $this->gallery_model->update( $data, $data_param  ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->gallery_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->gallery_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->m_account->errors() ? $this->gallery_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->gallery_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url($this->current_page)  );
	}

	public function delete(  ) {
		$upload_path = 'uploads/gallery/';

		$config['upload_path'] = './'.$upload_path;

		if( !($_POST) ) redirect( site_url($this->current_page) );
		
		$data_param['id'] 	= $this->input->post('id');
		if( $this->gallery_model->delete( $data_param ) ){
			if( !@unlink( $config['upload_path'].$this->input->post( 'file' ) ) )return;
		  	$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->gallery_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->gallery_model->errors() ) );
		}
		redirect( site_url($this->current_page)  );
	}
}
