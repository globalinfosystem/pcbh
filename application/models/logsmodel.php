<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Logsmodel extends SB_Model 
{

	public $table = 'tbl_logs';
	public $primaryKey = 'log_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT tbl_logs.* FROM tbl_logs   ";
	}
	public static function queryWhere(  ){
		
		 $ci=get_instance();
		$groupid=$ci->session->userdata["user_data"]["group_id"];
		$user_id=$ci->session->userdata["user_data"]["id"];
		
        if($groupid==2 || $groupid==3)
        {
			return "  WHERE tbl_logs.log_id IS NOT NULL AND tbl_logs.log_case_id 
			IN(select log_case_id from tbl_logs where log_user_id=".$user_id.")";	
		}else
        {
		   return "  WHERE tbl_logs.log_id IS NOT NULL   ";	
		}
	}
	
	public static function queryGroup(){
		return "  order by tbl_logs.log_case_id asc ";
	}
	
}

?>
