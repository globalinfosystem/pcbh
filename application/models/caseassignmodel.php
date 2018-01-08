<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Caseassignmodel extends SB_Model 
{

	public $table = 'tbl_case_asign';
	public $primaryKey = 'case_asign_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT concat(tbl_case.case_id,' ',tbl_case.case_id,' ',tbl_case.case_letter_number,' ',tbl_case.case_subject) as caseinfo,tbl_case.case_cuttent_status,tbl_case.case_status,tbl_case_asign.* FROM tbl_case_asign inner join tbl_case on tbl_case_asign.case_asign_case_id=tbl_case.case_id ";
	}
	public static function queryWhere(  ){
		
		$ci=get_instance();
		$groupid=$ci->session->userdata["user_data"]["group_id"];
		$user_id=$ci->session->userdata["user_data"]["id"];
		if($groupid==1)
		{
		 return "  WHERE tbl_case_asign.case_asign_id IS NOT NULL   ";
		}else
		{
			return "  WHERE tbl_case_asign.case_asign_id IS NOT NULL AND tbl_case_asign.case_asign_officer_id=".$user_id."   ";
		}	
	}
	
	public static function queryGroup(){
		return "  order by tbl_case_asign.case_asign_id desc ";
	}
	
}

?>
