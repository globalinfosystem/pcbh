<?php 
function get_applicant_name($reg_no,$year,$field,$type){
	$_this = & get_Instance();
	$res = $_this->db->query("SELECT $field as data FROM sic WHERE reg_no='$reg_no'  and year='$year'");
	$resultdata = $res->result();
	if($type==1){
		echo $resultdata['0']->data;
	} else if($type==2) {
		$resstage = $_this->db->query("SELECT sub_stage_desc  FROM stage_sub_mast WHERE substage_no='".$resultdata['0']->data."'");
		$resultdata = $resstage->result();
		echo $resultdata['0']->sub_stage_desc;
	}
	
}
?>