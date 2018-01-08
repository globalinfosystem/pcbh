<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Vctypemodel extends SB_Model 
{

	public $table = 'vc_type_master';
	public $primaryKey = 'vc_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT vc_type_master.* FROM vc_type_master   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE vc_type_master.vc_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
