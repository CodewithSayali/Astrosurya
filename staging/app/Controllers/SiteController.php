<?php

namespace App\Controllers;

use App\Controllers\VedicRishiClient;
use App\Models\UserRegisterModel as UserRegister;
use App\Models\UserContactModel as UserContact;
use App\Models\CmsPagesModel as CmsPages;
use App\Models\SeoModel;
use App\Models\ManageTeamModel as ManageTeam;
use App\Models\ServicesModel as AstroServices;

require 'vendor/autoload.php';

use Dompdf\Dompdf as Dompdf;

class SiteController extends BaseController {

    private $user;
    private $session;
    protected $helpers = [];

    public function __construct() {
        helper(['form', 'url', 'session', 'mail_helper', 'cookie']);
    }

    public function index() {
        $data['page_title'] = "Astrosurya";
        $data['current_page'] = "index";
        $data['load_page'] = "site/content/index";
        $ManageTeam = new ManageTeam();
        $data['teams'] = $ManageTeam->get_teams_details();
        $astroServices = new AstroServices();
        $data['astroServices']=$astroServices->get_all_active_services();
        return view('site/content/kernel', $data);
    }

    public function register() {
        if (!session()->get('loggedIn')) {
            $data['page_title'] = "Register";
            $data['current_page'] = "register";
            $data['load_page'] = "site/content/register";
            $astroServices = new AstroServices();
        $data['astroServices']=$astroServices->get_all_active_services();
            $SeoModel = new SeoModel();
            $data['seo'] = $SeoModel->get_seo_details(['id' => 7]);
            return view('site/content/kernel', $data);
        } else {
            return redirect()->to('home');
        }
    }

    public function login() {
        if (!session()->get('loggedIn')) {
            $data['page_title'] = "Login";
            $data['current_page'] = "login";
            $data['load_page'] = "site/content/login";
            $astroServices = new AstroServices();
            $data['astroServices']=$astroServices->get_all_active_services();
            $SeoModel = new SeoModel();
            $data['seo'] = $SeoModel->get_seo_details(['id' => 8]);
            return view('site/content/kernel', $data);
        } else {
            return redirect()->to('home');
            // load your login page
        }
    }

    public function forgot_password() {
        $data['page_title'] = "Forgot Password";
        $data['current_page'] = "forgot_password";
        $data['load_page'] = "site/content/forgot_password";
        return view('site/content/kernel', $data);
        $astroServices = new AstroServices();
        $data['astroServices']=$astroServices->get_all_active_services();
    }

    

    public function check_email() {
        $email = $this->request->getVar("txtEmail");
        $UserRegister = new UserRegister();
        $user_data = $UserRegister->check_email($email);
        if ($user_data) {
            $valid = "true";
        } else {
            $valid = "false";
        }
        echo $valid;
    }

    public function check_mobile() {
        $mobile = $this->request->getVar("txtPhone");
        $UserRegister = new UserRegister();
        $user_data = $UserRegister->check_mobile($mobile);
        if ($user_data) {
            $valid = "true";
        } else {
            $valid = "false";
        }
        echo $valid;
    }

    public function create_account() {
        if ($this->request->getPost()) {
            $rules = [
                "txtFirstName" => "required",
                "txtLastName" => "required",
                "txtEmail" => "required|valid_email",
                "txtPhone" => "required",
                "txtPassword" => "required",
            ];
            if (!$this->validate($rules)) {
                $response = [
                    'success' => false,
                    'msg' => "There are some validation errors",
                ];
            } else {
                $verify_code = mt_rand(1000, 9999);
                //$userModel = new UserModel();
                $UserRegister = new UserRegister();
                $data = [
                    "first_name" => $this->request->getVar("txtFirstName"),
                    "last_name" => $this->request->getVar("txtLastName"),
                    "email" => $this->request->getVar("txtEmail"),
                    "phone" => $this->request->getVar("txtPhone"),
                    "password" => base64_encode($this->request->getVar("txtPassword")),
                    "verify_code" => $verify_code
                ];
                $is_register = $UserRegister->insert_user_data($data);
                if ($is_register) {
                    $parser = \Config\Services::parser();
                    $view = \Config\Services::renderer();
                    $email_body_data = [
                        'name' => $data['first_name'] . " " . $data['last_name'],
                        'email' => $data['email'],
                        'activation_link'=> base_url('activate-user')."/" . base64_encode($is_register) . "/" . md5($verify_code)
                    ];
                    $body = $parser->setData($email_body_data)->render('email/register_email_verify.php');
                    $mail_response = sendMail(ADMIN_EMAIL, $data['email'], 'Email Verification for Astrosurya ', $body);
                    //print_r($mail_response);
                    
                    $response = [
                        'success' => true,
                        'msg' => "You are registered successfully. Please check your email and verify it for login.",
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'msg' => "Unable to register. Please contact us.",
                    ];
                }
            }
        } else {
            $response = [
                'success' => false,
                'msg' => "form not submitted",
            ];
        }
        return $this->response->setJSON($response);
    }

    
    public function activate_user() {
        $user_id = base64_decode($this->request->uri->getSegment(2));
        $verify_code = $this->request->uri->getSegment(3);
        $UserRegister = new UserRegister();
        $user = $UserRegister->get_last_register_user($user_id);
        //print_r(md5($user['verify_code']) . "==" . $verify_code);
        if ($user) {
            if ($user['is_active'] == 0 && $user['is_delete'] == 0) {
                if (md5($user['verify_code']) == $verify_code) {
                    $data = [
                        'is_active' => 1,
                        'is_delete' => 0,
                    ];
                    $update_user = $UserRegister->update_user($user_id, $data);
                    if($update_user)
                    {
                        $session_data = [
                        'user_id' => $user_id,
                        'email' => $user['email'],
                        'loggedIn' => true,
                    ];
                    $session = session();
                    $session->set('user',$session_data);
                    
                    }   
                        
                    $data['page_title'] = "Account Activation";
                    $data['current_page'] = "account-activation";
                    $data['load_page'] = "site/content/activation";
                    return view('user/content/kernel', $data);
                    //print_r($update_user);
                    //return redirect()->route('login');
                }
                else{
                     return redirect()->route('register');
                }
            }
        }else{
            return redirect()->route('register');
        }
        
    }
    
