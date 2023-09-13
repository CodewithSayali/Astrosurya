<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('SiteController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'SiteController::index');
$routes->add('register', 'SiteController::register');
$routes->add('login', 'SiteController::login');
$routes->add('check-email','SiteController::check_email');
$routes->add('check-mobile','SiteController::check_mobile');
$routes->post('create-account','SiteController::create_account');
$routes->post('check-login', 'UserController::check_login');
//$routes->post('email-verify', 'SiteController::email_verify');
$routes->add('forgot-password', 'SiteController::forgot_password');
$routes->add('activate-user/(:any)/(:any)', 'SiteController::activate_user');
$routes->add('contact-us', 'SiteController::contact_us');
$routes->post('submit-contact', 'SiteController::submit_contact');

$routes->add('service', 'SiteController::service');
$routes->add('service-details/(:any)', 'SiteController::service_details');

//Payments
$routes->add('book-now', 'PaymentController::book_now');

//static pages
$routes->add('about-us', 'SiteController::about_us');
$routes->add('terms-and-conditions', 'SiteController::terms_and_conditions');
$routes->add('privacy-policy', 'SiteController::privacy_policy');
$routes->add('cookies', 'SiteController::cookies');
$routes->add('western-astrology', 'SiteController::western_astrology');
$routes->add('team-detail/(:any)', 'SiteController::team_detail');

//user dashboard

$routes->add('home', 'UserController::home');
$routes->add('logout', 'UserController::logout');
//for astrology api
$routes->add('astrology-api', 'SiteController::astrology_api');
$routes->add('birth-details', 'AstrologyController::birth_details');
$routes->add('astro-details', 'AstrologyController::astro_details');
$routes->add('planets', 'AstrologyController::planets');
$routes->add('horochart', 'AstrologyController::horochart');
$routes->add('horochart-image', 'AstrologyController::horochart_image');
$routes->add('bhav-madhya', 'AstrologyController::bhav_madhya');
$routes->add('current-vdasha', 'AstrologyController::current_vdasha');
$routes->add('pro-horoscope-pdf', 'AstrologyController::pro_horoscope_pdf');
$routes->add('read-pdf', 'AstrologyController::read_pdf');

//Admin Backend
$routes->add('admin/login', 'AdminController::login');
$routes->post('admin/check-admin-login', 'AdminController::check_admin_login');
$routes->add('admin/logout', 'AdminController::admin_logout');

$routes->add('admin/dashboard', 'AdminController::index',['filter' => 'adminAuthGuard']);
$routes->add('admin/manage-user', 'AdminController::manage_user',['filter' => 'adminAuthGuard']);
$routes->post('admin/get-user-data', 'AdminController::get_user_data',['filter' => 'adminAuthGuard']);
$routes->post('admin/update-user', 'AdminController::update_user',['filter' => 'adminAuthGuard']);
$routes->post('admin/delete-user', 'AdminController::delete_user',['filter' => 'adminAuthGuard']);

$routes->add('admin/manage-pages', 'AdminController::manage_pages',['filter' => 'adminAuthGuard']);
$routes->add('admin/edit-page/(:any)', 'AdminController::edit_page/$1',['filter' => 'adminAuthGuard']);
$routes->add('admin/save-page', 'AdminController::save_page',['filter' => 'adminAuthGuard']);
$routes->add('admin/update-page', 'AdminController::update_page',['filter' => 'adminAuthGuard']);
$routes->add('AdminController/pageActiveInactive', 'AdminController::pageActiveInactive',['filter' => 'adminAuthGuard']);

$routes->add('admin/mail-templates', 'AdminController::mail_templates',['filter' => 'adminAuthGuard']);
$routes->add('admin/edit-mail/(:any)', 'AdminController::edit_mail/$1',['filter' => 'adminAuthGuard']);
$routes->add('admin/update-mail', 'AdminController::update_mail',['filter' => 'adminAuthGuard']);
$routes->add('AdminController/mailActiveInactive', 'AdminController::mailActiveInactive',['filter' => 'adminAuthGuard']);

$routes->add('admin/manage-queries', 'AdminController::manage_queries',['filter' => 'adminAuthGuard']);
$routes->post('admin/get-query-data', 'AdminController::get_query_data',['filter' => 'adminAuthGuard']);
$routes->post('AdminController/querieActiveInactive', 'AdminController::querieActiveInactive',['filter' => 'adminAuthGuard']);

$routes->add('admin/manage-services', 'AdminController::manage_services',['filter' => 'adminAuthGuard']);
$routes->add('admin/edit-services/(:any)', 'AdminController::edit_services/$1',['filter' => 'adminAuthGuard']);
$routes->post('admin/save-service', 'AdminController::save_service',['filter' => 'adminAuthGuard']);
$routes->post('admin/update-service', 'AdminController::update_service',['filter' => 'adminAuthGuard']);
$routes->post('admin/delete-service', 'AdminController::delete_service',['filter' => 'adminAuthGuard']);
$routes->post('AdminController/serviceActiveInactive', 'AdminController::serviceActiveInactive',['filter' => 'adminAuthGuard']);

$routes->add('admin/manage-seo', 'AdminController::manage_seo',['filter' => 'adminAuthGuard']);
$routes->add('admin/edit-seo/(:any)', 'AdminController::edit_seo/$1',['filter' => 'adminAuthGuard']);
$routes->post('admin/update-seo', 'AdminController::update_seo',['filter' => 'adminAuthGuard']);
$routes->post('AdminController/seoActiveInactive', 'AdminController::seoActiveInactive',['filter' => 'adminAuthGuard']);

$routes->add('admin/manage-setting', 'AdminController::manage_setting',['filter' => 'adminAuthGuard']);
$routes->add('admin/logo-crop','AdminController::logo_crop',['filter' => 'adminAuthGuard']);
$routes->post('admin/update-setting-logo', 'AdminController::update_setting_logo',['filter' => 'adminAuthGuard']); 
$routes->add('admin/update-setting', 'AdminController::update_setting',['filter' => 'adminAuthGuard']);

$routes->add('admin/manage-reports', 'AdminController::manage_reports',['filter' => 'adminAuthGuard']);

$routes->add('admin/manage-teams', 'AdminController::manage_teams',['filter' => 'adminAuthGuard']);
$routes->add('admin/edit-team/(:any)', 'AdminController::edit_team/$1',['filter' => 'adminAuthGuard']);
$routes->post('admin/save-team', 'AdminController::save_team',['filter' => 'adminAuthGuard']);
$routes->post('admin/update-team', 'AdminController::update_team',['filter' => 'adminAuthGuard']);
$routes->post('AdminController/teamActiveInactive', 'AdminController::teamActiveInactive',['filter' => 'adminAuthGuard']);






/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
