<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Registration extends SB_controller {

    protected $_key = 'id';
    protected $_class = 'page';
    protected $layout = "layouts/main";
    private $hatron;

    function __construct() {
        parent::__construct();
        $this->layout = 'layouts/' . CNF_THEME . '/index';
        $this->load->driver('cache');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->model('Registration_model');
        $this->load->library('Datatables');
    }

    public function index($page = null) {
        //$this->output->cache(1);

        $this->data['commissioner'] = $this->Hiceoms_model->get_all_bench();
        if (CNF_FRONT == 'false' && $this->uri->segment(1) == '') :
            redirect('dashboard', 301);
        endif;
        if ($page != null) :
            $this->load->model('Page_model');
            $row = $this->Page_model->get_page_result($page);
            if (count($row) >= 1) {

                $this->data['pageId'] = $row->pageID;
                $this->data['pageTitle'] = $row->title;
                $this->data['pageNote'] = $row->note;
                $this->data['pageAlias'] = $row->alias;
                $this->data['left_widget'] = $row->left_widget;
                $this->data['right_widget'] = $row->right_widget;
                $this->data['page_layout'] = $row->page_layout;
                $this->data['is_slider'] = $row->is_slider;
                $this->data['is_gallery'] = $row->is_gallery;
                $this->data['is_gallery_video'] = $row->is_gallery_video;
                $this->data['is_gallery_audio'] = $row->is_gallery_audio;
                $this->data['headerImage'] = $row->header_image;
                $this->data['featureImage'] = $row->feature_image;
                $this->data['breadcrumb'] = 'active';

                if ($row->access != '') {
                    $access = json_decode($row->access, true);
                } else {
                    $access = array();
                }

                // If guest not allowed 
                if ($row->allow_guest != 1) {
                    $group_id = $this->session->userdata('gid');
                    $isValid = (isset($access[$group_id]) && $access[$group_id] == 1 ? 1 : 0 );
                    if ($isValid == 0) {
                        redirect('', 301);
                    }
                }

                if ($row->template == 'backend') {
                    $this->layout = "layouts/main";
                } else {

                    if (empty($row->page_layout) && $row->page_layout == 'NULL' || $row->page_layout == '') {
                        
                    }

                    if ($row->page_layout == 5) {
                        $this->layout = 'layouts/' . CNF_THEME . '/empty';
                    }
                    if ($row->page_layout == 1) {
                        $this->layout = 'layouts/' . CNF_THEME . '/onecolumn';
                    }
                    if ($row->page_layout == 2) {
                        $this->layout = 'layouts/' . CNF_THEME . '/twocolumnwithright';
                    }
                    if ($row->page_layout == 3) {
                        $this->layout = 'layouts/' . CNF_THEME . '/twocolumnwithleft';
                    }
                    if ($row->page_layout == 4) {
                        $this->layout = 'layouts/' . CNF_THEME . '/threecolumn';
                    }
                }

                $filename = "application/views/pages/" . $row->filename . ".php";

                if (file_exists($filename)) {
                    $page = $row->filename;
                } else {
                    redirect('', 301);
                }
            } else {
                redirect('', 301);
            }


        else :
            $page = 'home';
            $this->load->model('Page_model');
            $row = $this->Page_model->get_page_result($page);
            $this->data['pageId'] = $row->pageID;
            $this->data['pageTitle'] = $row->title;
            $this->data['pageNote'] = $row->note;
            $this->data['pageAlias'] = $row->alias;
            $this->data['left_widget'] = $row->left_widget;
            $this->data['right_widget'] = $row->right_widget;
            $this->data['page_layout'] = $row->page_layout;
            $this->data['is_slider'] = $row->is_slider;
            $this->data['headerImage'] = $row->header_image;
            $this->data['featureImage'] = $row->feature_image;


            if (!empty($row->is_slider) && $row->is_slider == 1) {
                $this->data['slider_images'] = $this->Page_model->get_sliderImages_result($row->is_slider);
            }

            $this->data['breadcrumb'] = 'inactive';
            if (trim($row->page_layout) == 5) {
                $this->layout = 'layouts/' . CNF_THEME . '/empty';
            }
            if (trim($row->page_layout) == 1) {
                $this->layout = 'layouts/' . CNF_THEME . '/onecolumn';
            }
            if (trim($row->page_layout) == 2) {
                $this->layout = 'layouts/' . CNF_THEME . '/twocolumnwithright';
            }
            if (trim($row->page_layout) == 3) {
                $this->layout = 'layouts/' . CNF_THEME . '/twocolumnwithleft';
            }
            if (trim($row->page_layout) == 4) {
                $this->layout = 'layouts/' . CNF_THEME . '/threecolumn';
            }
            if ($row->page_layout == 'NULL' || $row->page_layout == '') {
                
            }
        endif;
        $this->data['content'] = $this->load->view('pages/' . $page, $this->data, true);
        $this->load->view($this->layout, $this->data);
    }

    function submitcontact() {
        $rules = array(
            array('field' => 'name', 'label' => ' Please Fill Name', 'rules' => 'required'),
            array('field' => 'email', 'label' => 'email ', 'rules' => 'required|email'),
            array('field' => 'message', 'label' => 'message', 'rules' => 'required'),
        );


        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run()) {

            $data = array(
                'name' => $this->input->post('name', true),
                'email' => $this->input->post('email', true),
                'subject' => 'New Form Submission',
                'notes' => $this->input->post('message', true)
            );
            $message = $this->load->view('emails/contact', $data, true);


            $to = CNF_EMAIL;
            $subject = 'New Form Submission';
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: ' . $this->input->post('name', true) . ' <' . $this->input->post('sender', true) . '>' . "\r\n";
            //mail($to, $subject, $message, $headers);			
            $message = "Thank You , Your message has been sent !";
            $this->session->set_flashdata('message', SiteHelpers::alert('success', $message));
            redirect('contact-us', 301);
        } else {
            $message = "The following errors occurred";
            $this->session->set_flashdata(array(
                'message' => SiteHelpers::alert('error', $message),
                'errors' => validation_errors('<li>', '</li>')
            ));
            redirect('contact-us', 301);
        }
    }

    public function lang($lang) {

        $this->session->set_userdata('lang', $lang);
        redirect($_SERVER['HTTP_REFERER']);
    }

    //Function Added By Abhishek
    function get_dynamic_page_popup($id_key, $id_val, $table) {
        $this->output->cache(1);
        $this->data['id_key'] = $id_key;
        $this->data['id_val'] = $id_val;
        $this->data['table_name'] = $table;

        if ($table == 'tb_stadiums'):
            $this->load->view('layouts/mango/details/popup_stadium.php', $this->data);
        elseif ($table == 'tb_districts'):
            $this->load->view('layouts/mango/details/popup_district.php', $this->data);
        elseif ($table == 'tb_games'):
            $this->load->view('layouts/mango/details/popup_games.php', $this->data);
        endif;
    }

    function employeesinstaffposition($staff_postion = NULL) {
        $this->output->cache(1);
        if ($staff_postion != null) {
            $this->data['staffdata'] = SiteHelpers::get_profiler_by_staffposition($staff_postion);
            $this->layout = 'layouts/' . CNF_THEME . '/index';
            $this->data['content'] = $this->load->view('pages/employeesinstaffposition.php', $this->data, true);

            $this->load->view($this->layout, $this->data, false);
        } else {
            redirect('', 301);
        }
    }

    function galleryimages($id) {

        if ($id) {
            $this->data['id'] = $id;
            $check = SiteHelpers::checkid($id);
            if ($check == 2) {
                redirect('404_override');
            }
            $image = SiteHelpers::getGalleryImagesbygalleryid($id);
            if (empty($image)) {
                redirect('404_override');
            }
            $this->layout = 'layouts/' . CNF_THEME . '/twocolumnwithright';
            $this->data['content'] = $this->load->view('pages/galleryimages.php', $this->data, true);
            $this->load->view($this->layout, $this->data, false);
        } else {
            redirect('image_gallery');
        }
    }

    function registrations() {
        if ($_POST) {
            if ($this->input->post('password') == $this->input->post('confirmpassword')) {
                $this->session->set_flashdata('success', 'Register Successfully');
                redirect('registration');
            } else {
                $this->session->set_flashdata('error', 'Password and Confirm Password does not match');
                redirect('registration');
            }
        }
    }

    function logins() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->session->set_flashdata('error', 'Invalid Username or Password');
            redirect('login');
        }
    }

    function reportuserlogins() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $captcha = base64_decode(base64_decode(trim($this->input->post('captcha'))));
            $captchatext = base64_decode(base64_decode(trim($this->input->post('captchatext'))));
            if (trim($captcha) != trim($captchatext)) {
                $this->session->set_flashdata('error', 'Ops Something went wrong. Please check captcha!');
                redirect('reportuserlogin?backurl=' . $this->input->post('url'));
                exit();
            }
            if (trim($this->input->post('user_email')) == 'legal_reports@gmail.com') {
                $password = base64_decode(base64_decode(trim($this->input->post('user_password'))));
                if (!empty($password) && $password == 'itdeptagoffice') {
                    $_SESSION['reportuser'] = array('user_email' => trim($this->input->post('user_email')), 'user_password' => $password);
                    redirect($this->input->post('url'));
                } else {
                    $this->session->set_flashdata('error', 'Invalid Password');
                    redirect('reportuserlogin?backurl=' . $this->input->post('url'));
                }
            } else {
                $this->session->set_flashdata('error', 'Invalid Email or Password');
                redirect('reportuserlogin?backurl=' . $this->input->post('url'));
            }
        } else {
            redirect('/');
        }
    }

    function reportlogout() {
        session_start();
        session_destroy();
        $this->session->sess_destroy();
        redirect('annual_report', 'refresh');
    }

    function public_suggestion_mail() {
        if ($this->input->is_ajax_request() && $_SERVER['REQUEST_METHOD'] == 'POST') {
            if (SB_Controller::sentmail($this->input->post('email'), 'User', 'Suggestion and Views', strip_tags($_POST['suggestion']), $to_mail = NULL)) {
                echo 1;
                exit;
            } else {
                echo 2;
                exit;
            }
        }
    }

    function searchpage() {
        if ($this->input->is_ajax_request() && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $ResponceData = array();
            if (trim($this->input->post('keyword', TRUE))) {
                $a = trim($this->input->post('keyword'));
                $a = base64_decode(base64_decode($a));
                if (strlen($a) < 3) {

                    $ResponceData['error'] = "Minimum 3 Character use for search";
                    echo json_encode($ResponceData);
                    exit;
                } else {
                    $a = $this->security->xss_clean($a);
                    if (
                            strpos($a, '<script>') !== false ||
                            strpos($a, '<') !== false ||
                            strpos($a, '>') !== false ||
                            strpos($a, '</script>') !== false ||
                            strpos($a, '<?php') !== false ||
                            strpos($a, '<?') !== false ||
                            strpos($a, '<html>') !== false ||
                            strpos($a, '<head>') !== false ||
                            strpos($a, '<body>') !== false ||
                            strpos($a, '?>') !== false) {
                        $ResponceData['error'] = "malicious script not allow  search- " . $a . " Please try another search...";
                        echo json_encode($ResponceData);
                        exit;
                    } else {
                        $keyword = trim($this->input->post('keyword'));
                        if (empty($keyword)) {
                            $ResponceData['error'] = "String can not be empty Please try another search...";
                            echo json_encode($ResponceData);
                            exit;
                        } else {
                            $keyword = base64_decode(base64_decode($keyword));
                            $this->load->model('Page_model');
                            $data['success'] = $this->Page_model->get_search_result($keyword);
                            if (!empty($data['success'])):
                                echo json_encode($data);
                                exit;
                            else:
                                $ResponceData['error'] = "There are no data exist from search- " . $keyword . " Please try another search...";
                                echo json_encode($ResponceData);
                                exit;
                            endif;
                        }
                    }
                }
            }
        } else {
            $ResponceData['error'] = "No direct script access allowed";
            echo json_encode($ResponceData);
            exit;
        }
    }

    function get_decisions_hic() {
        if ($this->input->is_ajax_request()) {
            if (!empty($_POST)) {
                $getdecisions = $this->Hiceoms_model->get_decisions_hic($_POST);
                $postRegNo = $_POST['regNo'];
                $postYearVal = $_POST['yearVal'];
                $this->load->view('layouts/' . CNF_THEME . '/tableformat/decisionsTable', array('searchdata' => $getdecisions, 'postRegNo' => $postRegNo, 'postYearVal' => $postYearVal, 'postData' => $_POST), false);
            }
        }
    }
	
	function get_decisions_hic_new() {
        if ($this->input->is_ajax_request()) {
            if (!empty($_POST)) {
                $getdecisions = $this->Hiceoms_model->get_decisions_hic_new($_POST);
                $postRegNo = '';
                $postYearVal = '';
                $this->load->view('layouts/' . CNF_THEME . '/tableformat/decisionsTableNew', array('searchdata' => $getdecisions, 'postRegNo' => $postRegNo, 'postYearVal' => $postYearVal, 'postData' => $_POST), false);
            }
        }
    }


    function get_couse_list() {
        if ($this->input->is_ajax_request()) {
            if (!empty($_POST)) {
                $getdecisions = $this->Hiceoms_model->get_couse_list($_POST);
                $postFromDate = $_POST['fromdate'];
                $postTodate = $_POST['todate'];
                $postYearVal = '';//$_POST['yearVal'];
                $this->load->view('layouts/' . CNF_THEME . '/tableformat/couseTable', array('searchdata' => $getdecisions, 'postFromDate' => $postFromDate, 'postTodate' => $postTodate, 'postYearVal' => $postYearVal, 'postData' => $_POST), false);
            }
        }
    }
	
	function get_couse_list_new() {
        if ($this->input->is_ajax_request()) {
            if (!empty($_POST)) {
                $getdecisions = $this->Hiceoms_model->get_couse_list_new($_POST);
                $postFromDate = '';
                $postTodate = '';
                $postYearVal = '';//$_POST['yearVal'];
                $this->load->view('layouts/' . CNF_THEME . '/tableformat/couseTableNew', array('searchdata' => $getdecisions, 'postFromDate' => $postFromDate, 'postTodate' => $postTodate, 'postYearVal' => $postYearVal, 'postData' => $_POST), false);
            }
        }
    }
	
	function get_couse_list_homepage() {
        if ($this->input->is_ajax_request()) {
            if (!empty($_POST)) {
                $getdecisions = $this->Hiceoms_model->get_couse_list_homepage();
                $this->load->view('layouts/' . CNF_THEME . '/tableformat/couseTableHome', array('searchdata' => $getdecisions, 'postFromDate' => '', 'postTodate' => '', 'postYearVal' => '', 'postData' => ''), false);
            }
        }
    }

    function get_check_status() {
        if ($this->input->is_ajax_request()) {
            if (!empty($_POST)) {
                $getdecisions = $this->Hiceoms_model->get_check_status($_POST);
                $postRegNo = !empty($_POST['regNo']) ? $_POST['regNo'] : '';
                $postYearVal = !empty($_POST['yearVal']) ? $_POST['yearVal'] : '';
                $this->load->view('layouts/' . CNF_THEME . '/tableformat/checkStatusTable', array('searchdata' => $getdecisions, 'postRegNo' => $postRegNo, 'postYearVal' => $postYearVal, 'postData' => $_POST), false);
            }
        }
    }
	
	function get_check_status_new() {
        if ($this->input->is_ajax_request()) {
            if (!empty($_POST)) {
                $getdecisions = $this->Hiceoms_model->get_check_status($_POST);
                $postRegNo = '';
                $postYearVal = '';
                $this->load->view('layouts/' . CNF_THEME . '/tableformat/checkStatusTableNew', array('searchdata' => $getdecisions, 'postRegNo' => $postRegNo, 'postYearVal' => $postYearVal, 'postData' => $_POST), false);
            }
        }
    }

    function get_decisions_hic_without_post() {
        $getdecisions = $this->Hiceoms_model->get_decisions_hic_without_post();
        $postYearVal = date('Y');
        $this->load->view('layouts/' . CNF_THEME . '/tableformat/decisionsTable', array('searchdata' => $getdecisions, 'postYearVal' => $postYearVal), false);
    }

    function popup($pageId, $tablename) {
        $pagefiles = SiteHelpers::pageFileInfo($pageId, $tablename);
        $this->load->view('layouts/' . CNF_THEME . '/page/popup', array('searchdata' => $pagefiles, 'tablename' => $tablename), false);
    }

    function loadolddesion() {
        $this->load->view('layouts/' . CNF_THEME . '/tableformat/olddecisionofhic', array(), false);
    }

    public function get_old_registration_list() {
        echo $this->Hiceoms_model->old_registration_list();
    }

	 
		/////// register form frontend /////////////
	 function register_save() {
		 $arraySic = array();
       	 $arrayLetter = array();
		 
		 $checkRegistrationEmailId = $this->Registration_model->get_registration_by_email($_POST['email']);
				if(!empty($checkRegistrationEmailId)){
					$this->session->set_flashdata('errors','You already register with this email. Please login');
					redirect('apply-online');
					exit();
				}
				
				        if (!empty($_POST)) 
						{
							$random_password=$this->random_password();
							$password= $this->encriptar('encrypt', $random_password);
							$token = md5(uniqid(rand(),true));
							
							$ip=$_SERVER['HTTP_USER_AGENT'];
							
							
							 $arraySic = array(
								'group_id' => 3,
								'name' => $_POST['aname'],
								'username' => '',
								'mobile' => $_POST['mobile'],
								'email' => $_POST['email'],
								'father_name' => $_POST['fname'],
								'address1' => $_POST['address'],
								'address2' => $_POST['address2'],
								'gender' => $_POST['gender'],
								'organization' => $_POST['organization'],
								'district' => $_POST['district'],
								'father_name' => $_POST['fname'],
								'state' => $_POST['state'],
								'password' => $password,
								'token' => $token,
								'device_token' => $ip
								 );
								  $ID = $this->Registration_model->insert_update_user($arraySic, '');
								  $username=str_replace(' ','',$_POST["aname"]);
								  $username=$username."_*_".$ID;
								  $userdata = $this->Registration_model->insert_update_user(array("username"=>$username), $ID);
								  
								  if (!empty($arraySic['email'])) {
									$emailData = $this->Registration_model->getEmailData(1);
										if ($emailData) 
										{
$message='Dear <b>'.strtoupper($_POST["aname"]).',</b><br><br>
You have been registered for submission of online application of appeals/complaint<br/>
against  "Haryana State Pollution Control Board" to the appellate authority.<br/>
Please click on the following link to activate your account.<br/>
<b>Link:</b>'.base_url()."registration/active_account?email_id=".$_POST['email']."&token=".$token.'<br/><br/>
Futher,You can access the account by following credential.<br/><br/>
<b>Url:</b>'.base_url().'user/login<br>
<b>User Name: </b>'.$username.'<br>
<b>Email Id: </b>'.$_POST["email"].'<br>
<b>Password: </b>'.$this->encriptar('decrypt', $arraySic['password']).'';
$mail=$this->sentmail($arraySic['email'], 'HSPCB', 'User Registration', $message);

									   }
									   
										$this->session->set_flashdata('success','Registration Submitted Successfully!. Please Check Your Email for registration of your Account.');
										redirect('apply-online', 'refresh');
				
									}
				
						}
						else
						{
						$data = array(
								'message' => 'Ops , The following errors occurred',
								'errors' => validation_errors('<li>', '</li>')
								);
								$this->displayError($data);
						}

	 }
	 /////// email activation ////////
	 public function active_account()
	{
		
		  if(isset($_GET["email_id"])&& isset($_GET["token"]))
		  {
			$this->load->model('pollution_model');
		    $data=$this->pollution_model->get_data("tb_users","count(*) as total",array("email"=>$_GET["email_id"],"token"=>$_GET["token"]));  
			if($data[0]["total"]!=0)
            {
				$this->pollution_model->updatedata("tb_users",array("email"=>$_GET["email_id"],"token"=>$_GET["token"]),array("active"=>1,"token"=>''));
			    echo "Congratulations,<br><br><br><br><br><br>Your Account Has Been Activated";
				redirect("activation?y=ok");
			}
            else
            {
				echo "This link is deactived";
				redirect("activation?y=cancel");
			}				
		  }else
          {
			  echo "Valid Information Not Found";
			  redirect("activation?y=error");
		  }			  
		  
	}

	
	public function getwidthnhieght(){
		if(isset($_POST['width']) && isset($_POST['height'])) {
			$_SESSION['screen_width'] = $_POST['width'];
			$_SESSION['screen_height'] = $_POST['height'];
			echo json_encode(array('outcome'=>'success'));
		} else {
			echo json_encode(array('outcome'=>'error','error'=>"Couldn't save dimension info"));
		}
	}
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/page.php */ 