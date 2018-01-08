<?php

//if (!defined('BASEPATH')) exit('No direct script access allowed');
define("ENCRYPT_METHOD", "AES-256-CBC");
define("SECRET_KEY","randomtextrandomtextforthesecretkey");
define("SECRET_IV", "randomtextforthesecretiv");
function pr($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    die;
}

class SB_Controller extends CI_Controller {

    var $data = array();

    function __construct() 
	{
        parent::__construct();
        session_start();
        $_SESSION['loginSession'] = 'Yes';
        if ($this->session->userdata('lang') == '') {
            $this->session->set_userdata('lang', 'en');
            $this->load->language('core', 'en');
        } else {
            $this->load->language('core', $this->session->userdata('lang'));
        }
		$this->checkuserlogin();
	    $this->data['content'] = 'Welcome to SIC Haryana';
        $this->data['page'] = $this->input->get('page', true);

        // init for upload library
        $upload_config = array();
        $this->load->library('upload', $upload_config);

        $imagelib_config = array();
        $this->load->library('image_lib', $imagelib_config);
        $_this = & get_Instance();
        $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
 
    }
	//=====This function use to update email=======//
	public function save_email()
	{
		
		$user_main_id=isset($_POST['user_main_id'])?$_POST['user_main_id']:'';
		/*
		$rules = array(array('field' => 'update_email', 'label' => 'email', 'rules' => 'required|valid_email|is_unique[tb_users.email]|callback_email_check['.$user_main_id.']')
		 );
		 */
$rules = array(array('field' => 'update_email', 'label' => 'email', 'rules' => 'required|valid_email|is_unique[tb_users.email]')
		 );		 
		    $this->form_validation->set_rules($rules);
            if ($this->form_validation->run()) 
			{
				
				
				$this->load->model('pollution_model');
				$update_email=$_POST["update_email"];
				$token = md5(uniqid(rand(),true));
				$user_data=$this->pollution_model->get_data('tb_users','name,username,email,password',array('id'=>$user_main_id));
				$this->pollution_model->updatedata('tb_users',array('id'=>$user_main_id),
				array('email'=>$update_email,'token'=>$token,'active'=>0));
				$message='Dear <b>'.strtoupper($user_data[0]["name"]).',</b><br><br>
Your Email has been Update of online application of appeals/complaint<br/>
against  "Haryana State Pollution Control Board" to the appellate authority.<br/>
Please click on the following link to activate your account.<br/>
<b>Link:</b>'.base_url()."registration/active_account?email_id=".$user_data[0]['email']."&token=".$token.'<br/><br/>
Futher,You can access the account by following credential.<br/><br/>
<b>Url:</b>'.base_url().'user/login<br>
<b>User Name: </b>'.$user_data[0]["username"].'<br>
<b>Email Id: </b>'.$update_email.'<br>
<b>Password: </b>'.$this->encriptar('decrypt', $user_data[0]['password']).'';
$mail=$this->sentmail($update_email, 'HSPCB', 'Forget Password', $message);
              $this->session->set_flashdata('message', SiteHelpers::alert('success', 'Email has been Update.Please check your email for active your account.'));
			}
			else
			{
				
				$errors=validation_errors();
			    $this->session->set_flashdata('message', SiteHelpers::alert('error', $errors));
				redirect('user/profile', 301);
			}
		
	}
	/*public function email_check($email,$id)
	{
		echo "test==>".$id;die;
	}*/
	//====******=======//
	//====Delete data from hearing and status table when data delete from assign table=====//
	public function delete_data_from_assign_case($assign_ids)
	{
		
		$this->load->model('pollution_model');
		$ids_assign=explode(',',$assign_ids);
		
		foreach($ids_assign as $id)
		{
			
			$result=$this->pollution_model->get_data('tbl_case_asign','case_asign_case_id',array('case_asign_id'=>$id));
		   
			$case_id=$result[0]["case_asign_case_id"];
			$this->pollution_model->delete_data('tbl_hearing',array('hearing_case_id'=> $case_id));
			$this->pollution_model->delete_data('tbl_case_status',array('disposed_case_id'=> $case_id));
			$this->pollution_model->updatedata('tbl_case',array('case_id'=>$case_id),array("case_cuttent_status"=>1));
		}
	}
	//======This function get asign and hearing case info========// 
	public function case_asign_hearing_info()
	{
		
		$this->load->model('pollution_model');
		$query="select 
max(tbl_logs.log_id) as log_id ,tbl_logs.log_active,tbl_case.case_id,tbl_case.case_cuttent_status,
tbl_case_asign.case_asign_id,
tbl_case_asign.case_asign_officer_id,
tbl_hearing.hearing_id,tbl_hearing.hearing_officer_id,tbl_case_status.disposed_id 
from tbl_case 
left join tbl_case_asign on 
(tbl_case_asign.case_asign_case_id=tbl_case.case_id) 
left join tbl_hearing on (tbl_hearing.hearing_case_id=tbl_case.case_id)
left join tbl_logs on (tbl_logs.log_case_id=tbl_case.case_id) 
left join tbl_case_status on(tbl_case_status.disposed_case_id=tbl_case.case_id)
where tbl_case.case_cuttent_status in(2,3,4,5) and tbl_case.case_status=1  group by tbl_logs.log_case_id";

	   $get_result=$this->pollution_model->custom_query($query);

	   $new_result=array();
	   $x='';
      foreach($get_result as $row)
	  { 
		unset($x);
		$x=$row["log_id"];
		$new_result[$x]=$row; 

	  }

   return $new_result;	  
	 
	   
	}
	///====check currnet status for case=======//
	public function check_case_exist($case_id)
	{
	   
      $result_hearing=$this->pollution_model->get_data('tbl_hearing','count(*) as total',array('hearing_case_id'=>$case_id));
      $result_asign=$this->pollution_model->get_data('tbl_case_asign','count(*) as total',array('case_asign_case_id'=>$case_id));	  
	  $result_pending=$this->pollution_model->get_data('tbl_case','count(*) as total',array('case_id'=>$case_id));	  
	  if($result_hearing[0]["total"]>0)
	  return "Hearing";
      else if($result_asign[0]["total"]>0)
      return "Assigned";
      else if($result_pending[0]["total"]>0)
      return "Pending";
	}
	//==========================================//
	//====== This fuction insert case history from mobile======// 
	public function save_data_in_log_from_mobile($description_type,$case_id,$user_id,$applicant_email_or_name,$addmessage=null)
	{
		
		    $log_data["log_case_id"]=$case_id;
			$log_data["log_user_id"]=$user_id;
			
			
            $caseinfo=$this->pollution_model->get_data("tbl_case","case_id,case_user_id,case_letter_number,case_subject,case_status",array("case_id"=>$case_id));
			switch($description_type)
			{
				case "case_apply":
				$log_active="Insert";
				$log_description="".$applicant_email_or_name." submit appeal. Appeal subject(case_id letter_number subject) is ".$caseinfo[0]["case_id"]." ".$caseinfo[0]["case_letter_number"]." ".$caseinfo[0]["case_subject"].". Appeal status is pending";
				$message='';
				break;
				case "case_edit":
                $case_status=($caseinfo[0]["case_status"]==1?"Enable":"Disable");
				$log_description="Case ".$caseinfo[0]["case_letter_number"]." and Case Id ".$caseinfo[0]["case_id"]." has been edit and case status is ".$case_status."";
				$log_active="Pending";
				$message='';
				break;
				case "assigned":
				$caseassignusername=$this->pollution_model->get_data("tb_users","username,name",array("id"=>$this->input->post('officer_id',true)));
				$log_description="Case ".$caseinfo[0]["case_letter_number"]." and Case Id ".$caseinfo[0]["case_id"]."  Assigned To ".$caseassignusername[0]["username"]."";
				$log_active="Assigned";
				$message="Case Assign For Hearing To ".$caseassignusername[0]["name"]."";
				break;
				case "hearing":
				$caseassignusername=$this->pollution_model->get_data("tb_users","username,name",array("id"=>$this->input->post('officer_id',true)));
				$log_description="Case ".$caseinfo[0]["case_letter_number"]." and Case Id ".$caseinfo[0]["case_id"]."  Assign For Hearing To ".$caseassignusername[0]["username"]." ".$addmessage."";
				$log_active="Hearing";
				$message="Case Assign For Hearing To ".$caseassignusername[0]["name"]."";
				break;
				case "disposeoff":
				$caseassignusername=$this->pollution_model->get_data("tb_users","username,name",array("id"=>$caseinfo[0]["case_user_id"]));
				$log_description="Case ".$caseinfo[0]["case_letter_number"]." and Case Id ".$caseinfo[0]["case_id"]." of ".$caseassignusername[0]["username"]."  Dispose Off ".$addmessage."";
				$log_active="Dispose Off";
				$message="Case ".$caseinfo[0]["case_letter_number"]." Dispose Off";
				break;
				case "decided":
				$caseassignusername=$this->pollution_model->get_data("tb_users","username,name",array("id"=>$caseinfo[0]["case_user_id"]));
				$log_description="Case ".$caseinfo[0]["case_letter_number"]." and Case Id ".$caseinfo[0]["case_id"]." of ".$caseassignusername[0]["username"]."  Decided ".$addmessage."";
				$log_active="Decided";
				$message="Case ".$caseinfo[0]["case_letter_number"]." Decided";
				break;
				case "delete":
			    $log_description="Case ".$caseinfo[0]["case_letter_number"]." Status Chenged By ".$applicant_email_or_name."";
				$log_active=$this->check_case_exist($case_id);
				$message='';
				break;
				default:
			    $log_description='';
				$message='';
				break;
			}   
			$log_data["log_active"]=$log_active;
			$log_data["log_description"]=$log_description;
			$this->pollution_model->insertdata('tbl_logs', $log_data);
			return $message;
		
	}
	//====end log function========//

