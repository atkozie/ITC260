<?php
//News_model.php

class News_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
    public function get_news($slug = FALSE)
        {
                if ($slug === FALSE)
                {
                        $query = $this->db->get('sp17_news');
                        return $query->result_array();
                }

                $query = $this->db->get_where('sp17_news', array('slug' => $slug));
                return $query->row_array();
        }
    
        public function set_news()
        {
        $this->load->helper('url');

            //here's the slug, derived from the title, adding dashes
        $slug = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(//associative array, adding the slug item created above
            'title' => $this->input->post('title'),
            'slug' => $slug,
            'text' => $this->input->post('text')
        );

            
        return $this->db->insert('sp17_news', $data);
    }//end set_news method
}//end News_model class