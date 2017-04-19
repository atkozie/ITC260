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
    
        public function create()
        {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a news item';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');

        if ($this->form_validation->run() === FALSE)
        {//show the form
            $this->load->view('templates/header', $data);
            $this->load->view('news/create', $data);
            $this->load->view('templates/footer', $data);

        } else {//say thanks for entering data
            $this->news_model->set_news();//nothing is being passed into the model here...
            $this->load->view('templates/header', $data);
            $this->load->view('news/success');
            $this->load->view('templates/footer', $data);
        }//end else   
    }//end create
    
}//end of News controller