	//==== This function use for save logs=======//
	public function save_data_in_log($description_type,$addmessage=null)
	{
		
		    $log_data["log_case_id"]=$this->input->post('case_id',true);
			$log_data["log_user_id"]=$this->session->userdata["user_data"]["id"];
			
			
            $caseinfo=$this->pollution_model->get_data("tbl_case","case_id,case_user_id,case_letter_number,case_status",array("case_id"=>$this->input->post('case_id',true)));
			switch($description_type)
			{
				case "case_edit":
                $case_status=($caseinfo[0]["case_status"]==1?"Enable":"Disable");
				$log_description="Case ".$caseinfo[0]["case_letter_number"]." and Case Id ".$caseinfo[0]["case_id"]." has been edit and case status is ".$case_status."";
				$log_active="Pending";
				break;
				case "assigned":
				$caseassignusername=$this->pollution_model->get_data("tb_users","username,name",array("id"=>$this->input->post('officer_id',true)));
				$log_description="Case ".$caseinfo[0]["case_letter_number"]." and Case Id ".$caseinfo[0]["case_id"]."  Assigned To ".$caseassignusername[0]["username"]."";
				$log_active="Assigned";
				$this->session->set_flashdata('message',"Case Assign For Hearing To ".$caseassignusername[0]["name"]."");
				break;
				case "hearing":
				$caseassignusername=$this->pollution_model->get_data("tb_users","username,name",array("id"=>$this->input->post('officer_id',true)));
				$log_description="Case ".$caseinfo[0]["case_letter_number"]." and Case Id ".$caseinfo[0]["case_id"]."  Assign For Hearing To ".$caseassignusername[0]["username"]." ".$addmessage."";
				$log_active="Hearing";
				$this->session->set_flashdata('message',"Case Assign For Hearing To ".$caseassignusername[0]["name"]."");
				break;
				case "disposeoff":
				$caseassignusername=$this->pollution_model->get_data("tb_users","username,name",array("id"=>$caseinfo[0]["case_user_id"]));
				$log_description="Case ".$caseinfo[0]["case_letter_number"]." and Case Id ".$caseinfo[0]["case_id"]." of ".$caseassignusername[0]["username"]."  Dispose Off ".$addmessage."";
				$log_active="Dispose Off";
				$this->session->set_flashdata('message',"Case ".$caseinfo[0]["case_letter_number"]." Dispose Off");
				break;
				case "decided":
				$caseassignusername=$this->pollution_model->get_data("tb_users","username,name",array("id"=>$caseinfo[0]["case_user_id"]));
				$log_description="Case ".$caseinfo[0]["case_letter_number"]." and Case Id ".$caseinfo[0]["case_id"]." of ".$caseassignusername[0]["username"]."  Decided ".$addmessage."";
				$log_active="Decided";
				$this->session->set_flashdata('message'," Case ".$caseinfo[0]["case_letter_number"]." Decided");
                break;
				case "delete":
				$username=$this->session->userdata["user_data"]["name"];
				$log_description="Case ".$caseinfo[0]["case_letter_number"]." Status Chenged By ".$username."";
				$log_active=$this->check_case_exist($caseinfo[0]["case_id"]);;
				break;
				default:
			    $log_description='';
				break;
			}   
			$log_data["log_active"]=$log_active;
			$log_data["log_description"]=$log_description;
			$this->pollution_model->insertdata('tbl_logs', $log_data);
		
	}//====end log function========//

