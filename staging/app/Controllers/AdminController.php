<?php

namespace App\Controllers;

//defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

use CodeIgniter\Controller;
use App\Models\Admin_master_model as AdminMaster;
use App\Models\UserRegisterModel as UserRegister;
use App\Models\CmsPagesModel as CmsPages;
use App\Models\ImagesModel as Images;
use App\Models\MailTemplatesModel as MailTemplates;
use App\Models\MailAttachmentModel as MailAttachment;
use App\Models\ManageQueriesModel as ManageQueries;
use App\Models\ServicesModel as Services;
use App\Models\SeoModel;
use App\Models\SettingsModel;
use App\Models\ReportsModel;
use App\Models\ManageTeamModel as ManageTeam;
use App\Libraries\ckeditor;

$db = \Config\Database::connect();

class AdminController extends BaseController {

    public function __construct() {
        helper(['form', 'url', 'session', 'mail_helper', 'cookie']);
        $session = session();
        $email = \Config\Services::email();
        $parser = \Config\Services::parser();
    }

    public function index() {
        $data['page_title'] = "Astrosurya Admin Dashoard";
        $data['spgname'] = "index";
        $data['load_page'] = "admin/content/dashboard";
        return view('admin/content/kernel', $data);
    }

    public function login() {
        $data['page_title'] = "Admin Login";
        $data['current_page'] = "admin-login";
        $data['load_page'] = "admin/content/login";
        return view('admin/content/login', $data);
    }

    public function manage_user() {
        $data['page_title'] = "Admin - Manage User";
        $data['spgname'] = "manage-user";
        $data['load_page'] = "admin/content/manage_user";
        $UserRegister = new UserRegister();
        $data['users'] = $UserRegister->get_all_users();
        return view('admin/content/kernel', $data);
    }

    public function get_user_data() {
        $UserRegister = new UserRegister();
        $user_id = $this->request->getVar('user_id');
        $users = $UserRegister->find($user_id);
        echo json_encode($users);
        exit();
    }

    public function update_user() {
//        echo '<pre>';
//        print_r($this->request->getVar());
//        exit();
        $UserRegister = new UserRegister();
        $id = $this->request->getVar('user_id');
        $data = array(
            'first_name' => $this->request->getVar('txtFirstName'),
            'last_name' => $this->request->getVar('txtLastName'),
            'email' => $this->request->getVar('txtEmail'),
            //'password' => $this->request->getVar('txtPassword'),
            'phone' => $this->request->getVar('txtPhone'),
            'dob' => $this->request->getVar('txtDob'),
            'latitude' => $this->request->getVar('txtLatitude'),
            'longitude' => $this->request->getVar('txtLongitude'),
            'timezone' => $this->request->getVar('txtTimezone'),
            'gender' => $this->request->getVar('radGender'),
        );
//         $update = $UserRegister->update_user('user_register', $data, array('id'=>$id));
        $update_user = $UserRegister->update_user($id, $data);
        return $this->response->setJSON($update_user);
    }

    public function delete_user() {
//        print_r($this->request->getVar("bond_id"));
//        exit;
        $id = $this->request->getVar("delid");
        $UserRegister = new UserRegister();
        $user_data = $UserRegister->delete_user($id);
        if ($user_data) {
            $response = 1;
        } else {
            $response = 0;
        }
        return $this->response->setJSON($response);
    }

    public function check_admin_login() {

        if (get_cookie("remember") != '') {
            redirect()->to('dashboard');
        } else {
            if ($this->request->getMethod() == "post") {
                $rules = [
                    "txtEmail" => "required",
                    "txtPassword" => "required",
                    "txtPin" => "required",
                ];
                if (!$this->validate($rules)) {
                    $response = [
                        'success' => false,
                        'msg' => "There are some validation errors",
                    ];
                } else {
                    $AdminMaster = new AdminMaster();
                    $data = [
                        "email" => $this->request->getVar("txtEmail"),
                        "password" => md5($this->request->getVar("txtPassword")),
                        "pin" => md5($this->request->getVar("txtPin")),
                    ];


                    $email = $this->request->getVar('txtEmail');
                    $password = $this->request->getVar('txtPassword');
                    $pin = $this->request->getVar('txtPin');
                    $remember = $this->request->getVar('chkRemember');
                    $admin_data = $AdminMaster->check_admin_login($data);

                    if ($admin_data) {
                        $session = session();
                        if (!empty($remember)) {
                            $cookie_hash = md5(uniqid() . "sghsgd876mbjb");
                            set_cookie('remember', $cookie_hash, 36000, '/');
                        } else {
                            set_cookie('remember', '');
                        }

                        $session_data = [
                            'id' => $admin_data['id'],
                            'email' => $admin_data['email'],
                            'loggedIn' => true,
                        ];

                        $session->set('admin', $session_data);

                        $response = [
                            'success' => true,
                            'msg' => "Login Successfull",
                        ];
                    } else {
                        $response = [
                            'success' => false,
                            'msg' => "Email, password or pin not correct.",
                        ];
                    }

                    return $this->response->setJSON($response);
                }
            }
        }
    }

