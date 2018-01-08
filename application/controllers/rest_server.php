<?php
class Rest_server extends SB_Controller {
    /*
     * Holds the type of request made by the server
     * 
     * @var     string
     * @access  protected
     * @since   0.0.1 
     */
    protected $_request_type;
    
    //----------------------------------------------------------
    
    /**
     * Constructor Method
     * 
     * @since       0.0.1
     * @version     0.0.1
     */
    public function __construct() 
	{
        parent::__construct();
		$this->_request_type = $this->_check_request_method();
		$this->_call_requested_function();
		
    }
    
    //----------------------------------------------------------
    
    /*
     * Checks which method has been used to make the request.
     * 
     * @version     0.0.1
     * @since       0.0.1
     */
    function _check_request_method() {
        $method = strtolower($this->input->server('REQUEST_METHOD'));
        if (in_array($method, array('get', 'delete', 'post', 'put'))) {
            return $method;
        }
        return 'get';
    }
    
    //----------------------------------------------------------
 
    /**
     * 
     */
    function _call_requested_function(){
		 
        #processing the arguments based on the type of request
        switch ($this->_request_type) 
		{
            case 'get':
                #converting the passed arguments into an associative array
                $data = $this->uri->uri_to_assoc(4);
                break;
            case 'post':
                $data = file_get_contents("php://input");
                $data = json_decode($data);
				break;
            case 'put':
                $data = file_get_contents("php://input");
                $data = json_decode($data);
                break;
            case 'delete':
                $data = file_get_contents("php://input");
                $data = json_decode($data);
            default:
                break;
        }
		
        
        #inserting the data entered by the user in the POST array
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $_POST[$key] = $value;
            }
        }
       
		
        
        #reading the object name for which the call is made
        //$object_name = $this->uri->segment(3);
		$object_name = $this->uri->segment(2);
        $controller_method = $object_name . '_' . $this->_request_type;
        //echo $object_name."----".$controller_method;die;
        #calling the target function
		
        call_user_func(array($this, $controller_method), $arr_argument='');
    }    
    
}
?>