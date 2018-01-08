<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Usercase extends SB_controller 
{
	private $layout= "layouts/hspcbharyana/onecolumn";
	function __construct() 
	{
        parent::__construct();
    }
     public function index() 
	 {
		 
		 
        if($this->session->userdata("logged_in")!=1) 
		{
            redirect('user/login', 301);
            exit();
        }
		$page="case-apply.php";
		$this->layout="layouts/hspcbharyana/onecolumn";
		
		
		$this->data['pageAlias']='apply-case';
		$this->data['type']='custom';
		$this->data['content'] = $this->load->view('case/'.$page, $this->data, true);
		 
		$this->load->view($this->layout, $this->data);
     }
	
    public function savecase()
	{   
	  if($_POST)
	  {
		  
		
		$this->form_validation->set_rules('letter_number', 'Letter Number', 'required');
		$this->form_validation->set_rules('date', 'Date', 'required');
		$this->form_validation->set_rules('subjectone', 'Petitioner Name', 'required');
		$this->form_validation->set_rules('subjecttwo', 'Respondent Name', 'required');
		 if ($this->form_validation->run() == FALSE)
		 {
			 $errors=validation_errors();
			 $this->session->set_flashdata('errors',$errors);
			 redirect('/usercase', 'refresh');
		 }else if(empty($_FILES['userFiles']['name'][0]))
		 {
			  $this->session->set_flashdata('errors',"Upload Only Pdf File.Each File Limit Less Then 5MB");
			  redirect('/usercase', 'refresh');
			 
		 }	 
		 else
         {
			
		    $userdata=$this->session->userdata('user_data');
			$user_id=$userdata["id"];
			$letter_number=$this->input->post('letter_number',true);
            $date=$this->input->post('date',true);
            $subjectone=$this->input->post('subjectone',true);
            $subjecttwo=$this->input->post('subjecttwo',true);
          	$petitioner_name=$subjectone;
			$respondent_name=$subjecttwo;
			$subject=$petitioner_name." "."VS"." ".$respondent_name;	
			$this->load->model('pollution_model');
			$current_status=$this->pollution_model->get_data('tbl_current_status','current_status_id',array('current_status_name'=>'Pending'));
			$case_id=$this->pollution_model->insertdata("tbl_case",array("case_user_id"=>$user_id,"case_letter_number"=>$letter_number,"case_date"=>$date,"case_petitioner_name"=>$petitioner_name,"case_respondent_name"=>$respondent_name,"case_cuttent_status"=>$current_status[0]["current_status_id"],"case_subject"=>$subject,"case_status"=>1));
		    
			    $logdata["log_case_id"]=$case_id;
				$logdata["log_user_id"]=$user_id;
				$logdata["log_active"]="Insert";
				$logdata["log_description"]="".$userdata["username"]." submit appeal. Appeal subject(case_id letter_number subject) is ".$case_id." ".$letter_number." ".$subject.". Appeal status is pending";
				$this->pollution_model->insertdata("tbl_logs",$logdata);
			if(!empty($_FILES['userFiles']['name'][0]))
			{
				 $max_limit=5242880;
				 $filesCount = count($_FILES['userFiles']['name']);
				 
				  for($i = 0; $i < $filesCount; $i++)
				  {
				       $filename = $_FILES['userFiles']['name'][$i];
                       $filetypetype = $_FILES['userFiles']['type'][$i];
					   $extension=strtolower($filetypetype);
                       //$_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                       $fileerror = $_FILES['userFiles']['error'][$i];
                       $filesize = $_FILES['userFiles']['size'][$i];
					   
					   if($filesize<5242880 && $extension!="application/pdf")
					   {
						   continue;
					   }else
					   {
						   $upload_path = 'uploads/appealpdf/';
			               $server_ip = gethostbyname(gethostname());
                           $upload_url = 'http://'.$server_ip.'/uploads/appealpdf/'.$upload_path;
						   $name=$this->getFileName($filename); 
                           $name=$name."_".$user_id;
						   
                           $file_url = $upload_url.$name .'.pdf';
                           $file_path = $upload_path .$name.'.pdf';
                           move_uploaded_file($_FILES['userFiles']['tmp_name'][$i],$file_path);	
                           if(file_exists($file_path))						   
						   {
							   $appeal_attachment["file_attachment_case_id"]=$case_id;
				               $appeal_attachment["file_attachment_user_id"]=$user_id;
				               $appeal_attachment["file_attachment_file_path"]=$file_path;
				               $this->pollution_model->insertdata('tbl_file_attachment',$appeal_attachment);
						   }
					   }   
				  }	  
			}
			                 
							 $this->session->set_flashdata('success',"Your Appeal Has Been Submitted Successfully!");
							   redirect('/usercase', 'refresh');

		 }			 
	  }
		
	}
	 private function getFileName($filename)
	 {
        $filename=explode('.',$filename);
	    $file_name=$filename[0];
	    $get_row=$this->pollution_model->getdate_select('tbl_file_attachment','(count( * ) +1) as total');
        return $file_name."_".$get_row[0]["total"];
	}
	
}
?>