    public function manage_pages() {
        $data['page_title'] = "Admin - Manage Pages";
        $data['spgname'] = "manage-pages";
        $data['load_page'] = "admin/content/manage_pages";
        $Images = new Images();
        $data['images'] = $Images->get_image();
        $CmsPages = new CmsPages();
        $data['pages'] = $CmsPages->get_all_pages();
        return view('admin/content/kernel', $data);
    }

    public function edit_page($id) {

        $CmsPages = new CmsPages();
        $Images = new Images();
        $edit_page_id = base64_decode($id);
        $data['page_title'] = "Edit Page";
        $data['spgname'] = "manage-pages";
        $data['current_page'] = "edit-page";
        $data['load_page'] = "admin/content/edit_page";
        $data['back'] = $_SERVER['HTTP_REFERER'];
        $data['images'] = $Images->get_image();
//        echo '<pre>';
//        print_r($data['images']);
//        exit();
        $data['page'] = $CmsPages->where('id', $edit_page_id)->first();
        return view('admin/content/kernel', $data);
    }

    public function save_page() {
//        echo '<pre>';
//        print_r($this->request->getVar());
//        exit();
        $image_data = $this->request->getVar('image');
        if ($image_data) {
            list($type, $image_data) = explode(';', $image_data);
            list(, $image_data) = explode(',', $image_data);

            $image_data = base64_decode($image_data);
            $image_name = time() . '.png';
            //$path =  base_url(). "/uploads/brands/" . $image_name;
            if (!is_dir(UPLOAD_PAGE_PATH)) {
                mkdir(UPLOAD_PAGE_PATH, 0777, true);
            }
            $path = UPLOAD_PAGE_PATH . $image_name;
            $output = file_put_contents($path, $image_data);
            $source = base_url() . "/admin-assets/uploads/page/" . $image_name;
        } else {
            $image_name = "";
        }
        $CmsPages = new CmsPages();
        $title = $this->request->getVar('title');
        $url_slug = url_title($title, '-', TRUE);
        $data = [
            'title' => $this->request->getVar('title'),
            'slug' => $url_slug,
//            'page_id'  => $this->request->getVar('id'),
            'content' => $this->request->getVar('content'),
            'seo_keywords' => $this->request->getVar('seo_keywords'),
            //'thumbnail'  => "abc.jpg",
            'page_image' => $image_name,
        ];

        $insertpage_data = $CmsPages->insert($data);
//        $insertimage_data = $Images->insert($imagesave);
        if ($insertpage_data) {
            $response = 1;
        } else {
            $response = 0;
        }
        return $this->response->setJSON($response);
    }

    public function update_page() {
//        echo '<pre>';
//        print_r($this->request->getVar());
//        exit();
        $pg_id = base64_decode($this->request->getVar('pg_id'));
//        $image_id = base64_decode($this->request->getVar('page_id'));
        $image_data = $this->request->getVar('image');
        if ($image_data) {
            list($type, $image_data) = explode(';', $image_data);
            list(, $image_data) = explode(',', $image_data);

            $image_data = base64_decode($image_data);
            $image_name = time() . '.png';
            //$path =  base_url(). "/uploads/brands/" . $image_name;
            if (!is_dir(UPLOAD_PAGE_PATH)) {
                mkdir(UPLOAD_PAGE_PATH, 0777, true);
            }
            $path = UPLOAD_PAGE_PATH . $image_name;
            $output = file_put_contents($path, $image_data);
            $source = base_url() . "/admin-assets/uploads/page/" . $image_name;
        } else {
            $image_name = $this->request->getVar('page_image');
        }
        $CmsPages = new CmsPages();
        $Images = new Images();
        $title = $this->request->getVar('title');
        $url_slug = url_title($title, '-', TRUE);
        $pagedata = [
            'title' => $this->request->getVar('title'),
            'slug' => $url_slug,
//            'page_id'  => $this->request->getVar('page_images'),
            'content' => $this->request->getVar('content'),
            'seo_keywords' => $this->request->getVar('seo_keywords'),
            //'thumbnail'  => "abc.jpg",
        ];
        $imagedata = [
            'page_image' => $image_name,
        ];
//        print_r($data);
//        die;

        $updatepage_data = $CmsPages->update($pg_id, $pagedata);
        $updateimage_data = $Images->update($pg_id, $imagedata);
        if ($updatepage_data && $updateimage_data) {
            $response = 1;
        } else {
            $response = 0;
        }

        return $this->response->setJSON($response);
    }