	// ===Pdf upload function for mobile============//
	function upload_pdf_file_for_mobile($file_id,$user_id,$upload_path,$existsfilename=null)
	{
		               $filename = $_FILES['attachment']['name'];
					   $filename=explode('.',$filename);
	                   $file_name=$filename[0];
                       $filetypetype = $_FILES['attachment']['type'];
					   $extension=strtolower($filetypetype);
                       //$_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                       $fileerror = $_FILES['attachment']['error'];
                       $filesize = $_FILES['attachment']['size'];
					   
					   if($filesize<5242880 && $extension!="application/pdf")
					   {
						   $data["message"]="Upload Only Pdf File. Size Limit Less Then 5MB!";
				           $data["status"]=0;
					       echo json_encode($data);
	                       die;
					   }else
					   {
						   $upload_path = $upload_path;
			               $server_ip = gethostbyname(gethostname());
                           $upload_url = 'http://'.$server_ip.'/uploads/appealpdf/'.$upload_path;
						  
                           $name=$file_name."_".$file_id."_".$user_id;
						   
                           $file_url = $upload_url.$name .'.pdf';
                           $file_path = $upload_path .$name.'.pdf';
						   move_uploaded_file($_FILES['attachment']['tmp_name'],$file_path);
               			   if(isset($existsfilename) && !empty($existsfilename))
						   {
							unlink($existsfilename);   
						   }   
						   return  $file_path;
					   }  
		
	}
	
	
	// ===Pdf upload function============//
	function upload_pdf_file($file_id,$user_id,$upload_path,$link,$existsfilename=null)
	{
		               $filename = $_FILES['attachment']['name'];
					   $filename=explode('.',$filename);
	                   $file_name=$filename[0];
                       $filetypetype = $_FILES['attachment']['type'];
					   $extension=strtolower($filetypetype);
                       //$_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
                       $fileerror = $_FILES['attachment']['error'];
                       $filesize = $_FILES['attachment']['size'];
					   
					   if($filesize<5242880 && $extension!="application/pdf")
					   {
						   $this->session->set_flashdata('errors',"Upload Only Pdf File. Size Limit Less Then 5MB!");
						   redirect($link, 'refresh');
						   //continue;
					   }else
					   {
						   $upload_path = $upload_path;
			               $server_ip = gethostbyname(gethostname());
                           $upload_url = 'http://'.$server_ip.'/uploads/appealpdf/'.$upload_path;
						  
                           $name=$file_name."_".$file_id."_".$user_id;
						   
                           $file_url = $upload_url.$name .'.pdf';
                           $file_path = $upload_path .$name.'.pdf';
						   move_uploaded_file($_FILES['attachment']['tmp_name'],$file_path);
               			   if(isset($existsfilename) && !empty($existsfilename))
						   {
							unlink($existsfilename);   
						   }   
						   return  $file_path;
					   }  
		
	}
   //=========================================================//
	//===== this function stroe all usre data in session after login=======//
    public function checkuserlogin()
	{
		
	   if($this->session->userdata("logged_in")==1)
	   {
		   
	     $data=$this->db->where('id',$this->session->userdata("uid"))->get('tb_users')->row_array();
		 $this->session->set_userdata('user_data', $data);
		 $page_name= $this->uri->segment(1);
		 if(isset($this->session->userdata["user_data"]["group_id"]) && $this->session->userdata["user_data"]["group_id"]==3 && $page_name=="apply-online")
         {
			 redirect(base_url(),'refresh');
		 }
		 
	   }	
	}
	//=================//
	//====Generate Random Password===============//
	public function random_password( $length = 8 ) 
	  {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.";
		$password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
      }
	//================================================//  
	//Password encrepted function---------//
  public function encriptar($action, $string)
   {
     $output = false;
     $key    = hash("sha256", SECRET_KEY);
    $iv     = substr(hash("sha256", SECRET_IV), 0, 16);

    if ($action == "encrypt")
    {
     $output = openssl_encrypt($string, ENCRYPT_METHOD, $key, 0, $iv);
     $output = base64_encode($output);
    }
    else if($action == "decrypt")
    {
        $output = base64_decode($string);
        $output = openssl_decrypt($output, ENCRYPT_METHOD, $key, 0, $iv);
    }
    return $output;
    }
	//===This function check current case status============//
	function check_case_current_status($case_id)
	{
		$this->load->model('pollution_model');
		$case_current_status=$this->pollution_model->get_data('tbl_case','case_cuttent_status,case_status',array('case_id'=>$case_id));
		if(empty($case_current_status))
		{
			redirect(base_url().'dashboard','refresh');
		}else
		{
			return ($case_current_status[0]["case_status"]==1?($case_current_status[0]["case_cuttent_status"]==1?1:0):0);
		   
		}	
		
		
	}
	
