<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Orderpassedmodel extends SB_Model 
{

	public $table = 'tbl_order_passed';
	public $primaryKey = 'order_passed_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT tbl_order_passed.* FROM tbl_order_passed   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE tbl_order_passed.order_passed_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
