<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pageimagemodel extends SB_Model 
{

	public $table = 'tb_page_image';
	public $primaryKey = 'tb_page_image_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT tb_page_image.* FROM tb_page_image   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE tb_page_image.tb_page_image_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
