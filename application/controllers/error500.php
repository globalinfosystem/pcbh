<?php 
class Error500 extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct(); 
    } 

    public function index() 
    { 
        $this->output->set_status_header('500'); 
        $data['content'] = 'error_500'; // View name 
        $this->header = 'layouts/' . CNF_THEME . '/header';
        $this->headertop = 'layouts/' . CNF_THEME . '/headertop';
        $this->footer = 'layouts/' . CNF_THEME . '/footer';
        $this->load->view($this->header);
        $this->load->view($this->headertop);
        $this->load->view('error/index_500',$data);
        $this->load->view($this->footer);
        
    } 
} 
?> 