	//========#####=========//
    function download() {
        $info = $this->model->makeInfo($this->module);
        $results = $this->model->getRows(array());
        $fields = $info['config']['grid'];
        $rows = $results['rows'];
        $content = $this->data['pageTitle'];
        $content .= '<table border="1">';
        $content .= '<tr>';
        foreach ($fields as $f) {
            if ($f['download'] == '1')
                $content .= '<th style="background:#f9f9f9;">' . $f['label'] . '</th>';
        }
        $content .= '</tr>';

        foreach ($rows as $row) {
            $content .= '<tr>';
            foreach ($fields as $f) {
                if ($f['download'] == '1'):
                    $conn = (isset($f['conn']) ? $f['conn'] : array() );
                    $content .= '<td>' . SiteHelpers::gridDisplay($row->{$f['field']}, $f['field'], $conn) . '</td>';
                endif;
            }
            $content .= '</tr>';
        }
        $content .= '</table>';

        @header('Content-Type: application/ms-excel');
        @header('Content-Length: ' . strlen($content));
        @header('Content-disposition: inline; filename="' . $title . ' ' . date("d/m/Y") . '.xls"');

        echo $content;
        exit;
    }

    function search() {
        $keyword = $this->module;
        if (!is_null($this->input->get('keyword', true))) {
            $keyword = 'administrator/' . $this->module . '?search=' . str_replace(' ', '_', $this->input->get('keyword', true));
        }
        return redirect($keyword);
    }

    function multisearch() {
        //echo '<pre>';print_r($_POST);echo '</pre>';exit;
        $post = $_POST;
        $items = '';
        foreach ($post as $item => $val):
            if ($_POST[$item] != '' and $item != '_token' and $item != 'md' && $item != 'id'):
                $items .= $item . ':' . trim($val) . '|';
            endif;

        endforeach;
        redirect('administrator/' . $this->module . '?search=' . substr($items, 0, strlen($items) - 1));
    }

    function filter() {
        $module = $this->module;
        $sort = (!is_null($this->input->get('sort', true)) ? $this->input->get('sort', true) : '');
        $order = (!is_null($this->input->get('order', true)) ? $this->input->get('order', true) : '');
        $rows = (!is_null($this->input->get('rows', true)) ? $this->input->get('rows', true) : '');
        $md = (!is_null($this->input->get('md', true)) ? $this->input->get('md', true) : '');

        $filter = '?';
        if ($sort != '')
            $filter .= '&sort=' . $sort;
        if ($order != '')
            $filter .= '&order=' . $order;
        if ($rows != '')
            $filter .= '&rows=' . $rows;
        if ($md != '')
            $filter .= '&md=' . $md;



        return redirect('administrator/' . $module . $filter);
    }

    function infoFieldSearch() {
        $info = $this->model->makeInfo($this->module);
        $forms = $info['config']['forms'];
        $data = array();
        foreach ($forms as $f) {
            if ($f['search'] == 1)
                if ($f['alias'] != '') {
                    $data[] = array('id' => $f['alias'] . "." . $f['field']);
                }
        }
        return $data;
    }

    function buildSearch() {
        $keywords = '';
        $fields = '';
        $param = '';
        $allowsearch = $this->info['config']['forms'];
        foreach ($allowsearch as $as)
            $arr[$as['field']] = $as;
        if ($this->input->get('search', true) != '') {
            $type = explode("|", $this->input->get('search', true));
            if (count($type) >= 1) {
                foreach ($type as $t) {
                    $keys = explode(":", $t);

                    if (in_array($keys[0], array_keys($arr))):
                        if ($arr[$keys[0]]['type'] == 'select' || $arr[$keys[0]]['type'] == 'radio') {
                            $param .= " AND " . $arr[$keys[0]]['alias'] . "." . $keys[0] . " = '" . $keys[1] . "' ";
                        } else {
                            $param .= " AND " . $arr[$keys[0]]['alias'] . "." . $keys[0] . " REGEXP '" . $keys[1] . "' ";
                        }
                    endif;
                }
            }
        }
        return $param;
    }

