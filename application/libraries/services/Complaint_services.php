<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Complaint_services
{
  

  function __construct(){

  }

  public function __get($var)
  {
    return get_instance()->$var;
  }
  
  public function get_table_config( $_page, $start_number = 1 )
  {
      $table["header"] = array(
        'email' => 'Email',
        'messages' => 'Pesan',
      );
      $table["number"] = $start_number;
      $table[ "action" ] = array(
              // array(
              //   "name" => 'Edit',
              //   "type" => "modal_form_multipart",
              //   "modal_id" => "edit_",
              //   "url" => site_url( $_page."edit/"),
              //   "button_color" => "primary",
              //   "param" => "id",
              //   "form_data" => array(
              //       "id" => array(
              //           'type' => 'hidden',
              //           'label' => "id",
              //       ),
              //   ),
              //   "title" => "Group",
              //   "data_name" => "name",
              // ),
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
                ),
                "title" => "Group",
                "data_name" => "email",
              ),
    );
    return $table;
  }
  public function validation_config( ){
    $config = array(
        array(
          'field' => 'name',
          'label' => 'name',
          'rules' =>  'trim|required',
        ),
        array(
          'field' => 'description',
          'label' => 'description',
          'rules' =>  'trim|required',
        ),
    );
    
    return $config;
  }
}
?>
