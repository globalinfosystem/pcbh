<?php
include_once("rest_server.php");
class Pollution extends Rest_server 
{
	 function __construct() 
	 {
		  parent::__construct();
		  
	 }
	 //===== This function get state name and districts name with id specialy for haryana state========//
	 function regpulldata_get()
	 {
         $this->load->model('pollution_model');
		 //$natureofletter=$this->pollution_model->get_data('complaint_mast','comp_no,comp_desc',array("comp_no"=>2));
		 //$data["natureofletter"]=$natureofletter;
	     $district=$this->pollution_model->get_data('tbl_districts','dist_no,dist_name',array("dist_no !="=>0));
		 //$department=$this->pollution_model->get_data('dept_mast','dept_no,dept_name,scut_name',array("dept_no"=>165));
		 $states=$this->pollution_model->get_data('states_name','state_id,state_name,status',array("state_id"=>1,"status"=>1));
		 //$data["natureofletter"]=array("comp_no"=>$natureofletter[0]["comp_no"],"comp_desc"=>$natureofletter[0]["comp_desc"]);
	     //$data["department"]=array("dept_no"=>$department[0]["dept_no"],"dept_name"=>$department[0]["dept_name"]);
		 $data["state"]=array("state_id"=>$states[0]["state_id"],"state_name"=>$states[0]["state_name"]);
		 $array_row=array();
		 foreach($district as $district_row)
		 {
		  $data["districts"][]=array("dist_no"=>$district_row["dist_no"],"dist_name"=>$district_row["dist_name"]);	
		 }
		 //$data["districts"]=$array_row;
		 $data["status"]=1;
		 echo json_encode($data);die;
	  }
	  ///=======//
	  //=======This function use for user registration from mobile==========// 
	  function  registration_post()
	  {
		    $this->load->model('pollution_model');
		    $error_message=array();
			
			if($this->validation_check((isset($_POST["organization"])?$_POST["organization"]:'')))
			$error_message["organization"]="Enter Public Organization";
            else if($this->validation_check((isset($_POST["applicant_name"])?$_POST["applicant_name"]:'')))
			$error_message["applicant_name"]="Enter Aplicant Name";	
		    else if($this->validation_check((isset($_POST["father_name"])?$_POST["father_name"]:'')))
			$error_message["father_name"]="Enter Father Name";	
	        else if($this->validation_check((isset($_POST["address1"])?$_POST["address1"]:'')))
			$error_message["address1"]="Enter Address";
		    //else if($this->validation_check((isset($_POST["address2"])?$_POST["address2"]:'')))
			//$error_message["address2"]="Enter Second Address";
		    else if($this->validation_check((isset($_POST["state"])?$_POST["state"]:'')))
			$error_message["state"]="Enter State";
	        else if($this->validation_check((isset($_POST["district"])?$_POST["district"]:'')))
			$error_message["district"]="Distric Name Not Found";
		    else if($this->validation_check((isset($_POST["applicant_email"])?$_POST["applicant_email"]:'')))
			$error_message["applicant_email"]="Enter Applicant Email";
		    else if($this->validation_check( (isset($_POST["applicant_mobile"])?$_POST["applicant_mobile"]:'')))
			$error_message["applicant_mobile"]="Enter Applicant Mobile";
		    else if($this->validation_check( (isset($_POST["gender"])?$_POST["gender"]:'')))
			$error_message["gender"]="Choose Gender";
            else if($this->validation_check( (isset($_POST["device_token"])?$_POST["device_token"]:'')))
			$error_message["device_token"]="Device Token Not Found";
		    
		    else if (!filter_var($_POST["applicant_email"],FILTER_VALIDATE_EMAIL))
            $error_message["applicant_email"]="Invalid email format";
            if(count($error_message))
			{
			    $data["error"]=$error_message;	
		        echo json_encode($data);
	            die;
			}else
		    {
			     $emailexisted=$this->pollution_model->get_data("tb_users","count(*) as total",array("email"=>$_POST["applicant_email"]));
			    if($emailexisted[0]["total"]!=0)
			    $error_message["applicant_email"]="This Email Already Existed";
                if(count($error_message))
                {
					$data["error"]=$error_message;
                    $data["status"]=0;					
		            echo json_encode($data);die;
				}
                else
                {
					$token=md5(uniqid(rand(), true));
					$random_password=$this->random_password();
					$password= $this->encriptar('encrypt', $random_password);
					$message=array("t"=>1);
					
				    $insert_data=array(
					"group_id"=>3,
					"organization"=>$_POST["organization"],
					"name"=>$_POST["applicant_name"],
					"father_name"=>$_POST["father_name"],
					"address1"=>$_POST["address1"],
					"address2"=>$_POST["address2"],
					"state"=>$_POST["state"],
					"district"=>$_POST["district"],
					"email"=>$_POST["applicant_email"],
					"mobile"=>$_POST["applicant_mobile"],
					"gender"=>$_POST["gender"],
					"password"=>$password,
					"token"=>$token,
					"device_token"=>$_POST["device_token"]);
					$reg_no=$this->pollution_model->insertdata('tb_users',$insert_data);
					$username=$_POST["applicant_name"]."_*_".$reg_no;
					$this->pollution_model->updatedata('tb_users',array("id"=>$reg_no),array("username"=>$username));
	
	$message='Dear <b>'.strtoupper($_POST["applicant_name"]).',</b><br><br>
You have been registered for submission of online application of appeals/complaint<br/>
against  "Haryana State Pollution Control Board" to the appellate authority.<br/>
Please click on the following link to activate your account.<br/>
<b>Link:</b>'.base_url()."registration/active_account?email_id=".$_POST["applicant_email"]."&token=".$token.'<br/><br/>
Futher,You can access the account by following credential.<br/><br/>
<b>Url:</b>'.base_url().'user/login<br>
<b>User Name: </b>'.$username.'<br>
<b>Email Id: </b>'.$_POST["applicant_email"].'<br>
<b>Password: </b>'.$this->encriptar('decrypt', $password).'';
//$mail=$this->sentmail($arraySic['email'], 'HSPCB', 'User Registration', $message);				
   $this->sentmail($_POST['applicant_email'], $_POST["applicant_name"], 'User Registration', $message);					
				$data["message"]="Registration Submitted Successfully!. Please Check Your Email for registration of your Account.";
				$data["status"]=1;
				echo json_encode($data);die;
				}					
				
			}		
		
	  }
	  //================//
	  //=====This function use for form validation check value is not empty========//
	  private function validation_check($varible_name)
	  {
		       if(empty($varible_name))
			   {
				   return 1;
			    	   
			   }
	  }
	  //=============================================================//
	  //====This function use for user login from mobile=========//
      public function login_post()
	  {
		  $this->load->model('pollution_model'); 
		  $error_message=array();
		  $user_name_email=(isset($_POST["applicant_email_or_name"])?$_POST["applicant_email_or_name"]:'');
		  $user_password=(isset($_POST["applicant_password"])?$this->encriptar('encrypt',$_POST["applicant_password"]):'');
		  $device_token=(isset($_POST["device_token"])?$_POST["device_token"]:'');
		  if($this->validation_check($user_name_email))
		  $error_message["applicant_email"]="Enter User Name or Email";	
		  else if($this->validation_check($user_password))
		  $error_message["applicant_password"]="Enter Password";
          else if($this->validation_check($device_token))
		  $error_message["device_token"]="Device Token Not Found";	  
		  	
	       if(count($error_message))
			{
			    $data["error"]=$error_message;	
		        echo json_encode($data);
	            die;
			}else
			{
			   
			   $is_valid_user= $this->pollution_model->get_data('tb_users','active,group_id','(email="'.$user_name_email.'" or username="'.$user_name_email.'") and password="'.$user_password.'"');	
			   
               if(empty($is_valid_user))
			   {
				    $data["message"]="Your Login Attempt was not Successful.Please Try Again";
				    $data["status"]=0;
				    
			   }else
               {   
		           $is_valid_user=$is_valid_user[0]['active'];
				   if($is_valid_user==1)
                   {
					$this->pollution_model->updatedata('tb_users','(email="'.$user_name_email.'" or username="'.$user_name_email.'") and password="'.$user_password.'"',array('device_token'=>$device_token));   
				    $data["message"]="Login Is Successful";
					$data["applicant_email_or_name"]=$user_name_email;
					$data["group_id"]=$is_valid_user[0]["group_id"];
				    $data["status"]=1;
					
			       }else
                   {
				    $data["message"]="Please Actived Your Account";
					$data["applicant_email_or_name"]=$user_name_email;
					$data["group_id"]=$is_valid_user[0]["group_id"];
				    $data["status"]=0;
			       }
				     
			   }				   
			   echo json_encode($data);
	            die;  				   
			}	
	  
	  }
	  //============================================//
	  //=====This function use for forget password for mobile user======//
	  public function forget_password_get()
	 { 
		$this->load->model('pollution_model'); 
		$error_message=array();
		$user_email=(isset($_GET["applicant_email"])?$_GET["applicant_email"]:'');
		if($this->validation_check($user_email))
		$error_message["applicant_email"]="Enter Email";
	    else if (!filter_var($user_email,FILTER_VALIDATE_EMAIL))
		$error_message["applicant_email"]="Invalid Email Format";	
            if(count($error_message))
			{
			    $data["error"]=$error_message;	
		        echo json_encode($data);
	            die;
			}else
            {
				$emailexisted=$this->pollution_model->get_data("tb_users","username,group_id,name,email,password,active,token",array("email"=>$user_email));
				if(empty($emailexisted))
			   {
				    $data["message"]="This Email Is Not Registered With Us";
				    $data["status"]=0;
					echo json_encode($data);
	                die;
				   
			   }else
			   {
				   $addmessage='';
				   if($emailexisted[0]["active"]==0)
				   {
					   $addmessage="Your account is not activate.To activate account click on the following link or copy-paste 
					   in your browser.<br/><br>".base_url()."registration/active_account?email_id=".$emailexisted[0]["email"]."&token=".$emailexisted[0]["token"]."";
					   
				   }   
				  
                  $message="Dear <b>".strtoupper($emailexisted[0]["name"])."</b>,<br/>
                    Your login details.<br/>
				    <b>User Name: </b>".$emailexisted[0]["username"]."<br/>
                    <b>Email_id: </b>".$emailexisted[0]["email"]."<br/>
                    <b>Password: </b>".$this->encriptar('decrypt',$emailexisted[0]["password"])."<br/>You can login with email id or name.<br/>".$addmessage."<br/>"; 
                    $this->sentmail($emailexisted[0]["email"], $emailexisted[0]["name"], 'Forget Password', $message);	
				   
			    $data["message"]="Your Login Details Has Been Send In Your Email Id ".$emailexisted[0]["email"]."";
			    $data["status"]=1;
				$data["group_id"]=$emailexisted[0]["group_id"];
			    echo json_encode($data);
	            die;
			  } 	   
			}				
	 }
	 //=================================================//
	 //====This function display profile for mobile user======//
	 public function user_profile_get()
	 {
		 
		$applicant_email_or_name=(isset($_GET["applicant_email_or_name"])?$_GET["applicant_email_or_name"]:'');
		$user_device_token=(isset($_GET["device_token"])?$_GET["device_token"]:'');
		$error_message=array();
		if($this->validation_check($applicant_email_or_name))
	    $error_message["comp_no"]="Send User Email or name";
        else if($this->validation_check($user_device_token))	
		$error_message["comp_no"]="Device Token Not Found";
	    if(count($error_message))
		{
			    $data["error"]=$error_message;	
				$data["status"]=0;
		        echo json_encode($data);
	            die;
		}else
		{
		 $this->load->model('pollution_model'); 	
			$custom_query="SELECT `tb_users`.`id`,`tb_users`.`group_id`,`tb_users`.`address1`,
`tb_users`.`district`,`tbl_districts`.`dist_name`,`tb_users`.`state`,`states_name`.`state_name`,`tb_users`.`name`,
`tb_users`.`mobile`,`tb_users`.`email`,`tb_users`.`gender`,`tb_users`.`organization`,`tb_users`.`father_name`,
`tb_users`.`address2`   FROM `tb_users` inner join `states_name` on (`states_name`.`state_id`=`tb_users`.`state`) 
inner join  `tbl_districts` 
on  (`tb_users`.`district`=`tbl_districts`.`dist_no`) 
where (`tb_users`.`email`='".$applicant_email_or_name."' or `tb_users`.`username`='".$applicant_email_or_name."')   
and `tb_users`.`device_token`='".$user_device_token."'";
		$user_data=$this->pollution_model->custom_query($custom_query);	
		if(empty($user_data))
		{
			$data["message"]="Send valid email id or username with token";
			$data["status"]=0;
			echo json_encode($data);die;
			
		}else
	    {
        $data["group_id"]=$user_data[0]["group_id"];			
		$data["state"]=array("state_id"=>$user_data[0]["state"],"state_name"=>$user_data[0]["state_name"]);
		$data["district"]=array("district_id"=>$user_data[0]["district"],"district_name"=>$user_data[0]["dist_name"]);
		$data["username"]=$user_data[0]["name"];
		$data["mobilenumber"]=$user_data[0]["mobile"];
		$data["email"]=$user_data[0]["email"];
		$data["gender"]=$user_data[0]["gender"];
		$data["organization"]=$user_data[0]["organization"];
		$data["father_name"]=$user_data[0]["father_name"];
		$data["address1"]=$user_data[0]["address1"];
		$data["address2"]=$user_data[0]["address2"];
		$district=$this->pollution_model->get_data('tbl_districts','dist_no,dist_name',array("dist_no !="=>0));
		$states=$this->pollution_model->get_data('states_name','state_id,state_name,status',array("state_id"=>1,"status"=>1));
		$data["current_state"]=array("state_id"=>$states[0]["state_id"],"state_name"=>$states[0]["state_name"]);
		$array_row=array();
		 foreach($district as $district_row)
		 {
		  $data["current_districts"][]=array("dist_no"=>$district_row["dist_no"],"dist_name"=>$district_row["dist_name"]);	
		 }
		$data["status"]=1;
		$data["group_id"]=$user_data[0]["group_id"];
		echo json_encode($data);die;
		}
		}	
		
	 }
	 //===========================================//
	//====This function change password for mobile users=====//
	 public function change_password_post()
	 {
		 $applicant_email_or_name=(isset($_POST["applicant_email_or_name"])?$_POST["applicant_email_or_name"]:'');
		 $device_token=(isset($_POST["device_token"])?$_POST["device_token"]:'');
		 $password=(isset($_POST["password"])?$_POST["password"]:'');
		 $confirm_password=(isset($_POST["confirm_password"])?$_POST["confirm_password"]:'');
		 $group_id=(isset($_POST["group_id"])?$_POST["group_id"]:'');
		 		 
         $validation=array(
		 array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		 array($device_token,"device_token","Device Token Not Found"),
		 array($group_id,"group_id","Group Id Not Found"),
		 array($password,"password","Enter Password"),
		 array($confirm_password,"confirm_password","Enter Confirm Password")
		 );
		 $this->check_error_message($validation);
		 if(strcmp($password,$confirm_password)!=0)
		 {
		   	 $data["status"]=0;
		     $data["message"]="Password does not match the confirm password.";
		     echo json_encode($data);die;
		 }else
         {
			  $this->load->model('pollution_model');
$userid=$this->pollution_model->get_data("tb_users","id,group_id",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');
		if(empty($userid))
		{
			$data["message"]="Pass valid email id or username with token";
			$data["status"]=0;
			echo json_encode($data);die;
		}
		  
		  $this->pollution_model->updatedata("tb_users",array("id"=>$userid[0]["id"]),array("password"=>$this->encriptar('encrypt',$password)));	 
          $data["message"]="Password has been updated";
		  $data["status"]=1;
		  echo json_encode($data);die;
		 
		 }			 
		 
	 }
	 //======================================================================//
	 //===== This function use for profile update for mobile users==========//
	 public function update_user_profile_post()
	 {
		  
		  $error_message=array();
		  $state=(isset($_POST["state"])?$_POST["state"]:'');
		  $district=(isset($_POST["district"])?$_POST["district"]:'');
		  $name=(isset($_POST["applicant_name"])?$_POST["applicant_name"]:'');
		  $mobile=(isset($_POST["applicant_mobile"])?$_POST["applicant_mobile"]:'');
		  $applicant_email_or_name=(isset($_POST["applicant_email_or_name"])?$_POST["applicant_email_or_name"]:'');
		  $gender=(isset($_POST["gender"])?$_POST["gender"]:'');
		  $organization=(isset($_POST["organization"])?$_POST["organization"]:'');
		  $father_name=(isset($_POST["father_name"])?$_POST["father_name"]:'');
		  $address1=(isset($_POST["address1"])?$_POST["address1"]:'');
		  $address2=(isset($_POST["address2"])?$_POST["address2"]:'');
		  $device_token=(isset($_POST["device_token"])?$_POST["device_token"]:'');
		if($this->validation_check($state))
	    $error_message["state"]="Select State";
		else if($this->validation_check($district))
	    $error_message["district"]="Select District";
        else if($this->validation_check($name))	
		$error_message["applicant_name"]="Enter User Name";
	    else if($this->validation_check($mobile))	
		$error_message["applicant_mobile"]="Enter Mobile Number";
        else if($this->validation_check($applicant_email_or_name))	
		$error_message["email"]="Send User Email or User Name";
	    else if($this->validation_check($gender))	
		$error_message["gender"]="Choose Gender";
	    else if($this->validation_check($organization))	
		$error_message["gender"]="Enter Organization";
	    else if($this->validation_check($father_name))	
		$error_message["father_name"]="Enter Father Name";
	    else if($this->validation_check($address1))	
		$error_message["address1"]="Enter Address1";
        else if($this->validation_check($device_token))	
		$error_message["device_token"]="Device Token Not Found";
	
	    if(count($error_message))
		{
			    $data["error"]=$error_message;	
				$data["status"]=0;
		        echo json_encode($data);
	            die;
		}else
		{
		  $this->load->model('pollution_model'); 
		  
		  $this->pollution_model->updatedata("tb_users",'(email="'.$applicant_email_or_name.'" or username="'.$applicant_email_or_name.'") and device_token="'.$device_token.'"'
		,array("district"=>$district,"name"=>$name,"mobile"=>$mobile,"gender"=>$gender,"organization"=>$organization,"father_name"=>$father_name,"address1"=>$address1,"address2"=>$address2,'updated_at'=>date('Y-m-d H:i:s')));
		  $data["message"]="Profile Has Been Updated";
          $data["status"]=1;
		  echo json_encode($data);
	      die;		 
		}	
		 
	 }
	 //===================Apply for Case from mobile devices============================//
	 public function case_create_post()
	 {
		$error_message=array();
		$applicant_email_or_name=(isset($_POST["applicant_email_or_name"])?$_POST["applicant_email_or_name"]:'');
        $letter_number=(isset($_POST["letter_number"])?$_POST["letter_number"]:'');	
        $case_date=(isset($_POST["case_date"])?$_POST["case_date"]:'');
        $petitioner=(isset($_POST["petitioner"])?$_POST["petitioner"]:'');
        $respondent=(isset($_POST["respondent"])?$_POST["respondent"]:'');
		$subject=$petitioner." VS ".$respondent;
		$device_token=(isset($_POST["device_token"])?$_POST["device_token"]:'');		
		if($this->validation_check($applicant_email_or_name))
	    $error_message["applicant_email_or_name"]="Send User Email or User Name";
	    else if($this->validation_check($device_token))
		$error_message["device_token"]="Device Token Not Found";	
		else if($this->validation_check($letter_number))
		$error_message["letter_number"]="Enter Letter Number";
        else if($this->validation_check($case_date))
		$error_message["case_date"]="Enter Date";	
		else if($this->validation_check($petitioner))
		$error_message["petitioner"]="Enter Petitioner";
	    else if($this->validation_check($respondent))
		$error_message["respondent"]="Enter Respondent";
	   
	    if(count($error_message))
		{
			    $data["error"]=$error_message;	
				$data["status"]=0;
				echo json_encode($data);
	            die;
		}else
		{
			$this->load->model('pollution_model');
$userid=$this->pollution_model->get_data("tb_users","id,group_id",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');
		if(empty($userid))
		{
			$data["message"]="Pass valid email id or username with token";
			$data["status"]=0;
			echo json_encode($data);die;
			
		}else
        {
		    
			    $user_id=$userid[0]["id"];
		        $data["case_user_id"]=$user_id;
		        $data["case_letter_number"]=$letter_number;
		        $data["case_date"]=$case_date;
				$data["case_petitioner_name"]=$petitioner;
				$data["case_respondent_name"]=$respondent;
		        $data["case_subject"]=$subject;
				$data["case_status"]=1;
				$data["case_cuttent_status"]=1;
				
		        $lastId=$this->pollution_model->insertdata("tbl_case",$data);
				$this->save_data_in_log_from_mobile("case_apply",$lastId,$user_id,$applicant_email_or_name,$addmessage=null);
				$resposedata["message"]="Your Appeal Has Been Saved";
				$resposedata["case_id"]=$lastId;
				$resposedata["group_id"]=$userid[0]["group_id"];
				$resposedata["status"]=1;
				echo json_encode($resposedata);
	            die;	
		}			
				
		}	
        	
	 }
	 //==== this function use for upload pdf file one by one from mobile==================//
	 public function upload_attechment_post()
	 {
        $error_message=array();
		$applicant_email_or_name=(isset($_POST["applicant_email_or_name"])?$_POST["applicant_email_or_name"]:'');
		$device_token=(isset($_POST["device_token"])?$_POST["device_token"]:'');		
        $case_id=(isset($_POST["case_id"])?$_POST["case_id"]:'');
        $has_appeal_pdf=(isset($_FILES['appeal_pdf']['name'])?$_FILES['appeal_pdf']['name']:'');
		$appeal_pdf_size=($_FILES["appeal_pdf"]["size"]?$_FILES["appeal_pdf"]["size"]:0);
		$max_limit=5242880;
		    $fileinfo = pathinfo($_FILES['appeal_pdf']['name']);
			$extension = $fileinfo['extension'];
			$extension=strtolower($extension);
		
		if($this->validation_check($applicant_email_or_name))
	    $error_message["applicant_email_or_name"]="Send User Email or User Name";
	    else if($this->validation_check($device_token))
		$error_message["device_token"]="Device Token Not Found";	
		else if($this->validation_check($case_id))
		$error_message["case_id"]="Send Case Id";
	    else if($this->validation_check($has_appeal_pdf) || $extension!='pdf')
		$error_message["appeal_pdf"]="Upload Pdf";
	    else if($appeal_pdf_size>$max_limit)
		$error_message["appeal_pdf"]="Upload Pdf Size Less Then 5MB";
			
		if(count($error_message))
		{
			    $data["error"]=$error_message;	
				$data["status"]=0;
		        echo json_encode($data);
	            die;
		}else
		{
			 $this->load->model('pollution_model');
			 $userid=$this->pollution_model->get_data("tb_users","id,group_id",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');
		if(empty($userid))
		{
			$data["message"]="Pass valid email id or username with token";
			$data["status"]=0;
			echo json_encode($data);die;
			
		}else
        {
			$maxfiles=$this->pollution_model->get_data('tbl_file_attachment','count( * ) as total',array('file_attachment_case_id'=>$case_id));
			if($maxfiles[0]['total']>=5)
			{
			  $data["message"]="Max limit for upload file is five.";
			  $data["group_id"]=$userid[0]["group_id"];
			  $data["status"]=0;
			  echo json_encode($data);die;	
				
			}	
			$upload_path = 'uploads/appealpdf/';
			$server_ip = gethostbyname(gethostname());
            $upload_url = 'http://'.$server_ip.'/'.$upload_path;
			$name=$this->getFileName($_FILES['appeal_pdf']['name']);
			$name=$name."_".$userid[0]["id"];
		    //$file_url = $upload_url.$name .'.'.$extension;
            $file_path = $upload_path .$name.'.'. $extension;
			try
			{
				move_uploaded_file($_FILES['appeal_pdf']['tmp_name'],$file_path);
				if(!file_exists($file_path))
				{
					$data["message"]="Pdf File Not Uploded";
				    $data["status"]=0;
					echo json_encode($data);
	                die;
				}	
				$appeal_attachment["file_attachment_case_id"]=$case_id;
				$appeal_attachment["file_attachment_user_id"]=$userid[0]["id"];
				$appeal_attachment["file_attachment_file_path"]=$file_path;
				$this->pollution_model->insertdata('tbl_file_attachment',$appeal_attachment);
				$data["message"]="Pdf Has Been Uploaded";
				$data["number_of_files_this_case"]=($maxfiles[0]['total']+1);
				$data["group_id"]=$userid[0]["group_id"];
				$data["status"]=1;
			}catch(Exception $e)
			{
				$data["message"]=$e->getMessage();
				$data["status"]=0;
				
			}
		}			
			
		}	
		echo json_encode($data);
	    die;
	 }
	 //=======Get pdf file name with filename_attachementid_userid format========//
	 private function getFileName($filename)
	 {
        $filename=explode('.',$filename);
	    $file_name=$filename[0];
	    $get_row=$this->pollution_model->getdate_select('tbl_file_attachment','(count( * ) +1) as total');
        return $file_name."_".$get_row[0]["total"];
	}
	///=====This function use for error validation=========//
	private function check_error_message($validation)
	{
		$error_message=array();
		foreach($validation as $valid)
		{
			if($this->validation_check($valid[0]))
			{	
	         $error_message[$valid[1]]=$valid[2];
			 break;
			}
			
		}
		if(count($error_message))
		 {
			    $data["error"]=$error_message;	
				$data["status"]=0;
		        echo json_encode($data);
	            die;
		 }
		  
	 }
	//=========================================================================//
	public function appeal_get()
	{
		
		 
	   	 $applicant_email_or_name=(isset($_GET["applicant_email_or_name"])?$_GET["applicant_email_or_name"]:'');
		 $device_token=(isset($_GET["device_token"])?$_GET["device_token"]:'');
		 $group_id=(isset($_GET["group_id"])?$_GET["group_id"]:'');
		 $offset=(isset($_GET["offset_num"])?$_GET["offset_num"]:0);
		 $limit=(isset($_GET["limit_num"])?$_GET["limit_num"]:10);
		 
         $validation=array(array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		 array($device_token,"device_token","Device Token Not Found"),array($group_id,"group_id","Group Id Not Found"));
		 $this->check_error_message($validation);
     	  
		     $this->load->model('pollution_model');
			 $userid=$this->pollution_model->get_data("tb_users","id,group_id",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		if(empty($userid))
		{
			$data["message"]="Pass valid email id or username with token";
			$data["status"]=0;
			echo json_encode($data);die;
			
		}else
		{
			if($group_id==1)
			{
			
      $countquery=$this->pollution_model->getdate_select('tbl_case','count(*) as total');
      $total_row=$countquery[0]['total'];

			$query= "select tbl_case.case_id,concat(tb_users.name,' ',tb_users.mobile) as name,
tbl_case.case_letter_number,
tbl_case.case_petitioner_name,tbl_case.case_respondent_name,
tbl_case.case_subject,tbl_current_status.current_status_name
,tb_status.status_name
from tbl_case inner join tb_users on (tbl_case.case_user_id=tb_users.id)
inner join tb_status on(tb_status.status_id=tbl_case.case_status)
inner join tbl_current_status on(tbl_current_status.current_status_id=tbl_case.case_cuttent_status) 
order by tbl_case.case_id desc limit ".$offset.",".$limit."";
			}
			else if($group_id==2)
			{
			$count_query="select count(*) as total from tbl_case inner join tbl_case_asign on (tbl_case_asign.case_asign_case_id=tbl_case.case_id)
inner join tb_users on (tbl_case_asign.case_asign_officer_id=tb_users.id) 
where (tb_users.username='".$applicant_email_or_name."' or tb_users.email='".$applicant_email_or_name."')";	
$countquery=$this->pollution_model->custom_query($count_query);
            $total_row=$countquery[0]['total'];
            $query= 
			"SELECT tbl_case_asign.case_asign_officer_id, tbl_case.case_id,concat(tb_users.name,' ',tb_users.mobile) as name,
tbl_case.case_letter_number,
tbl_case.case_petitioner_name,tbl_case.case_respondent_name,
tbl_case.case_subject,tbl_current_status.current_status_name
,tb_status.status_name FROM  tbl_case_asign inner join tbl_case
on (tbl_case_asign.case_asign_case_id=tbl_case.case_id)
inner join tb_users on (tb_users.id=tbl_case.case_user_id)
inner join tb_status on (tb_status.status_id=tbl_case.case_status)
inner join tbl_current_status on (tbl_current_status.current_status_id=tbl_case.case_cuttent_status)
where  tbl_case_asign.case_asign_officer_id=".$userid[0]["id"]." order by tbl_case.case_id desc limit ".$offset.",".$limit."";
			}	
			else if($group_id==3)
			{
				
		 $countquery=$this->pollution_model->join_with_condition('count(*) as total','tbl_case','tb_users','tbl_case.case_user_id=tb_users.id','inner',"(tb_users.username='".$applicant_email_or_name."' or tb_users.email='".$applicant_email_or_name."')");		
		 $total_row=$countquery[0]->total;
		
				$query= "select tbl_case.case_id,concat(tb_users.name,' ',tb_users.mobile) as name,
tbl_case.case_letter_number,
tbl_case.case_petitioner_name,tbl_case.case_respondent_name,
tbl_case.case_subject,tbl_current_status.current_status_name
,tb_status.status_name
from tbl_case inner join tb_users on (tbl_case.case_user_id=tb_users.id)
inner join tb_status on(tb_status.status_id=tbl_case.case_status)
inner join tbl_current_status on(tbl_current_status.current_status_id=tbl_case.case_cuttent_status)
where (tb_users.username='".$applicant_email_or_name."' or tb_users.email='".$applicant_email_or_name."') 
order by tbl_case.case_id desc limit ".$offset.",".$limit."";

			}	
		$result=$this->pollution_model->custom_query($query);
		
		$caseinfo=array();
		foreach($result as $row)
		{
			$permission=$this->permission($row["current_status_name"],$group_id,$row["case_id"]);
			$case=array("case_id"=>$row["case_id"],"name"=>$row["name"],
		  "case_letter_number"=>$row["case_letter_number"],
		  "case_petitioner_name"=>$row["case_petitioner_name"],
		  "case_respondent_name"=>$row["case_respondent_name"],"case_subject"=>$row["case_subject"],
		  "case_current_status"=>$row["current_status_name"],"case_status"=>$row["status_name"]);
		   $caseinfo[]=array_merge($case,$permission);
		}
		 
		  $next_offset=$limit+$offset;
		  $previous_offset=$offset-$limit;
		  $next_link=($next_offset<$total_row?1:0);
		  $previous_link=($previous_offset<0?0:1);
		  $data["case_info"]=$caseinfo;
		  $data["next_offset"]=$next_offset;
		  $data["previous_offset"]=$previous_offset;
		  $data["next_link"]=$next_link;
		  $data["previous_link"]=$previous_link;
		  $data["limit"]=$limit;
		  
		  echo json_encode($data,JSON_UNESCAPED_SLASHES);die;
		}
		 	 
         		 
	}
	// =======This function check permission for handle cases =======//
	private function permission($current_status_name,$group_id,$case_id)
	{
		        $case_view_url='';	
				$case_attechment_url='';	
				$case_edit_url='';	
				$case_disposeoff_url='';	
				$case_assign_url='';	
				$case_hearing_url='';	
				$case_edithearing_url='';	
				$case_decided_url='';
			
			if($current_status_name=="Pending")
			{
				
				if($group_id==1)
				{
				$case_view_url=base_url()."pollution/caseview";	
				$case_attechment_url=base_url()."pollution/caseattechment";	
				$case_edit_url=base_url()."pollution/casedisplay";	
				$case_disposeoff_url=base_url()."pollution/casedisposeoff";	
				$case_assign_url=base_url()."pollution/caseassign";	
				}else if($group_id==3)
				{
				$case_view_url=base_url()."pollution/caseview";	
				$case_attechment_url=base_url()."pollution/caseattechment";	
				$case_edit_url=base_url()."pollution/casedisplay";	
				}	
				
			}
			else if($current_status_name=="Assigned")
			{

				if($group_id==1 || $group_id==2)
				{
				 $case_view_url=base_url()."pollution/caseview";	
				 $case_attechment_url=base_url()."pollution/caseattechment";	
				 $case_disposeoff_url=base_url()."pollution/casedisposeoff";		
					 
				  $caseassign= $this->pollution_model->get_data("tbl_case_asign","case_asign_date_of_assign",array("case_asign_case_id"=>$case_id));	
				  $casedate=$caseassign[0]["case_asign_date_of_assign"];
				  $current_time_stamp=strtotime(date('Y-m-d'));
			      $nextdate_time_stamp=strtotime($casedate);
				  if($current_time_stamp>=$nextdate_time_stamp)
				  {
					$case_hearing_url=base_url()."pollution/casehearing";  
				  }	  
				    
				}	
				
			}
            else if($current_status_name=="Hearing")
            {
				if($group_id==1 || $group_id==2)
				{
					$case_view_url=base_url()."pollution/caseview";	
				    $case_attechment_url=base_url()."pollution/caseattechment";	
				    $case_disposeoff_url=base_url()."pollution/casedisposeoff";
                    $casehearing= $this->pollution_model->get_data("tbl_hearing","hearing_next_date",array("hearing_case_id"=>$case_id));	
                    $casedate=$casehearing[0]["hearing_next_date"];
                    $current_time_stamp=strtotime(date('Y-m-d'));
			        $nextdate_time_stamp=strtotime($casedate);
                    if($current_time_stamp>=$nextdate_time_stamp)
				    {
					 $case_edithearing_url=base_url()."pollution/caseedithearing";  
				    }
					$case_decided_url=base_url()."pollution/casedecided";
				}	
				
			}
            else if($current_status_name=="Dispose Off" || $current_status_name=="Decided")
            {
				   $case_view_url=base_url()."pollution/caseview";	
				   $case_attechment_url=base_url()."pollution/case_attechment";
			}
            			
	    return array("case_view_url"=>$case_view_url,
		  "case_attechment_url"=>$case_attechment_url,
		  "case_edit_url"=>$case_edit_url,
		  "case_disposeoff_url"=>$case_disposeoff_url,
		  "case_assign_url"=>$case_assign_url,
		  "case_hearing_url"=>$case_hearing_url,
		  "case_edithearing_url"=>$case_edithearing_url,
		  "case_decided_url"=>$case_decided_url,
		  );
		
	}
	//=======this function use to check case belong to user or not==========//
	private function check_case_belong_user($group_id,$case_id,$user_id)
	{
		    switch($group_id)
			{
			 case 1:
			 $countquery=$this->pollution_model->get_data('tbl_case','count(*) as total',array('tbl_case.case_id'=>$case_id));
			 $total_row=$countquery[0]['total'];	
			 break;
			 case 2:
			 $count_query="select count(*) as total from tbl_case inner join tbl_case_asign on (tbl_case_asign.case_asign_case_id=tbl_case.case_id)
inner join tb_users on (tbl_case_asign.case_asign_officer_id=tb_users.id) 
where (tb_users.id=".$user_id." and tbl_case.case_id=".$case_id.")";	
$countquery=$this->pollution_model->custom_query($count_query);
            $total_row=$countquery[0]['total'];
			 break;
			 case 3:
			 $countquery=$this->pollution_model->join_with_condition('count(*) as total','tbl_case','tb_users','tbl_case.case_user_id=tb_users.id','inner',"(tb_users.id=".$user_id." and tbl_case.case_id=".$case_id.")");		
		     $total_row=$countquery[0]->total;
			 break;
			 default:
			 $countquery=$this->pollution_model->getdate_select('tbl_case','count(*) as total');
             $total_row=$countquery[0]['total'];	
			 break;
            }
			if($total_row==0)
			{
			    $data["error"]="Case info not found";	
				$data["status"]=0;
		        echo json_encode($data);
	            die;	
		    }	
			
		
	}
	//=====view case info with current status for all users=========//
	public function caseview_get()
	{     
	     
		 $applicant_email_or_name=(isset($_GET["applicant_email_or_name"])?$_GET["applicant_email_or_name"]:'');
		 $device_token=(isset($_GET["device_token"])?$_GET["device_token"]:'');
		 $group_id=(isset($_GET["group_id"])?$_GET["group_id"]:'');
		 $case_id=(isset($_GET["case_id"])?$_GET["case_id"]:'');
		 
		
 		 $validation=array(array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		 array($device_token,"device_token","Device Token Not Found"),array($group_id,"group_id","Group Id Not Found"),
		 array($case_id,"case_id","Case Id Not Found"));
		 $this->check_error_message($validation);
		 
		 
			  $this->load->model('pollution_model');
			  $userid=$this->pollution_model->get_data("tb_users","id,group_id",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		if(empty($userid))
		{
			$data["message"]="Pass valid email id or username with token";
			$data["status"]=0;
			echo json_encode($data);die;
			
		}
		else
		{
			  $this->check_case_belong_user($group_id,$case_id,$userid[0]["id"]);
			
			  $case_info="select tbl_case.case_id,concat(tb_users.name,' ',tb_users.mobile) as name,
tbl_case.case_letter_number,
tbl_case.case_petitioner_name,tbl_case.case_respondent_name,
tbl_case.case_subject,tbl_current_status.current_status_name
,tb_status.status_name
from tbl_case inner join tb_users on (tbl_case.case_user_id=tb_users.id)
inner join tb_status on(tb_status.status_id=tbl_case.case_status)
inner join tbl_current_status on(tbl_current_status.current_status_id=tbl_case.case_cuttent_status)
where tbl_case.case_id=".$case_id."";
	      
            $result=$this->pollution_model->custom_query($case_info);
			$data["case_info"]=$result;
			
			$assign_detail="SELECT tb_users.id, tb_users.name, tb_users.username, tbl_case_asign.case_asign_case_id
		  ,tbl_case_asign.case_asign_date_of_assign,tbl_case_asign.case_asign_update_date
FROM tbl_case_asign
INNER JOIN tb_users ON tbl_case_asign.case_asign_officer_id = tb_users.id where tbl_case_asign.case_asign_case_id=".$case_id."";
		   $assign_detail=$this->pollution_model->custom_query($assign_detail);
		   $data['assign_detail']=$assign_detail;
          
		   $hearing_detail="SELECT tb_users.id, tb_users.name, tb_users.username, tbl_hearing.hearing_case_id,tbl_hearing.hearing_next_date,tbl_hearing.hearing_time,
addresses.address_address,tbl_hearing.remark,tbl_hearing.hearing_created_date
FROM tbl_hearing
INNER JOIN tb_users ON tbl_hearing.hearing_officer_id = tb_users.id 
INNER JOIN addresses ON tbl_hearing.hearing_address_id=addresses.address_id 
where tbl_hearing.hearing_case_id=".$case_id."";
$hearing_detail=$this->pollution_model->custom_query($hearing_detail);
		 $data['hearing_detail']=$hearing_detail; 
		
		 $case_status_detail="SELECT tb_users.id, tb_users.name, tb_users.username,
 tbl_case_status.disposed_date,tbl_case_status.disposed_remark,tbl_case_status
.case_current_status,CASE tbl_case_status.case_current_status 
WHEN 4 THEN 'Dispose Off'
WHEN 5 THEN 'Decided'
ELSE 'NO' END as case_status,tbl_case_status.attachment
FROM tbl_case_status
INNER JOIN tb_users ON tbl_case_status.disposed_officer_id = tb_users.id 
where tbl_case_status.disposed_case_id=".$case_id."";
		  $case_status_detail=$this->pollution_model->custom_query($case_status_detail);
		  $data['case_status_detail']=$case_status_detail; 
		  
		  echo json_encode($data);
	      die;
		}	
			
		 
	 
	}
	//==========This function use for edit case when case in pending for user and super admin===//
	public function casedisplay_get()
	{
		 
		 $applicant_email_or_name=(isset($_GET["applicant_email_or_name"])?$_GET["applicant_email_or_name"]:'');
		 $device_token=(isset($_GET["device_token"])?$_GET["device_token"]:'');
		 $group_id=(isset($_GET["group_id"])?$_GET["group_id"]:'');
		 $case_id=(isset($_GET["case_id"])?$_GET["case_id"]:'');
		 $validation=array(array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		 array($device_token,"device_token","Device Token Not Found"),array($group_id,"group_id","Group Id Not Found"),
		 array($case_id,"case_id","Case Id Not Found"));
		 $this->check_error_message($validation);
		 $this->load->model('pollution_model');
         $userid=$this->pollution_model->get_data("tb_users","id,group_id",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else
		   {
			   $this->check_case_belong_user($group_id,$case_id,$userid[0]["id"]);
			   $case_result= $this->pollution_model->get_data('tbl_case','case_id,case_letter_number,case_date,case_petitioner_name,case_respondent_name',array('case_id'=>$case_id)); 
		       $data["case_result"]=$case_result;
			   echo json_encode($data);die;
		   }	  
		
	}
	//===this function use for case pending cases by users and super admin for mobile==========//
	public function caseedit_post()
	{
		
		 $applicant_email_or_name=(isset($_POST["applicant_email_or_name"])?$_POST["applicant_email_or_name"]:'');
		 $device_token=(isset($_POST["device_token"])?$_POST["device_token"]:'');
		 $group_id=(isset($_POST["group_id"])?$_POST["group_id"]:'');
		 $case_id=(isset($_POST["case_id"])?$_POST["case_id"]:'');
		 $case_letter_number=(isset($_POST["case_letter_number"])?$_POST["case_letter_number"]:'');
		 $case_petitioner_name=(isset($_POST["case_petitioner_name"])?$_POST["case_petitioner_name"]:'');
		 $case_respondent_name=(isset($_POST["case_respondent_name"])?$_POST["case_respondent_name"]:'');
		 $case_date=(isset($_POST["case_date"])?$_POST["case_date"]:'');
		 $validation=array(
		 array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		 array($device_token,"device_token","Device Token Not Found"),
		 array($group_id,"group_id","Group Id Not Found"),
		 array($case_id,"case_id","Case Id Not Found"),
		 array($case_letter_number,"case_letter_number","Enter Case Letter Number"),
		 array($case_petitioner_name,"case_petitioner_name","Enter Case Petitioner Name"),
		 array($case_respondent_name,"case_respondent_name","Enter Case Respondent Name"),
		 array($case_date,"case_date","Enter Case Date")
		 );
		  $this->check_error_message($validation);
          $this->load->model('pollution_model');
          $userid=$this->pollution_model->get_data("tb_users","id,group_id",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else if($userid[0]["group_id"]==2)
		   {
			  $data["message"]="No authority for edit case";
			  $data["status"]=0;
			  echo json_encode($data);die; 
		   }   
		   else
		   {

              $caseresult=$this->pollution_model->join_with_condition('tbl_current_status.current_status_name',
  'tbl_case','tbl_current_status','tbl_current_status.current_status_id=tbl_case.case_cuttent_status',
  'inner','(tbl_case.case_id='.$case_id.')');
               if($caseresult[0]->current_status_name!="Pending")
			   {
				  $data["message"]="No authority for edit case";
			      $data["status"]=0;
			      echo json_encode($data);die; 
			   }
			   
			   $this->check_case_belong_user($group_id,$case_id,$userid[0]["id"]);
			   $data["case_letter_number"]=$case_letter_number;
			   $data["case_petitioner_name"]=$case_petitioner_name;
			   $data["case_respondent_name"]=$case_respondent_name;
			   $data["case_subject"]=$case_petitioner_name." VS ".$case_respondent_name;
			   $data["case_date"]=$case_date;
			   $this->pollution_model->updatedata('tbl_case',array('case_id'=>$case_id),$data);
               $this->save_data_in_log_from_mobile('case_edit',$case_id,$userid[0]["id"],$applicant_email_or_name);
		       $editdata["message"]="Case has been updated";
			   $editdata["group_id"]=$group_id;
			   $editdata["status"]=1;
			   echo json_encode($editdata);die;
		   }	   
		
	}
	///=============this function display attechment=========//
    public function caseattechment_get()
	{
		 $applicant_email_or_name=(isset($_GET["applicant_email_or_name"])?$_GET["applicant_email_or_name"]:'');
		 $device_token=(isset($_GET["device_token"])?$_GET["device_token"]:'');
		 $group_id=(isset($_GET["group_id"])?$_GET["group_id"]:'');
		 $case_id=(isset($_GET["case_id"])?$_GET["case_id"]:'');
		 $validation=array(
		 array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		 array($device_token,"device_token","Device Token Not Found"),
		 array($group_id,"group_id","Group Id Not Found"),
		 array($case_id,"case_id","Case Id Not Found")
         );
		  $this->check_error_message($validation);
		  $this->load->model('pollution_model');
          $userid=$this->pollution_model->get_data("tb_users","id,group_id",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }
		 $this->check_case_belong_user($group_id,$case_id,$userid[0]["id"]);
		  $base_url= base_url();
		  $query="select 
concat(tbl_case.case_id,' ',tbl_case.case_letter_number,' ',tbl_case.case_subject) as case_subject,
concat(tb_users.name,' ',tb_users.mobile) as userinfo, 
concat('".$base_url."',tbl_file_attachment.file_attachment_file_path) as file_path,
tbl_file_attachment.file_attachment_created_date 
from tbl_file_attachment inner join  tbl_case 
on (tbl_file_attachment.file_attachment_case_id=tbl_case.case_id)
inner join tb_users on (tb_users.id=tbl_file_attachment.file_attachment_user_id)
where file_attachment_case_id=".$case_id."";
         $attechment_info=$this->pollution_model->custom_query($query);
		 $data["case_id"]=$case_id;
		 $data["attechment_info"]=$attechment_info;
		 $data["group_id"]=$group_id;
		 $data["total_attechment"]=count($attechment_info);
		 $data["add_attechment"]=count($attechment_info)<5?base_url()."pollution/add_attechment":'';
		 $data["status"]=1;
		 echo json_encode($data,JSON_UNESCAPED_SLASHES);die;
	}
	//====this function use for add attechement when attechment less then five for mobile users=====//
	public function add_attechment_post()
	{
		 $applicant_email_or_name=(isset($_POST["applicant_email_or_name"])?$_POST["applicant_email_or_name"]:'');
		 $device_token=(isset($_POST["device_token"])?$_POST["device_token"]:'');
		 $group_id=(isset($_POST["group_id"])?$_POST["group_id"]:'');
		 $case_id=(isset($_POST["case_id"])?$_POST["case_id"]:'');
		 $attachment=(isset($_FILES['attachment']['name'])?$_FILES['attachment']['name']:'');
		 $validation=array(
		 array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		 array($device_token,"device_token","Device Token Not Found"),
		 array($group_id,"group_id","Group Id Not Found"),
		 array($case_id,"case_id","Case Id Not Found"),
		 array($attachment,"attachment","Upload Pdf Less Then 5MB")
         );
		  $this->check_error_message($validation);
		  $this->load->model('pollution_model');
          $userid=$this->pollution_model->get_data("tb_users","id,group_id,name",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else if($userid[0]["group_id"]!=3)
		   {
			  $data["message"]="No authority for disposeoff";
			  $data["status"]=0;
			  echo json_encode($data);die; 
		   }
		  
		$file_attachment["file_attachment_case_id"]=$case_id;
		$file_attachment["file_attachment_user_id"]=$userid[0]['id'];
		$total_files=$this->pollution_model->get_data('tbl_file_attachment','count(*) as total',array('file_attachment_case_id'=>$case_id));
		$total=$total_files[0]["total"];
		if($total>=5)
		{
			  $data["message"]="File upload limit has been exceeded for this case.";
			  $data["status"]=0;
			  echo json_encode($data);die;
		}
		$file_id=$this->pollution_model->insertdata('tbl_file_attachment',$file_attachment); 
        $file_path=$this->upload_pdf_file_for_mobile($file_id,$userid[0]['id'],'uploads/appealpdf/');
      	$this->pollution_model->updatedata('tbl_file_attachment',array("file_attachment_id"=>$file_id),array('file_attachment_file_path'=>$file_path));	
		$attachment_data["message"]="File Has Been Uploaded";
	    $attachment_data["status"]=1;
		$attachment_data["group_id"]=$userid[0]["group_id"];
	    echo json_encode($attachment_data);die;
	}
//======this function display case subject and officer name for dispose off page====//
	public function casedisposeoff_get()
	{
		 $applicant_email_or_name=(isset($_GET["applicant_email_or_name"])?$_GET["applicant_email_or_name"]:'');
		 $device_token=(isset($_GET["device_token"])?$_GET["device_token"]:'');
		 $group_id=(isset($_GET["group_id"])?$_GET["group_id"]:'');
		 $case_id=(isset($_GET["case_id"])?$_GET["case_id"]:'');
		 $validation=array(
		 array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		 array($device_token,"device_token","Device Token Not Found"),
		 array($group_id,"group_id","Group Id Not Found"),
		 array($case_id,"case_id","Case Id Not Found")
         );
		  $this->check_error_message($validation);
		  $this->load->model('pollution_model');
          $userid=$this->pollution_model->get_data("tb_users","id,group_id,name",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else if($userid[0]["group_id"]==3)
		   {
			  $data["message"]="No authority for disposeoff";
			  $data["status"]=0;
			  echo json_encode($data);die; 
		   }
		      $this->check_case_belong_user($group_id,$case_id,$userid[0]["id"]);
			  $custom_query="SELECT tbl_current_status.current_status_name,
	concat(tbl_case.case_id,' ',tbl_case.case_letter_number,' ',tbl_case.case_subject) 
	as subject
FROM (tbl_case)
INNER JOIN tbl_current_status ON tbl_current_status.current_status_id=tbl_case.case_cuttent_status
WHERE (tbl_case.case_id=".$case_id.")";

			   $casedata=$this->pollution_model->custom_query($custom_query);	
 
               if($casedata[0]["current_status_name"]!="Hearing")
			   {
				  $data["message"]="No authority for disposeoff";
			      $data["status"]=0;
			      echo json_encode($data);die; 
			   }
			    $datadisposeoff["group_id"]=$userid[0]["group_id"];
			   $datadisposeoff["case_name"]=$casedata[0]["subject"];
			   $datadisposeoff["user_name"]=$userid[0]["name"];
			    $datadisposeoff["case_id"]=$case_id;
			   echo json_encode($datadisposeoff,JSON_UNESCAPED_SLASHES);die;
	}
	//====this function display case subject and officer name for decided page=====//
	public function casedecided_get()
	{
		  $this->casedisposeoff_get();
		
	}
	//==========This function use for action disposeoff and decided=========================//
	public function savedisposeoffandcasedecided_post()
	{
		
		 $applicant_email_or_name=(isset($_POST["applicant_email_or_name"])?$_POST["applicant_email_or_name"]:'');
		 $device_token=(isset($_POST["device_token"])?$_POST["device_token"]:'');
		 $group_id=(isset($_POST["group_id"])?$_POST["group_id"]:'');
		 $case_id=(isset($_POST["case_id"])?$_POST["case_id"]:'');
		 $date=(isset($_POST["date"])?$_POST["date"]:'');
		 $remark=(isset($_POST["remark"])?$_POST["remark"]:'');
		 $attachment=(isset($_FILES['attachment']['name'])?$_FILES['attachment']['name']:'');
		 $status_type=(isset($_POST["status_type"])?$_POST["status_type"]:'');
		 if($status_type=="decided")
		 {	 
		   $validation=array(
		   array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		   array($device_token,"device_token","Device Token Not Found"),
		   array($group_id,"group_id","Group Id Not Found"),
		   array($case_id,"case_id","Case Id Not Found"),
		   array($status_type,"status_type","Status Type Not Found"),
		   array($date,"date","Enter Date"),
		   array($attachment,"attechment","Upload Pdf File"),
		   array($remark,"remark","Enter Remark")
		   );
		 }else
		 {
			 
			$validation=array(
		   array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		   array($device_token,"device_token","Device Token Not Found"),
		   array($group_id,"group_id","Group Id Not Found"),
		   array($case_id,"case_id","Case Id Not Found"),
		   array($status_type,"status_type","Status Type Not Found"),
		   array($date,"date","Enter Date"),
		   array($remark,"remark","Enter Remark")
		   ); 
			 
		 }	
	 
		  $this->check_error_message($validation);
        
		  $this->load->model('pollution_model');
          $userid=$this->pollution_model->get_data("tb_users","id,group_id,name",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else if($userid[0]["group_id"]==3)
		   {
			  $data["message"]="No authority";
			  $data["status"]=0;
			  echo json_encode($data);die; 
		   }
		      $this->check_case_belong_user($group_id,$case_id,$userid[0]["id"]);
		       $caseresult=$this->pollution_model->join_with_condition('tbl_current_status.current_status_name',
  'tbl_case','tbl_current_status','tbl_current_status.current_status_id=tbl_case.case_cuttent_status',
  'inner','(tbl_case.case_id='.$case_id.')');

               if($caseresult[0]->current_status_name!="Hearing"&& $status_type=="decided")
			   {
				  $data["message"]="No authority for decided";
			      $data["status"]=0;
			      echo json_encode($data);die; 
			   }
			   
				$casecurrentstatus=($status_type=="disposeoff"?4:($status_type=="decided"?5:''));
				$attechment_file_path='';
		        $disposed_off["disposed_case_id"]=$case_id;
				$disposed_off["disposed_officer_id"]=$userid[0]["id"];
				$disposed_off["disposed_date"]=$date;
				$disposed_off["disposed_remark"]=$remark;
				$disposed_off["case_current_status"]=$casecurrentstatus;
		        if($casecurrentstatus==4)
				{
				$file_id=$this->pollution_model->insertdata('tbl_case_status',$disposed_off);
                $this->pollution_model->updatedata('tbl_case',array('case_id'=>$case_id),array('case_cuttent_status'=>$casecurrentstatus));				
				}
				else
				{
					  if(isset($_FILES['attachment']['name']) && !empty($_FILES['attachment']['name']))
			          {
                
				       $file_id=$this->pollution_model->insertdata('tbl_case_status',$disposed_off);
				      
				       $file_path=$this->upload_pdf_file_for_mobile($file_id,$disposed_off["disposed_officer_id"],'uploads/decided_attachment/');
				       
					   $this->pollution_model->updatedata('tbl_case_status',array('disposed_id'=>$file_id),array('attachment'=>$file_path));
				       $this->pollution_model->updatedata('tbl_case',array('case_id'=>$this->input->post('case_id',true)),array('case_cuttent_status'=>$casecurrentstatus));
					   $attechment_file_path="<br/>Attechment:".base_url().$file_path;
					
				      }else
                      {
						 $data["message"]="Upload Only Pdf File. Size Limit Less Then 5MB!";
			             $data["status"]=0;
			             echo json_encode($data);die;
						
					  }						  
		     
			   }
			    $addmessage="<br/>Date ".$disposed_off["disposed_date"]."<br/>"."Remark ".$disposed_off["disposed_remark"].$attechment_file_path;
				$this->save_data_in_log_from_mobile($status_type,$case_id,$userid[0]["id"],$applicant_email_or_name,$addmessage);
				$data["message"]="Case Has Been ".$status_type."";
                $data["group_id"]=$userid[0]["group_id"];			   
			    $data["status"]=1;
			    echo json_encode($data);die;
	}
	//======this function display case subject and officer name for case assign page====//
    public function caseassign_get()
	{
		 $applicant_email_or_name=(isset($_GET["applicant_email_or_name"])?$_GET["applicant_email_or_name"]:'');
		 $device_token=(isset($_GET["device_token"])?$_GET["device_token"]:'');
		 $group_id=(isset($_GET["group_id"])?$_GET["group_id"]:'');
		 $case_id=(isset($_GET["case_id"])?$_GET["case_id"]:'');
		 $validation=array(
		 array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		 array($device_token,"device_token","Device Token Not Found"),
		 array($group_id,"group_id","Group Id Not Found"),
		 array($case_id,"case_id","Case Id Not Found")
         );
		  $this->check_error_message($validation);
		  $this->load->model('pollution_model');
          $userid=$this->pollution_model->get_data("tb_users","id,group_id,name",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else if($userid[0]["group_id"]==2 || $userid[0]["group_id"]==3)
		   {
			  $data["message"]="No authority for disposeoff";
			  $data["status"]=0;
			  echo json_encode($data);die; 
		   }
		       $this->check_case_belong_user($group_id,$case_id,$userid[0]["id"]);
			   
	$custom_query="SELECT tbl_current_status.current_status_name,
	concat(tbl_case.case_id,' ',tbl_case.case_letter_number,' ',tbl_case.case_subject) 
	as subject
FROM (tbl_case)
INNER JOIN tbl_current_status ON tbl_current_status.current_status_id=tbl_case.case_cuttent_status
WHERE (tbl_case.case_id=".$case_id.")";

			  $casedata=$this->pollution_model->custom_query($custom_query);		 
			 
			   
			   if($casedata[0]["current_status_name"]!="Pending")
			   {
				  $data["message"]="No authority for assign";
			      $data["status"]=0;
			      echo json_encode($data);die; 
			   }
			   
			   $officerdata=$this->pollution_model->get_data('tb_users','id,name',array('group_id'=>2));
			   $data_assign["case_id"]=$case_id;
			   $data_assign["case_name"]=$casedata[0]["subject"];
			   $data_assign["user_name"]=$userid[0]["name"];
			   $data_assign["officer_name_with_id"]=$officerdata;
			   $data_assign["group_id"]=$userid[0]["group_id"];	
			   echo json_encode($data_assign,JSON_UNESCAPED_SLASHES);die;
		
	}
	//===============#######@@@@@#####=========================//
	public function savecaseassign_post()
	{
		
		 $applicant_email_or_name=(isset($_POST["applicant_email_or_name"])?$_POST["applicant_email_or_name"]:'');
		 $device_token=(isset($_POST["device_token"])?$_POST["device_token"]:'');
		 $group_id=(isset($_POST["group_id"])?$_POST["group_id"]:'');
		 $case_id=(isset($_POST["case_id"])?$_POST["case_id"]:'');
		 $officer_id=(isset($_POST["officer_id"])?$_POST["officer_id"]:'');
		 $case_asign_date_of_assign=(isset($_POST["case_asign_date_of_assign"])?$_POST["case_asign_date_of_assign"]:'');
		 
		 $validation=array(
		 array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		 array($device_token,"device_token","Device Token Not Found"),
		 array($group_id,"group_id","Group Id Not Found"),
		 array($case_id,"case_id","Case Id Not Found"),
		 array($officer_id,"officer_id","Select Officer Name"),
		 array($case_asign_date_of_assign,"case_asign_date_of_assign","Enter Date")
         );
		    $this->check_error_message($validation);
		    $this->load->model('pollution_model');
			$userid=$this->pollution_model->get_data("tb_users","id,group_id,name",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else if($userid[0]["group_id"]!=1)
		   {
			  $data["message"]="No authority for assign";
			  $data["status"]=0;
			  echo json_encode($data);die; 
		   }
		    $this->check_case_belong_user($group_id,$case_id,$userid[0]["id"]);
			$custom_query="SELECT tbl_current_status.current_status_name FROM (tbl_case)
INNER JOIN tbl_current_status ON tbl_current_status.current_status_id=tbl_case.case_cuttent_status
WHERE (tbl_case.case_id=".$case_id.")";

			  $casedata=$this->pollution_model->custom_query($custom_query);		 
			 
			   
			   if($casedata[0]["current_status_name"]!="Pending")
			   {
				  $data["message"]="No authority for assign";
			      $data["status"]=0;
			      echo json_encode($data);die; 
			   }
			$assign_data["case_asign_case_id"]=$case_id;
			$assign_data["case_asign_officer_id"]=$officer_id;
			$assign_data["case_asign_date_of_assign"]=$case_asign_date_of_assign;
			$assign_data["case_asign_status_id"]=1;
		    $this->pollution_model->insertdata('tbl_case_asign',$assign_data);
		    $this->pollution_model->updatedata('tbl_case',array('case_id'=>$case_id),array('case_cuttent_status'=>2));
			
            $message=$this->save_data_in_log_from_mobile("assigned",$case_id,$userid[0]['id'],$applicant_email_or_name);
			$data["message"]=$message;
			$data["group_id"]=$userid[0]["group_id"];	
			$data["status"]=1;
			echo json_encode($data,JSON_UNESCAPED_SLASHES);die; 
	}
	//======this function display case subject and officer name,case status and address for case hearing page===//
	public function casehearing_get()
	{
		 $applicant_email_or_name=(isset($_GET["applicant_email_or_name"])?$_GET["applicant_email_or_name"]:'');
		 $device_token=(isset($_GET["device_token"])?$_GET["device_token"]:'');
		 $group_id=(isset($_GET["group_id"])?$_GET["group_id"]:'');
		 $case_id=(isset($_GET["case_id"])?$_GET["case_id"]:'');
		 $validation=array(
		 array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		 array($device_token,"device_token","Device Token Not Found"),
		 array($group_id,"group_id","Group Id Not Found"),
		 array($case_id,"case_id","Case Id Not Found")
         );
		  $this->check_error_message($validation);
		  $this->load->model('pollution_model');
          $userid=$this->pollution_model->get_data("tb_users","id,group_id,name",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else if($userid[0]["group_id"]==3)
		   {
			  $data["message"]="No authority for hearing";
			  $data["status"]=0;
			  echo json_encode($data);die; 
		   }
		   $this->check_case_belong_user($userid[0]["group_id"],$case_id,$userid[0]["id"]);
		   
		$custom_query="SELECT tbl_case.case_cuttent_status,tbl_current_status.current_status_name,
	concat(tbl_case.case_id,' ',tbl_case.case_letter_number,' ',tbl_case.case_subject) 
	as subject
FROM (tbl_case)
INNER JOIN tbl_current_status ON tbl_current_status.current_status_id=tbl_case.case_cuttent_status
WHERE (tbl_case.case_id=".$case_id.")";

	    $casedata=$this->pollution_model->custom_query($custom_query);
		 if($casedata[0]["current_status_name"]!="Assigned")
		 {
			  $data["message"]="No authority for hearing";
			  $data["status"]=0;
			  echo json_encode($data);die; 
		 }
		 
		 $currentcase_status=$casedata[0]["case_cuttent_status"]+1;
		 $current_status_data=$this->pollution_model->get_data("tbl_current_status","current_status_id,current_status_name",array("current_status_id"=>$currentcase_status));
		 $hearing_case["case_id"]=$case_id;
         $hearing_case["group_id"]=$userid[0]["group_id"];
         $hearing_case["case_status"]=$current_status_data;		
		 $hearing_case["case_subject"]=$casedata[0]["subject"];
		 $officer_data=$this->pollution_model->get_data("tb_users","id,name",array("group_id"=>2));
		 $hearing_case["officer_data"]=$officer_data;
		 $address_data=$this->pollution_model->get_data("addresses","address_id,address_address",array("address_status"=>1));
		 $hearing_case["address_data"]=$address_data;
		 echo json_encode($hearing_case,JSON_UNESCAPED_SLASHES);die; 
	
	}
	//=================================================//
	//==== action save case hearing for mobile user========//
	public function savecasehearing_post()
	{
		 $applicant_email_or_name=(isset($_POST["applicant_email_or_name"])?$_POST["applicant_email_or_name"]:'');
		 $device_token=(isset($_POST["device_token"])?$_POST["device_token"]:'');
		 $group_id=(isset($_POST["group_id"])?$_POST["group_id"]:'');
		 $case_id=(isset($_POST["case_id"])?$_POST["case_id"]:'');
		 $current_status_id=(isset($_POST["current_status_id"])?$_POST["current_status_id"]:'');
		 $officer_id=(isset($_POST["officer_id"])?$_POST["officer_id"]:'');
		 $date=(isset($_POST["date"])?$_POST["date"]:'');
		 $time_of_hearing=(isset($_POST["time_of_hearing"])?$_POST["time_of_hearing"]:'');
		 $remark=(isset($_POST["remark"])?$_POST["remark"]:'');
		 $address_id=(isset($_POST["address_id"])?$_POST["address_id"]:'');
		 $validation=array(
		 array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		 array($device_token,"device_token","Device Token Not Found"),
		 array($group_id,"group_id","Group Id Not Found"),
		 array($case_id,"case_id","Case Id Not Found"),
		 array($current_status_id,"current_status_id","Enter Case Status"),
		 array($officer_id,"officer_id","Select Officer Name"),
		 array($date,"date","Enter Date"),
		 array($time_of_hearing,"time_of_hearing","Enter Time"),
		 array($remark,"remark","Enter Remark"),
		 array($address_id,"address_id","Select Address")
		 );
		  $this->check_error_message($validation);
		  $this->load->model('pollution_model');
          $userid=$this->pollution_model->get_data("tb_users","id,group_id,name",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else if($userid[0]["group_id"]==3)
		   {
			   $data["message"]="No authority for hearing";
			   $data["status"]=0;
			   echo json_encode($data);die; 
			   
		   }	   
		   $this->check_case_belong_user($group_id,$case_id,$userid[0]["id"]);
		   

         $casedata=$this->pollution_model->join_with_condition('tbl_current_status.current_status_name',
  'tbl_case','tbl_current_status','tbl_current_status.current_status_id=tbl_case.case_cuttent_status',
  'inner','(tbl_case.case_id='.$case_id.')');
	
		if($casedata[0]->current_status_name!="Assigned" && $casedata[0]->current_status_name!="Hearing")
	    {
			
				$data["message"]="No authority for hearing";
			    $data["status"]=0;
			    echo json_encode($data);die;   
				   
		}
		else if($casedata[0]->current_status_name=="Hearing")
		{
			$hearing_id=isset($_POST["hearing_id"])?$_POST["hearing_id"]:'';
			$validation=array(
		         array($hearing_id,"hearing_id","Send Hearing Id")
		               );
			$this->check_error_message($validation);		   
		}
	
		   $hearing_data["hearing_case_id"]=$case_id;
		   $hearing_data["hearing_officer_id"]=$officer_id;
		   $hearing_data["hearing_time"]=$time_of_hearing;
		   $hearing_data["hearing_next_date"]=$date;
		   $hearing_data["hearing_address_id"]=$address_id;
		   $hearing_data["remark"]=$remark;
			
			if($casedata[0]->current_status_name=="Hearing")
			{
		    $this->pollution_model->updatedata('tbl_hearing',array('hearing_id'=>$hearing_id),$hearing_data);		
			}
			else
			{
			$this->pollution_model->insertdata('tbl_hearing', $hearing_data);	
			
			}	
		    $case_cuttent_status=$current_status_id;
		    $this->pollution_model->updatedata('tbl_case',array('case_id'=>$case_id),array('case_cuttent_status'=>$case_cuttent_status));
			$this->pollution_model->updatedata('tbl_case_asign',array('case_asign_case_id'=>$case_id),array('case_asign_officer_id'=>$officer_id,'case_asign_update_date'=>date('Y-m-d h:i:s')));
			$getaddress=$this->pollution_model->get_data('addresses','address_address',array("address_id"=>$address_id,"address_status"=>1));
			$addmessage="<br/>Hearing Date:".$hearing_data["hearing_next_date"]."<br/>Hearing Time:".$hearing_data["hearing_time"]."<br/>Remark:".$hearing_data["remark"]."<br/>Address:".$getaddress[0]["address_address"];
			
			$message=$this->save_data_in_log_from_mobile("hearing",$case_id,$userid[0]["id"],$applicant_email_or_name,$addmessage);
			
			$hearing["message"]=$message;
			$hearing["group_id"]=$group_id;
			$hearing["status"]=1;
			echo json_encode($hearing,JSON_UNESCAPED_SLASHES);die;
	}
	//======this function display case subject and officer name,case status and address and  case hearing===//
	//===detail for edit hearing page for mobile users===//
	public function caseedithearing_post()
	{
		 $applicant_email_or_name=(isset($_POST["applicant_email_or_name"])?$_POST["applicant_email_or_name"]:'');
		 $device_token=(isset($_POST["device_token"])?$_POST["device_token"]:'');
		 $group_id=(isset($_POST["group_id"])?$_POST["group_id"]:'');
		 $case_id=(isset($_POST["case_id"])?$_POST["case_id"]:'');
		 $validation=array(
		 array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		 array($device_token,"device_token","Device Token Not Found"),
		 array($group_id,"group_id","Group Id Not Found"),
		 array($case_id,"case_id","Case Id Not Found")
         );
		  $this->check_error_message($validation);
		  $this->load->model('pollution_model');
          $userid=$this->pollution_model->get_data("tb_users","id,group_id,name",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else if($userid[0]["group_id"]==3)
		   {
			  $data["message"]="No authority for hearing";
			  $data["status"]=0;
			  echo json_encode($data);die; 
		   }
		  $this->check_case_belong_user($userid[0]["group_id"],$case_id,$userid[0]["id"]);
		  
		$custom_query="SELECT tbl_case.case_cuttent_status,tbl_current_status.current_status_name,
	concat(tbl_case.case_id,' ',tbl_case.case_letter_number,' ',tbl_case.case_subject) 
	as subject
FROM (tbl_case)
INNER JOIN tbl_current_status ON tbl_current_status.current_status_id=tbl_case.case_cuttent_status
WHERE (tbl_case.case_id=".$case_id.")";

	    $casedata=$this->pollution_model->custom_query($custom_query);
		
		
		if($casedata[0]["current_status_name"]=="Hearing")
		{
			$edithearingdata["subject"]=$casedata[0]["subject"];
		    
			$currentcase_status=$casedata[0]["case_cuttent_status"];
		    $current_status_data=$this->pollution_model->get_data("tbl_current_status","current_status_id,current_status_name",array("current_status_id"=>$currentcase_status));
		    $edithearingdata["case_status"]=$current_status_data;
			$hearing_data=$this->pollution_model->get_data("tbl_hearing","hearing_id,hearing_case_id,hearing_officer_id,hearing_time,hearing_next_date,hearing_address_id,remark",array("hearing_case_id"=>$case_id));
		    $edithearingdata["hearing_data"]=$hearing_data;
			$edithearingdata["currentcase_status"]=$currentcase_status;
			$officer_data=$this->pollution_model->get_data("tb_users","id,name",array("group_id"=>2));
		    $edithearingdata["officer_data"]=$officer_data;
			$address_data=$this->pollution_model->get_data("addresses","address_id,address_address",array("address_status"=>1));
			$edithearingdata["address"]=$address_data;
			$edithearingdata["case_id"]=$case_id;
			$edithearingdata["group_id"]=$userid[0]["group_id"];
			$edithearingdata["status"]=1;
			echo json_encode($edithearingdata,JSON_UNESCAPED_SLASHES);die;
		}	
		
		
		
	}
	////============this function use for display case history for mobile users===========//
	public function display_case_history_get()
	{
		
		 $applicant_email_or_name=(isset($_GET["applicant_email_or_name"])?$_GET["applicant_email_or_name"]:'');
		 $device_token=(isset($_GET["device_token"])?$_GET["device_token"]:'');
		 $group_id=(isset($_GET["group_id"])?$_GET["group_id"]:'');
		 $offset=(isset($_GET["offset_num"])?$_GET["offset_num"]:0);
		 $limit=(isset($_GET["limit_num"])?$_GET["limit_num"]:10);
		 $validation=array(
		                   array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		                   array($device_token,"device_token","Device Token Not Found"),
		                   array($group_id,"group_id","Group Id Not Found")
		                  );
		 $this->check_error_message($validation);
		 $this->load->model('pollution_model');
         $userid=$this->pollution_model->get_data("tb_users","id,group_id,name",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }
		   
		     $user_id=$userid[0]["id"];
		    if($userid[0]["group_id"]==1)
			{
				 $countquery=$this->pollution_model->getdate_select('tbl_logs','count(*) as total');
                 $total_row=$countquery[0]['total'];
                 $query= "SELECT 
 tbl_logs.log_id,
concat(tbl_case.case_id,' ',tbl_case.case_letter_number,' ',tbl_case.case_subject) as subject,
concat(tb_users.name,' ',tb_users.email) as userinfo, tbl_logs.log_active,tbl_logs.log_date,
tbl_logs.log_description
FROM tbl_logs 
inner join tbl_case 
on (tbl_logs.log_case_id=tbl_case.case_id) 
inner join tb_users
on (tb_users.id=tbl_logs.log_user_id)
ORDER BY tbl_logs.log_case_id asc limit ".$offset.",".$limit."";
				
			}else
			{
				 $countquery=$this->pollution_model->get_data('tbl_logs','count(*) as total',"(tbl_logs.log_id IS NOT NULL AND tbl_logs.log_case_id 
IN(select log_case_id from tbl_logs where log_user_id=".$user_id."))");
                 
				  $total_row=$countquery[0]['total'];
                 				  
				$query= "SELECT 
 tbl_logs.log_id,
concat(tbl_case.case_id,' ',tbl_case.case_letter_number,' ',tbl_case.case_subject) as subject,
concat(tb_users.name,' ',tb_users.email) as userinfo, tbl_logs.log_active,tbl_logs.log_date,
tbl_logs.log_description
FROM tbl_logs 
inner join tbl_case 
on (tbl_logs.log_case_id=tbl_case.case_id) 
inner join tb_users
on (tb_users.id=tbl_logs.log_user_id) where tbl_logs.log_id IS NOT NULL AND tbl_logs.log_case_id 
IN(select log_case_id from tbl_logs where log_user_id=".$user_id.")
ORDER BY tbl_logs.log_case_id asc limit ".$offset.",".$limit."";
				
			}	
			
		  $case_history_info=$this->pollution_model->custom_query($query);
		  if($userid[0]["group_id"]==1 && $userid[0]["group_id"]==2)
		  {
			$case_asign_hearing_info=$this->case_asign_hearing_info();
		    $history=array();
		   foreach($case_history_info as $info)
		   {
			$casehistory["log_id"]=$info["log_id"];
            $casehistory["subject"]=$info["subject"];
            $casehistory["userinfo"]=$info["userinfo"];
            $casehistory["log_active"]=$info["log_active"];
            $casehistory["log_date"]=$info["log_date"]; 
            $casehistory["log_description"]=$info["log_description"]; 
			$log_url=$this->case_edit_url($case_asign_hearing_info,$info["log_id"],$userid[0]["group_id"]);
			$casehistory["edit_case"]=(empty($log_url)?'':$log_url);
			$history[]=$casehistory;
		   }
		   
		 }else
         {
			 
			 $history=$case_history_info;
		 }			 
		   
		
		  $next_offset=$limit+$offset;
		  $previous_offset=$offset-$limit;
		  $next_link=($next_offset<$total_row?1:0);
		  $previous_link=($previous_offset<0?0:1);
		  $casehistorydata["case_history_info"]=$history;
		  $casehistorydata["next_offset"]=$next_offset;
		  $casehistorydata["previous_offset"]=$previous_offset;
		  $casehistorydata["next_link"]=$next_link;
		  $casehistorydata["previous_link"]=$previous_link;
		  $casehistorydata["limit"]=$limit;
		  
		  echo json_encode($casehistorydata,JSON_UNESCAPED_SLASHES);die;
	}
	//====this function use for case history for get url for edit assign,hearing,Dispose Off and Decided======//
	private function case_edit_url($case_asign_hearing_info,$log_id,$group_id)
	{
		           $data=array();
		           if(isset($case_asign_hearing_info[$log_id]) && !empty($case_asign_hearing_info[$log_id]) )
					{
						
						$hold_array=$case_asign_hearing_info[$log_id];
					 
	                 switch($hold_array["case_cuttent_status"])
	                  {
		                case 2:
		                $status_id= $hold_array["case_asign_id"];
		                break;
		                case 3:
		                $status_id= $hold_array["case_id"];
		                break;
		                case 4:
		                $status_id= $hold_array["disposed_id"];
		                break;
		                case 5:
		                $status_id= $hold_array["disposed_id"];
		                break;
		                default:
		                $status_id=0;
	                  }

					
					  if($hold_array["case_cuttent_status"]==2)
					   {
						  if($group_id==1)
						  {
						   $data['title']='Edit Case Assign';  
						   $data['url']=base_url().'pollution/editcaseassign';
						   $data['asign_id']=$status_id; 
						  }
					   
					   }else if($hold_array["case_cuttent_status"]==3)
					   {   
				           if($group_id==1 || $group_id==2)
                           {
							   $data['title']='Edit Hearing';  
						       $data['url']=base_url().'pollution/caseedithearing';
						       $data['case_id']=$status_id;
   
						   }							   
						   						   
					   }else if($hold_array["case_cuttent_status"]==4)
                       {
						   if($group_id==1 || $group_id==2)
                           {
						    $data['title']='Edit Case Dispose Off';  
						    $data['url']=base_url().'pollution/edit_page_casedecided_disposeoff';
						    $data['dispose_off_id']=$status_id;
						   }
					   }
                       else if($hold_array["case_cuttent_status"]==5)
                       {
						     if($group_id==1 || $group_id==2)
							 {	 
							  $data['title']='Edit Case Decided';  
						      $data['url']=base_url().'pollution/edit_page_casedecided_disposeoff';
						      $data['decided_id']=$status_id;
							 }
					   }						   
                        						   
					   
					}
		return $data;
		
	}
	//==========This function use for display case assign for super admin==============//
	public function display_caseassign_get()
    {
		 $applicant_email_or_name=(isset($_GET["applicant_email_or_name"])?$_GET["applicant_email_or_name"]:'');
		 $device_token=(isset($_GET["device_token"])?$_GET["device_token"]:'');
		 $group_id=(isset($_GET["group_id"])?$_GET["group_id"]:'');
		 $offset=(isset($_GET["offset_num"])?$_GET["offset_num"]:0);
		 $limit=(isset($_GET["limit_num"])?$_GET["limit_num"]:10);
		 $validation=array(
		                   array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		                   array($device_token,"device_token","Device Token Not Found"),
		                   array($group_id,"group_id","Group Id Not Found")
		                  );
		 $this->check_error_message($validation);
		 $this->load->model('pollution_model');
         $userid=$this->pollution_model->get_data("tb_users","id,group_id,name",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else if($userid[0]["group_id"]!=1)
		   {
			   $data["message"]="No authority";
			   $data["status"]=0;
			   echo json_encode($data);die;
		   }   
		
                  $countquery=$this->pollution_model->getdate_select('tbl_case_asign','count(*) as total');
				  
				  $total_row=$countquery[0]['total'];
		$custom_query="select tbl_case_asign.case_asign_id, concat(tbl_case.case_id,' ',tbl_case.case_letter_number,' ',tbl_case.case_subject) as subject,
concat(tb_users.name,' ',tb_users.email) as officerinfo,tbl_case_asign.case_asign_date_of_assign,
tb_status.status_name,tbl_current_status.current_status_name,
IF(tbl_case.case_cuttent_status = '2', '".base_url()."pollution/editcaseassign', '') as edit_url
from tbl_case_asign 
inner join
tbl_case on(tbl_case_asign.case_asign_case_id=tbl_case.case_id)
inner join
tb_users on (tb_users.id=tbl_case_asign.case_asign_officer_id)
inner join 
tb_status on (tb_status.status_id=tbl_case.case_status)
inner join 
tbl_current_status on (tbl_current_status.current_status_id=tbl_case.case_cuttent_status) order by tbl_case_asign.case_asign_id desc limit ".$offset.",".$limit."";
	      $case_assign_info=$this->pollution_model->custom_query($custom_query);	  
		  
		  $next_offset=$limit+$offset;
		  $previous_offset=$offset-$limit;
		  $next_link=($next_offset<$total_row?1:0);
		  $previous_link=($previous_offset<0?0:1);
		  $casehistorydata["case_assign_info"]=$case_assign_info;
		  $casehistorydata["next_offset"]=$next_offset;
		  $casehistorydata["previous_offset"]=$previous_offset;
		  $casehistorydata["next_link"]=$next_link;
		  $casehistorydata["previous_link"]=$previous_link;
		  $casehistorydata["limit"]=$limit;
		  
		  echo json_encode($casehistorydata,JSON_UNESCAPED_SLASHES);die;
	}
//========This function delete case assign by super admin for mobile user=========//	
  public function delete_caseassign_post()
  {
	     $applicant_email_or_name=(isset($_POST["applicant_email_or_name"])?$_POST["applicant_email_or_name"]:'');
		 $device_token=(isset($_POST["device_token"])?$_POST["device_token"]:'');
		 $group_id=(isset($_POST["group_id"])?$_POST["group_id"]:'');
		 $assign_id=(isset($_POST["assign_id"])?$_POST["assign_id"]:'');
	     $validation=array(
		                   array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		                   array($device_token,"device_token","Device Token Not Found"),
		                   array($group_id,"group_id","Group Id Not Found"),
						   array($assign_id,"assign_id","Assign Id Not Found")
		                 );
	     $this->check_error_message($validation);
		 $this->load->model('pollution_model');
         $userid=$this->pollution_model->get_data("tb_users","id,group_id,name",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else if($userid[0]["group_id"]!=1)
		   {
			   $data["message"]="No authority";
			   $data["status"]=0;
			   echo json_encode($data);die;
		   }
		
		    $result=$this->pollution_model->get_data('tbl_case_asign','case_asign_case_id',array('case_asign_id'=> $assign_id));
		    if(!empty($result))
			{
			    $case_id=$result[0]["case_asign_case_id"];
			    $this->pollution_model->delete_data('tbl_hearing',array('hearing_case_id'=> $case_id));
			    $this->pollution_model->delete_data('tbl_case_status',array('disposed_case_id'=> $case_id));
			    $this->pollution_model->updatedata('tbl_case',array('case_id'=>$case_id),array("case_cuttent_status"=>1));
		        $this->pollution_model->delete_data('tbl_case_asign',array('case_asign_id'=>$assign_id));	
                $this->save_data_in_log_from_mobile('delete',$case_id,$userid[0]['id'],$applicant_email_or_name);
		        $data["message"]="Case has been deleted";
	            $data["status"]=1;
		        $data["group_id"]=$userid[0]["group_id"];
	            echo json_encode($data);die;		
	         }else
			 {
				 $data["message"]="No information about case";
	             $data["status"]=0;
		         echo json_encode($data);die;
			 }	 
			}
//======display case hearing for superadmin and admin for mobile users==============//
   public function display_case_hearing_get()
	{
			
         $applicant_email_or_name=(isset($_GET["applicant_email_or_name"])?$_GET["applicant_email_or_name"]:'');
		 $device_token=(isset($_GET["device_token"])?$_GET["device_token"]:'');
		 $group_id=(isset($_GET["group_id"])?$_GET["group_id"]:'');
		 $offset=(isset($_GET["offset_num"])?$_GET["offset_num"]:0);
		 $limit=(isset($_GET["limit_num"])?$_GET["limit_num"]:10);
		 $validation=array(
		                   array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		                   array($device_token,"device_token","Device Token Not Found"),
		                   array($group_id,"group_id","Group Id Not Found")
		                  );
		 $this->check_error_message($validation);
		 $this->load->model('pollution_model');
         $userid=$this->pollution_model->get_data("tb_users","id,group_id,name",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else if($userid[0]["group_id"]==3)
		   {
			   $data["message"]="No authority";
			   $data["status"]=0;
			   echo json_encode($data);die;
		   } 
           
         if($userid[0]["group_id"]==1)
		 {
		       $countquery=$this->pollution_model->getdate_select('tbl_hearing','count(*) as total');
		       $total_row=$countquery[0]['total'];
		       $custom_query="select tbl_hearing.hearing_id, 
concat(tbl_case.case_id,' ',tbl_case.case_letter_number,' ',tbl_case.case_subject) as subject,
concat(tb_users.name,' ',tb_users.email) as officerinfo,
tbl_hearing.hearing_next_date,tbl_hearing.hearing_time,tbl_hearing.remark,
addresses.address_address
from tbl_hearing 
inner join
tbl_case on(tbl_hearing.hearing_case_id=tbl_case.case_id)
inner join
tb_users on (tb_users.id=tbl_hearing.hearing_officer_id)
inner join 
addresses on (addresses.address_id=tbl_hearing.hearing_address_id) 
order by tbl_hearing.hearing_id desc limit ".$offset.",".$limit."";		   
	  }else
	  {
		       $countquery=$this->pollution_model->get_data('tbl_hearing','count(*) as total',array("hearing_officer_id"=>$userid[0]["id"]));
			   
		       $total_row=$countquery[0]['total'];
		       $custom_query="select tbl_hearing.hearing_id, 
concat(tbl_case.case_id,' ',tbl_case.case_letter_number,' ',tbl_case.case_subject) as subject,
concat(tb_users.name,' ',tb_users.email) as officerinfo,
tbl_hearing.hearing_next_date,tbl_hearing.hearing_time,tbl_hearing.remark,
addresses.address_address
from tbl_hearing 
inner join
tbl_case on(tbl_hearing.hearing_case_id=tbl_case.case_id)
inner join
tb_users on (tb_users.id=tbl_hearing.hearing_officer_id)
inner join 
addresses on (addresses.address_id=tbl_hearing.hearing_address_id)
where  hearing_officer_id=".$userid[0]["id"]."
order by tbl_hearing.hearing_id desc limit ".$offset.",".$limit."";
	}	  
	       $case_hearing_info=$this->pollution_model->custom_query($custom_query);	  
		   $next_offset=$limit+$offset;
		   $previous_offset=$offset-$limit;
		   $next_link=($next_offset<$total_row?1:0);
		   $previous_link=($previous_offset<0?0:1);
		   $casehearingdata["case_hearing_info"]=$case_hearing_info;
		   $casehearingdata["next_offset"]=$next_offset;
		   $casehearingdata["previous_offset"]=$previous_offset;
		   $casehearingdata["next_link"]=$next_link;
		   $casehearingdata["previous_link"]=$previous_link;
		   $casehearingdata["limit"]=$limit;
		  
		  echo json_encode($casehearingdata,JSON_UNESCAPED_SLASHES);die;	 				
				
	}
	//====This function use to display dispose off data for mobile users=====//
	public function display_disposeoff_get()
	{
	     $applicant_email_or_name=(isset($_GET["applicant_email_or_name"])?$_GET["applicant_email_or_name"]:'');
		 $device_token=(isset($_GET["device_token"])?$_GET["device_token"]:'');
		 $group_id=(isset($_GET["group_id"])?$_GET["group_id"]:'');
		 $offset=(isset($_GET["offset_num"])?$_GET["offset_num"]:0);
		 $limit=(isset($_GET["limit_num"])?$_GET["limit_num"]:10);
		 $validation=array(
		                   array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		                   array($device_token,"device_token","Device Token Not Found"),
		                   array($group_id,"group_id","Group Id Not Found")
		                  );
		 $this->check_error_message($validation);
		 $this->load->model('pollution_model');
         $userid=$this->pollution_model->get_data("tb_users","id,group_id,name",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else if($userid[0]["group_id"]==3)
		   {
			   $data["message"]="No authority";
			   $data["status"]=0;
			   echo json_encode($data);die;
		   }
         if($userid[0]["group_id"]==1)
		 {		   
		     $countquery=$this->pollution_model->get_data('tbl_case_status','count(*) as total',array("case_current_status"=>4));
		     $total_row=$countquery[0]['total'];
		       
			   $custom_query="select tbl_case_status.disposed_id,tbl_case.case_id, 
concat(tbl_case.case_id,' ',tbl_case.case_letter_number,' ',tbl_case.case_subject) as subject,
concat(tb_users.name,' ',tb_users.email) as officerinfo,
tbl_case_status.disposed_date,tbl_case_status.disposed_remark,
tbl_current_status.current_status_name
from tbl_case_status 
inner join
tbl_case on(tbl_case_status.disposed_case_id=tbl_case.case_id)
inner join
tb_users on (tb_users.id=tbl_case_status.disposed_officer_id)
inner join 
tbl_current_status
on (tbl_current_status.current_status_id=tbl_case_status.case_current_status)
where tbl_case_status.case_current_status=4
order by tbl_case_status.disposed_id desc limit ".$offset.",".$limit."";		   
		 }else
         {
		     $countquery=$this->pollution_model->get_data('tbl_case_status','count(*) as total',array("case_current_status"=>4,"disposed_officer_id"=>$userid[0]["id"]));
		     $total_row=$countquery[0]['total'];
		       
			   $custom_query="select tbl_case_status.disposed_id,tbl_case.case_id, 
concat(tbl_case.case_id,' ',tbl_case.case_letter_number,' ',tbl_case.case_subject) as subject,
concat(tb_users.name,' ',tb_users.email) as officerinfo,
tbl_case_status.disposed_date,tbl_case_status.disposed_remark,
tbl_current_status.current_status_name
from tbl_case_status 
inner join
tbl_case on(tbl_case_status.disposed_case_id=tbl_case.case_id)
inner join
tb_users on (tb_users.id=tbl_case_status.disposed_officer_id)
inner join 
tbl_current_status
on (tbl_current_status.current_status_id=tbl_case_status.case_current_status)
where tbl_case_status.case_current_status=4 and tbl_case_status.disposed_officer_id=".$userid[0]["id"]."
order by tbl_case_status.disposed_id desc limit ".$offset.",".$limit."";		   
		 } 		 
	       $case_disposeoff_info=$this->pollution_model->custom_query($custom_query);	  
		   $next_offset=$limit+$offset;
		   $previous_offset=$offset-$limit;
		   $next_link=($next_offset<$total_row?1:0);
		   $previous_link=($previous_offset<0?0:1);
		   $casedisposeoffdata["case_disposeoff_info"]=$case_disposeoff_info;
		   $casedisposeoffdata["next_offset"]=$next_offset;
		   $casedisposeoffdata["previous_offset"]=$previous_offset;
		   $casedisposeoffdata["next_link"]=$next_link;
		   $casedisposeoffdata["previous_link"]=$previous_link;
		   $casedisposeoffdata["limit"]=$limit;
		   echo json_encode($casedisposeoffdata,JSON_UNESCAPED_SLASHES);die;	 				
	}
	//======================================================//
	//====This function use to display decided data for mobile users=====//
	public function  display_casedecided_get()
	{
	     $applicant_email_or_name=(isset($_GET["applicant_email_or_name"])?$_GET["applicant_email_or_name"]:'');
		 $device_token=(isset($_GET["device_token"])?$_GET["device_token"]:'');
		 $group_id=(isset($_GET["group_id"])?$_GET["group_id"]:'');
		 $offset=(isset($_GET["offset_num"])?$_GET["offset_num"]:0);
		 $limit=(isset($_GET["limit_num"])?$_GET["limit_num"]:10);
		 $validation=array(
		                   array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		                   array($device_token,"device_token","Device Token Not Found"),
		                   array($group_id,"group_id","Group Id Not Found")
		                  );
		 $this->check_error_message($validation);
		 $this->load->model('pollution_model');
         $userid=$this->pollution_model->get_data("tb_users","id,group_id,name",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else if($userid[0]["group_id"]==3)
		   {
			   $data["message"]="No authority";
			   $data["status"]=0;
			   echo json_encode($data);die;
		   }
         if($userid[0]["group_id"]==1)
		 {		   
		     $countquery=$this->pollution_model->get_data('tbl_case_status','count(*) as total',array("case_current_status"=>5));
		     $total_row=$countquery[0]['total'];
		       
			   $custom_query="select tbl_case_status.disposed_id,tbl_case.case_id, 
concat(tbl_case.case_id,' ',tbl_case.case_letter_number,' ',tbl_case.case_subject) as subject,
concat(tb_users.name,' ',tb_users.email) as officerinfo,concat('".base_url()."',tbl_case_status.attachment) as file_attachment,
tbl_case_status.disposed_date,tbl_case_status.disposed_remark,
tbl_current_status.current_status_name
from tbl_case_status 
inner join
tbl_case on(tbl_case_status.disposed_case_id=tbl_case.case_id)
inner join
tb_users on (tb_users.id=tbl_case_status.disposed_officer_id)
inner join 
tbl_current_status
on (tbl_current_status.current_status_id=tbl_case_status.case_current_status)
where tbl_case_status.case_current_status=5
order by tbl_case_status.disposed_id desc limit ".$offset.",".$limit."";		   
		 }else
         {
		     $countquery=$this->pollution_model->get_data('tbl_case_status','count(*) as total',array("case_current_status"=>5,"disposed_officer_id"=>$userid[0]["id"]));
		     $total_row=$countquery[0]['total'];
		       
			   $custom_query="select tbl_case_status.disposed_id,tbl_case.case_id, 
concat(tbl_case.case_id,' ',tbl_case.case_letter_number,' ',tbl_case.case_subject) as subject,
concat(tb_users.name,' ',tb_users.email) as officerinfo,concat(".base_url().",tbl_case_status.attachment) as file_attachment,
tbl_case_status.disposed_date,tbl_case_status.disposed_remark,
tbl_current_status.current_status_name
from tbl_case_status 
inner join
tbl_case on(tbl_case_status.disposed_case_id=tbl_case.case_id)
inner join
tb_users on (tb_users.id=tbl_case_status.disposed_officer_id)
inner join 
tbl_current_status
on (tbl_current_status.current_status_id=tbl_case_status.case_current_status)
where tbl_case_status.case_current_status=5 and tbl_case_status.disposed_officer_id=".$userid[0]["id"]."
order by tbl_case_status.disposed_id desc limit ".$offset.",".$limit."";		   
		 } 		 
	       $case_disposeoff_info=$this->pollution_model->custom_query($custom_query);	  
		   $next_offset=$limit+$offset;
		   $previous_offset=$offset-$limit;
		   $next_link=($next_offset<$total_row?1:0);
		   $previous_link=($previous_offset<0?0:1);
		   $casecasedecideddata["case_disposeoff_info"]=$case_disposeoff_info;
		   $casecasedecideddata["next_offset"]=$next_offset;
		   $casecasedecideddata["previous_offset"]=$previous_offset;
		   $casecasedecideddata["next_link"]=$next_link;
		   $casecasedecideddata["previous_link"]=$previous_link;
		   $casecasedecideddata["limit"]=$limit;
		   echo json_encode($casecasedecideddata,JSON_UNESCAPED_SLASHES);die;	 				
	
	}
	//====This function use for delete case decided or disposeoff by superadmin and admin ========//
	public function delete_casedecided_disposeoff_post()
	{
		 $applicant_email_or_name=(isset($_POST["applicant_email_or_name"])?$_POST["applicant_email_or_name"]:'');
		 $device_token=(isset($_POST["device_token"])?$_POST["device_token"]:'');
		 $group_id=(isset($_POST["group_id"])?$_POST["group_id"]:'');
		 $case_id=(isset($_POST["case_id"])?$_POST["case_id"]:'');
		 $decided_disposeoff_id=(isset($_POST["decided_disposeoff_id"])?$_POST["decided_disposeoff_id"]:'');
		 $validation=array(
		                   array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		                   array($device_token,"device_token","Device Token Not Found"),
		                   array($group_id,"group_id","Group Id Not Found"),
						   array($case_id,"case_id","Send Case Id"),
						   array($decided_disposeoff_id,"decided_disposeoff_id","Send Decided_disposeoff Id")
		                  );
		 $this->check_error_message($validation);
		 $this->load->model('pollution_model');
         $userid=$this->pollution_model->get_data("tb_users","id,group_id,name",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else if($userid[0]["group_id"]==3)
		   {
			   $data["message"]="No authority";
			   $data["status"]=0;
			   echo json_encode($data);die;
		   }
		    $attachment=$this->pollution_model->get_data("tbl_case_status","attachment",array("disposed_id"=>$decided_disposeoff_id));
		    if(!empty($attachment[0]["attachment"]))
			{
			 unlink($attachment[0]["attachment"]);	   	
			}	
		    $this->pollution_model->delete_data("tbl_case_status",array("disposed_id"=>$decided_disposeoff_id));
	        $this->save_data_in_log_from_mobile("delete",$case_id,$userid[0]["id"],$applicant_email_or_name);	
            $data["message"]="Data Has Been Deleted";
		    echo json_encode($data,JSON_UNESCAPED_SLASHES);die;	 		   
	}
	//============This function use for edit case decided and case disposeoff action for mobile users=========//
	public function edit_casedecided_disposeoff_post()
	{
		 $applicant_email_or_name=(isset($_POST["applicant_email_or_name"])?$_POST["applicant_email_or_name"]:'');
		 $device_token=(isset($_POST["device_token"])?$_POST["device_token"]:'');
		 $group_id=(isset($_POST["group_id"])?$_POST["group_id"]:'');
		 $decided_disposeoff_id=(isset($_POST["decided_disposeoff_id"])?$_POST["decided_disposeoff_id"]:'');
		 $date=(isset($_POST["date"])?$_POST["date"]:'');
		 $remark=(isset($_POST["remark"])?$_POST["remark"]:'');
		 $attachment=(isset($_FILES['attachment']['name'])?$_FILES['attachment']['name']:'');
		
		$validation=array(
		   array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		   array($device_token,"device_token","Device Token Not Found"),
		   array($group_id,"group_id","Group Id Not Found"),
		   array($decided_disposeoff_id,"decided_disposeoff_id","Send Decided_disposeoff Id"),
		   array($date,"date","Enter Date"),
		   array($remark,"remark","Enter Remark")
		   );
		 		   
		 $this->check_error_message($validation);
		 
		 $this->load->model('pollution_model');
         $userid=$this->pollution_model->get_data("tb_users","id,group_id,name",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else if($userid[0]["group_id"]==3)
		   {
			   $data["message"]="No authority";
			   $data["status"]=0;
			   echo json_encode($data);die;
		   }
                $disposed_off["disposed_date"]=$date;
				$disposed_off["disposed_remark"]=$remark;
				
	          $case_current_id=$this->pollution_model->join_with_condition("case_id,case_cuttent_status","tbl_case_status","tbl_case",
"tbl_case_status.case_current_status=tbl_case.case_cuttent_status","inner",array("disposed_id"=>$decided_disposeoff_id));			   		   
		 		
				
				if(!empty($case_current_id))
			   {
				   
				if($case_current_id[0]->case_cuttent_status==4)
				{
					$this->pollution_model->updatedata('tbl_case_status',array("disposed_id"=>$decided_disposeoff_id),$disposed_off);
				}
                else if($case_current_id[0]->case_cuttent_status==5)
                {
					$this->pollution_model->updatedata('tbl_case_status',array("disposed_id"=>$decided_disposeoff_id),$disposed_off);
					
				    if(isset($_FILES['attachment']['name']) && !empty($_FILES['attachment']['name']))
			        {
                     $attachment=$this->pollution_model->get_data("tbl_case_status","attachment",array("disposed_id"=>$decided_disposeoff_id));
                     if(!empty($attachment[0]["attachment"]) && file_exists($attachment[0]["attachment"]))
			         {
			         unlink($attachment[0]["attachment"]);	   	
			         }		            
					 $file_path=$this->upload_pdf_file_for_mobile($decided_disposeoff_id,$userid[0]["id"],'uploads/decided_attachment/');
				     
				     $this->pollution_model->updatedata('tbl_case_status',array("disposed_id"=>$decided_disposeoff_id),array("attachment"=>$file_path));
				   }else
				   {
						  $data["message"]="Upload Pdf File Less Then 5MB";
			              $data["status"]=0;
			              echo json_encode($data);die;
				   }
				
				}else
				{
					      $data["message"]="No authority";
			              $data["status"]=0;
			              echo json_encode($data);die;
					
				}
				   
				$status_type=($case_current_id[0]->case_cuttent_status==4?"disposeoff":"decided");
		        
	            $this->save_data_in_log_from_mobile($status_type,$case_current_id[0]->case_id,$userid[0]["id"],$applicant_email_or_name);	
                $data["message"]="Case Has Been Updated";
			    $data["status"]=1;
			    echo json_encode($data);die;	   
				   
			   }else
               {
				 $data["message"]="No Case Information Found";
			     $data["status"]=0;
			     echo json_encode($data);die;  
				   
			   }
				
		
	}
	///=======this function for display edit page for case decided or disposeoff page========//
	public function edit_page_casedecided_disposeoff_get()
	{
		 $applicant_email_or_name=(isset($_GET["applicant_email_or_name"])?$_GET["applicant_email_or_name"]:'');
		 $device_token=(isset($_GET["device_token"])?$_GET["device_token"]:'');
		 $group_id=(isset($_GET["group_id"])?$_GET["group_id"]:'');
		 $decided_disposeoff_id=(isset($_GET["decided_disposeoff_id"])?$_GET["decided_disposeoff_id"]:'');
		 $validation=array(
		   array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		   array($device_token,"device_token","Device Token Not Found"),
		   array($group_id,"group_id","Group Id Not Found"),
		   array($decided_disposeoff_id,"decided_disposeoff_id","Send Decided_disposeoff Id")
		         );
		 		   
		 $this->check_error_message($validation);
		 $this->load->model('pollution_model');
         $userid=$this->pollution_model->get_data("tb_users","id,group_id,name",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else if($userid[0]["group_id"]==3)
		   {
			   $data["message"]="No authority";
			   $data["status"]=0;
			   echo json_encode($data);die;
		   }
		   
$query="select tbl_case.case_id,tbl_case.case_cuttent_status,tbl_current_status.current_status_name,
concat(tbl_case.case_id,' ',tbl_case.case_letter_number,' ',tbl_case.case_subject) as subject,
 tb_users.name as officername,tbl_case_status.disposed_date as date,tbl_case_status.disposed_remark as remark,
IF(tbl_case_status.attachment!='',concat('".base_url()."',tbl_case_status.attachment), '') as attachment 
from tbl_case_status
inner join tbl_case on (tbl_case_status.case_current_status=tbl_case.case_cuttent_status)
inner join tb_users on (tb_users.id=tbl_case_status.disposed_officer_id) 
inner join  tbl_current_status on( tbl_current_status.current_status_id=tbl_case_status.case_current_status)
where tbl_case_status.disposed_id=".$decided_disposeoff_id."
";	
         $result=$this->pollution_model->custom_query($query);	
		 $data["casedecided_disposeoff_data"]=$result;
		 $data["status"]=1;
		  echo json_encode($data,JSON_UNESCAPED_SLASHES);die;
		 
	}
	//======Display all  users for super admin for mobile======//
	public function display_users_get()
	{
		 $applicant_email_or_name=(isset($_GET["applicant_email_or_name"])?$_GET["applicant_email_or_name"]:'');
		 $device_token=(isset($_GET["device_token"])?$_GET["device_token"]:'');
		 $group_id=(isset($_GET["group_id"])?$_GET["group_id"]:'');
		 $offset=(isset($_GET["offset_num"])?$_GET["offset_num"]:0);
		 $limit=(isset($_GET["limit_num"])?$_GET["limit_num"]:10);
		 $validation=array(
		   array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		   array($device_token,"device_token","Device Token Not Found"),
		   array($group_id,"group_id","Group Id Not Found")
		           );
		 
		 $this->check_error_message($validation);
		 $this->load->model('pollution_model');
		 
		 $userid=$this->pollution_model->get_data("tb_users","id,group_id,name",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else if($userid[0]["group_id"]!=1)
		   {
			   $data["message"]="No authority";
			   $data["status"]=0;
			   echo json_encode($data);die;
		   }
		 
		 $countquery=$this->pollution_model->getdate_select('tb_users','count(*) as total');
		 $total_row=$countquery[0]['total'];
		 $custom_query="select tb_users.id,tb_groups.name,tb_users.username,tb_users.email,tb_users.name,
		 tb_users.gender,tb_users.father_name,tb_users.mobile,states_name.state_name,
		 tbl_districts.dist_name
		 from tb_users left join
		 states_name on(states_name.state_id=tb_users.state) 
		 left join
		 tbl_districts on(tbl_districts.dist_no=tb_users.district)
		 inner join
		 tb_groups on(tb_groups.group_id=tb_users.group_id) order by tb_users.id asc  limit ".$offset.",".$limit."";
		   $usersresult=$this->pollution_model->custom_query($custom_query);
		   $next_offset=$limit+$offset;
		   $previous_offset=$offset-$limit;
		   $next_link=($next_offset<$total_row?1:0);
		   $previous_link=($previous_offset<0?0:1);
		   $usersdata["usersdata"]=$usersresult;
		   $usersdata["next_offset"]=$next_offset;
		   $usersdata["previous_offset"]=$previous_offset;
		   $usersdata["next_link"]=$next_link;
		   $usersdata["previous_link"]=$previous_link;
		   $usersdata["limit"]=$limit;
		   echo json_encode($usersdata,JSON_UNESCAPED_SLASHES);die;	
		 
	}
	//=========this function use for edit case assign page for mobile user for super admin=======//
	public function editcaseassign_get()
	{
		 $applicant_email_or_name=(isset($_GET["applicant_email_or_name"])?$_GET["applicant_email_or_name"]:'');
		 $device_token=(isset($_GET["device_token"])?$_GET["device_token"]:'');
		 $group_id=(isset($_GET["group_id"])?$_GET["group_id"]:'');
		 $case_assign_id=(isset($_GET["case_assign_id"])?$_GET["case_assign_id"]:'');
		 $validation=array(
		   array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		   array($device_token,"device_token","Device Token Not Found"),
		   array($group_id,"group_id","Group Id Not Found"),
		   array($case_assign_id,"case_assign_id","Case Assign Id Not Found")
		           );
		 
		 $this->check_error_message($validation);
		 $this->load->model('pollution_model');
		  $userid=$this->pollution_model->get_data("tb_users","id,group_id,name",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else if($userid[0]["group_id"]!=1)
		   {
			   $data["message"]="No authority";
			   $data["status"]=0;
			   echo json_encode($data);die;
		   }
		 $custom_query="select tbl_case_asign.case_asign_id,tbl_case.case_id,tbl_case_asign.case_asign_officer_id,
		 tbl_case_asign.case_asign_date_of_assign,
		 concat(tbl_case.case_id,' ',tbl_case.case_letter_number,' ',tbl_case.case_subject) as subject
       	 from tbl_case_asign 
		 inner join tbl_case on (tbl_case_asign.case_asign_case_id=tbl_case.case_id)
		 where tbl_case_asign.case_asign_case_id=".$case_assign_id.""; 
		 $case_assign_result=$this->pollution_model->custom_query($custom_query);
		 $officer=$this->pollution_model->get_data("tb_users","id,name",array("group_id"=>2)); 
         $assign_case_data["case_assign_result"]=$case_assign_result; 
		 $assign_case_data["officer"]=$officer;
		 $assign_case_data["status"]=1;
		 echo json_encode($assign_case_data,JSON_UNESCAPED_SLASHES);die;
	}
	//==========this function save edit case assign data for super admin=======================//
	public function save_editcaseassign_post()
	{
		 $applicant_email_or_name=(isset($_POST["applicant_email_or_name"])?$_POST["applicant_email_or_name"]:'');
		 $device_token=(isset($_POST["device_token"])?$_POST["device_token"]:'');
		 $group_id=(isset($_POST["group_id"])?$_POST["group_id"]:'');
		 $case_assign_id=(isset($_POST["case_assign_id"])?$_POST["case_assign_id"]:'');
		 $officer_id=(isset($_POST["officer_id"])?$_POST["officer_id"]:'');
		 $date=(isset($_POST["date"])?$_POST["date"]:'');
		 $validation=array(
		   array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		   array($device_token,"device_token","Device Token Not Found"),
		   array($group_id,"group_id","Group Id Not Found"),
		   array($case_assign_id,"case_assign_id","Case Assign Id Not Found"),
		   array($officer_id,"Officer id","Select Officer Name"),
		   array($date,"date","Enter Date")
		           );
		  $this->check_error_message($validation);
		  $this->load->model('pollution_model');
		  $userid=$this->pollution_model->get_data("tb_users","id,group_id,name",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }else if($userid[0]["group_id"]!=1)
		   {
			   $data["message"]="No authority";
			   $data["status"]=0;
			   echo json_encode($data);die;
		   }
		   $assigncaseid=$this->pollution_model->get_data('tbl_case_asign','case_asign_case_id',array("case_asign_id"=>$case_assign_id));
		   $case_id=$assigncaseid[0]["case_asign_case_id"];
		   $updatefield["case_asign_officer_id"]=$officer_id;
		   $updatefield["case_asign_date_of_assign"]=$date;
		   $updatefield["case_asign_update_date"]=date('Y-m-d');
		   $this->pollution_model->updatedata('tbl_case_asign',array('case_asign_id'=>$case_assign_id),$updatefield);		   
	$this->save_data_in_log_from_mobile('assigned',$case_id,$userid[0]["id"],$applicant_email_or_name);	   
		   $data["message"]="Case Assign Has Been Updated";
		   $data["status"]=1;
		   echo json_encode($data);die;
	}
	//=====This function use to update email for mobile usres=======//
	public function update_email_post()
	{
		 $applicant_email_or_name=(isset($_POST["applicant_email_or_name"])?$_POST["applicant_email_or_name"]:'');
		 $device_token=(isset($_POST["device_token"])?$_POST["device_token"]:'');
		 $group_id=(isset($_POST["group_id"])?$_POST["group_id"]:'');
		 $update_email=(isset($_POST["update_email"])?$_POST["update_email"]:'');
		 $validation=array(
		   array($applicant_email_or_name,"applicant_email_or_name","Send User Email or User Name"),
		   array($device_token,"device_token","Device Token Not Found"),
		   array($group_id,"group_id","Group Id Not Found"),
		   array($update_email,"update_email","Enter Email")
		               );
		  $this->check_error_message($validation);
		  $this->load->model('pollution_model');
		   $userid=$this->pollution_model->get_data("tb_users","id,group_id,name,username,password,name,email",'(email="'.$applicant_email_or_name.'" or 
username="'.$applicant_email_or_name.'") 
and device_token="'.$device_token.'"');

		   if(empty($userid))
		   {
			 $data["message"]="Pass valid email id or username with token";
			 $data["status"]=0;
			 echo json_encode($data);die;
		   }
		   else if (!filter_var($update_email,FILTER_VALIDATE_EMAIL))
		   {
			    $data["message"]="Enter Valid Email";
			    $data["status"]=0;
			    echo json_encode($data);die;
		   }   
            
		  $user=$this->pollution_model->get_data('tb_users','count(*) as total',array('email'=>$update_email));
          $total=$user[0]['total'];
		  if($total)
		  {
			   $data["message"]="Email Already Exist";
			   $data["status"]=0;
			   echo json_encode($data);die;
		  }else
          {
			    $token = md5(uniqid(rand(),true));
				$this->pollution_model->updatedata('tb_users',array('id'=>$userid[0]["id"]),
				array('email'=>$update_email,'token'=>$token,'active'=>0));
				$message='Dear <b>'.strtoupper($userid[0]["name"]).',</b><br><br>
Your Email has been Update of online application of appeals/complaint<br/>
against  "Haryana State Pollution Control Board" to the appellate authority.<br/>
Please click on the following link to activate your account.<br/>
<b>Link:</b>'.base_url()."registration/active_account?email_id=".$userid[0]['email']."&token=".$token.'<br/><br/>
Futher,You can access the account by following credential.<br/><br/>
<b>Url:</b>'.base_url().'user/login<br>
<b>User Name: </b>'.$userid[0]["username"].'<br>
<b>Email Id: </b>'.$update_email.'<br>
<b>Password: </b>'.$this->encriptar('decrypt', $userid[0]['password']).'';
$mail=$this->sentmail($update_email, 'HSPCB', 'Forget Password', $message);
             $data["message"]="Email has been Update.Please check your email for active your account"; 
			 $data["status"]=1;
			 echo json_encode($data);die;
		}			  
	}
	//=======********========//
}	

?>