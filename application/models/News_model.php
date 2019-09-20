<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_model extends MY_Model
{
  protected $table = "news";

  function __construct() {
      parent::__construct( $this->table );
      parent::set_join_key( 'news_id' );
  }

  /**
   * create
   *
   * @param array  $data
   * @return static
   * @author madukubah
   */
  public function create( $data )
  {
      // Filter the data passed
      $data = $this->_filter_data($this->table, $data);

      $this->db->insert($this->table, $data);
      $id = $this->db->insert_id($this->table . '_id_seq');
    
      if( isset($id) )
      {
        $this->set_message("berhasil");
        return $id;
      }
      $this->set_error("gagal");
        return FALSE;
  }
  /**
   * update
   *
   * @param array  $data
   * @param array  $data_param
   * @return bool
   * @author madukubah
   */
  public function update( $data, $data_param  )
  {
    $this->db->trans_begin();
    $data = $this->_filter_data($this->table, $data);

    $this->db->update($this->table, $data, $data_param );
    if ($this->db->trans_status() === FALSE)
    {
      $this->db->trans_rollback();

      $this->set_error("gagal");
      return FALSE;
    }

    $this->db->trans_commit();

    $this->set_message("berhasil");
    return TRUE;
  }
  /**
   * delete
   *
   * @param array  $data_param
   * @return bool
   * @author madukubah
   */
  public function delete( $data_param  )
  {
    //foreign
    //delete_foreign( $data_param. $models[]  )
    if( !$this->delete_foreign( $data_param ) )
    {
      $this->set_error("gagal");//('news_delete_unsuccessful');
      return FALSE;
    }
    //foreign
    $this->db->trans_begin();

    $this->db->delete($this->table, $data_param );
    if ($this->db->trans_status() === FALSE)
    {
      $this->db->trans_rollback();

      $this->set_error("gagal");//('news_delete_unsuccessful');
      return FALSE;
    }

    $this->db->trans_commit();

    $this->set_message("berhasil");//('news_delete_successful');
    return TRUE;
  }

    /**
   * news
   *
   * @param int|array|null $id = id_newss
   * @return static
   * @author madukubah
   */
  public function news( $id = NULL  )
  {
      if (isset($id))
      {
        $this->where($this->table.'.id', $id);
      }

      $this->limit(1);
      $this->order_by($this->table.'.id', 'desc');

      $this->newses(  );

      return $this;
  }

  /**
   * news
   *
   * @param int|array|null $id = id_newss
   * @return static
   * @author madukubah
   */
  public function news_by_file_name( $file_name  )
  {
      $this->like($this->table.'.file_content', $file_name);

      $this->limit(1);
      $this->order_by($this->table.'.id', 'desc');

      $this->newses(  );

      return $this;
  }
  // /**
  //  * newss
  //  *
  //  *
  //  * @return static
  //  * @author madukubah
  //  */
  // public function newss(  )
  // {
      
  //     $this->order_by($this->table.'.id', 'asc');
  //     return $this->fetch_data();
  // }

  /**
   * newss
   *
   *
   * @return static
   * @author madukubah
   */
  public function newses( $start = 0 , $limit = NULL )
  {
      if (isset( $limit ))
      {
        $this->limit( $limit );
      }
      $this->select( $this->table.'.*' );
      $this->select( "CONCAT( '".base_url("uploads/news/photo/")."' , {$this->table}.image ) as images" );
      $this->select( "CONCAT( users.first_name, ' ', users.last_name ) as author" );
      $this->select( "CONCAT( '".base_url("uploads/users_photo/")."' , users.image ) as author_image" );
      $this->select( "category.name as category_name" );
      $this->join( 
        "category" ,
        "category.id = news.category_id" ,
        "inner"
      );

      $this->join( 
        "users" ,
        "users.id = news.user_id" ,
        "inner"
      );
      $this->offset( $start );
      $this->order_by( $this->table.'.id', 'desc');
      return $this->fetch_data();
  }

  /**
   * newss
   *
   *
   * @return static
   * @author madukubah
   */
  public function most_viewed( $start = 0 , $limit = NULL )
  {
      if (isset( $limit ))
      {
        $this->limit( $limit );
      }
      $this->select( $this->table.'.*' );
      $this->select( "CONCAT( '".base_url("uploads/news/photo/")."' , {$this->table}.image ) as images" );
      $this->select( "CONCAT( users.first_name, ' ', users.last_name ) as author" );
      $this->select( "CONCAT( '".base_url("uploads/users_photo/")."' , users.image ) as author_image" );
      $this->select( "category.name as category_name" );
      $this->join( 
        "category" ,
        "category.id = news.category_id" ,
        "inner"
      );

      $this->join( 
        "users" ,
        "users.id = news.user_id" ,
        "inner"
      );
      $this->offset( $start );
      $this->order_by( $this->table.'.hit', 'desc');
      return $this->fetch_data();
  }

}
?>