    public function pageActiveInactive() {
        $pg_id = $this->request->getVar("pg_id");
        if ($this->request->getVar("status") == '1') {
            $data = array('is_active' => '0');
        } else {
            $data = array('is_active' => '1');
        }
        $CmsPages = new CmsPages();
        $admin_data = $CmsPages->active_inactive_pages($pg_id, $data);
        if ($admin_data) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function mail_templates() {
        $data['page_title'] = "Admin - Mail Templates";
        $data['spgname'] = "mail-templates";
        $data['load_page'] = "admin/content/mail_templates";
        $MailAttachment = new MailAttachment();
        $data['attach'] = $MailAttachment->get_attachments();
        $MailTemplates = new MailTemplates();
        $data['mails'] = $MailTemplates->get_all_mails();
        return view('admin/content/kernel', $data);
    }

    public function edit_mail($id) {

        $MailTemplates = new MailTemplates();
        $MailAttachment = new MailAttachment();
        $edit_mail_id = base64_decode($id);
        $data['page_title'] = "Edit Mail Templates";
        $data['spgname'] = "mail-templates";
        $data['current_page'] = "edit-mail";
        $data['load_page'] = "admin/content/edit_mail";
        $data['back'] = $_SERVER['HTTP_REFERER'];
        $data['attachment'] = $MailAttachment->get_attachments();
        $data['mails'] = $MailTemplates->where('id', $edit_mail_id)->first();
        return view('admin/content/kernel', $data);
    }

    public function update_mail() {
//        echo '<pre>';
//        print_r($this->request->getVar());
//        exit();
        $id = base64_decode($this->request->getVar('id'));
        $attach_data = $this->request->getVar('attach');
        if ($attach_data) {
            list($type, $attach_data) = explode(';', $attach_data);
            list(, $attach_data) = explode(',', $attach_data);

            $attach_data = base64_decode($attach_data);
            $attach_name = time() . '.pdf';
            //$path =  base_url(). "/uploads/brands/" . $image_name;
            if (!is_dir(UPLOAD_MAIL_PATH)) {
                mkdir(UPLOAD_MAIL_PATH, 0777, true);
            }
            $path = UPLOAD_MAIL_PATH .  $id . "/" . $attach_name;
            $output = file_put_contents($path, $attach_data);
            $source = base_url() . "/admin-assets/uploads/attachment/" .  $id . "/" . $attach_name;
        } else {
            $attach_name = $this->request->getVar('attachment');
        }
        $MailTemplates = new MailTemplates();
//        $subject = $this->request->getVar('subject');
        $data = [
            'subject' => $this->request->getVar('subject'),
//            'mail_id' => $this->request->getVar('templates_id'),
            'content' => $this->request->getVar('content'),
            'attachment' => $attach_name,
        ];

        $update_data = $MailTemplates->update($id, $data);
        if ($update_data) {
            $response = 1;
        } else {
            $response = 0;
        }
        return $this->response->setJSON($response);
    }

    public function mailActiveInactive() {
        $mail_id = $this->request->getVar("mail_id");
        if ($this->request->getVar("status") == '1') {
            $data = array('is_active' => '0');
        } else {
            $data = array('is_active' => '1');
        }
        $MailTemplates = new MailTemplates();
        $admin_data = $MailTemplates->active_inactive_mails($mail_id, $data);
        if ($admin_data) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function manage_queries() {
        $data['page_title'] = "Admin - Manage Queries";
        $data['spgname'] = "manage-queries";
        $data['load_page'] = "admin/content/manage_queries";
        $ManageQueries = new ManageQueries();
        $data['queries'] = $ManageQueries->get_all_queries();
        return view('admin/content/kernel', $data);
    }

    public function get_query_data() {
        $ManageQueries = new ManageQueries();
        $querie_id = $this->request->getVar('querie_id');
        $queries = $ManageQueries->find($querie_id);
        echo json_encode($queries);
        exit();
    }

    public function querieActiveInactive() {
        $querie_id = $this->request->getVar("querie_id");
        if ($this->request->getVar("status") == '1') {
            $data = array('is_read' => '0');
        } else {
            $data = array('is_read' => '1');
        }
        $ManageQueries = new ManageQueries();
        $admin_data = $ManageQueries->active_inactive_queries($querie_id, $data);
        if ($admin_data) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function manage_services() {
        $data['page_title'] = "Admin - Manage services";
        $data['spgname'] = "manage-services";
        $data['load_page'] = "admin/content/manage_services";
        $Services = new Services();
        $data['services'] = $Services->get_all_services();
        return view('admin/content/kernel', $data);
    }

    public function edit_services($id) {

        $Services = new Services();
        $edit_page_id = base64_decode($id);
        $data['page_title'] = "Edit Service";
        $data['spgname'] = "manage-services";
        $data['current_page'] = "edit-services";
        $data['load_page'] = "admin/content/edit_services";
        $data['back'] = $_SERVER['HTTP_REFERER'];
        $data['services'] = $Services->where('id', $edit_page_id)->first();
        return view('admin/content/kernel', $data);
    }

//    public function save_service() {
////        echo '<pre>';
////        print_r($this->request->getVar());
////        exit();
//        $icon_data = $this->request->getVar('icon');
//        if ($icon_data) {
//            list($type, $icon_data) = explode(';', $icon_data);
//            list(, $icon_data) = explode(',', icon_data);
//
//            $icon_data = base64_decode($icon_data);
//            $icon_name = time() . '.png';
//            //$path =  base_url(). "/uploads/brands/" . $image_name;
//            if (!is_dir(UPLOAD_SERVICE_PATH)) {
//                mkdir(UPLOAD_SERVICE_PATH, 0777, true);
//            }
//            $path = UPLOAD_SERVICE_PATH . $icon_name;
//            $output = file_put_contents($path, $icon_data);
//            $source = base_url() . "/admin-assets/uploads/service/1/" . $icon_name;
//        } else {
//            $icon_name = $this->request->getVar('icon');
//        }
//        $Services = new Services();
////        $service_id = base64_decode($this->request->getVar('id'));
//        $data = array(
//            'name' => $this->request->getVar('name'),
//            'icon' => $icon_name,
//            'description' => $this->request->getVar('description'),
//            'price' => $this->request->getVar('price'),
//            'gst' => $this->request->getVar('gst'),
//            'service_charge' => $this->request->getVar('service_charge'),
//            'tax' => $this->request->getVar('tax'),
//        );
////      $insert_data = $CmsPages->insert($data);
//        $insert_data = $Services->insert($data);
//        if ($insert_data) {
//            $response = 1;
//        } else {
//            $response = 0;
//        }
//        return $this->response->setJSON($response);
//    }

    public function update_service() {
//        echo '<pre>';
//        print_r($this->request->getVar());
//        exit();
        $service_id = base64_decode($this->request->getVar('id'));
        $icon_data = $this->request->getVar('icon');
        if ($icon_data) {
            list($type, $icon_data) = explode(';', $icon_data);
            list(, $icon_data) = explode(',', $icon_data);

            $icon_data = base64_decode($icon_data);
            $icon_name = time() . '.png';
            //$path =  base_url(). "/uploads/brands/" . $image_name;
            if (!is_dir(UPLOAD_SERVICE_PATH)) {
                mkdir(UPLOAD_SERVICE_PATH, 0777, true);
            }
            $path = UPLOAD_SERVICE_PATH . $service_id . "/" . $icon_name;
            $output = file_put_contents($path, $icon_data);
            $source = base_url() . "/admin-assets/uploads/service/" . $service_id . "/" . $icon_name;
        } else {
            $icon_name = $this->request->getVar('icon');
        }
        $Services = new Services();
//        $service_id = base64_decode($this->request->getVar('id'));
        $data = array(
            'name' => $this->request->getVar('name'),
            'icon' => $icon_name,
            'description' => $this->request->getVar('description'),
            'price' => $this->request->getVar('price'),
            'gst' => $this->request->getVar('gst'),
            'service_charge' => $this->request->getVar('service_charge'),
            'tax' => $this->request->getVar('tax'),
        );
//         $update = $UserRegister->update_service('user_register', $data, array('id'=>$id));
        $update_service = $Services->update_service($service_id, $data);
        return $this->response->setJSON($update_service);
    }

    public function delete_service() {
//        print_r($this->request->getVar("bond_id"));
//        exit;
        $id = $this->request->getVar("serviceid");
        $Services = new Services();
        $service_data = $Services->delete_service($id);
        if ($service_data) {
            $response = 1;
        } else {
            $response = 0;
        }
        return $this->response->setJSON($response);
    }

    public function serviceActiveInactive() {
        $service_id = $this->request->getVar("service_id");
        if ($this->request->getVar("status") == '1') {
            $data = array('is_active' => '0');
        } else {
            $data = array('is_active' => '1');
        }
        $Services = new Services();
        $admin_data = $Services->active_inactive_services($service_id, $data);
        if ($admin_data) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function manage_seo() {

        $data['page_title'] = "Admin - Manage SEO";
        $data['spgname'] = "manage-seo";
        $data['load_page'] = "admin/content/manage_seo";
        $SeoModel = new SeoModel();
        $data['seo'] = $SeoModel->get_all_seo();
//        e$datacho '<pre>';
//        print_r($data['seo']);
//        exit();
        return view('admin/content/kernel', $data);
    }

    public function edit_seo($id) {

        $SeoModel = new SeoModel();
        $edit_page_id = base64_decode($id);
        $data['page_title'] = "Edit SEO";
        $data['spgname'] = "manage-seo";
        $data['current_page'] = "edit-seo";
        $data['load_page'] = "admin/content/edit_seo";
        $data['back'] = $_SERVER['HTTP_REFERER'];
        $data['seo'] = $SeoModel->where('id', $edit_page_id)->first();
        return view('admin/content/kernel', $data);
    }

    public function update_seo() {
//        echo '<pre>';
//        print_r($this->request->getVar());
//        exit();
        $id = base64_decode($this->request->getVar('id'));
        $SeoModel = new SeoModel();

        $data = array(
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'keywords' => $this->request->getVar('keywords'),
            'canonical_url' => $this->request->getVar('canonical'),
        );
//         $update = $UserRegister->update_user('user_register', $data, array('id'=>$id));
        $update_seo = $SeoModel->update_seo($id, $data);
        return $this->response->setJSON($update_seo);
    }

    public function seoActiveInactive() {
        $id = $this->request->getVar("id");
        if ($this->request->getVar("status") == '1') {
            $data = array('is_active' => '0');
        } else {
            $data = array('is_active' => '1');
        }
        $SeoModel = new SeoModel();
        $admin_data = $SeoModel->active_inactive_seo($id, $data);
        if ($admin_data) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function manage_setting() {

        $data['page_title'] = "Admin - Manage Setting";
        $data['spgname'] = "manage-setting";
        $data['load_page'] = "admin/content/manage_setting";
        $SettingsModel = new SettingsModel();
        $data['settings'] = $SettingsModel->get_all_settings();
//        e$datacho '<pre>';
//        print_r($data['seo']);
//        exit();
        return view('admin/content/kernel', $data);
    }

    public function logo_crop() {
//         echo '<pre>';
//        print_r($this->request->getVar());
//        exit();
        $image_data = $this->request->getVar('image');
        $id = $this->request->getVar('id');

        list($type, $image_data) = explode(';', $image_data);
        list(, $image_data) = explode(',', $image_data);

        $image_data = base64_decode($image_data);
        $image_name = time() . '.png';
        //$path =  base_url(). "/uploads/brands/" . $image_name;
        if (!is_dir(UPLOAD_LOGO_PATH . $id)) {
            mkdir(UPLOAD_LOGO_PATH . $id, 0777, true);
        }
        $path = UPLOAD_LOGO_PATH . $id . "/" . $image_name;
        $output = file_put_contents($path, $image_data);
        $source = base_url() . "/admin-assets/uploads/setting/" . $id . "/" . $image_name;
        //print_r($source); 
        //exit;    
        //$cpImg = adds`1hes(file_get_contents($image_name));
        $SettingsModel = new SettingsModel();
        $website_logo = $SettingsModel->get_setting_logo($id);
        if ($website_logo == 1) {
            $update_data = ["logo" => $image_name];
            $update_logo = $SettingsModel->update_setting_logo($id, $update_data);
        }
        if ($update_logo) {
            $response = [
                'success' => true,
                'msg' => "Logo updated successfully",
                'source' => $source,
            ];
        } else {
            $response = [
                'success' => false,
                'msg' => "Logo not uploaded, Please try again",
                'source' => $source,
            ];
        }
        return $this->response->setJSON($response);
        //return json_encode(['status' => 1, 'message' => "Image uploaded successfully"]);
    }

    public function update_setting() {
//        echo '<pre>';
//        print_r($this->request->getVar());
//        exit();
        $SettingsModel = new SettingsModel();
        $settingId = $this->request->getVar('settingId');
        $data = array(
            'name' => $this->request->getVar('settingName'),
        );
        $update_setting = $SettingsModel->update_setting($settingId, $data);
        return $this->response->setJSON($update_setting);
    }

    public function manage_reports() {

        $data['page_title'] = "Admin - Manage Reports";
        $data['spgname'] = "manage-reports";
        $data['load_page'] = "admin/content/manage_reports";
//        $ReportsModel = new ReportsModel();
//        $data['reports'] = $ReportsModel->findAll();
//        e$datacho '<pre>';
//        print_r($data['seo']);
//        exit();
        return view('admin/content/kernel', $data);
    }

    public function manage_teams() {
        $data['page_title'] = "Admin - Manage Teams";
        $data['spgname'] = "manage-teams";
        $data['load_page'] = "admin/content/manage_teams";
        $ManageTeam = new ManageTeam();
        $data['teams'] = $ManageTeam->get_all_teams();
        return view('admin/content/kernel', $data);
    }

    public function edit_team($id) {

        $ManageTeam = new ManageTeam();
        $edit_team_id = base64_decode($id);
        $data['page_title'] = "Edit Team";
        $data['spgname'] = "manage-team";
        $data['current_page'] = "edit-team";
        $data['load_page'] = "admin/content/edit_team";
        $data['back'] = $_SERVER['HTTP_REFERER'];
        $data['teams'] = $ManageTeam->where('id', $edit_team_id)->first();
        return view('admin/content/kernel', $data);
    }

    public function update_team() {
//        echo '<pre>';
//        print_r($this->request->getVar());
//        exit();
        $team_id = base64_decode($this->request->getVar('team_id'));
        $image_data = $this->request->getVar('team_image');
//        echo '<pre>';
//        print_r($team_id);
//        die;
        if ($image_data) {
//            print_r($image_data);
//            die;
            list($type, $image_data) = explode(";", $image_data);
            list(, $image_data) = explode(",", $image_data);


            $image_data = base64_decode($image_data);
//           print_r($image_data);
//            die;
            $image_name = time() . '.png';
            //$path =  base_url(). "/uploads/brands/" . $image_name;
            if (!is_dir(UPLOAD_TEAM_PATH)) {
                mkdir(UPLOAD_TEAM_PATH, 0777, true);
            }
            $path = UPLOAD_TEAM_PATH . $team_id . "/" . $image_name;
            $output = file_put_contents($path, $image_data);
//            echo '<pre>';
//            print_r($path);
//            die;
            $source = base_url() . "/admin-assets/uploads/team/" . $team_id . "/" . $image_name;
//            echo '<pre>';
//            print_r($source);
//            die;
        } else {
            $image_name = $this->request->getVar('image');
        }
        $ManageTeam = new ManageTeam();
//        $service_id = base64_decode($this->request->getVar('id'));
        $data = array(
            'fullname' => $this->request->getVar('fullname'),
            'designation' => $this->request->getVar('designation'),
            'image' => $image_name,
            'content' => $this->request->getVar('content'),
        );
//         $update = $UserRegister->update_service('user_register', $data, array('id'=>$id));
        $update_team = $ManageTeam->update_team($team_id, $data);
        return $this->response->setJSON($update_team);
    }

    public function teamActiveInactive() {
        $team_id = $this->request->getVar("team_id");
        if ($this->request->getVar("status") == '1') {
            $data = array('is_active' => '0');
        } else {
            $data = array('is_active' => '1');
        }
        $ManageTeam = new ManageTeam();
        $admin_data = $ManageTeam->active_inactive_teams($team_id, $data);
        if ($admin_data) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function admin_logout() {
        $session = session();
        delete_cookie('remember');
        $session->destroy();
        return redirect()->to('admin/login');
    }

}
