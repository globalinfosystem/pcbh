<?php 
class Error400 extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct(); 
    } 

    public function index() 
    { 
        $this->output->set_status_header('400'); 
        $data['content'] = 'error_400'; // View name 
        $this->header = 'layouts/' . CNF_THEME . '/header';
        $this->headertop = 'layouts/' . CNF_THEME . '/headertop';
        $this->footer = 'layouts/' . CNF_THEME . '/footer';
        $this->load->view($this->header);
        $this->load->view($this->headertop);
        $this->load->view('error/index_400',$data);
        $this->load->view($this->footer);
        
    } 
} 
?> 