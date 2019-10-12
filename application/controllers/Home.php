<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {
	private $services = null;
    private $name = null;
    private $parent_page = 'home/';
	private $current_page = 'home/';
	
	public function __construct(){
		parent::__construct();
		$this->load->library('services/Gallery_services');
		$this->services = new Gallery_services;
		$this->load->model(array(
			'gallery_model',
			'complaint_model',
			'news_model',
		));
		$this->data["right_bar"]['latest_posts'] = $this->news_model->newses( 0, 3 )->result();
		$this->data["right_bar"]['most_vieweds'] = $this->news_model->most_viewed( 0, 3 )->result();
		
	}
	public function index(  )
	{
		// 
		$page = ($this->uri->segment(4 - 1  )) ? ($this->uri->segment( 4 - 1 ) - 1) : 0;
		// echo $page;return;
		//pagination parameter
		$pagination['base_url'] = base_url( $this->current_page ) .'index';
		$pagination['total_records'] = $this->news_model->record_count() ;
		$pagination['limit_per_page'] = 6;
		$pagination['start_record'] = $page*$pagination['limit_per_page'];
		$pagination['uri_segment'] = 4 - 1;
		//set pagination
		if ($pagination['total_records']>0) $this->data['pagination_links'] = $this->setPagination($pagination);

	   $this->data['newses']  = $this->news_model->newses(  $pagination['start_record'], $pagination['limit_per_page'] )->result();


		$this->data['sliders'] = $this->gallery_model->galleries( 2 )->result();
		$this->data['caretakers'] = $this->gallery_model->galleries( 5, 0, 4 )->result();
		// $this->data['newses'] = $this->news_model->newses( )->result();

		// echo var_dump( $this->data['pagination_links'] );return;

		// return;
		#################################################################3
		$alert = $this->session->flashdata('alert');
		$this->data["alert"] = (isset($alert)) ? $alert : NULL ;

		$this->render("public/index");
	}

	public function structure()
	{
		$this->data['structure'] = $this->gallery_model->galleries( 3 )->row();
		// TODO : tampilkan landing page bagi user yang belum daftar
		$this->render("public/Struktur");
	}

	public function gallery()
	{
		$this->data["galleries"] = $this->gallery_model->galleries( $IMAGE_TYPE = 1 )->result();
		// TODO : tampilkan landing page bagi user yang belum daftar
		$this->render("public/gallery");
	}
	public function visi_misi()
	{
		// TODO : tampilkan landing page bagi user yang belum daftar
		$this->render("public/visi_misi");
	}

	public function article( $file )
	{
		$upload_path = 'uploads/news/';

		$config['upload_path'] = './'.$upload_path;
		$file = str_replace( "%20", " ", $file );
		$file_content = file_get_contents(  $config['upload_path'] . $file );

		$this->data['file_content'] = $file_content;
		$this->data['news'] = $this->news_model->news_by_file_name( $file )->row();
		if( $this->data['news'] == NULL ) redirect( site_url( )  );

		$data["hit"] = $this->data['news']->hit + 1;
		$data_param['id'] = $this->data['news']->id;
		$this->news_model->update( $data, $data_param );
		
		// echo $file_content;return;
		// TODO : tampilkan landing page bagi user yang belum daftar
		$this->render("public/single");
	}

	public function complaint()
	{
		if( !($_POST) ) redirect(site_url(  $this->current_page ));  

		// echo var_dump( $data );return;
		$this->form_validation->set_rules( "email", "email", "trim|required" );
		$this->form_validation->set_rules( "messages", "messages", "trim|required" );
        if ($this->form_validation->run() === TRUE )
        {
			$data['email'] = $this->input->post( 'email' );
			$data['messages'] = $this->input->post( 'messages' );

			// echo var_dump( $data );return;
			if( $this->complaint_model->create( $data ) ){
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::SUCCESS, "Pesan telah Terkirim, Terima kasih atas tanggapannya :)" ) );
			}else{
				$this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->complaint_model->errors() ) );
			}
		}
        else
        {
          $this->data['message'] = (validation_errors() ? validation_errors() : ($this->complaint_model->errors() ? $this->complaint_model->errors() : $this->session->flashdata('message')));
          if(  validation_errors() || $this->complaint_model->errors() ) $this->session->set_flashdata('alert', $this->alert->set_alert( Alert::DANGER, $this->data['message'] ) );
		}
		
		redirect( site_url( )  );
	}

	public function contact()
	{
		// TODO : tampilkan landing page bagi user yang belum daftar
		$this->render("public/contact");
	}
}