    public function contact_us() {
        $data['page_title'] = "Contact Us";
        $data['current_page'] = "contact-us";
        $data['load_page'] = "site/content/contact_us";
        $SeoModel = new SeoModel();
        $data['seo'] = $SeoModel->get_seo_details(['id' => 9]);
        return view('site/content/kernel', $data);
    }

    function submit_contact() {
//        $captcha_response = trim($this->request->getVar('g-recaptcha-response'));
//        if ($captcha_response != '') {
//            $keySecret = GCAPTCHA_SECRETKEY;
//            $check = array(
//                'secret' => $keySecret,
//                'response' => $this->request->getVar('g-recaptcha-response')
//            );
//            $startProcess = curl_init();
//            curl_setopt($startProcess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
//            curl_setopt($startProcess, CURLOPT_POST, true);
//            curl_setopt($startProcess, CURLOPT_POSTFIELDS, http_build_query($check));
//            curl_setopt($startProcess, CURLOPT_SSL_VERIFYPEER, false);
//            curl_setopt($startProcess, CURLOPT_RETURNTRANSFER, true);
//            $receiveData = curl_exec($startProcess);
//            $finalResponse = json_decode($receiveData, true);
//            if ($finalResponse['success']) {
        if ($this->request->getMethod() == "post") {
            $rules = [
                "txtName" => "required",
                "txtEmail" => "required",
                "txtMobile" => "required",
//                        "selQuery" => "required",
                "txtMessage" => "required",
                    //"txtPageSource" => "required",
            ];
            if (!$this->validate($rules)) {
                $response = [
                    'success' => false,
                    'msg' => "There are some validation errors",
                    'error_no' => '1'
                ];
            } else {
                $name = trim($this->request->getVar('txtName'));
                $email = trim($this->request->getVar('txtEmail'));
//                        $query_type = trim($this->request->getVar('selQuery'));
                $mobile = $this->request->getVar('txtMobile');
                $message = trim($this->request->getVar('txtMessage'));
                //$page_source = $this->request->getVar('txtPageSource');
                $conact_data = [
                    "name" => $name,
                    "email" => $email,
                    "mobile" => $mobile,
//                            "query_type" => $query_type,
                    "message" => $message,
                    "page_source" => $page_source
                ];

                $UserContact = new UserContact();

                $contact_insert = $UserContact->insert_contact_data($conact_data);
                if ($contact_insert) {
                    $parser = \Config\Services::parser();
                    $view = \Config\Services::renderer();
                    $email_body_data = [
                        "name" => $name,
                        "email" => $email,
                        "mobile" => $mobile,
                        "query_type" => "Inquiry",
                        "message" => $message,
                        "page_source" => $page_source
                    ];
                    $body = $parser->setData($email_body_data)->render('email/contact_us.php');
                    $mail_response = sendMail(ADMIN_EMAIL, ADMIN_EMAIL, 'From Astrosurya - Contact US', $body);
                    //print_r($user_data);
                    //print_r($mail_response);

                    $response = [
                        'success' => true,
                        'msg' => "Contact saved successfully",
                        'error_no' => '2'
                    ];
                } else {

                    $response = [
                        'success' => false,
                        'msg' => "Contact not saved",
                        'error_no' => '3'
                    ];
                }
                return $this->response->setJSON($response);
            }
        } else {
            $response = [
                'success' => false,
                'msg' => "Captcha not valid",
                'error_no' => '4'
            ];
        }
//            } else {
//                $response = [
//                    'success' => false,
//                    'msg' => "Please verify captcha",
//                    'error_no' => '5'
//                ];
//            }
//        } else {
//            $response = [
//                'success' => false,
//                'msg' => "Please verify captcha",
//                'error_no' => '6'
//            ];
//        }
        return $this->response->setJSON($response);
    }