    function comboselect() 
	{
        $param = explode(':', $this->input->get('filter', true));
		
		
        $rows = $this->model->getComboselect($param);
       
		$items = array();

        $fields = explode("|", $param[2]);

        foreach ($rows as $row) {
            $value = "";
            foreach ($fields as $item => $val) {
                if ($val != "")
                    $value .= $row->{$val} . " ";
            }
            $items[] = array($row->{$param['1']}, $value);
        }

        echo json_encode($items);
		
    }

    function comboselectCommisoner() {
        $param = explode(':', $this->input->get('filter', true));
        $rows = $this->model->getComboselectCommisoner($param);
        $items = array();

        $fields = explode("|", $param[2]);

        foreach ($rows as $row) {
            $value = "";
            foreach ($fields as $item => $val) {
                if ($val != "")
                    $value .= $row->{$val} . " ";
            }
            $items[] = array($row->{$param['1']}, $value);
        }

        echo json_encode($items);
    }

    function combotable() {
        $rows = $this->model->getTableList($this->db->database);

        $items = array();
        foreach ($rows as $row) {
            $items[] = array($row, $row);
        }

        echo json_encode($items);
    }

    function combotablefield() {
        $items = array();
        $table = $this->input->get('table', true);
        if ($table != '') {
            $rows = $this->model->getTableField($this->input->get('table', true));
            foreach ($rows as $row)
                $items[] = array($row, $row);
        }
        echo json_encode($items);
    }

    function validateListError($rules) {
        $errMsg = $this->lang->line('core.note_error');
        $errMsg .= '<hr /> <ul>';
        foreach ($rules as $key => $val) {
            $errMsg .= '<li>' . $key . ' : ' . $val[0] . '</li>';
        }
        $errMsg .= '</li>';
        return $errMsg;
    }

    function validateForm() {
        $forms = $this->info['config']['forms'];
        $rules = array();
        foreach ($forms as $form) {
            if ($form['required'] == '' || $form['required'] != '0') {
                $rules[] = array('field' => $form['field'], 'label' => $form['label'], 'rules' => 'required');
            } elseif ($form['required'] == 'alpa') {
                $rules[] = array('field' => $form['field'], 'label' => $form['label'], 'rules' => 'required|alpha');
            } elseif ($form['required'] == 'alpa_num') {
                $rules[] = array('field' => $form['field'], 'label' => $form['label'], 'rules' => 'required|alpha_numeric');
            } elseif ($form['required'] == 'alpa_dash') {
                $rules[] = array('field' => $form['field'], 'label' => $form['label'], 'rules' => 'required|alpha_dash');
            } elseif ($form['required'] == 'email') {
                $rules[] = array('field' => $form['field'], 'label' => $form['label'], 'rules' => 'required|valid_email');
            } elseif ($form['required'] == 'numeric') {
                $rules[] = array('field' => $form['field'], 'label' => $form['label'], 'rules' => 'required|numeric');
            } else {
                
            }
        }

        //echo '<pre>';print_r($rules);echo '<pre>';exit;
        return $rules;
    }

    function validatePost($table = '') {
        $str = $this->info['config']['forms'];
        $data = array();

        foreach ($str as $f) {
            $field = $f['field'];
            if ($f['view'] == 1) {

                if (!is_null($this->input->get($field, true))) {
                    $data[$field] = $this->input->get($field, true);
                }

                switch ($f['type']) {
                    case 'textarea_editor':
                    case 'textarea':
                        $content = $this->input->get_post($field) ? $this->input->get_post($field) : '';
                        $data[$field] = $content;

                        break;

                    case 'file' :
                        $this->load->library('upload');
                        echo $destinationPath = "." . $f['option']['path_to_upload'];

                        $config['upload_path'] = $destinationPath;
                        $config['allowed_types'] = 'gif|jpg|png';

                        $this->upload->initialize($config);
                        if ($this->upload->do_upload($field)) {
                            $file_data = $this->upload->data();
                            $filename = $file_data['file_name'];
                            $extension = $file_data['file_ext']; //if you need extension of the file


                            if ($f['option']['resize_width'] != '0' && $f['option']['resize_width'] != '') {
                                if ($f['option']['resize_height'] == 0) {
                                    $f['option']['resize_height'] = $f['option']['resize_width'];
                                }

                                $origFile = $destinationPath . '/' . $filename;
                                SiteHelpers::cropImage($f['option']['resize_width'], $f['option']['resize_height'], $orgFile, $extension, $orgFile);
                            }

                            $data[$field] = $filename;
                        } else {
                            unset($data[$field]);
                        }

                        break;

                    case 'checkbox' :
                        if (!is_null($this->input->get($field, true))) {
                            $data[$field] = implode(",", $this->input->get_post($field, true));
                        }

                        break;

                    case 'date' :
                        $data[$field] = date("Y-m-d", strtotime($this->input->get_post($field, true)));
                        break;

                    case 'select' :
                        if (isset($f['option']['is_multiple']) && $f['option']['is_multiple'] == 1) {
                            $data[$field] = implode(",", $this->input->get_post($field, true));
                        } else {
                            $data[$field] = $this->input->get_post($field, true);
                        }
                        break;

                    case 'text' :
                    default:
                        $data[$field] = $this->input->get_post($field, true);
                        break;
                }
            }
        }
        $global = (isset($this->access['is_global']) ? $this->access['is_global'] : 0 );
        if ($global == 0)
            $data['entry_by'] = $this->session->userdata('uid');

        return $data;
    }

