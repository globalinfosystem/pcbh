<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Smsmodel extends SB_Model 
{

	public $table = 'tb_sms';
	public $primaryKey = 'sms_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT tb_sms.* FROM tb_sms   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE tb_sms.sms_id IS NOT NULL  ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
