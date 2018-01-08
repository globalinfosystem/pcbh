<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Posttypemodel extends SB_Model 
{

	public $table = 'post_type';
	public $primaryKey = 'post_type_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT post_type.* FROM post_type   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE post_type.post_type_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
