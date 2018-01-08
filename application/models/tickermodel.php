<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tickermodel extends SB_Model 
{

	public $table = 'tb_ticker';
	public $primaryKey = 'ticker_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "   SELECT tb_ticker.* FROM tb_ticker   ";
	}
	public static function queryWhere(  ){
		
		return "  WHERE tb_ticker.ticker_id IS NOT NULL   ";
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
