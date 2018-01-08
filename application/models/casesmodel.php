<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Casesmodel extends SB_Model 
{

	public $table = 'tbl_case';
	public $primaryKey = 'case_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "   SELECT  tbl_case.* FROM tbl_case   ";
		
		 
	}
	public static function queryWhere(  ){
		$ci=get_instance();
		$groupid=$ci->session->userdata["user_data"]["group_id"];
		$user_id=$ci->session->userdata["user_data"]["id"];
		if($groupid==1)
		{
		  return "  WHERE tbl_case.case_id IS NOT NULL   ";	
			
		}else if($groupid==2)
		{
			
			return "  WHERE tbl_case.case_id IS NOT NULL AND tbl_case.case_id IN (SELECT case_asign_case_id FROM  tbl_case_asign where case_asign_officer_id=".$user_id.")";	
		}	
		else if($groupid==3)
        {
		    return "  WHERE tbl_case.case_id IS NOT NULL AND tbl_case.case_user_id=".$user_id."";		
			
		}			
		
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
