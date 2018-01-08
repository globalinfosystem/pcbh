<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Emailmodel extends SB_Model 
{

	public $table = 'tb_email';
	public $primaryKey = 'email_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT tb_email.* FROM tb_email   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE tb_email.email_id IS NOT NULL  ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
