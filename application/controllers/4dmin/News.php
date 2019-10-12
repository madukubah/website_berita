<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class News extends User_Controller {
	const IMAGE_TYPE = 1;
	private $services = null;
    private $name = null;
    private $parent_page = '4dmin';
	private $current_page = '4dmin/news/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/News_services');
		$this->services = new News_services;
		$this->load->model(
			array(
				'news_model',
			)
		);

	}
	public function index( $id_user = NULL )
	{
		 // 
		 $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
		// echo $page;return;		 
		 //pagination parameter
		 $pagination['base_url'] = base_url( $this->current_page ) .'/index';
		 $pagination['total_records'] = $this->news_model->record_count() ;
		 $pagination['limit_per_page'] = 10;
		 $pagination['start_record'] = $page*$pagination['limit_per_page'];
		 $pagination['uri_segment'] = 4;
		 //set pagination
		 if ($pagination['total_records']>0) $this->data['pagination_links'] = $this->setPagination($pagination);

		$table = $this->services->get_table_config( $this->current_page );
		$table[ "rows" ] = $this->news_model->newses(  $pagination['start_record'], $pagination['limit_per_page'] )->result();
		$table = $this->load->view('templates/tables/plain_table_image', $table, true);
		$this->data[ "contents" ] = $table;

		// echo var_dump( $this->news_model->db );return;
		$link_add = 
		array(
			"name" => "Buat Berita",
			"type" => "link",
			"url" => site_url( $this->current_page."create/"),
			"button_color" => "primary",	
			"data" => NULL,
		);
		$this->data[ "header_button" ] =  $this->load->view('templates/actions/link', $link_add, TRUE ); ;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["key"] = $this->input->get('key', FALSE);
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
		$this->data["current_page"] = $this->current_page;
		$this->data["block_header"] = "Berita";
		$this->data["header"] = "Berita";
		$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';
		$this->render( "templates/contents/plain_content" );
	}

	public function create()
    {
        $this->form_validation->set_rules( $this->services->get_validation_config() );
        if ($this->form_validation->run()  )
        {
			$data['category_id'] = $this->input->post( 'category_id' );
			$data['title'] = $this->input->post( 'title' );
			$data['user_id'] = $this->input->post( 'user_id' );
			$data['preview'] = $this->input->post( 'preview' );
			$data['timestamp'] = time();			
			
			// $a = file_get_contents($upload_path.$file_name);

			// echo $a ;
			$this->load->library('upload');
			$title = str_replace( ".", "_",   $data['title']  ); // Load librari upload
			$title = str_replace( "/", "_",   $title  ); // Load librari upload
			$config = $this->services->get_photo_upload_config( $title );

			$this->upload->initialize( $config );
			// echo var_dump( $_FILES ); return;
			// if( $_FILES['image']['name'] != "" )
			if( $this->upload->do_upload("image") )
			{
				$data['image'] = $this->upload->data()["file_name"];
				// if( !@unlink( $config['upload_path'].$this->input->post( 'file' ) ) );
			}
			else
			{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->upload->display_errors() ) );
				redirect( site_url($this->current_page."create/")  );				
			}
			// buat content html
			$config =  $this->services->get_file_upload_config( $title );
			
			if( file_put_contents( $config['upload_path'].$config['file_name'] , $this->input->post( 'summernote' ))  )
			{
				$data['file_content'] = $config['file_name'];
			}
			else
			{
				$data['file_content'] = "default.html";
			}

			// echo var_dump( $data ); return ;
			if( $this->news_model->create( $data ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->news_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->news_model->errors() ) );
			}
			
			redirect( site_url($this->current_page)  );
        }
        else
        {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->news_model->errors() ? $this->news_model->errors() : $this->session->flashdata('message')));
            if(  !empty( validation_errors() ) || $this->news_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );

            $alert = $this->session->flashdata('alert');
			$this->data["key"] = $this->input->get('key', FALSE);
			$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
			$this->data["current_page"] = $this->current_page;
			$this->data["block_header"] = "Buat Berita ";
			$this->data["header"] = "Buat Berita ";
			$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

            $form_data = $this->services->get_form_data();
            $form_data = $this->load->view('templates/form/plain_form', $form_data , TRUE ) ;

            $this->data[ "contents" ] =  $form_data;
            $this->render( "user/news/plain_content_form" );
        }
	}

	public function edit( $news_id = NULL )
	{
		$this->form_validation->set_rules( $this->services->get_validation_config() );
        if ($this->form_validation->run()  )
        {
			$data['category_id'] = $this->input->post( 'category_id' );
			$data['title'] = $this->input->post( 'title' );
			$data['user_id'] = $this->input->post( 'user_id' );
			$data['preview'] = $this->input->post( 'preview' );
			$data['timestamp'] = time();
			
			// $a = file_get_contents($upload_path.$file_name);

			// echo $a ;
			$this->load->library('upload');
			$title = str_replace( ".", "_",   $data['title']  ); // Load librari upload
			$title = str_replace( "/", "_",   $title  ); // Load librari upload
			$config = $this->services->get_photo_upload_config( $title );

			$this->upload->initialize( $config );
			// echo var_dump( $_FILES ); return;
			if( $_FILES['image']['name'] != "" )
			if( $this->upload->do_upload("image") )
			{
				$data['image'] = $this->upload->data()["file_name"];
				if( !@unlink( $config['upload_path'].$this->input->post( 'file_image' ) ) );
			}
			else
			{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->upload->display_errors() ) );
				redirect( site_url($this->current_page)  );				
			}
			// buat content html

			$config =  $this->services->get_file_upload_config( $title );
			if( file_put_contents( $config['upload_path'].$config['file_name'], $this->input->post( 'summernote' ))  )
			{
				$data['file_content'] = $config['file_name'];
				if( $this->input->post( 'file_content' ) != "default.html" )
					if( !@unlink( $config['upload_path'].$this->input->post( 'file_content' ) ) ) return;
			}
			else
			{
				$data['file_content'] = "default.html";
			}
			

			// echo var_dump( $data ); return ;
			$data_param['id'] = $this->input->post( 'id' );

			if( $this->news_model->update( $data, $data_param ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->news_model->messages() ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->news_model->errors() ) );
			}
			
			redirect( site_url($this->current_page)  );
        }
        else
        {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->news_model->errors() ? $this->news_model->errors() : $this->session->flashdata('message')));
            if(  !empty( validation_errors() ) || $this->news_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );

            $alert = $this->session->flashdata('alert');
			$this->data["key"] = $this->input->get('key', FALSE);
			$this->data["alert"] = (isset($alert)) ? $alert : NULL ;
			$this->data["current_page"] = $this->current_page;
			$this->data["block_header"] = "Buat Berita ";
			$this->data["header"] = "Buat Berita ";
			$this->data["sub_header"] = 'Klik Tombol Action Untuk Aksi Lebih Lanjut';

            $form_data = $this->services->get_form_data( $news_id );
            $form_data = $this->load->view('templates/form/plain_form', $form_data , TRUE ) ;

            $this->data[ "contents" ] =  $form_data;
            $this->render( "user/news/plain_content_form" );
        }
	}

	public function delete(  ) {
		$upload_path = 'uploads/news/';

		$config['upload_path'] = './'.$upload_path;

		if( !($_POST) ) redirect( site_url($this->current_page) );
		
		$data_param['id'] 	= $this->input->post('id');
		if( $this->news_model->delete( $data_param ) )
		{
			// delete file
			if( !@unlink( $config['upload_path'].$this->input->post( 'file_content' ) ) )return;
			// delete image
			if( !@unlink( $config['upload_path']."photo/".$this->input->post( 'image' ) ) )return;

		  	$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, $this->news_model->messages() ) );
		}else{
		  $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->news_model->errors() ) );
		}
		redirect( site_url($this->current_page)  );
	}
}
