<?php
//News.php, the news controller
class News extends CI_Controller {

        public function __construct()
        { /* calls the constructor of its parent class (CI_Controller) and loads the model, so it can be used in all other methods in this controller. */
                parent::__construct();
                $this->load->model('news_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                $data['news'] = $this->news_model->get_news();
                $data['title'] = 'News archive';
            
                //we reuse the data items here: header, data/meat of the page, and footer
                $this->load->view('templates/header', $data);
                $this->load->view('news/index', $data);
                $this->load->view('templates/footer', $data);
        }

        public function view($slug = NULL)
        {
                $data['news_item'] = $this->news_model->get_news($slug);

                if (empty($data['news_item']))
                {
                        show_404();
                }

                $data['title'] = $data['news_item']['title'];//array called news_item, position of the title in the array

                $this->load->view('templates/header', $data);
                $this->load->view('news/view', $data);
                $this->load->view('templates/footer');
        }
}