<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Caseattechments extends SB_Controller 
{

	protected $layout 	= "layouts/main";
	public $module 		= 'caseattechments';
	public $per_page	= '10';

	function __construct() {
		parent::__construct();
		
		$this->load->model('caseattechmentsmodel');
		$this->model = $this->caseattechmentsmodel;
		
		$this->info = $this->model->makeInfo( $this->module);
		$this->access = $this->model->validAccess($this->info['id']);	
		$this->data = array_merge( $this->data, array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'	=> 'caseattechments',
		));
		
		if(!$this->session->userdata('logged_in')) redirect('user/login',301);
		
	}
	//=== This function check case id =====//
	private function check_case_id($case_id)
	{
		$this->load->model('pollution_model');
		$user_id=$this->session->userdata["user_data"]["id"];
		$group_id=$this->session->userdata["user_data"]["group_id"];
		if($group_id==1)
		{
			return 1;
		}else if($group_id==3)
        {
			$case_status=$this->pollution_model->get_data("tbl_case","count(*) as total",array("case_user_id"=>$user_id,"case_id"=>$case_id));
		    return($case_status[0]["total"]>=1?1:0);
		}else if($group_id==2)
        {
		    $case_status=$this->pollution_model->get_data("tbl_case_asign","count(*) as total",array("case_asign_case_id"=>$case_id,"case_asign_officer_id "=>$case_id));
		    return($case_status[0]["total"]>=1?1:0);	
		}			
		
	}//=====
	//================================================//
	//======Display Attechment files=============//
	function files($case_id)
	{
		if($this->access['is_view'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
		}	
	
		if(!isset($case_id) || $this->check_case_id((int)$case_id)==0)
		{
			redirect('dashboard',301);
		}
		$case_id=(int)$case_id;
		$this->model->addcondition("and tbl_file_attachment.file_attachment_case_id=".$case_id."");
		// Filter sort and order for query 
		$sort = (!is_null($this->input->get('sort', true)) ? $this->input->get('sort', true) : 'file_attachment_id'); 
		$order = (!is_null($this->input->get('order', true)) ? $this->input->get('order', true) : 'asc');
		// End Filter sort and order for query 
		// Filter Search for query		
		$filter = (!is_null($this->input->get('search', true)) ? $this->buildSearch() : '');
		// End Filter Search for query 
		
		$page = max(1, (int) $this->input->get('page', 1));
		$params = array(
			'page'		=> $page ,
			'limit'		=> ($this->input->get('rows', true) !='' ? filter_var($this->input->get('rows', true),FILTER_VALIDATE_INT) : $this->per_page ) ,
			'sort'		=> $sort ,
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
		$this->data["case_id"]=$case_id;
		//==check case status for edit part========//
		$case_current_status=$this->check_case_current_status($case_id);
		
		$this->data['access']['is_edit']=$case_current_status;
		$this->access['is_remove']=$case_current_status;
		$this->access['is_add']=($case_current_status==1?(count($results['rows'])<5?1:0):0);
		
	    //=====================================//
		$this->data['content'] = $this->load->view('administrator/caseattechments/index',$this->data, true );
		
    	$this->load->view('layouts/main', $this->data );
		
	}
	
	//==========this function use for get case id for group two=======//
	public function get_case_id_for_officer()
	{
		$this->load->model('pollution_model');
		$user_id=$this->session->userdata["user_data"]["id"];
		$group_id=$this->session->userdata["user_data"]["group_id"];
        $group_case_id='';
		if($group_id==2)
		{

       $caseid= $this->pollution_model->get_data('tbl_case_asign','group_concat( `case_asign_case_id` ) AS case_id',
array('case_asign_officer_id'=>$user_id));
		$group_case_id=(empty($caseid[0]['case_id'])?'':$caseid[0]['case_id']);
		}	
		return $group_case_id;
		
	}
	//================//
	function index() 
	{
	
		if($this->access['is_view'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
		}	
        
		 //==== here check user group id if group id two then find case id for that user======//		  
		  $group_case_id=$this->get_case_id_for_officer();
		  
		   if(!empty($group_case_id))
		   {
			   
		    $this->model->addcondition("and tbl_file_attachment.file_attachment_case_id in (".$group_case_id.")");	
		   }	
		  $this->access['is_add']=0; 
		  $this->access['is_edit']=0;
		  $this->access['is_remove']=0;
		//==========================end condition==========================================================//
		// Filter sort and order for query 
		$sort = (!is_null($this->input->get('sort', true)) ? $this->input->get('sort', true) : 'file_attachment_id'); 
		$order = (!is_null($this->input->get('order', true)) ? $this->input->get('order', true) : 'asc');
		// End Filter sort and order for query 
		// Filter Search for query		
		$filter = (!is_null($this->input->get('search', true)) ? $this->buildSearch() : '');
		// End Filter Search for query 
		
		$page = max(1, (int) $this->input->get('page', 1));
		$params = array(
			'page'		=> $page ,
			'limit'		=> ($this->input->get('rows', true) !='' ? filter_var($this->input->get('rows', true),FILTER_VALIDATE_INT) : $this->per_page ) ,
			'sort'		=> $sort ,
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
		$this->data['add_new_button']=0;
		$this->data['content'] = $this->load->view('administrator/caseattechments/index',$this->data, true );
		
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
			$this->data['row'] = $this->model->getColumnTable('tbl_file_attachment'); 
		}
		
		$this->data['id'] = $id;
		$this->data['content'] =  $this->load->view('administrator/caseattechments/view', $this->data ,true);	  
		$this->load->view('layouts/main',$this->data);
	}
	// This function add image from backend==========//
    public function addimage($case_id)
	{
		if(!isset($case_id) || $this->check_case_id((int)$case_id)==0)
		{
			redirect('dashboard',301);
		}else
		{
			$this->load->model('pollution_model');
		    $caseinfodata=$this->pollution_model->custom_query("select `case_user_id`,concat(`case_id`,' ',`case_letter_number`,' ',`case_subject`) AS caseinfo from tbl_case where case_id=".$case_id."");
		    $this->data['caseinfo']=$caseinfodata[0]["caseinfo"];
			$this->data['file_attachment_user_id']=$caseinfodata[0]["case_user_id"];
			$this->data['file_attachment_case_id']=$case_id;
			
			$file_attachment_id=$this->pollution_model->getdate_select("tbl_file_attachment","(max(file_attachment_id)+1
) AS nextid");

            $this->data['row']['file_attachment_id']=$file_attachment_id[0]["nextid"];
		    $this->data['id'] = $case_id;
			$this->data['formtype']="addimage";
		    $this->data['content'] = $this->load->view('administrator/caseattechments/form',$this->data, true );		
	  	    $this->load->view('layouts/main', $this->data);
		}	
		
	}
	//------------------//
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
			$this->data['row'] = $this->model->getColumnTable('tbl_file_attachment'); 
		}
	    $this->load->model('pollution_model');
		if(!empty($row))
		{
         $caseinfodata=$this->pollution_model->custom_query("select concat(`case_id`,' ',`case_letter_number`,' ',`case_subject`) AS caseinfo from tbl_case where case_id=".$this->data['row']['file_attachment_case_id']." and case_status=1");
    	 $this->data['caseinfo']=$caseinfodata[0]["caseinfo"];
		}else
		{
		 redirect('/dashboard', 'refresh');	   		
		}	
		$this->data['id'] = $id;
		$this->data['formtype']="editimage";
		$this->data['content'] = $this->load->view('administrator/caseattechments/form',$this->data, true );		
	  	$this->load->view('layouts/main', $this->data );
	
	}
	// ===Image upload function============//
	function upload_pdf_file($file_id,$existsfilename,$user_id)
	{
		               $filename = $_FILES['file_attachment_file_path']['name'];
					   $filename=explode('.',$filename);
	                   $file_name=$filename[0];
                       $filetypetype = $_FILES['file_attachment_file_path']['type'];
					   $extension=strtolower($filetypetype);
                       //$_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                       $fileerror = $_FILES['file_attachment_file_path']['error'];
                       $filesize = $_FILES['file_attachment_file_path']['size'];
					   
					   if($filesize<5242880 && $extension!="application/pdf")
					   {
						   $this->session->set_flashdata('errors',"Upload Only Pdf File. Size Limit Less Then 5MB!");
						   redirect('/administrator/caseattechments/add/'.$file_id.'', 'refresh');
						   //continue;
					   }else
					   {
						   $upload_path = 'uploads/appealpdf/';
			               $server_ip = gethostbyname(gethostname());
                           $upload_url = 'http://'.$server_ip.'/uploads/appealpdf/'.$upload_path;
						  
                           $name=$file_name."_".$file_id."_".$user_id;
						   
                           $file_url = $upload_url.$name .'.pdf';
                           $file_path = $upload_path .$name.'.pdf';
						   move_uploaded_file($_FILES['file_attachment_file_path']['tmp_name'],$file_path);
               			   unlink($existsfilename);
						   return  $file_path;
					   }  
		
	}
	//==============================================//
	function save() 
	{
		
		$rules = $this->validateForm();

		$this->form_validation->set_rules( $rules );
		if( $this->form_validation->run() )
		{
			$data = $this->validatePost();
			$formtype=$this->input->get_post( 'formtype' , true );
			if(isset($_FILES['file_attachment_file_path']['name']) && !empty($_FILES['file_attachment_file_path']['name']))
			{
				$filepath=$this->upload_pdf_file($this->input->get_post( 'file_attachment_id' , true ),$_POST["filename"],$this->input->get_post('file_attachment_user_id', true ));	
				$data["file_attachment_file_path"]=$filepath;
			}else
			{    
		          $this->session->set_flashdata('errors',"Upload Only Pdf File. Size Limit Less Then 5MB!");   
				
				 if($formtype=="addimage")
				 {
					redirect('/administrator/caseattechments/addimage/'.$this->input->get_post('file_attachment_case_id' , true ).'', 'refresh');	  
				 }else
                 {
				   redirect('/administrator/caseattechments/add/'.$this->input->get_post( 'file_attachment_id' , true ).'', 'refresh');	 
				 }					 
				 
			}	
			if($formtype=="addimage")
			{
			  $ID = $this->model->insertRow($data ,'');	
			}else
            {
				$data["file_attachment_update_date"]=date('Y-m-d H:i:s');
				$ID = $this->model->insertRow($data , $this->input->get_post( 'file_attachment_id' , true ));	
			}				
			
			// Input logs
			if( $this->input->get( 'file_attachment_id' , true ) =='')
			{
				$this->inputLogs("New Entry row with ID : $ID  , Has Been Save Successfull");
			} else {
				$this->inputLogs(" ID : $ID  , Has Been Changed Successfull");
			}
			// Redirect after save	
			$this->session->set_flashdata('message',SiteHelpers::alert('success'," Data has been saved succesfuly !"));
			if($this->input->post('apply'))
			{
				redirect( 'administrator/caseattechments/add/'.$ID,301);
			} else {
				redirect( 'administrator/caseattechments',301);
			}			
			
			
		} else {
			$data =	array(
					'message'	=> 'Ops , The following errors occurred',
					'errors'	=> validation_errors('<li>', '</li>')
					);			
			$this->displayError($data);
		}
	}
    //=====Remove file from backend=======//
	private function removefile($file_id)
	{
		$this->load->model('pollution_model');
		$file_name=$this->pollution_model->get_data("tbl_file_attachment","file_attachment_file_path",array("file_attachment_id"=>$file_id));
	    $existsfilename=$file_name[0]["file_attachment_file_path"];
	    unlink($existsfilename);
	}
	//=======================================//
	function destroy()
	{
		if($this->access['is_remove'] ==0)
		{ 
			$this->session->set_flashdata('error',SiteHelpers::alert('error','Your are not allowed to access the page'));
			redirect('dashboard',301);
	  	}
		$this->removefile($_POST["id"][0]);	
		$this->model->destroy($this->input->post( 'id' , true ));
		$this->inputLogs("ID : ".implode(",",$this->input->post( 'id' , true ))."  , Has Been Removed Successfull");
		$this->session->set_flashdata('message',
			SiteHelpers::alert('success',"ID : ".implode(",",$this->input->post( 'id' , true ))."  , Has Been Removed Successfull"));
		Redirect('administrator/caseattechments',301);
	}


}
