<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Registration_model extends SB_Model {

    function __construct() {
        parent::__construct();
    }

    function get_search_result($keyword) {
        $this->db->trans_start();
        $this->db->select('title, alias');
        $this->db->like('title', $keyword);
        $this->db->where('status', 'enable');
        $getResult = $this->db->get("tb_pages")->result_array();
        $this->db->trans_complete();
        return $getResult;
    }

    function get_all_districts_of_one_state() {
        $this->db->trans_start();
        $getResult = $this->db->where('dist_no !=',0)->get("tbl_districts")->result_array();
        $this->db->trans_complete();
        return $getResult;
    }
	
	public function insert_update_user($data,$id)
	{
		
		if($id!="")
		{
		
				$this->db->trans_start();
				$this->db->where('id', trim($id));
				$getResult = $this->db->update("tb_users",$data);
				$this->db->trans_complete();
				//return $registration_id;
		}
		else
		{
			
			$this->db->insert('tb_users',$data);
			$lastId = $this->db->insert_id();
	        return $lastId;
		}
	}
	////////// email format///////////////////
	function getEmailData($id) {
        $this->db->trans_start();
        $getResult = $this->db->get_where('tb_email', array('email_id' => $id))->row_array();
        $this->db->trans_complete();
        return $getResult;
    }
	
	//////// check email id exists ///////////
	    function get_registration_by_email($email) {
        $this->db->trans_start();
        $getResult = $this->db->get_where('tb_users', array('email' => $email))->result_array();
        $this->db->trans_complete();
        return $getResult;
    }



    function get_page_result($pageID) {
        $this->db->trans_start();
        $this->db->where('alias', trim($pageID));
        $this->db->where('status', 'enable');
        $getResult = $this->db->get("tb_pages")->row();
        $this->db->trans_complete();
        return $getResult;
    }
    
    
    function get_sliderImages_result($is_slider) {
        $this->db->trans_start();
        $getResult = $this->db->get_where('tb_slider_images', array('slider_id' => $is_slider, 'slider_image_status' => 'enable'))->result_array();
        $this->db->trans_complete();
        return $getResult;
    }

}
