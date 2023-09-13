<?php

namespace App\Controllers;

require FCPATH . 'vendor/autoload.php';

use App\Controllers\BaseController;
use App\Models\UserRegisterModel as UserRegister;

class UserController extends BaseController {

    public $user;
    public $session;
    protected $helpers = [];

    public function __construct() {
        helper(['form', 'url', 'session', 'mail_helper', 'cookie']);
        $session = session();
        //print_r($session->get('user'));
    }

    public function index() {
        //
    }
public function check_login() {

        if ($this->request->getMethod() == "post") {
            $rules = [
                "txtEmailMobile" => "required",
                "txtPassword" => "required",
            ];
            if (!$this->validate($rules)) {
                $response = [
                    'success' => false,
                    'msg' => "There are some validation errors",
                    'error_no' => '1'
                ];
            } else {
                $email_mobile = trim($this->request->getVar('txtEmailMobile'));
                $password =base64_encode(trim($this->request->getVar('txtPassword')));
                $rememberMe = $this->request->getVar('chkRememberMe');
                $UserRegister = new UserRegister();
                $user_data = $UserRegister->check_mail_mobile($email_mobile,$password);
                //base64_decode
                if ($user_data) {
                    $session_data = [
                        'user_id' => $user_data['id'],
                        'user_email' => $user_data['email'],
                        'loggedIn' => true,
                    ];
                    
                    $session = session();
                    $session->set('user',$session_data);

                    if (!empty($rememberMe)) {
                        $cookie_hash = md5(uniqid() . "sghsgd876mbjb");
                        set_cookie('rememberMe', $cookie_hash, 36000, '/');
                    } else {
                        set_cookie('rememberMe', '');
                    }
                    
                    $response = [
                        'success' => true,
                        'msg' => "Login Successfully",
                        'error_no' => '2'
                    ];
                } else {

                    $response = [
                        'success' => false,
                        'msg' => "Please enter correct details",
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


        return $this->response->setJSON($response);
    }
    public function home() {
        $data['page_title'] = "Home";
        $data['current_page'] = "home";
        $data['load_page'] = "user/content/home";
        //$session = session();
        //$userData = $_SESSION;
        
                     $session = session();
                    $user_session=$session->get('user');
//                    print_r($user_session);
//                    exit;
        //print_r($user_session['user_email']);
        return view('user/content/kernel', $data);
    }
    
    public function logout() {
        $session = session();
        //delete_cookie('rememberMe');
        $session->set(array('user_id' => '', 'loggedIn' => false));
        $session->destroy();
        return redirect()->to('/');
    }

}
