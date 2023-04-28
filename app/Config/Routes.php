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
$routes->get('/', 'Home::index');

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
$routes->group('output-records', static function ($routes) {
    $routes->get('', 'OutputRecordsController::index');
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
});


// ## Route for Datatable
$routes->group('dtable', static function ($routes){
    $routes->get('gl', 'GlsController::dtableGl',['as' => 'dtable_gl']);
    $routes->get('line', 'LinesController::dtableLine',['as' => 'dtable_line']);
    $routes->get('output-record', 'OutputRecordsController::dtableOutputRecord',['as' => 'dtable_output_record']);
    $routes->get('slideshow', 'SlideshowsController::dtableSlideshow',['as' => 'dtable_slideshow']);
});


// ## Dashboard Page
$routes->get('dashboard-production','DashboardProductionsController::index', ['as' =>'dashboard-production']);
$routes->get('dashboard-production/get-data','DashboardProductionsController::getDataDashboard', ['as' =>'get_data_dashboard']);


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