    public function service() {
        $data['page_title'] = "Service";
        $data['current_page'] = "service";
        $data['load_page'] = "site/content/service";
        $SeoModel = new SeoModel();
        $data['seo'] = $SeoModel->get_seo_details(['id' => 10]);
        $astroServices = new AstroServices();
        $data['astroServices']=$astroServices->get_all_active_services();
        return view('site/content/kernel', $data);
    }

    public function service_details() {
        $service_id = base64_decode($this->request->uri->getSegment(2));
        $data['page_title'] = "Service Details";
        $data['current_page'] = "service_details";
        $data['load_page'] = "site/content/service_details";
        $astroServices = new AstroServices();
        $data['astroServices']=$astroServices->get_all_active_services();
        $data['astroServiceInfo']=$astroServices->get_active_services_by_id($service_id);
//        print_r($data['astroServiceInfo']);
//        exit;
        //$SeoModel = new SeoModel();
        //$data['seo'] = $SeoModel->get_seo_details(['id' => 10]);
        return view('site/content/kernel', $data);
    }

    public function about_us() {

        $data['page_title'] = "About us";
        $data['current_page'] = "about-us";
        $data['load_page'] = "site/content/about_us";
        $astroServices = new AstroServices();
            $data['astroServices']=$astroServices->get_all_active_services();
        $CmsPages = new CmsPages();
        $data['pages'] = $CmsPages->get_page_details(['page_id' => 3]);
//        print_r($data['pages']);
        //$data = array_merge($data, $pages);
        $SeoModel = new SeoModel();
        $data['seo'] = $SeoModel->get_seo_details(['id' => 3]);
        return view('site/content/kernel', $data);
    }

    public function western_astrology() {
        $data['page_title'] = "Western Astrology";
        $data['current_page'] = "western_astrology";
        $data['load_page'] = "site/content/western_astrology";
        $astroServices = new AstroServices();
            $data['astroServices']=$astroServices->get_all_active_services();
        $SeoModel = new SeoModel();
        $data['seo'] = $SeoModel->get_seo_details(['id' => 11]);
        return view('site/content/kernel', $data);
    }

    public function terms_and_conditions() {

        $data['page_title'] = "Terms and Conditions";
        $data['current_page'] = "terms-and-conditions";
        $data['load_page'] = "site/content/terms_and_conditions";
        $astroServices = new AstroServices();
            $data['astroServices']=$astroServices->get_all_active_services();
        $CmsPages = new CmsPages();
        $data['pages'] = $CmsPages->get_page_details(['page_id' => 8]);
        $SeoModel = new SeoModel();
        $data['seo'] = $SeoModel->get_seo_details(['id' => 4]);
        return view('site/content/kernel', $data);
    }

    public function privacy_policy() {

        $data['page_title'] = "Privacy Policy";
        $data['current_page'] = "privacy-policy";
        $data['load_page'] = "site/content/privacy_policy";
        $astroServices = new AstroServices();
            $data['astroServices']=$astroServices->get_all_active_services();
        $CmsPages = new CmsPages();
        $data['pages'] = $CmsPages->get_page_details(['page_id' => 7]);
        $SeoModel = new SeoModel();
        $data['seo'] = $SeoModel->get_seo_details(['id' => 5]);
        return view('site/content/kernel', $data);
    }

    public function cookies() {

        $data['page_title'] = "Cookies";
        $data['current_page'] = "cookies";
        $data['load_page'] = "site/content/cookies";
        $astroServices = new AstroServices();
            $data['astroServices']=$astroServices->get_all_active_services();
        $CmsPages = new CmsPages();
        $data['pages'] = $CmsPages->get_page_details(['page_id' => 6]);
        $SeoModel = new SeoModel();
        $data['seo'] = $SeoModel->get_seo_details(['id' => 6]);
        return view('site/content/kernel', $data);
    }

    public function team_detail() {
        $team_id = $this->request->uri->getSegment(2);
        $data['page_title'] = "Astrosurya";
        $data['current_page'] = "team-detail";
        $data['load_page'] = "site/content/team_detail";
        $astroServices = new AstroServices();
            $data['astroServices']=$astroServices->get_all_active_services();
        $ManageTeam = new ManageTeam();
        $data['teams'] = $ManageTeam->get_teams_details(['id' => $team_id]);
        return view('site/content/kernel', $data);
    }

}
