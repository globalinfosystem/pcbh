
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Galleryimages extends SB_controller {

    protected $_key = 'id';
    protected $_class = 'page';
    protected $layout = "layouts/main";
    private $hatron;

    function __construct() {
        parent::__construct();
        $this->layout = 'layouts/' . CNF_THEME . '/index';
        $this->load->driver('cache');
        }


   

    

   

    
    function index($id)
    {
      
        if($id)
        {
             $this->data['id'] = $id;
             
                        $this->layout = 'layouts/' . CNF_THEME . '/twocolumnwithright';
                 $this->data['content'] = $this->load->view('pages/galleryimages.php', $this->data, true);
               $this->load->view($this->layout, $this->data, false);
        }
        else
        {
            redirect();
            
        }
        
        
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/page.php */ 