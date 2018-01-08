<?php

class Config extends SB_Controller {

    protected $layout = "layouts.main";

    public function __construct() {

        parent::__construct();
        $this->data = array(
            'pageTitle' => 'Site Config',
            'pageNote' => 'Manage Setting COnfiguration'
        );
        if (!$this->session->userdata('logged_in')) {
            redirect('user/login', 301);
        }

        if ($this->session->userdata('gid') != 1)
            redirect('dashboard', 301);
    }

    public function index() {
        $this->data['themes'] = self::themeOption();
        $this->data['groups'] = $this->db->get('tb_groups');
        $this->data['content'] = $this->load->view('administrator/config/index', $this->data, true);
        $this->load->view('layouts/main', $this->data);
    }

    public function postSave() {

        $val = "<?php \n";
        $val .= "define('CNF_APPNAME','" . $this->input->post('cnf_appname', true) . "');\n";
        $val .= "define('CNF_APPDESC','" . $this->input->post('cnf_appdesc', true) . "');\n";
        $val .= "define('CNF_COMNAME','" . $this->input->post('cnf_comname', true) . "');\n";
        $val .= "define('CNF_EMAIL','" . $this->input->post('cnf_email') . "',true);\n";
        $val .= "define('CNF_METAKEY','" . $this->input->post('cnf_metakey', true) . "');\n";
        $val .= "define('CNF_METADESC','" . $this->input->post('cnf_metadesc', true) . "');\n";
        $val .= "define('CNF_GROUP','" . $this->input->post('cnf_group', true) . "');\n";
        $val .= "define('CNF_ACTIVATION','" . $this->input->post('cnf_activation', true) . "');\n";
        $val .= "define('CNF_REGIST','" . $this->input->post('cnf_regist', true) . "');\n";
        $val .= "define('CNF_FRONT','" . $this->input->post('cnf_front', true) . "');\n";
        $val .= "define('CNF_THEME','" . $this->input->post('cnf_theme', true) . "');\n";
        $val .= "define('CNF_MULTILANG','" . ($this->input->post('cnf_multilang') == 1 ? '1' : '0') . "');\n";
        $val .= "?>";

        $filename = 'setting.php';
        $fp = fopen($filename, "w+");
        fwrite($fp, $val);
        fclose($fp);
        redirect(site_url('administrator/config'));
    }

    public function blast() {
        $this->data = array(
            'groups' => $this->db->get('tb_groups'),
            'pageTitle' => 'Blast Email',
            'pageNote' => 'Send email to users'
        );
        $this->data['content'] = $this->load->view('administrator/config/blast', $this->data, true);
        $this->load->view('layouts/main', $this->data);
    }

    function doBlast() {
        if (!is_null($this->input->post('groups'))) {
            $groups = $this->input->post('groups');
            for ($i = 0; $i < count($groups); $i++) {
                if ($this->input->post('uStatus') == 'all') {
                    $users = $this->db->get_where('tb_users', array('group_id' => $groups[$i]));
                } else {
                    $users = $this->db->get_where('tb_users', array('group_id' => $groups[$i], 'active' => $this->input->post('uStatus')));
                }
                $count = 0;
                foreach ($users->result() as $row) {

                    $to = $row->email;
                    $subject = $this->input->post('subject');
                    $message = $this->input->post('message');
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= 'From: ' . CNF_APPNAME . ' <' . CNF_EMAIL . '>' . "\r\n";
                    mail($to, $subject, $message, $headers);

                    $count = ++$count;
                }
            }
            $this->session->set_flashdata('message', SiteHelpers::alert('success', 'Total ' . $count . ' Message has been sent'));
            return redirect('administrator/config/blast', 301);
        }
    }

    public function email() {

        $regEmail = "application/views/emails/registration.php";
        $resetEmail = "application/views/emails/reminder.php";
        $this->data = array(
            'pageTitle' => 'Blast Email',
            'pageNote' => 'Send email to users',
            'regEmail' => file_get_contents($regEmail),
            'resetEmail' => file_get_contents($resetEmail)
        );

        $this->data['content'] = $this->load->view('administrator/config/email', $this->data, true);
        $this->load->view('layouts/main', $this->data);
    }

    function postEmail() {
        $regEmailFile = "application/views/emails/registration.php";
        $resetEmailFile = "application/views/emails/reminder.php";

        $fp = fopen($regEmailFile, "w+");
        fwrite($fp, $_POST['regEmail']);
        fclose($fp);

        $fp = fopen($resetEmailFile, "w+");
        fwrite($fp, $_POST['resetEmail']);
        fclose($fp);

        $this->session->set_flashdata('message', SiteHelpers::alert('success', 'Email Has Been Updated'));
        redirect('administrator/config/email', 301);
    }

    public function themeOption() {
        $theme_path = "application/views/layouts/";
        $themes = scandir($theme_path);
        $t = array();
        foreach ($themes as $value) {
            if ($value === '.' || $value === '..')
                continue;
            if (is_dir("./application/views/layouts/" . $value) && file_exists("./application/views/layouts/" . $value . '/info.json')) {
                $fp = file_get_contents($theme_path . $value . '/info.json');
                $fp = json_decode($fp, true);
                $t[] = $fp;
            }
        }
        return $t;
    }

}