    function validAccess($methode) {

        if ($this->model->validAccess($methode, $this->info['id']) == false) {
            $this->session->setflashdata('message', SiteHelpers::alert('error', ' Your are not allowed to access the page '));
            return redirect('home');
        }
    }

    function inputLogs($note = NULL) {
        $data = array(
            'module' => $this->uri->segment(1),
            'task' => $this->uri->segment(2),
            'user_id' => $this->session->userdata('uid'),
            'ipaddress' => $this->input->ip_address(),
            'note' => $note
        );
        $this->db->trans_start();
        $this->db->insert('tb_logs', $data);
        $this->db->trans_complete();
    }

    function paginator($options = array()) {

        $keepLive = '';
        $sort = (!is_null($this->input->get('sort', true)) ? $this->input->get('sort', true) : '');
        $order = (!is_null($this->input->get('order', true)) ? $this->input->get('order', true) : '');
        $rows = (!is_null($this->input->get('rows', true)) ? $this->input->get('rows', true) : '');
        $search = (!is_null($this->input->get('search', true)) ? $this->input->get('search', true) : '');

        $appends = array();
        if ($sort != '')
            $keepLive .='&sort=' . $sort;
        if ($order != '')
            $keepLive .='&order=' . $order;
        if ($rows != '')
            $keepLive .='&rows=' . $rows;
        if ($search != '')
            $keepLive .='&search=' . $search;

        $toptions = array_replace_recursive(array(
            'base_url' => site_url('administrator/' . $this->module) . '?' . $keepLive,
            'total_rows' => 0,
            'per_page' => $this->per_page,
                ), $options);
        $this->pagination->initialize($toptions);

        return $this->pagination->create_links();
    }

    function displayError($data) {
        $this->load->view('layouts/errors', $data);
    }

