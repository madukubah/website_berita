<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class News_services
{
  	const CONTENT_PATH = './uploads/news/';
  	protected $id;
  	protected $category_id;
  	protected $title;
  	protected $user_id;
  	protected $image;
  	protected $preview;
  	protected $file_content;
  function __construct(){
  	$this->id           = 0;
  	$this->category_id  = 0;
  	$this->title        = "";
  	$this->user_id      = "";
  	$this->image        = "";
  	$this->preview        = "-";
  	$this->file_content = "default.html";
    
  }

  public function __get($var)
  {
    return get_instance()->$var;
  }
  public function get_photo_upload_config( $name )
  {
    $filename = "NEWS_".$name."_".time();
    $upload_path = 'uploads/news/photo/';

    $config['upload_path'] = './'.$upload_path;
    $config['allowed_types'] = "gif|jpg|png|jpeg";
    $config['overwrite']="true";
    $config['max_size']="2048";
    $config['file_name'] = ''.$filename;

    return $config;
  }

  public function get_file_upload_config( $name )
  {
    // $name = str_replace( "(" )
    // $filename = "NEWS_".$name."_".time().".html";
    $filename = "NEWS__".time().".html";
    $upload_path = 'uploads/news/';

    $config['upload_path'] = './'.$upload_path;
    $config['file_name'] = ''.$filename;

    return $config;
  }

  public function get_table_config( $_page, $start_number = 1 )
  {
      $table["header"] = array(
        'title' => 'Judul',
        'category_name' => 'Kategori',
        'images' => 'Gambar',
        'preview' => 'Konten Preview',
        'hit' => 'dilihat',
      );
      $table["number"] = $start_number;
      $table[ "action" ] = array(
              array(
                "name" => "Edit",
                "type" => "link",
                "url" => site_url( $_page."edit/"),
                "button_color" => "primary",	
                "param" => "id",
              ),
              array(
                "name" => 'X',
                "type" => "modal_delete",
                "modal_id" => "delete_",
                "url" => site_url( $_page."delete/"),
                "button_color" => "danger",
                "param" => "id",
                "form_data" => array(
                  "id" => array(
                    'type' => 'hidden',
                    'label' => "id",
                  ),
                  "image" => array(
                      'type' => 'hidden',
                      'label' => "Nama Group",
                  ),
                  "file_content" => array(
                      'type' => 'hidden',
                      'label' => "Nama Group",
                  ),
                ),
                "title" => "Berita",
                "data_name" => "title",
              ),
    );
    return $table;
  }
  public function get_validation_config( ){
    $config = array(
        array(
          'field' => 'category_id',
          'label' => 'category_id',
          'rules' =>  'trim|required',
        ),
        array(
          'field' => 'title',
          'label' => 'title',
          'rules' =>  'trim|required',
        ),
        array(
          'field' => 'user_id',
          'label' => 'user_id',
          'rules' =>  'trim|required',
        ),
    );
    
    return $config;
  }

  
  /**
	 * get_form_data
	 *
	 * @return array
	 * @author madukubah
	 **/
	public function get_form_data( $news_id = NULL )
	{
    $this->load->model(array(
			'category_model',
			'news_model',
    ));
    if( $news_id != NULL )
    {
        $news = $this->news_model->news( $news_id )->row();
        $this->id           = $news->id;
        $this->category_id  = $news->category_id;
        $this->title        = $news->title;
        $this->user_id      = $news->user_id;
        $this->image        = $news->image;
        $this->preview        = $news->preview;
        $this->file_content = $news->file_content;
    }
    $this->load->model(array(
			'category_model',
    ));
    $categories = $this->category_model->categories()->result();
    $category_select = [];
    foreach( $categories as $item )
    {
      $category_select[ $item->id ] =  $item->name ;
    }

    // try {
    //   $file_content = file_get_contents( News_services::CONTENT_PATH . $this->file_content );
    // }
    // catch (InvalidArgumentException $e) {
    //   $file_content = "";
    // }
    // finally {
    //     //optional code that always runs
    // }
    if( file_exists( News_services::CONTENT_PATH . $this->file_content ) )
    {
      $file_content = file_get_contents( News_services::CONTENT_PATH . $this->file_content );
    }
    else
    {
      $file_content = "";
    }
		$_data["form_data"] = array(
			"id" => array(
				'type' => 'hidden',
				'label' => "ID",
				'value' => $this->form_validation->set_value('id', $this->id),
			  ),
			"category_id" => array(
			  'type' => 'select',
			  'label' => "Kategori",
			  'options' => $category_select,
			  'selected' =>  $this->category_id,
			),
			"title" => array(
			  'type' => 'text',
			  'label' => "Judul",
			  'value' => $this->form_validation->set_value('title', $this->title),
			  
			),
			"user_id" => array(
			  'type' => 'hidden',
			  'label' => "user_id",
			  'value' => $this->form_validation->set_value('user_id', $this->ion_auth->get_user_id() ),			  
      ),
      "file_content" => array(
			  'type' => 'hidden',
			  'label' => "user_id",
			  'value' => $this->form_validation->set_value('file_content', $this->file_content ),			  
      ),
      "file_image" => array(
			  'type' => 'hidden',
			  'label' => "user_id",
			  'value' => $this->form_validation->set_value( 'image', $this->image  ),			  
			),
			"image" => array(
			  'type' => 'file',
			  'label' => "Gambar Depan",
			  'value' => $this->form_validation->set_value( 'image', $this->image),			  
      ),
      "preview" => array(
			  'type' => 'textarea',
			  'label' => "Konten Preview",
			  'value' => $this->form_validation->set_value('preview', $this->preview  ),			  
			),
      "summernote" => array(
			  'type' => 'textarea',
			  'label' => "Konten",
			  'value' => $this->form_validation->set_value('image', $file_content  ),			  
			),
    );
		return $_data;
	}
}
?>
