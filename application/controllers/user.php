<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends SB_controller {

    protected $_key = 'id';
    protected $_class = 'welcome';
    protected $_model = 'usersmodel';

    function __construct() {
        parent::__construct();
    }

    public function index() {
        if (!empty($_SESSION['loginSession'])) {
            redirect('user/login', 301);
            exit();
        }
    }
	public function getpassword($string)
	{
		
		echo "password==".$this->encriptar("decrypt", $string);
		die;
	}
	// ===this function use for forget password=====/
   function forget_password()
	{
		   if($_POST)
		   {
			  $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
       		  if ($this->form_validation->run() == FALSE)
		      {
			  $errors=validation_errors();
			  $this->session->set_flashdata('errors',$errors);
			  }else
              {
				$this->load->model('pollution_model');  
				$hasemail=$this->pollution_model->get_data('tb_users','username,name,password,email,token,active',array("email"=>$this->input->post('email',true))); 
			    if(!empty($hasemail))
				{
					$name=$hasemail[0]["name"];
					$username=$hasemail[0]["username"];
					$email=$hasemail[0]["email"];
					$token=$hasemail[0]["token"];
					$password=$this->encriptar('decrypt', $hasemail[0]["password"]);
					$addmessage='';
					if($hasemail[0]["active"]==0)
				   {
					   $addmessage="Your account is not activate.To activate account click on the following link or copy-paste 
					   in your browser.<br>".base_url()."registration/active_account?email_id=".$email."&token=".$token."";
					   
				   }
                   $message="Dear <b>".strtoupper($name)."</b>,<br/>
                    Your login details.<br/>
				    <b>User Name: </b>".$username."<br/>
                    <b>Email_id: </b>".$email."<br/>
                    <b>Password: </b>".$password."<br/>You can login with email id or name.<br/>".$addmessage."<br/>"; 
                   $this->sentmail($email, $name, 'Forget Password', $message);	
                   $this->session->set_flashdata('success',"Your Login Detail Has Been Send Your Email Id<br>".$email."");
				   
				}else
				{
					$this->session->set_flashdata('errors',"This Email Is Not Exist");
				}
			  }				  
			 redirect('/user/forget_password', 'refresh');  
		   }   
            $this->data['content'] = $this->load->view('user/forget_password', $this->data, true);
            $this->load->view('layouts/login', $this->data);
       
	}
	//==============================#######============/
    public function profile() {
        if (!empty($_SESSION['loginSession'])) {
            if (!$this->session->userdata('logged_in')) {
                redirect('user/login', 301);
                exit();
            }

            $info = $this->db->get_where('tb_users', array('id' => $this->session->userdata('uid')));
			$districts=$this->db->where("dist_no !=",0)->get("tbl_districts")->result_array();
            
			$this->data = array(
                'pageTitle' => 'My Profile',
                'pageNote' => 'View Detail My Info',
                'info' => $info->row(),
				'districts'=>$districts
            );
			
			$this->data['user_id']=$this->session->userdata('uid');
            $this->data['content'] = $this->load->view('user/profile', $this->data, true);
            $this->load->view('layouts/main', $this->data);
        }
    }

    public function saveProfile() {
        if (!empty($_SESSION['loginSession'])) {
            if (!$this->session->userdata('logged_in')) {
                redirect('user/login', 301);
                exit();
            }
			//print_r($this->session->userdata);die;
			 $group_id=$this->input->post('group_id', true);
            if($group_id==1)
			{
			  $rules = array(
                array('field' => 'name', 'label' => 'Name', 'rules' => 'required'));
            }else
			{
			      $rules = array(
				array('field' => 'organization', 'label' => 'Organization', 'rules' => 'required'),
                array('field' => 'name', 'label' => 'Name', 'rules' => 'required'),
                array('field' => 'father_name', 'label' => 'Father Name', 'rules' => 'required'),
				array('field' => 'mobile', 'label' => 'Mobile', 'rules' => 'required'),
				array('field' => 'address1', 'label' => 'Address1', 'rules' => 'required'),
				array('field' => 'address2', 'label' => 'Address1', 'rules' => 'required')
				
				
              );	
		    }
            if ($this->input->post('email', true) != $this->session->userdata('eid') && $group_id==1) 
			{
				
                $rules[] = array('field' => 'email', 'label' => 'Email Address', 'rules' => 'required|email|is_unique[tb_users.email]');
            }


            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run()) {
                 if($group_id==1)
			    {
					
					$data = array(
                    'name' => $this->input->post('name', true),
					'email' => $this->input->post('email', true)
					);
                
                }else
				{
					$data = array(
                    'name' => $this->input->post('name', true),
                    'organization' => $this->input->post('organization', true),
					'father_name' => $this->input->post('father_name', true),
					'mobile' => $this->input->post('mobile', true),
					'state' => $this->input->post('state', true),
					'district' => $this->input->post('district', true),
					'address1' => $this->input->post('address1', true),
					'address2' => $this->input->post('address2', true),
					'gender' => $this->input->post('gender', true)
					
                );
					
				}
                if (!empty($_FILES['avatar']['name'])) {
                    $this->load->library('upload');
                    $destinationPath = "./uploads/users/";

                    $config['upload_path'] = $destinationPath;
                    $config['allowed_types'] = 'gif|jpg|png';
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('avatar')) {
                        $file_data = $this->upload->data();
                        $data['avatar'] = $file_data['file_name'];
                    } else {
                        $this->session->set_flashdata('message', SiteHelpers::alert('error', 'Allow gif|jpg|png file only'));
                        redirect('user/profile', 301);
                    }
                }
                $this->db->trans_start();
                $this->db->where('id', $this->session->userdata('uid'));
               
			   $this->db->update('tb_users', $data);
                $this->db->trans_complete();
                $this->session->set_flashdata('message', SiteHelpers::alert('success', 'Your Profile has been updated succesfuly'));
                redirect('user/profile', 301);
            } else {
  
                $this->session->set_flashdata('message', SiteHelpers::alert('error', 'Ops Something went wrong !'));
                redirect('user/profile', 301);
            }
        }
    }

    public function savePassword() {
        if (!empty($_SESSION['loginSession'])) {
            if (!$this->session->userdata('logged_in')) {
                redirect('user/login', 301);
                exit();
            }

            $rules = array(
                array('field' => 'password', 'label' => 'password', 'rules' => 'required'),
                array('field' => 'password_confirmation', 'label' => 'password confirmation', 'rules' => 'required|matches[password]'),
                array('field' => 'captcha', 'label' => 'captcha required', 'rules' => 'required'),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run()) {
                $captcha = base64_decode(base64_decode($this->input->post('captcha')));
                $captchatext = base64_decode(base64_decode($this->input->post('captchatext')));

                if (trim($captcha) != trim($captchatext)) {
                    $this->session->set_flashdata('message', SiteHelpers::alert('error', 'Ops Something went wrong. Please check captcha!'));
                    redirect('user/profile', 301);
                } else {
                    $password = explode('&', $this->input->post('password'));
                    $password = base64_decode(base64_decode(end($password)));
                    //===== password encrypt by base64_encode =====// 
					$password=$this->encriptar('encrypt',trim($password));
					$data = array('password' =>$password);
					//=======########====================//
					//$data = array('password' => md5(trim($password)));
                    $this->db->trans_start();
                    $this->db->where('id', $this->session->userdata('uid'));
                    $this->db->update('tb_users', $data);
                    $this->db->trans_complete();
                    $this->session->set_flashdata('message', SiteHelpers::alert('success', 'Your password has been changed succesfuly'));
                    redirect('user/profile', 301);
                }
            } else {
                $this->session->set_flashdata('message', SiteHelpers::alert('error', 'Ops Something went wrong !'));
                redirect('user/profile', 301);
            }
        }
    }

    public function login() {
        if (!empty($_SESSION['loginSession'])) {
            $this->data['content'] = $this->load->view('user/login', $this->data, true);
            $this->load->view('layouts/login', $this->data);
        }
    }

    public function postLogin() {
        if (empty($_POST['loginval'])) {
            redirect('user/login');
        }
		
        $password = explode('&', trim($this->input->post('password')));
		
        $password = base64_decode(base64_decode($password[1]));
		
   $password_encrypt=$this->encriptar('encrypt', $password);
        $row = $this->db->query("SELECT "
                . "`tb_users`.* "
                . " FROM (`tb_users`)  WHERE (`email` = '".trim($this->input->post('email'))."' OR username = '".trim($this->input->post('email'))."') AND (`password` = '".md5(trim($password))."' OR `password`='".$password_encrypt."') AND `active` = '1'")->row();;
        
		
        if (count($row) >= 1) {
            $this->session->set_userdata(array(
                'logged_in' => true,
                'uid' => $row->id,
                'gid' => $row->group_id,
                'eid' => $row->email,
                'll' => $row->last_login,
                'fid' => $row->first_name . ' ' . $row->last_name,

              
            ));
            redirect('user/profile', 301);
        } else {
            $this->session->set_flashdata('message', SiteHelpers::alert('error', 'Invalid email or password combination <br /> or your account is not active yet'));
            redirect('user/login', 301);
        }
    }

    public function register() {
        if (!empty($_SESSION['loginSession'])) {
            if (CNF_REGIST == 'false') :
                if ($this->session->userdata('logged_in')):
                    redirect('', 301);
                else:
                    redirect('user/login', 301);
                endif;

            else :
                $this->data['content'] = $this->load->view('user/register', $this->data, true);
                $this->load->view('layouts/login', $this->data);
            endif;
        }
    }

    public function create() {
        if (!empty($_SESSION['loginSession'])) {
            $rules = array(
                array('field' => 'firstname', 'label' => 'firstname', 'rules' => 'required'),
                array('field' => 'lastname', 'label' => 'lastname', 'rules' => 'required'),
                array('field' => 'email', 'label' => 'email', 'rules' => 'required|email|is_unique[tb_users.email]'),
                array('field' => 'password', 'label' => 'password', 'rules' => 'required'),
                array('field' => 'password_confirmation', 'label' => 'password_confirmation', 'rules' => 'required'),
            );

            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run()) {



                $captcha = base64_decode(base64_decode($this->input->post('captcha')));

                $captchatext = base64_decode(base64_decode($this->input->post('captchatext')));
                if (trim($captcha) != trim($captchatext)) {
                    $this->session->set_flashdata('message', SiteHelpers::alert('error', 'Ops Something went wrong. Please check captcha!'));
                    redirect('user/register', 301);
                    exit();
                }
                $code = rand(10000, 10000000);
                $password = explode('&', $this->input->post('password'));
                $password = base64_decode(base64_decode(end($password)));
                $authen = array(
                    'first_name' => $this->input->post('firstname', true),
                    'last_name' => $this->input->post('lastname', true),
                    'email' => $this->input->post('email', true),
                    'activation' => $code,
                    'group_id' => CNF_GROUP,
                    'password' => md5(trim($password)),
                );
                if (CNF_ACTIVATION == 'auto') {
                    $authen['active'] = '1';
                } else {
                    $authen['active'] = '0';
                }
                $this->db->trans_start();
                $this->db->insert('tb_users', $authen);
                $this->db->trans_complete();

                $data = array(
                    'firstname' => $this->input->post('firstname'),
                    'lastname' => $this->input->post('lastname'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                    'code' => $code
                );
                if (CNF_ACTIVATION == 'confirmation') {
                    $to = $this->input->post('email');
                    $subject = "[ " . CNF_APPNAME . " ] REGISTRATION ";
                    $message = $this->load->view('emails/registration', $data, true);
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= 'From: ' . CNF_APPNAME . ' <' . CNF_EMAIL . '>' . "\r\n";
                    mail($to, $subject, $message, $headers);

                    $message = "Thanks for registering! . Please check your inbox and follow activation link";
                } elseif (CNF_ACTIVATION == 'manual') {
                    $message = "Thanks for registering! . We will validate you account before your account active";
                } else {
                    $message = "Thanks for registering! . Your account is active now ";
                }

                $this->session->set_flashdata('message', SiteHelpers::alert('success', $message));
                redirect('user/login', 301);
            } else {
                $this->session->set_flashdata('message', SiteHelpers::alert('error', 'Ops Something Went Wrong'));
                redirect('user/register', 301);
            }
        }
    }

    public function activation() {
        if (!empty($_SESSION['loginSession'])) {
            $num = $this->input->get('code', true);
            if ($num == '') {
                $this->session->set_flashdata('message', SiteHelpers::alert('error', 'Invalid Code Activation!'));
                redirect('user/login', 301);
            }
            $user = $this->db->get_where('tb_users', array('activation' => $num))->row();
            if (count($user) >= 1) {
                $data = array('active' => 1, 'activation' => '');
                $this->db->trans_start();
                $this->db->where('activation', $num);
                $this->db->update('tb_users', $data);
                $this->db->trans_complete();

                $this->session->set_flashdata('message', SiteHelpers::alert('success', 'Your account is active now!'));
                redirect('user/login', 301);
            } else {

                $this->session->set_flashdata('message', SiteHelpers::alert('error', 'Invalid Code Activation!'));
                redirect('user/login', 301);
            }
        }
    }

    public function saveRequest() {
        if (!empty($_SESSION['loginSession'])) {
            $rules = array(
                array('field' => 'credit_email', 'label' => 'credit email', 'rules' => 'required|email'),
            );
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run()) {
                $user = $this->db->get_where('tb_users', array('email' => $this->input->post('credit_email', true)))->row();
                if (count($user) >= 1) {
                    $token = rand(10000, 10000000);
                    $data = array('token' => $token);
                    $to = $this->input->post('credit_email', true);
                    $subject = "[ " . CNF_APPNAME . " ] REQUEST PASSWORD RESET ";
                    $message = $this->load->view('emails/reminder', $data, true);
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= 'From: ' . CNF_APPNAME . ' <' . CNF_EMAIL . '>' . "\r\n";
                    mail($to, $subject, $message, $headers);
                    $data = array('reminder' => $token);
                    $this->db->where('id', $user->id);
                    $this->db->update('tb_users', $data);

                    $this->session->set_flashdata('message', SiteHelpers::alert('success', 'Please check your email and follow reset link '));
                    redirect('user/login', 301);
                } else {
                    $this->session->set_flashdata('message', SiteHelpers::alert('error', 'Cant find email address'));
                    redirect('user/login', 301);
                }
            } else {
                $this->session->set_flashdata('message', SiteHelpers::alert('error', 'Please write your email address'));
                redirect('user/login', 301);
            }
        }
    }

    public function reset($token = '') {
        if (!empty($_SESSION['loginSession'])) {
            $this->db->trans_start();
            $user = $this->db->get_where('tb_users', array('reminder' => $token))->row();
            $this->db->trans_complete();
            if (count($user) >= 1) {
                $this->data = array('verCode' => $token);
                $this->data['content'] = $this->load->view('user/remind', $this->data, true);
                $this->load->view('layouts/login', $this->data);
            } else {
                $this->session->set_flashdata('message', SiteHelpers::alert('error', 'Cant find your reset code'));
                redirect('user/login', 301);
            }
        }
    }

    public function saveReset($token = '') {
        if (!empty($_SESSION['loginSession'])) {
            $rules = array(
                array('field' => 'password', 'label' => 'password', 'rules' => 'required'),
                array('field' => 'password_confirmation', 'label' => 'password confirmation', 'rules' => 'required|matches[password]'),
            );


            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run()) {
                $this->db->trans_start();
                $user = $this->db->get_where('tb_users', array('reminder' => $token))->row();
                $this->db->trans_complete();
                if (count($user) >= 1) {
                    $data = array('password' => md5(trim($this->input->post('password'))), 'reminder' => '');
                    $this->db->trans_start();
                    $this->db->where('id', $user->id);
                    $this->db->update('tb_users', $data);
                    $this->db->trans_complete();
                }
                $this->session->set_flashdata('message', SiteHelpers::alert('success', 'Password has been saved!'));
                redirect('user/login', 301);
            } else {
                $this->session->set_flashdata(
                        array(
                            'message' => SiteHelpers::alert('error', 'The following errors occurred'),
                            'errors' => validation_errors('<li>', '</li>')
                        )
                );
                redirect('user/reset/' . $token, 301);
            }
        }
    }

    public function logout() {
        if (!empty($_SESSION['loginSession'])) {
            $this->session->unset_userdata(array(
                'logged_in' => '',
                'uid' => '',
                'gid' => '',
                'eid' => '',
                'll' => '',
                'fid' => '',
				'user_data'=>''
            ));
            session_start();
            session_destroy();
            redirect('', 301);
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/page.php */ 