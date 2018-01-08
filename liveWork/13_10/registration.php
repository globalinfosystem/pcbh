<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Registration extends SB_Controller {

    protected $layout = "layouts/main";
    public $module = 'registration';
    public $per_page = '10';

    function __construct() {
        parent::__construct();

        $this->load->model('registrationmodel');
        $this->load->model('Hiceoms_model');
        $this->load->library('Datatables');
        $this->model = $this->registrationmodel;

        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);

        $this->data = array_merge($this->data, array(
            'pageTitle' => $this->info['title'],
            'pageNote' => $this->info['note'],
            'pageModule' => 'registration',
        ));

        if (!$this->session->userdata('logged_in'))
            redirect('user/login', 301);
    }

    function index() {
        if ($this->access['is_view'] == 0) {
            $this->session->set_flashdata('error', SiteHelpers::alert('error', 'Your are not allowed to access the page'));
            redirect('dashboard', 301);
        }


       
        $this->data['getsessiondata'] = $this->session->userdata;
        $this->data['content'] = $this->load->view('administrator/registration/index', $this->data, true);
        $this->load->view('layouts/main', $this->data);
    }

    function show($id = null, $reg = null) {
        if ($this->access['is_detail'] == 0) {
            $this->session->set_flashdata('error', SiteHelpers::alert('error', 'Your are not allowed to access the page'));
            redirect('dashboard', 301);
        }

        $row = $this->model->getRowCustom($id, $reg, 'reg_no');
        if ($row) {
            $this->data['row'] = $row;
        } else {
            $this->data['row'] = $this->model->getColumnTable('sic');
        }

        $this->data['id'] = $id;
        $this->data['content'] = $this->load->view('administrator/registration/view', $this->data, true);
        $this->load->view('layouts/main', $this->data);
    }

    function add($id = null, $reg = null) {
        if ($id == '')
            if ($this->access['is_add'] == 0)
                redirect('dashboard', 301);

        if ($id != '')
            if ($this->access['is_edit'] == 0)
                redirect('dashboard', 301);

        $row = $this->model->getRowCustom($id, $reg, 'reg_no');
        if ($row) {
            $this->data['row'] = $row;
        } else {
            $this->data['row'] = $this->model->getColumnTable('sic');
        }

        $this->data['id'] = $id;
        $this->data['content'] = $this->load->view('administrator/registration/form', $this->data, true);
        $this->load->view('layouts/main', $this->data);
    }

    function save() {
        $arraySic = array();
        $arrayLetter = array();
        if (!empty($_POST)) {
            $this->load->model('Registrationmodel');
            $NewRegNo = $this->Registrationmodel->getLastRegNumber();

            $reg_no = !empty($_POST['reg_no']) ? $_POST['reg_no'] : $NewRegNo;
            $year = !empty($_POST['year']) ? $_POST['year'] : date('Y');
            $arraySic = array(
                'reg_no' => $reg_no,
                'year' => $year,
                'file_no' => 'HIC/CIC/A/' . $year . '/' . $reg_no,
                'stage_no' => !empty($_POST['stage']) ? $_POST['stage'] : '',
                'subject' => !empty($_POST['subject']) ? $_POST['subject'] : '',
                'applicant_name' => $_POST['aname'],
                'applicant_phone' => $_POST['aphone'],
                'applicant_mobile' => $_POST['mobile'],
                'application_email' => $_POST['email'],
                'from_whom_reciv' => $_POST['address'],
                'letter_no' => $_POST['letterno'],
                'cate_id' => $_POST['category'],
                'gender' => $_POST['gender'],
                'comp_no' => $_POST['casetype'],
                'dept_no' => $_POST['department'],
                'dist_no' => $_POST['district'],
                'area' => $_POST['area'],
                'reg_date' => date('d-m-Y', strtotime($_POST['receiveddate'])),
                'remarks' => $_POST['remarks'],
                'info_req' => $_POST['info_req'],
                'ptype' => $_POST['ptype'],
                'textarea1' => $_POST['textarea1'],
                'textarea2' => $_POST['textarea2'],
                'textarea3' => $_POST['textarea3'],
                'textarea4' => $_POST['textarea4'],
                'textarea5' => $_POST['textarea5'],
                'textarea6' => $_POST['textarea6'],
                'dealing_assistant' => $_POST['dealingassistant'],
                'postid' => $_POST['dealingassistant'],
                'entry_by' => 'Off'
            );

            if (empty($_POST['reg_no'])) {

                $arrayLetter = array(
                    'reg_no' => $reg_no,
                    'year' => $year,
                    'letter_no' => $_POST['letterno'],
                    'letter_date' => date('d-m-Y', strtotime($_POST['letterdate'])),
                    'letter_to' => $_POST['commissioner']
                );
            }

            if (empty($_POST['reg_no'])) {
                $arraySic['registration_date'] = date('Y-m-d H:i:s');
                $ID = $this->Registrationmodel->insert_update('', '', $arraySic, $arrayLetter);
                if (!empty($arraySic['applicant_mobile'])) {
                    $message = 'Your RTI application has been registered with registration number ' . $NewRegNo;
                    $this->smsPostData(TRUE, '7307642729,8699033316,8528985448,' . $arraySic['applicant_mobile'], $message, null);
                }
                if (!empty($arraySic['application_email'])) {
                    $message = 'Your RTI application has been  registered with registration number ' . $NewRegNo;
                    $this->sentmail($arraySic['application_email'], 'Sic', 'New rti application is register (' . $NewRegNo . ')', $message);
                }
            } else {
                $ID = $this->Registrationmodel->insert_update($_POST['reg_no'], $_POST['year'], $arraySic, '');
            }



            // Redirect after save	
            $this->session->set_flashdata('message', SiteHelpers::alert('success', " Data has been saved succesfuly !"));
            if ($this->input->post('apply')) {
                redirect('administrator/registration/add/' . $ID, 301);
            } else {
                redirect('administrator/registration', 301);
            }
        } else {
            $data = array(
                'message' => 'Ops , The following errors occurred',
                'errors' => validation_errors('<li>', '</li>')
            );
            $this->displayError($data);
        }
    }

    public function respondents($reg_no, $year) {
        $this->data['reg_no'] = $reg_no;
        $this->data['year'] = $year;
        $this->load->view('administrator/registration/respondents', $this->data, false);
    }

    public function hearing($year, $reg_no) {
        $this->data['reg_no'] = $reg_no;
        $this->data['year'] = $year;
        $this->data['content'] = $this->load->view('administrator/registration/hearing', $this->data, true);
        $this->load->view('layouts/main', $this->data);
    }

    public function orderpassed($year, $reg_no) {
        $this->data['reg_no'] = $reg_no;
        $this->data['year'] = $year;
        $this->data['content'] = $this->load->view('administrator/registration/orderpassed', $this->data, true);
        $this->load->view('layouts/main', $this->data);
    }

    public function hearing_location() {
        $this->load->model('Registrationmodel');
        if (!empty($_POST)) {
            $getData = $this->Registrationmodel->gethearingtype($_POST);
            echo $getData;
            exit();
        }
    }

    public function hearing_district_address() {
        $this->load->model('Registrationmodel');
        if (!empty($_POST)) {
            $getData = $this->Registrationmodel->hearing_district_address($_POST);
            echo $getData;
            exit();
        }
    }

    public function addrespondents($reg_no, $year) {
        $this->data['reg_no'] = $reg_no;
        $this->data['year'] = $year;
        $this->load->model('Registrationmodel');
        if (!empty($_POST)) {
            $arrayPost = array(
                'reg_no' => $reg_no,
                'year' => $year,
                'file_no' => 'HIC/CIC/A/' . $year . '/' . $reg_no,
                'resp_name' => !empty($_POST['rname']) ? $_POST['rname'] : '',
                'resp_desig' => !empty($_POST['desig']) ? $_POST['desig'] : '',
                'resp_addr' => $_POST['offadd'],
                'resp_phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'stage_no' => 0
            );
            $this->Registrationmodel->insert_update_respondents($reg_no, $year, '', $arrayPost);
            if (!empty($_POST['phone'])) {
                $message = 'New Respondent has been registered with registration number ' . $reg_no;
                $this->smsPostData(TRUE, '7307642729,8699033316,8528985448,' . $_POST['phone'], $message, null);
            }
            if (!empty($_POST['email'])) {
                $message = 'New Respondent has been  registered with registration number ' . $reg_no;
                $this->sentmail($_POST['email'], 'Sic', 'New Respondent is registered on (' . $reg_no . ')', $message);
            }
        }
        $this->data['respondents'] = $this->Registrationmodel->get_respondent_list($reg_no, $year);
        $this->load->view('administrator/registration/addrespondents', $this->data, false);
    }

    public function deleteRespondents($reg_no = null, $year = null, $resp_no = null) {
        if ($reg_no && $year && $resp_no) {
            $this->load->model('Registrationmodel');
            $this->Registrationmodel->deleteRespondents($reg_no, $year, $resp_no);
            $this->data['respondents'] = $this->Registrationmodel->get_respondent_list($reg_no, $year);
            $this->load->view('administrator/registration/addrespondents', $this->data, false);
        }
    }

    function destroy() {
        if ($this->access['is_remove'] == 0) {
            $this->session->set_flashdata('error', SiteHelpers::alert('error', 'Your are not allowed to access the page'));
            redirect('dashboard', 301);
        }

        $this->model->destroy($this->input->post('id', true));
        $this->inputLogs("ID : " . implode(",", $this->input->post('id', true)) . "  , Has Been Removed Successfull");
        $this->session->set_flashdata('message', SiteHelpers::alert('success', "ID : " . implode(",", $this->input->post('id', true)) . "  , Has Been Removed Successfull"));
        Redirect('administrator/registration', 301);
    }

    function savehearing($year = null, $reg_no = null) {
        $arrayHearing = array();
        $arrayRespondents = array();
        if (!empty($_POST)) {
            $this->load->model('Registrationmodel');
            $this->load->model('Hiceoms_model');
            $arrayHearing = array(
                'reg_no' => $reg_no,
                'year' => $year,
                'file_no' => !empty($_POST['file_no']) ? $_POST['file_no'] : '',
                'hearing_date' => !empty($_POST['hearing_date']) ? $_POST['hearing_date'] . ' ' . $_POST['hearing_time'] . ':' . $_POST['hmin'] . ':00' : '',
                'hearing_issue_date' => !empty($_POST['hearing_issuedateh']) ? $_POST['hearing_issuedateh'] : '',
                'bench_type' => !empty($_POST['bench_type']) ? $_POST['bench_type'] : '',
                'hearing_type' => !empty($_POST['hearing_type']) ? $_POST['hearing_type'] : ''
            );

            if (!empty($_POST['bench_type']) && $_POST['bench_type'] == 1) {
                $arrayHearing['bench'] = !empty($_POST['i_bench']) ? $_POST['i_bench'] : '';
            }
            if (!empty($_POST['bench_type']) && $_POST['bench_type'] == 2) {
                $arrayHearing['bench'] = !empty($_POST['l_bench']) ? implode(',', $_POST['l_bench']) : '';
            }

            if (!empty($_POST['hearing_type']) && $_POST['hearing_type'] == 'VC') {
                $arrayHearing['hearing_location'] = !empty($_POST['hearing_location']) ? $_POST['hearing_location'] : '';
                if (!empty($_POST['hearing_location']) && ($_POST['hearing_location'] == 'SWAN Room' || $_POST['hearing_location'] == 'NIC Studio')) {
                    $arrayHearing['district_id'] = !empty($_POST['applicant_district']) ? $_POST['applicant_district'] : '';
                    $arrayHearing['district_location'] = !empty($_POST['applicant_location']) ? $_POST['applicant_location'] : '';
                }
            }

            if (!empty($_POST['resp_no'])) {
                foreach ($_POST['resp_no'] as $key => $value) {
                    if (!empty($_POST['respondent_district'][$value])) {
                        $arrayRespondents[] = array(
                            'reg_no' => $reg_no,
                            'year' => $year,
                            'resp_no' => $value,
                            'resp_name' => !empty($_POST['resp_name'][$value]) ? $_POST['resp_name'][$value] : '',
                            'hearing_location' => !empty($_POST['hearing_location']) ? $_POST['hearing_location'] : '',
                            'district_id' => !empty($_POST['respondent_district'][$value]) ? $_POST['respondent_district'][$value] : '',
                            'address' => !empty($_POST['respondent_location'][$value]) ? $_POST['respondent_location'][$value] : '',
                        );
                    }
                }
            }
            if (empty($_POST['hearing_no'])) {
                $firstTime = '';
                if (!empty($year) && !empty($reg_no) && !empty($_POST['file_no'])) {
                    if (!$this->Registrationmodel->checkFirstTimeHearing($year, $reg_no, $_POST['file_no'])) {
                        $firstTime = 1;
                    } else {
                        $firstTime = '';
                    }
                }
                $arrayHearing['hearing_no'] = $this->Registrationmodel->getLastHearingNumber();
                $arrayHearing['template_created_date'] = date('Y-m-d H:i:s');
                $this->Registrationmodel->insert_update_hearing('', '', '', $arrayHearing, $arrayRespondents);
                $getReg = $this->Hiceoms_model->get_all_sic_with_perameter($year, $reg_no);
                $getbench = $this->Hiceoms_model->get_all_bench();
                $getDistricts = $this->Hiceoms_model->get_all_districts();
                $commissionerName = '';
                if (!empty($_POST['bench_type']) && $_POST['bench_type'] == 1) {
                    $commissionerName = $getbench[$_POST['i_bench']]['emp_name'];
                }
                if (!empty($_POST['bench_type']) && $_POST['bench_type'] == 2) {
                    foreach ($_POST['l_bench'] as $new_l_value) {
                        $commissionerName .= $getbench[$new_l_value]['emp_name'] . ' ,';
                    }
                }
                if ($firstTime) {
                    if (!empty($getReg[$reg_no][$year][0]['applicant_mobile'])) {
                        $message = 'Your registration number ' . $reg_no . ' is schedule for ' . $_POST["hearing_date"] . ' , ' . $_POST["hearing_time"] . ' : ' . $_POST["hmin"] . ', ' . $_POST['hearing_location'] . ', ' . $arrayHearing['district_location'] . ', ' . $getDistricts[$arrayHearing['district_id']] . ' to  ' . $commissionerName;
                        $this->smsPostData(TRUE, '7307642729,8699033316,8528985448,' . $getReg[$reg_no][$year][0]['applicant_mobile'], $message, null);
                    }
                    if (!empty($getReg[$reg_no][$year][0]['application_email'])) {
                        $message = 'Your registration number ' . $reg_no . ' is schedule for ' . $_POST["hearing_date"] . ' , ' . $_POST["hearing_time"] . ' : ' . $_POST["hmin"] . ', ' . $_POST['hearing_location'] . ', ' . $arrayHearing['district_location'] . ', ' . $getDistricts[$arrayHearing['district_id']] . '  to  ' . $commissionerName;
                        $this->sentmail($getReg[$reg_no][$year][0]['application_email'], 'Sic', 'your registration number ' . $reg_no . ' is schedule', $message);
                    }
                } else {
                    if (!empty($getReg[$reg_no][$year][0]['applicant_mobile'])) {
                        $message = 'Your registration number ' . $reg_no . ' has been adjourned  on ' . $_POST["hearing_date"] . ' , ' . $_POST["hearing_time"] . ' : ' . $_POST["hmin"] . ', ' . $_POST['hearing_location'] . ', ' . $arrayHearing['district_location'] . ', ' . $getDistricts[$arrayHearing['district_id']] . '  to  ' . $commissionerName;
                        $this->smsPostData(TRUE, '7307642729,8699033316,8528985448,' . $getReg[$reg_no][$year][0]['applicant_mobile'], $message, null);
                    }
                    if (!empty($getReg[$reg_no][$year][0]['application_email'])) {
                        $message = 'Your registration number ' . $reg_no . ' has been adjourned  on ' . $_POST["hearing_date"] . ' , ' . $_POST["hearing_time"] . ' : ' . $_POST["hmin"] . ', ' . $_POST['hearing_location'] . ', ' . $arrayHearing['district_location'] . ', ' . $getDistricts[$arrayHearing['district_id']] . '  to  ' . $commissionerName;
                        $this->sentmail($getReg[$reg_no][$year][0]['application_email'], 'Sic', 'your registration number ' . $reg_no . ' has been adjourn', $message);
                    }
                }
                $this->data['year'] = $year;
                $this->data['reg_no'] = $reg_no;
                $this->load->view('administrator/registration/showhearingajax', $this->data, false);
            } else {
                $this->Registrationmodel->insert_update_hearing($reg_no, $year, $_POST['hearing_no'], $arrayHearing, '');
            }
        } else {
            
        }
    }

    function saveorderpassed($year = null, $reg_no = null) {
        $arrayHearing = array();
        if (!empty($_POST)) {

            $this->load->model('Registrationmodel');
            $arrayHearing = array(
                'reg_no' => $reg_no,
                'year' => $year,
                'remarks' => !empty($_POST['remarks']) ? $_POST['remarks'] : '',
                'commissioner' => !empty($_POST['commissioner']) ? $_POST['commissioner'] : '',
                'order_date' => !empty($_POST['order_date']) ? $_POST['order_date'] : ''
            );
            $arrayHearing['id'] = $this->Registrationmodel->getLastOrderPassedNumber();
            if (!empty($_FILES['upload_order_passed']['name'])) {
                $ext = pathinfo($_FILES['upload_order_passed']['name'], PATHINFO_EXTENSION);
                $this->load->library('upload');
                $destinationPath = "./uploads/orders/";
                $config['upload_path'] = $destinationPath;
                $config['allowed_types'] = 'pdf';
                $config['file_name'] = 'OP_' . $reg_no . '_' . $year . '_' . $arrayHearing['id'] . '.' . $ext;
                $this->upload->initialize($config);
                if ($this->upload->do_upload('upload_order_passed')) {
                    $file_data = $this->upload->data();
                    $arrayHearing['uploaded_file_path'] = $file_data['file_name'];
                    $arrayHearing['original_file_path'] = $_FILES['upload_order_passed']['name'];
                }
            }


            if (empty($_POST['id'])) {

                $this->Registrationmodel->insert_update_orderpassed('', '', '', $arrayHearing);
                $getReg = $this->Hiceoms_model->get_all_sic_with_perameter($year, $reg_no);
                if (!empty($getReg[$reg_no][$year][0]['applicant_mobile'])) {
                    $message = 'Your orders has been passed regarding your registration no ' . $reg_no . ', you can also check on our website cicharyana.gov.in';
                    $this->smsPostData(TRUE, '7307642729,8699033316,8528985448,' . $getReg[$reg_no][$year][0]['applicant_mobile'], $message, null);
                }
                if (!empty($getReg[$reg_no][$year][0]['application_email'])) {
                    $message = 'Your orders has been passed regarding your registration no ' . $reg_no . ', you can also check on our website cicharyana.gov.in';
                    $this->sentmail($getReg[$reg_no][$year][0]['application_email'], 'Sic', 'orders has passed regarding your registration no (' . $reg_no . ')', $message);
                }
                $this->data['year'] = $year;
                $this->data['reg_no'] = $reg_no;
                $this->load->view('administrator/registration/showorderpassed', $this->data, false);
            } else {
                $this->Registrationmodel->insert_update_orderpassed($reg_no, $year, $_POST['id'], $arrayHearing);
                $this->data['year'] = $year;
                $this->data['reg_no'] = $reg_no;
                $this->load->view('administrator/registration/showorderpassed', $this->data, false);
            }
        } else {
            
        }
    }

    public function get_registration_list() {
        echo $this->Hiceoms_model->registration_list();
    }

    function noticepdf() {
        if ($this->input->is_ajax_request()) {
            if (!empty($_POST)) {
                $reg_no = $_POST['reg_no'];
                $year = $_POST['year'];
                $hearing_no = $_POST['hearing_no'];
                if (!empty($reg_no) && !empty($year) && !empty($hearing_no)) {
                    $data = [];
                    $data['reg_no'] = $reg_no;
                    $data['year'] = $year;
                    $data['hearing_no'] = $hearing_no;
                    $data['getReg'] = $this->Hiceoms_model->get_all_sic_with_perameter($year, $reg_no);
                    $data['getRegHearing'] = $this->Hiceoms_model->get_all_hearing_bench_with_perameter($year, $reg_no);
                    $data['getRespondents'] = $this->Hiceoms_model->get_all_respondent_details_with_perameter($year, $reg_no);
                    $data['getDistricts'] = $this->Hiceoms_model->get_all_districts();
                    $data['getRegHearing'] = $this->Hiceoms_model->get_all_hearing_bench_with_perameter($year, $reg_no);
                    $data['getBench'] = $this->Hiceoms_model->get_all_bench();
                    $data['get_commissner'] = $this->Hiceoms_model->get_commissner();
                    $folderPath = "uploads/noticepdf/";
                    $file = $reg_no . '_' . $year . '_' . $hearing_no . '.pdf';
                    $pdfFilePath = $folderPath . $file;
                    $folderPathHtml = "uploads/noticehtml/";
                    $filehtml = $reg_no . '_' . $year . '_' . $hearing_no . '.html';
                    $htmlFilePath = $folderPathHtml . $filehtml;

                    $this->Hiceoms_model->update_hearing_notice($file, $reg_no, $year, $hearing_no);
                    $html = $this->load->view('administrator/registration/notice', $data, true);
                    $content = str_replace('<--?', '<?', $html);
                    $content = str_replace('?-->', '?>', $content);
                    $fp = fopen($htmlFilePath, "wp");
                    fwrite($fp, $content);
                    fclose($fp);

                    $this->load->library('m_pdf');
                    $this->m_pdf->pdf->WriteHTML($html);
                    $this->m_pdf->pdf->Output($pdfFilePath, "F");
                    die('<a href=' . base_url() . $folderPath . $file . ' target="_blank">' . $file . '</a>');
                    exit();
                }
            }
        }
    }

    public function ajaxnoticeupdate($reg_no, $year, $hearing_no) {
        $this->data['reg_no'] = $reg_no;
        $this->data['year'] = $year;
        $this->data['hearing_no'] = $hearing_no;
        $html = './uploads/noticehtml/' . $reg_no . '_' . $year . '_' . $hearing_no . '.html';
        $this->data['content'] = file_get_contents($html);
        $this->load->view('administrator/registration/ajaxnoticeupdate', $this->data, false);
    }

    public function updatenotice($reg_no, $year, $hearing_no) {
        if ($this->input->is_ajax_request()) {
            if (!empty($_POST)) {
                $folderPath = "uploads/noticepdf/";
                $file = $reg_no . '_' . $year . '_' . $hearing_no . '.pdf';
                $pdfFilePath = $folderPath . $file;
                $folderPathHtml = "uploads/noticehtml/";
                $filehtml = $reg_no . '_' . $year . '_' . $hearing_no . '.html';
                $htmlFilePath = $folderPathHtml . $filehtml;
                $content = str_replace('<--?', '<?', $_POST['notice']);
                $content = str_replace('?-->', '?>', $content);
                $fp = fopen($htmlFilePath, "wp");
                fwrite($fp, $content);
                fclose($fp);

                $this->load->library('m_pdf');
                $this->m_pdf->pdf->WriteHTML($html);
                $this->m_pdf->pdf->Output($pdfFilePath, "F");

                exit();
            }
        }
    }

}
