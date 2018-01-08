<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pagepdfmodel extends SB_Model 
{

	public $table = 'tb_page_pdf';
	public $primaryKey = 'tb_page_pdf_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT tb_page_pdf.* FROM tb_page_pdf   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE tb_page_pdf.tb_page_pdf_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
