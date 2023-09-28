<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
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

$routes->get('/login', 'LoginController::index');
$routes->post('/login', 'LoginController::process');
$routes->get('/logout', 'LoginController::logout');

$routes->get('/', function () {
    return view('landing-page');
});

$routes->group('', ['filter' => 'usersAuth'], static function ($routes) {
    // $routes->get('/home', 'Home::index');
    $routes->get('/home', 'Home::home');
    // $routes->get('/', 'Home::home');

    $routes->group('gls', static function ($routes) {
        $routes->get('', 'GlsController::index');
        $routes->get('(:segment)', 'GlsController::show/$1', ['as' => 'gl_show']);
        $routes->post('', 'GlsController::store', ['as' => 'gl_store']);
        $routes->get('edit/(:segment)', 'GlsController::edit/$1', ['as' => 'gl_edit']);
        $routes->put('(:segment)', 'GlsController::update/$1', ['as' => 'gl_update']);
        $routes->delete('(:segment)', 'GlsController::destroy/$1', ['as' => 'gl_destroy']);
    });
    $routes->group('lines', static function ($routes) {
        $routes->get('', 'LinesController::index');
        $routes->get('(:segment)', 'LinesController::show/$1', ['as' => 'line_show']);
        $routes->post('', 'LinesController::store', ['as' => 'line_store']);
        $routes->get('edit/(:segment)', 'LinesController::edit/$1', ['as' => 'line_edit']);
        $routes->put('(:segment)', 'LinesController::update/$1', ['as' => 'line_update']);
        $routes->delete('(:segment)', 'LinesController::destroy/$1', ['as' => 'line_destroy']);
    });
    $routes->group('groups', static function ($routes) {
        $routes->get('', 'GroupsController::index');
        $routes->get('(:segment)', 'GroupsController::show/$1', ['as' => 'group_show']);
        $routes->post('', 'GroupsController::store', ['as' => 'group_store']);
        $routes->get('edit/(:segment)', 'GroupsController::edit/$1', ['as' => 'group_edit']);
        $routes->put('(:segment)', 'GroupsController::update/$1', ['as' => 'group_update']);
        $routes->delete('(:segment)', 'GroupsController::destroy/$1', ['as' => 'group_destroy']);
    });
    $routes->group('remarks', static function ($routes) {
        $routes->get('', 'RemarksController::index');
        $routes->get('(:segment)', 'RemarksController::show/$1', ['as' => 'remark_show']);
        $routes->post('', 'RemarksController::store', ['as' => 'remark_store']);
        $routes->get('edit/(:segment)', 'RemarksController::edit/$1', ['as' => 'remark_edit']);
        $routes->put('(:segment)', 'RemarksController::update/$1', ['as' => 'remark_update']);
        $routes->delete('(:segment)', 'RemarksController::destroy/$1', ['as' => 'remark_destroy']);
    });
    $routes->group('buyers', static function ($routes) {
        $routes->get('', 'BuyersController::index');
        $routes->get('(:segment)', 'BuyersController::show/$1', ['as' => 'buyer_show']);
        $routes->post('', 'BuyersController::store', ['as' => 'buyer_store']);
        $routes->get('edit/(:segment)', 'BuyersController::edit/$1', ['as' => 'buyer_edit']);
        $routes->put('(:segment)', 'BuyersController::update/$1', ['as' => 'buyer_update']);
        $routes->delete('(:segment)', 'BuyersController::destroy/$1', ['as' => 'buyer_destroy']);
    });

    $routes->group('categories', static function ($routes) {
        $routes->get('', 'CategoriesController::index');
        $routes->get('(:segment)', 'CategoriesController::show/$1', ['as' => 'category_show']);
        $routes->post('', 'CategoriesController::store', ['as' => 'category_store']);
        $routes->get('edit/(:segment)', 'CategoriesController::edit/$1', ['as' => 'category_edit']);
        $routes->put('(:segment)', 'CategoriesController::update/$1', ['as' => 'category_update']);
        $routes->delete('(:segment)', 'CategoriesController::destroy/$1', ['as' => 'category_destroy']);
    });

    $routes->get('output-record-create', 'OutputRecordsController::create', ['as' => 'output_record_create']);
    $routes->group('output-records', static function ($routes) {
        $routes->get('', 'OutputRecordsController::index');
        $routes->get('create', 'OutputRecordsController::create', ['as' => 'output_record_create']);
        $routes->get('(:segment)', 'OutputRecordsController::show/$1', ['as' => 'output_record_show']);
        $routes->post('', 'OutputRecordsController::store', ['as' => 'output_record_store']);
        $routes->get('edit/(:segment)', 'OutputRecordsController::edit/$1', ['as' => 'output_record_edit']);
        $routes->put('(:segment)', 'OutputRecordsController::update/$1', ['as' => 'output_record_update']);
        $routes->delete('(:segment)', 'OutputRecordsController::destroy/$1', ['as' => 'output_record_destroy']);
    });
    $routes->group('slideshows', static function ($routes) {
        $routes->get('', 'SlideshowsController::index');
        $routes->get('(:segment)', 'SlideshowsController::show/$1', ['as' => 'slideshow_show']);
        $routes->post('', 'SlideshowsController::store', ['as' => 'slideshow_store']);
        $routes->get('edit/(:segment)', 'SlideshowsController::edit/$1', ['as' => 'slideshow_edit']);
        $routes->put('(:segment)', 'SlideshowsController::update/$1', ['as' => 'slideshow_update']);
        $routes->delete('(:segment)', 'SlideshowsController::destroy/$1', ['as' => 'slideshow_destroy']);

        $routes->get('toggle/flag_status', 'SlideshowsController::toggle_status', ['as' => 'slideshow_toggle_status']);
    });

    $routes->group('report', static function ($routes) {
        $routes->get('defect', 'ReportController::defect', ['as' => 'defect_report']);
        $routes->get('downtime', 'ReportController::downtime', ['as' => 'downtime_report']);
        $routes->get('efficiency', 'ReportController::efficiency', ['as' => 'efficiency_report']);
        $routes->get('output', 'ReportController::output', ['as' => 'output_report']);
    });

    // ## Route for Datatable
    $routes->group('dtable', static function ($routes) {
        $routes->get('buyer', 'BuyersController::dtableBuyer', ['as' => 'dtable_buyer']);
        $routes->get('gl', 'GlsController::dtableGl', ['as' => 'dtable_gl']);
        $routes->get('line', 'LinesController::dtableLine', ['as' => 'dtable_line']);
        $routes->get('group', 'GroupsController::dtableGroup', ['as' => 'dtable_group']);
        $routes->get('output-record', 'OutputRecordsController::dtableOutputRecord', ['as' => 'dtable_output_record']);
        $routes->get('slideshow', 'SlideshowsController::dtableSlideshow', ['as' => 'dtable_slideshow']);
        $routes->get('remark', 'RemarksController::dtableRemark', ['as' => 'dtable_remark']);
        $routes->get('category', 'CategoriesController::dtableCategory', ['as' => 'dtable_category']);
    });

    $routes->group('fetch', static function ($routes) {
        $routes->get('', 'FetchController::index');
        $routes->get('style', 'FetchController::style', ['as' => 'fetch_style']);
    });


    // ## Log Viewer Route
    $routes->get('logs', "LogViewerController::index");
});


// ## Dashboard Page BARU
$routes->get('dashboard', 'DashboardController::index', ['as' => 'dashboard']);


// ## Dashboard Page
$routes->get('dashboard-production', 'DashboardProductionsController::index', ['as' => 'dashboard-production']);
$routes->get('dashboard-production-date/(:any)', 'DashboardProductionsController::index_date/$1', ['as' => 'dashboard-production-date']);
$routes->get('dashboard-production/get-data', 'DashboardProductionsController::getDataDashboard', ['as' => 'get_data_dashboard']);

$routes->get('dashboard-production-manager', 'DashboardProductionsController::dashboardManager', ['as' => 'dashboard_manager']);
$routes->get('dashboard-production/get-data-all-line', 'DashboardProductionsController::getDataAllLine', ['as' => 'get_data_all_line']);

$routes->get('dashboard-video', 'DashboardVideo', ['as' => 'dashboard_video']);

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