    function do_upload($folder_name, $file_name, $allowed_types = 'gif|jpg|jpeg|png') {
        $config['upload_path'] = './uploads/' . $folder_name;
        $config['allowed_types'] = "*";
        $config['max_size'] = '10000000';
        $config['overwrite'] = false;
        $config['encrypt_name'] = FALSE;
        $config['remove_spaces'] = TRUE;
        if (!is_dir($config['upload_path']))
            return 1;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($file_name)) {
            return 2;
        } else {
            return array('upload_data' => $this->upload->data());
        }
    }

    function get_media($file, $height, $width, $align) {
        if ($file) {
            if (strpos($file, '.jpg') != false || strpos($file, '.png') != false || strpos($file, '.gif') != false || strpos($file, '.jpeg') != false) {
                return "<img src='" . base_url() . "uploads/media/" . $file . "' class='img-responsive' height='" . $height . "' width='" . $width . "' align='" . $align . "' />";
            }
            if (strpos($file, '.mp4') != false) {
                return "<video width='" . $width . "' height='" . $height . "' src='" . base_url() . "uploads/media/" . $file . "' align='" . $align . "' type='video/mp4' id='player1' poster='" . base_url() . "uploads/media/echo-hereweare.jpg' controls='controls' preload='none'></video>";
            }
            if (strpos($file, '.mp3') != false) {
                return "<audio id='player2' src='" . base_url() . "uploads/media/" . $file . "' type='audio/mp3' align='" . $align . "' controls='controls'></audio>";
            }
        }
    }

    function get_url($file, $height, $width, $align) {
		echo end(explode('.',$file));
		die;
        if ($file) {
            return "
					<iframe src='" . $file . "' width='" . $width . "' height='" . $height . "' align='" . $align . "' frameborder='0'></iframe>
			";
        }
    }

    function get_form($form_id) {
        if ($form_id) {
            $field_data = $this->db->query('select * from tb_form_field where field_form_id="' . $form_id . '" and 	field_status="enable" order by field_order asc')->result_array();
            $form_data = $this->db->get_where('tb_forms', array('form_status' => 'enable', 'form_id' => $form_id))->row_array();
            $return_data = '';
            if ($form_data) {

                $form_class = !empty($form_data['form_class']) ? "class='form-horizontal " . $form_data['form_class'] . "'" : "class='form-horizontal'";
                $form_id = !empty($form_data['form_ids']) ? "id='" . $form_data['form_ids'] . "'" : '';
                $form_action = "action='" . base_url() . $form_data['form_action'] . "'";
                $post = "method='post'";
                $return_data.="";
                //$return_data. = "<form " . $form_class . " " . $form_id . " ".$form_action." ".$post." >";
                $return_data.="<form " . $form_class . " " . $form_id . " " . $form_action . " " . $post . ">";
                $count_textarea_editor = 0;
                if ($field_data) {
                    if ($form_data['form_post'] == 1):
                        $return_data.="<div id='message" . trim($form_data['form_ids']) . "' style='background: green none repeat scroll 0 0; border: 1px solid #c1c1c1;  color: #fff; font-size: 18px; margin-bottom: 20px; margin-left: 0; padding: 10px;display:none;'></div>";
                    endif;
                    foreach ($field_data as $value) {
                        $class = !empty($value['field_class']) ? "class='" . $value['field_class'] . "'" : '';
                        $id = !empty($value['fiel_id_type']) ? "id='" . $value['fiel_id_type'] . "'" : '';
                        $required = (!empty($value['field_required']) && $value['field_required'] == 1) ? "required" : '';
                        $field_value = !empty($value['field_value']) ? "value='" . $value['field_value'] . "'" : '';
                        if ($value['field_type'] == 1) {
                            $return_data.="<div class='form-group'>";
                            $return_data.="<label class='control-label col-sm-2' for='" . $value['field_name'] . "'>" . $value['field_label'] . "</label>";
                            $return_data.="<div class='col-sm-10'>";
                            $return_data.="<input type='text' name='" . $value['field_name'] . "' " . $class . " " . $id . " " . $required . " " . $field_value . " />";
                            $return_data.="</div>";
                            $return_data.="</div>";
                        }
                        if ($value['field_type'] == 3) {
                            $field_value = '';
                            $field_value = !empty($value['field_value']) ? $value['field_value'] : '';
                            $return_data.="<div class='form-group'>";
                            $return_data.="<label class='control-label col-sm-2' for='" . $value['field_name'] . "'>" . $value['field_label'] . "</label>";
                            $return_data.="<div class='col-sm-10'>";
                            $return_data.="<textarea name='" . $value['field_name'] . "' " . $class . " " . $id . " " . $required . " rows='5' >" . $field_value . "</textarea>";
                            $return_data.="</div>";
                            $return_data.="</div>";
                        }
                        if ($value['field_type'] == 4) {
                            $class = '';
                            $class = !empty($value['field_class']) ? "class='ckeditor " . $value['field_class'] . "'" : "class='ckeditor'";
                            $field_value = '';
                            $field_value = !empty($value['field_value']) ? $value['field_value'] : '';
                            $return_data.="<div class='form-group'>";
                            $return_data.="<label class='control-label col-sm-2' for='" . $value['field_name'] . "'>" . $value['field_label'] . "</label>";
                            $return_data.="<div class='col-sm-10'>";

                            $return_data.="<textarea name='" . $value['field_name'] . "' " . $class . " " . $id . " " . $required . " rows='5' >" . $field_value . "</textarea>";
                            $return_data.="</div>";
                            $return_data.="</div>";
                            $count_textarea_editor++;
                        }
                        if ($value['field_type'] == 9) {
                            $return_data.="<input type='hidden' name='" . $value['field_name'] . "' " . $class . " " . $id . " " . $required . " " . $field_value . " />";
                        }
                        if ($value['field_type'] == 10) {
                            $return_data.="<div class='form-group'>";
                            $return_data.="<label class='control-label col-sm-2' for='" . $value['field_name'] . "'>" . $value['field_label'] . "</label>";
                            $return_data.="<div class='col-sm-10'>";

                            $return_data.="<input type='submit' name='" . $value['field_name'] . "' " . $class . " " . $id . " " . $required . " " . $field_value . " />";
                            $return_data.="</div>";
                            $return_data.="</div>";
                        }
                        if ($value['field_type'] == 11) {
                            $return_data.="<div class='form-group'>";
                            $return_data.="<label class='control-label col-sm-2' for='" . $value['field_name'] . "'>" . $value['field_label'] . "</label>";
                            $return_data.="<div class='col-sm-10'>";

                            $return_data.=$value['field_label'] . "<input type='button' name='" . $value['field_name'] . "' " . $class . " " . $id . " " . $required . " " . $field_value . " />";
                            $return_data.="</div>";
                            $return_data.="</div>";
                        }
                    }

                    $return_data.="</form>";

                    if ($count_textarea_editor > 0) {
                        $return_data.='<script type="text/javascript" src="' . base_url() . 'administrator/ckeditor/ckeditor.js"></script>';
                    }
                    if ($form_data['form_post'] == 1):
                        $return_data.= "<script type='text/javascript'>
                                        
                                         $('#" . trim($form_data['form_ids']) . "').submit(function (event) {
                                                 $('html, body').animate({ scrollTop: 0 }, 'slow');
                                                event.preventDefault();
                                                var formData = $(this).serialize();
                                                call_page_loader(1);
                                                $.ajax({
                                                    type: $(this).attr('method'),
                                                    url: $(this).attr('action'),
                                                    data: formData,
                                                    success: function (data) {
                                                    if($.trim(data) == 1){
                                                    $('#message" . trim($form_data['form_ids']) . "').show();
                                                        $('#message" . trim($form_data['form_ids']) . "').html('Thanks for connecting with us. We will contact you shortly');
                                                             call_page_loader(2);
                                                                $('#" . trim($form_data['form_ids']) . " input[type=text]').val('');
                                                                $('#" . trim($form_data['form_ids']) . " textarea').html('');
                                                                $('#" . trim($form_data['form_ids']) . " textarea').val('');
                                                                $('#" . trim($form_data['form_ids']) . " select').val('');
                                                              $('html, body').animate({
                                                                    scrollTop: $('#message" . trim($form_data['form_ids']) . "').offset().top
                                                                }, 2000);
                                                              $('#message" . trim($form_data['form_ids']) . "').fadeOut(10000); 
                                                    }else{
                                                     $('#message" . trim($form_data['form_ids']) . "').show();
                                                        $('#message" . trim($form_data['form_ids']) . "').html(data);
                                                             call_page_loader(2);
                                                              $('html, body').animate({
                                                                    scrollTop: $('#message" . trim($form_data['form_ids']) . "').offset().top
                                                                }, 2000);
                                                                $('#message" . trim($form_data['form_ids']) . "').fadeOut(10000); 
                                                    }
                                                    },
                                                    error: function(){
                                                        alert('error in ajax form submission');
                                                        }
                                                });

                                        return false;
                                        });
					</script>";

                    endif;
                    return $return_data;
                } else {

                    return $return_data;
                }
            }
        }
    }

    public static function show_date($date) {
        if ($date == '') {
            return '';
        } else if ($date == '0000-00-00 00:00:00') {
            return '';
        } else if ($date == 'NULL') {
            
        } else {
            return date('d-M-Y', strtotime($date));
        }
    }

    public static function my_slider($id) {
        $html = '';
        $q = SiteHelpers::getSliderImages($id);
        if (!empty($q)) {
            $html.="<div class='flexslider'><ul class='slides'>";
            foreach ($q as $rows) {
                $html.= "<li>
                <img src='" . base_url() . "uploads/sliderImages/" . $rows['slider_image_path'] . "' alt='slider image' />
                <p class='flex-caption'>" . $rows['slider_image_content'] . "</p>
                </li>";
            }

            $html.="  </ul></div>";
        }
        return $html;
    }

    public static function getrow_as_id_as_key($table_name, $keyValue, $where_data_array = NULL) {
        $_this = & get_Instance();
        $result = array();
        if ($where_data_array) {
            foreach ($where_data_array as $key => $data) {
                $_this->db->where($key, $data);
            }
        }
        $q = $_this->db->get($table_name)->result_array();
        if (!empty($q)) {
            foreach ($q as $rows) {
                $result[$rows[$keyValue]] = $rows;
            }
        }
        return $result;
    }

    public static function custom_category_post($id, $show_no_pages = NULL) {
        $_this = & get_Instance();
        $categories = $_this->getrow_as_id_as_key('tb_categories', 'category_id', array('category_status' => 'enable'));
        $result = array();
        if (!empty($id)) {
            $ids = explode(',', $id);
            foreach ($ids as $id) {
                if (!empty($categories[$id]['category_title'])) {

                    $_this->db->where_in('categories_id', $id);
                    $_this->db->order_by('categories_id', 'asc');
                    $pages = $_this->db->get_where('tb_pages', array('status' => 'enable'))->result_array();
                    if ($show_no_pages) {
                        $i = 0;
                        foreach ($pages as $rows) {
                            $result[][$categories[$id]['category_title']] = $rows['title'];
                            if ($i == $show_no_pages) {
                                break;
                            }

                            $i++;
                        }
                    } else {
                        foreach ($pages as $rows) {
                            $result[][$categories[$id]['category_title']] = $rows['title'];
                        }
                    }
                }
            }
        }

        return $result;
    }

    public static function get_post_by_category($id, $show_no = NULL) {
        $_this = & get_Instance();
        $result = array();
        if ($id) {
            $_this->db->trans_start();
            $_this->db->where_in('categories_id', $id);
            $_this->db->order_by('created', 'desc');
            $_this->db->limit($show_no);
            $pages = $_this->db->get_where('tb_pages', array('status' => 'enable'))->result_array();
            $_this->db->trans_complete();
        }

        return $pages;
    }

    function check_report_auth($url) {

        if (isset($_SESSION['reportuser'])) {

            return TRUE;
        } else {

            if ($this->uri->uri_string == 'reportuserlogin') {

                return TRUE;
            } else {


                $this->session->set_userdata('redirect_uri', $this->uri->uri_string);
                redirect('reportuserlogin/?backurl=' . $url, 'refresh');
            }
        }
    }

    public static function encodekey() {
        $msg = 'its secret';
        $_this = & get_Instance();
        $encrypted_string = $_this->encrypt->encode($msg);
        return $encrypted_string;
    }

    function post_to_url($url, $data) {
        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= $key . '=' . $value . '&';
        }
        rtrim($fields, '&');
        $post = curl_init();
        curl_setopt($post, CURLOPT_URL, $url);
        curl_setopt($post, CURLOPT_POST, count($data));
        curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($post);
        curl_close($post);
        return $result;
    }

    function smsPostData($bulksms = null, $bulkno = null, $message, $number) {
        $smsData = array(
            "username" => USERNAME, // type your assigned username here(for example: "username" => "CDACMUMBAI")
            "password" => PASSWORD, //type your password
            "senderid" => SENDERID, //type your senderID
            "smsservicetype" => SINGLESERVICE, //*Note* for single sms enter ”singlemsg” , for bulk enter “bulkmsg”
            "mobileno" => "7307642729", //enter the mobile number
            "bulkmobno" => "", //enter the mobile numbers separated by commas, in case of bulk sms otherwise leave it blank
            "content" => $message //type the message.
        );

        if ($bulksms && $bulkno) {
            $smsData['smsservicetype'] = BULKSERVICE;
            $smsData['bulkmobno'] = $bulkno;
        }

        if ($number) {
            $smsData['mobileno'] = $number;
        }
        $getResult = $this->post_to_url("http://msdgweb.mgov.gov.in/esms/sendsmsrequest", $smsData);
        return $getResult;
    }

    function sentmail($email, $name, $subject, $message,$attach = null) {
        $this->load->library('email');
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.haryanasahityasangam.org',
            'smtp_port' => 25,
            'smtp_user' => 'noreply@haryanasahityasangam.org',
            'smtp_pass' => 'utsav2017',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        $config['newline'] = "\r\n";
        $config['validation'] = TRUE;
        $this->email->initialize($config);

        $this->email->set_newline("\r\n");
        $this->email->from($email, 'Haryana State Pollution Control Board');
		$data["email_message"]=$message;
		
		//$data["image_path"]=$this->email->attach(base_url()."logo.png"); 
		$message = $this->load->view('emails/registration.php',$data,true);
        if ($email):
            $this->email->to(trim($email), $name);
            //$this->email->cc('webgis2001@gmail.com');
            //$this->email->bcc('webgis2001@gmail.com');
        else:
            $this->email->to('webgis2001@gmail.com');
        endif;
        $this->email->subject($subject);
        $this->email->message($message);
		if($attach){
			$this->email->attach($attach);
		}
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

}

?>