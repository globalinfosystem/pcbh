<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page_model extends SB_Model {

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
        $this->db->select('title, alias');
        $this->db->like('title', $keyword);
        $this->db->where('status', 'enable');
        $getResult = $this->db->get("tb_pages")->result_array();
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
