<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pagetextmodel extends SB_Model 
{

	public $table = 'tb_page_text';
	public $primaryKey = 'tb_page_text_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT tb_page_text.* FROM tb_page_text   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE tb_page_text.tb_page_text_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
