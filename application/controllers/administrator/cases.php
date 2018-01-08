<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cases extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'cases';
	public $per_page	= '10';

	function __construct() 
	{
		parent::__construct();
		
		$this->load->model('casesmodel');
		$this->model = $this->casesmodel;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'cases',
		));
		
		if(!$this->session->userdata('logged_in')) redirect('user/login',301);
		
	}

	
	//====this function use to get next case date=======//
	private function get_case_next_date()
	{
		$this->load->model('pollution_model');
		$query="select tbl_case.case_id, case  
when tbl_case.case_cuttent_status=2 Then (SELECT  tbl_case_asign.case_asign_date_of_assign FROM `tbl_case_asign` where tbl_case_asign.case_asign_case_id=tbl_case.case_id)
when tbl_case.case_cuttent_status=3 Then (SELECT tbl_hearing.hearing_next_date FROM `tbl_hearing` where tbl_hearing.hearing_case_id= tbl_case.case_id)
ELSE 0 END as nextdate
from tbl_case";
		$get_result=$this->pollution_model->custom_query($query);
		$next_date_data=array();
		foreach($get_result as $result)
		{
		  $next_date_data[$result["case_id"]]=$result["nextdate"];	
			
		}
		return $next_date_data;
	}
		//=====Case Assign Functions Start Here=====//
	//======Case Assign By Aamin============//
	public function case_assign($case_id)
	{
		if($this->access['is_view'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
		}
		$this->load->model('pollution_model');
		
		$this->data["pageTitle"]="Case Assign";
		$this->data['case_asign_id']=$case_id;
		
		
		//$casedata=$officer_data=$this->pollution_model->get_data("tbl_case","case_letter_number",array("case_id "=>$case_id));
		$casedata=$this->pollution_model->custom_query("select concat(case_id,' ',case_letter_number,' ',case_subject) as subject,case_cuttent_status from tbl_case where case_id=".$case_id."");
		$this->data["subject"]=$casedata[0]["subject"];
		$officer_data=$this->pollution_model->get_data("tb_users","id,name",array("group_id"=>2));
		$this->data["officer_data"]=$officer_data;
		$status_data=$this->pollution_model->getdate_select("tb_status","status_id,status_name");
		$this->data["status_data"]=$status_data;
		$this->data['content'] = $this->load->view('administrator/cases/assign_case',$this->data, true );
		
		
    	$this->load->view('layouts/main', $this->data );
		
	}
	//================
	//======Case save from this function=========//
	public function assign_case_save()
	{
		
		if($_POST)
		{
			
			$this->load->model('pollution_model');
			$assign_data["case_asign_case_id"]=$this->input->post('case_id',true);;
			$assign_data["case_asign_officer_id"]=$this->input->post('officer_id',true);;
			$assign_data["case_asign_date_of_assign"]=$this->input->post('case_asign_date_of_assign',true);
			$assign_data["case_asign_status_id"]=$this->input->post('case_asign_status_id',true);
		    $this->pollution_model->insertdata('tbl_case_asign',$assign_data);
		    $this->pollution_model->updatedata('tbl_case',array('case_id'=>$assign_data["case_asign_case_id"]),array('case_cuttent_status'=>2));
			$this->save_data_in_log("assigned");
			redirect('administrator/cases',301);
		}	
		
	}//=====Case Assign functions End here===========
	//===================Hearing Functions====================
	//=========Display case hearing function start here==============// 
	public function case_hearing($case_id)
	{
        if($this->access['is_view'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
		}			
		$this->load->model('pollution_model');
		
		$this->data["pageTitle"]="Case Hearing";
		$this->data['case_id']=$case_id;
		$custom_query="SELECT tbl_case.case_cuttent_status,
	concat(tbl_case.case_id,' ',tbl_case.case_letter_number,' ',tbl_case.case_subject) 
	as subject
FROM (tbl_case) WHERE (tbl_case.case_id=".$case_id.")";
       $casedata=$this->pollution_model->custom_query($custom_query);

		
		$this->data["subject"]=$casedata[0]["subject"];
		$officer_data=$this->pollution_model->get_data("tb_users","id,name",array("group_id"=>2));
		$this->data["officer_data"]=$officer_data;
		$address_data=$this->pollution_model->get_data("addresses","address_id,address_address",array("address_status"=>1));
		$this->data["address_data"]=$address_data;
		$currentcase_status=$casedata[0]["case_cuttent_status"]+1;
		$current_status_data=$this->pollution_model->get_data("tbl_current_status","current_status_id,current_status_name",array("current_status_id"=>$currentcase_status));
		$this->data["status"]=$current_status_data;
		//$this->data["current_status_name"]=$current_status_data[0]["current_status_name"];
		$this->data['content'] = $this->load->view('administrator/cases/case_hearing',$this->data, true );
		$this->load->view('layouts/main', $this->data );
	}
	//======== Save case hearing function=======//
	public function save_case_hearing()
	{
		if($_POST)
		{
			
		  $this->form_validation->set_rules('hearing_status', 'Hearing Status', 'required');
		   $this->form_validation->set_rules('officer_id', 'Officer Name', 'required');
		  
		  $this->form_validation->set_rules('hearing_next_date', 'Hearing Next Date', 'required');
		  $this->form_validation->set_rules('remark', 'Remark', 'required');
		  $this->form_validation->set_rules('hearing_address_id', 'Hearing Address', 'required');
		  
		 if ($this->form_validation->run() == FALSE)
		 {
			 $errors=validation_errors();
			 $this->session->set_flashdata('errors',$errors);
			 redirect('administrator/cases/case_hearing/'.$this->input->post('case_id',true).'', 'refresh');
		 }
		 else
		 { 
			$this->load->model('pollution_model');
			$hearing_data["hearing_case_id"]=$this->input->post('case_id',true);;
			$hearing_data["hearing_officer_id"]=$this->input->post('officer_id',true);;
			$hearing_data["hearing_time"]=$this->input->post('hour',true).":".$this->input->post('minute',true).":".$this->input->post('second',true)." ".$this->input->post('timeformat',true);
			$hearing_data["hearing_next_date"]=$this->input->post('hearing_next_date',true);
			$hearing_data["hearing_address_id"]=$this->input->post('hearing_address_id',true);
		    $hearing_data["remark"]=$this->input->post('remark',true);
			
			if(isset($_POST["hearing_id"]))
			{
		    $this->pollution_model->updatedata('tbl_hearing',array('hearing_id'=>$this->input->post('hearing_id',true)),$hearing_data);		
			}
			else
			{
			$this->pollution_model->insertdata('tbl_hearing', $hearing_data);	
			
			}	
		    $case_cuttent_status=$this->input->post('hearing_status',true);
		    $this->pollution_model->updatedata('tbl_case',array('case_id'=>$this->input->post('case_id',true)),array('case_cuttent_status'=>$case_cuttent_status));
			$this->pollution_model->updatedata('tbl_case_asign',array('case_asign_case_id'=>$this->input->post('case_id',true)),array('case_asign_officer_id'=>$this->input->post('officer_id',true),'case_asign_update_date'=>date('Y-m-d h:i:s')));
			$getaddress=$this->pollution_model->get_data('addresses','address_address',array("address_id"=>$hearing_data["hearing_address_id"],"address_status"=>1));
			$addmessage="<br/>Hearing Date:".$hearing_data["hearing_next_date"]."<br/>Hearing Time:".$hearing_data["hearing_time"]."<br/>Remark:".$hearing_data["remark"]."<br/>Address:".$getaddress[0]["address_address"];
			$this->save_data_in_log("hearing",$addmessage);
			
			redirect('administrator/cases',301);
		 }	 
		}	
		
		
	}
	//======Edit Hearing function=======//
	public function edithearing($case_id)
	{
		if($this->access['is_view'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
		}
		
		$this->load->model('pollution_model');
		$this->data["pageTitle"]="Case Hearing";
		$this->data['case_id']=$case_id;
		
		$custom_query="SELECT tbl_case.case_cuttent_status,
	concat(tbl_case.case_id,' ',tbl_case.case_letter_number,' ',tbl_case.case_subject) 
	as subject
FROM (tbl_case) WHERE (tbl_case.case_id=".$case_id.")";
        $casedata=$this->pollution_model->custom_query($custom_query);
        $this->data["subject"]=$casedata[0]["subject"];
		$officer_data=$this->pollution_model->get_data("tb_users","id,name",array("group_id"=>2));
		$this->data["officer_data"]=$officer_data;
		$address_data=$this->pollution_model->get_data("addresses","address_id,address_address",array("address_status"=>1));
		$this->data["address_data"]=$address_data;
		$currentcase_status=$casedata[0]["case_cuttent_status"];
		$current_status_data=$this->pollution_model->get_data("tbl_current_status","current_status_id,current_status_name",array("current_status_id"=>$currentcase_status));
		$this->data["status"]=$current_status_data;
		$hearing_data=$this->pollution_model->get_data("tbl_hearing","hearing_id,hearing_case_id,hearing_officer_id,hearing_time,hearing_next_date,hearing_address_id,remark",array("hearing_case_id"=>$case_id));
		$this->data["hearing_data"]=$hearing_data;
		$this->data["currentcase_status"]=$currentcase_status;
		
		$date=explode(':',$this->data["hearing_data"][0]["hearing_time"]);
		
		$this->data['hour']=$date[0];
		$this->data['minute']=$date[1];
		$second_time_format=explode(' ',$date[2]);
		$this->data['second']=$second_time_format[0];
		$this->data['dateformat']=$second_time_format[1];
		$this->data['content'] = $this->load->view('administrator/cases/case_hearing',$this->data, true );
		$this->load->view('layouts/main', $this->data );
		
	}
	//========End Hearing Function here========//
	//=====Start Dispose/Decided function here========//
	//==Display Dispose/Decided form here=======//
	public function change_status($case_id,$status_type)
	{
		
          	if($this->access['is_view'] ==0)
		    { 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
		   }
		   
         $this->load->model('pollution_model');
		 
         $casedata=$this->pollution_model->custom_query("select concat(case_id,' ',case_letter_number,' ',case_subject) as subject,case_cuttent_status from tbl_case where case_id=".$case_id."");		

		$this->data["pageTitle"]=($status_type=="disposeoff"?"Case Dispose Off":($status_type=="decided"?"Case Decided":""));
		 $this->data['case_id']=$case_id;
		 $this->data['status_type']=$status_type;
		$this->data["subject"]=$casedata[0]["subject"];
		$this->data["officername"]=$this->session->userdata["user_data"]["name"];
		$this->data["officerid"]=$this->session->userdata["user_data"]["id"];
		
		$this->data['content'] = $this->load->view('administrator/cases/disposed_off',$this->data, true );
		$this->load->view('layouts/main', $this->data );  
		
	}
	//===save Dispose/Decided information=======//
	public function save_change_status()
	{
		if($this->access['is_view'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
		}
		if($_POST)
		{
			$status_type=$this->input->post('status_type',true);
			$this->form_validation->set_rules('disposed_off_date', 'Date', 'required');
		    $this->form_validation->set_rules('remark', 'Remark', 'required');
			if ($this->form_validation->run() == FALSE)
		    {
			 $errors=validation_errors();
			 $this->session->set_flashdata('errors',$errors);
			 redirect('administrator/cases/change_status/'.$this->input->post('case_id',true).'/'.$status_type.'', 'refresh');
		    }
			else
			{   
		         $attechment_file_path='';
				$this->load->model('pollution_model');
				$disposed_off["disposed_case_id"]=$this->input->post('case_id',true);
				$disposed_off["disposed_officer_id"]=$this->input->post('officer_id',true);
				$disposed_off["disposed_date"]=$this->input->post('disposed_off_date',true);
				$disposed_off["disposed_remark"]=$this->input->post('remark',true);
				//$casecurrentstatus=$this->pollution_model->get_data("tbl_case","case_cuttent_status",array("case_id"=>$this->input->post('case_id',true)));
				$casecurrentstatus=($status_type=="disposeoff"?4:($status_type=="decided"?5:''));
				//$casecurrentstatus=($casecurrentstatus[0]["case_cuttent_status"]+1);
				$disposed_off["case_current_status"]=$casecurrentstatus;
				
				if($casecurrentstatus==4)
				{
				$file_id=$this->pollution_model->insertdata('tbl_case_status',$disposed_off);
               $this->pollution_model->updatedata('tbl_case',array('case_id'=>$this->input->post('case_id',true)),array('case_cuttent_status'=>$casecurrentstatus));				
					
				}else
				{
					  if(isset($_FILES['attachment']['name']) && !empty($_FILES['attachment']['name']))
			          {
                
				       $file_id=$this->pollution_model->insertdata('tbl_case_status',$disposed_off);
				      
				       $file_path=$this->upload_pdf_file($file_id,$disposed_off["disposed_officer_id"],'uploads/decided_attachment/','administrator/cases/change_status/'.$this->input->post('case_id',true).'/'.$status_type.'');
				       $this->pollution_model->updatedata('tbl_case_status',array('disposed_id'=>$file_id),array('attachment'=>$file_path));
				       $this->pollution_model->updatedata('tbl_case',array('case_id'=>$this->input->post('case_id',true)),array('case_cuttent_status'=>$casecurrentstatus));
					   $attechment_file_path="<br/>Attechment:".base_url().$file_path;
					
				      }else
                      {
						$this->session->set_flashdata('errors',"Upload Only Pdf File. Size Limit Less Then 5MB!"); 
                       redirect('administrator/cases/change_status/'.$this->input->post('case_id',true).'/'.$status_type.'', 'refresh');  
					  }						  
		     
			   }	
		  }	
		        $addmessage="<br/>Date ".$disposed_off["disposed_date"]."<br/>"."Remark ".$disposed_off["disposed_remark"].$attechment_file_path;
				$this->save_data_in_log($status_type,$addmessage);
				//$this->session->set_flashdata('message',"Case Dispose Off ".$caseassignusername[0]["name"]."");
			    redirect('administrator/cases',301);				
		
	}
	}

   //==============================================//
	function index() 
	{
		if($this->access['is_view'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
		}	
		  
		// Filter sort and order for query 
		$sort = (!is_null($this->input->get('sort', true)) ? $this->input->get('sort', true) : 'case_id'); 
		$order = (!is_null($this->input->get('order', true)) ? $this->input->get('order', true) : 'asc');
		// End Filter sort and order for query 
		// Filter Search for query		
		$filter = (!is_null($this->input->get('search', true)) ? $this->buildSearch() : '');
		// End Filter Search for query 
		
		$page = max(1, (int) $this->input->get('page', 1));
		$params = array(
			'page'		=> $page,
			'limit'		=> ($this->input->get('rows', true) !='' ? filter_var($this->input->get('rows', true),FILTER_VALIDATE_INT) : $this->per_page ) ,
			'sort'		=> $sort,
			'order'		=> $order,
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		// Get Query 
		$results = $this->model->getRows( $params );		
		
		// Build pagination setting
		$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;	
		#$pagination = Paginator::make($results['rows'], $results['total'],$params['limit']);		
		$this->data['rowData']		= $results['rows'];
		// Build Pagination
		
		$pagination = $this->paginator( array(
			'total_rows' => $results['total'] ,
			'per_page'	 => $params['limit']
		));
		$this->data['pagination']	= $pagination;
		// Row grid Number 
		$this->data['i']			= ($page * $params['limit'])- $params['limit']; 
		// Grid Configuration 
		$this->data['tableGrid'] 	= $this->info['config']['grid'];
		$this->data['tableForm'] 	= $this->info['config']['forms'];
		$this->data['colspan'] 		= SiteHelpers::viewColSpan($this->info['config']['grid']);		
		// Group users permission
		$this->data['access']		= $this->access;
		// Render into template
		$this->data["groupid"]=$this->session->userdata["user_data"]["group_id"];
		$this->data["user_id"]=$this->session->userdata["user_data"]["id"];
		$this->data["case_next_date"]=$this->get_case_next_date();
		
		$this->data['content'] = $this->load->view('administrator/cases/index',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
    
	  
	}
	
	function show( $id = null) 
	{
		if($this->access['is_detail'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
	  	}		

		$row = $this->model->getRow($id);
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('tbl_case'); 
		}
		
		$this->data['id'] = $id;
		
		if(isset($row['case_id']))
		{
		   $this->load->model('pollution_model');
		  $query="SELECT tb_users.id, tb_users.name, tb_users.username, tbl_case_asign.case_asign_case_id
		  ,tbl_case_asign.case_asign_date_of_assign,tbl_case_asign.case_asign_update_date
FROM tbl_case_asign
INNER JOIN tb_users ON tbl_case_asign.case_asign_officer_id = tb_users.id where tbl_case_asign.case_asign_case_id=".$row['case_id']."";
		 $assign_detail=$this->pollution_model->custom_query($query);
		 if(!empty($assign_detail))
		 {	
		 $this->data['assign_detail']=$assign_detail;
         }
		 $query="SELECT tb_users.id, tb_users.name, tb_users.username, tbl_hearing.hearing_case_id,tbl_hearing.hearing_next_date,tbl_hearing.hearing_time,
addresses.address_address,tbl_hearing.remark,tbl_hearing.hearing_created_date
FROM tbl_hearing
INNER JOIN tb_users ON tbl_hearing.hearing_officer_id = tb_users.id 
INNER JOIN addresses ON tbl_hearing.hearing_address_id=addresses.address_id 
where tbl_hearing.hearing_case_id=".$row['case_id']."";
$hearing_detail=$this->pollution_model->custom_query($query);
		 if(!empty($hearing_detail))
		 {
			$this->data['hearing_detail']=$hearing_detail; 
		 }
		 
		 $query="SELECT tb_users.id, tb_users.name, tb_users.username,
 tbl_case_status.disposed_date,tbl_case_status.disposed_remark,tbl_case_status
.case_current_status,CASE tbl_case_status.case_current_status 
WHEN 4 THEN 'Dispose Off'
WHEN 5 THEN 'Decided'
ELSE 'NO' END as case_status,tbl_case_status.attachment
FROM tbl_case_status
INNER JOIN tb_users ON tbl_case_status.disposed_officer_id = tb_users.id 
where tbl_case_status.disposed_case_id=".$row['case_id']."";
		  $case_status_detail=$this->pollution_model->custom_query($query);
		   if(!empty($case_status_detail))
		  {
			$this->data['case_status_detail']=$case_status_detail; 
		  }
		  
		}
      		
		$this->data['content'] =  $this->load->view('administrator/cases/view', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}
  
	function add( $id = null ) 
	{
		if($id =='')
			if($this->access['is_add'] ==0) redirect('dashboard',301);

		if($id !='')
			if($this->access['is_edit'] ==0) redirect('dashboard',301);	

		$row = $this->model->getRow( $id );
		if($row)
		{
			$this->data['row'] =  $row;
		} else {
			$this->data['row'] = $this->model->getColumnTable('tbl_case'); 
		}
	    if(!empty($row))
        {			
	    $this->load->model('pollution_model');
	    $userinfo=$this->pollution_model->custom_query("select concat(name,mobile) as userinfo from  tb_users where tb_users.id=".$this->data['row']['case_user_id']."");
		$this->data['userinfo']=$userinfo[0]["userinfo"];
		}
		$this->data["groupid"]=$this->session->userdata["user_data"]["group_id"];
		$this->data["user_id"]=$this->session->userdata["user_data"]["id"];
		
		$this->data['id'] = $id;
		
		$this->data['content'] = $this->load->view('administrator/cases/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}
	
	function save() {
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			$data["case_subject"]=$data["case_petitioner_name"]." VS ".$data["case_respondent_name"];
			$data["case_update_date"]=date("Y-m-d H:i:s");
			$ID = $this->model->insertRow($data , $this->input->get_post( 'case_id' , true ));
			// Input logs
			if( $this->input->get( 'case_id' , true ) =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			  $this->load->model('pollution_model');
			  $this->save_data_in_log("case_edit");
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			if($this->input->post('apply'))
			{
				redirect( 'administrator/cases/add/'.$ID,301);
			} else {
				redirect( 'administrator/cases',301);
			}			
			
			
		} else {
			$data =	array(
					'message'	=> 'Ops , The following errors occurred',
					'errors'	=> validation_errors('<li>', '</li>')
					);			
			$this->displayError($data);
		}
	}

	function destroy()
	{
		if($this->access['is_remove'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
	  	}
			
		$this->model->destroy($this->input->post( 'id' , true ));
		$this->inputLogs("ID : ".implode(",",$this->input->post( 'id' , true ))."  , Has Been Removed Successfull");
		$this->session->set_flashdata('message',
			SiteHelpers::alert('success',"ID : ".implode(",",$this->input->post( 'id' , true ))."  , Has Been Removed Successfull"));
		Redirect('administrator/cases',301);
	}


}
