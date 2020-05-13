<?php
class News_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }


  public function get_news($slug = FALSE)
  {
    if ($slug === FALSE)
    {
      $query = $this->db->get('news');
      $result = $query->result_array();
      return $result;
    }

    $query = $this->db->get_where('news', array('slug' => $slug));
    $row = $query->row_array();
    return $row;
  }

  public function set_news()
  {
      $this->load->helper('url');

      $slug = url_title($this->input->post('title'), 'dash', TRUE);

      $data = array(
          'title' => $this->input->post('title'),
          'slug' => md5($slug),
          'text' => $this->input->post('text')
      );

      return $this->db->insert('news', $data);
  }

}