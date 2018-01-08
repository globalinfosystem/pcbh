<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Casedecisionmodel extends SB_Model 
{

	public $table = 'tbl_case_status';
	public $primaryKey = 'disposed_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT tbl_case_status.* FROM tbl_case_status   ";
	}
	public static function queryWhere(  ){
		
		$ci=get_instance();
		$groupid=$ci->session->userdata["user_data"]["group_id"];
		$user_id=$ci->session->userdata["user_data"]["id"];
		$status= $ci->uri->segment(3);
		if($groupid==1 && empty($status))
		return "  WHERE tbl_case_status.disposed_id IS NOT NULL AND tbl_case_status.case_current_status=5 ";
	    else if($groupid==1 && $status=="disposeoff")
		return "  WHERE tbl_case_status.disposed_id IS NOT NULL AND tbl_case_status.case_current_status=4 ";   
	    else if($groupid==2 && empty($status))
		return "  WHERE tbl_case_status.disposed_id IS NOT NULL AND tbl_case_status.disposed_officer_id=".$user_id." AND tbl_case_status.case_current_status=5 ";	
	    else if($groupid==2 &&  $status=="disposeoff")
		return "  WHERE tbl_case_status.disposed_id IS NOT NULL AND tbl_case_status.disposed_officer_id=".$user_id." AND tbl_case_status.case_current_status=4 ";
        else
        return "  WHERE tbl_case_status.disposed_id IS NOT NULL ";			
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
