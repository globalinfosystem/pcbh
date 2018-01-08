<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Casestatusmodel extends SB_Model 
{

	public $table = 'tbl_current_status';
	public $primaryKey = 'current_status_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT tbl_current_status.* FROM tbl_current_status   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE tbl_current_status.current_status_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
