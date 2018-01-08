<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Caseattechmentsmodel extends SB_Model 
{

	public $table = 'tbl_file_attachment';
	public $primaryKey = 'file_attachment_id';
    private $addcondition='';
	public function __construct() {
		parent::__construct();
		
	}
    public function addcondition($condition)
	{
		$ci=get_instance();
		$ci->addcondition=$condition;
		
	}
	public static function querySelect(  )
	{
		return "   SELECT tbl_file_attachment.* FROM tbl_file_attachment   ";
	}
	public static function queryWhere(  )
	{
		$ci=get_instance();
		$group_id=$ci->session->userdata["user_data"]["group_id"];
		if(empty($ci->addcondition))
		{
          if($group_id==3)
          {			  
		     return "  WHERE tbl_file_attachment.file_attachment_id IS NOT NULL and tbl_file_attachment.file_attachment_user_id=".$ci->session->userdata["user_data"]["id"]."";
		  }else
		  {
			 return "  WHERE tbl_file_attachment.file_attachment_id IS NOT NULL "; 
		  }	  
	    }
		else
		{
		     return "  WHERE tbl_file_attachment.file_attachment_id IS NOT NULL  ".$ci->addcondition."";		
		}	
		
		
	}
	
	public static function queryGroup(){
		return "   ";
	}
	
}

?>
