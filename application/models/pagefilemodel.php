<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pagefilemodel extends SB_Model 
{

	public $table = 'tb_page_file';
	public $primaryKey = 'tb_page_file_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT tb_page_file.* FROM tb_page_file   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE tb_page_file.tb_page_file_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
