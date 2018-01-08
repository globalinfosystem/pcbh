<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Casehearingmodel extends SB_Model 
{

	public $table = 'tbl_hearing';
	public $primaryKey = 'hearing_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT tbl_hearing.* FROM tbl_hearing   ";
	}
	public static function queryWhere(  ){
		
		$ci=get_instance();
		$groupid=$ci->session->userdata["user_data"]["group_id"];
		$user_id=$ci->session->userdata["user_data"]["id"];
		if($groupid==1)
		{
		  return "  WHERE tbl_hearing.hearing_id IS NOT NULL   ";
		}else
		{
			return "  WHERE tbl_hearing.hearing_id IS NOT NULL AND tbl_hearing.hearing_officer_id=".$user_id."  ";
		}	
		 
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
