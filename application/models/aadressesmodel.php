<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Aadressesmodel extends SB_Model 
{

	public $table = 'addresses';
	public $primaryKey = 'address_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT addresses.* FROM addresses   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE addresses.address_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
