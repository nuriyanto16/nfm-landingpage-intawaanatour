<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ---------------------------------------------------------------------
// Publik
// ---------------------------------------------------------------------
$routes->get('/', 'Home::index');
$routes->get('home/section/(:segment)', 'Home::section/$1'); // fragmen async (skeleton)
$routes->get('about', 'Pages::about');
$routes->get('contact', 'Pages::contact');

$routes->get('trips', 'Trips::index');
$routes->get('trips/(:segment)', 'Trips::detail/$1');

$routes->get('gallery', 'Gallery::index');

$routes->get('articles', 'Articles::index');
$routes->get('articles/(:segment)', 'Articles::detail/$1');

$routes->post('booking', 'Booking::store');

$routes->get('lang/(:segment)', 'Language::set/$1');

// CAPTCHA (gambar, dipakai di form login admin)
$routes->get('admin/captcha', 'Captcha::image');

// SEO
$routes->get('sitemap.xml', 'Seo::sitemap');
$routes->get('robots.txt', 'Seo::robots');

// ---------------------------------------------------------------------
// Admin
// ---------------------------------------------------------------------
$routes->group('admin', static function ($routes) {
    // Auth (tanpa filter)
    $routes->get('login', 'Admin\Auth::login');
    $routes->post('login', 'Admin\Auth::attempt');
    $routes->get('logout', 'Admin\Auth::logout');

    // Area terproteksi
    $routes->group('', ['filter' => 'adminauth'], static function ($routes) {
        $routes->get('/', 'Admin\Dashboard::index');

        $routes->get('trips', 'Admin\TripController::index');
        $routes->get('trips/new', 'Admin\TripController::new');
        $routes->post('trips', 'Admin\TripController::create');
        $routes->get('trips/(:num)/edit', 'Admin\TripController::edit/$1');
        $routes->post('trips/(:num)', 'Admin\TripController::update/$1');
        $routes->get('trips/(:num)/delete', 'Admin\TripController::delete/$1');
        $routes->get('trips/image/(:num)/delete', 'Admin\TripController::deleteImage/$1');

        $routes->get('gallery', 'Admin\GalleryController::index');
        $routes->post('gallery', 'Admin\GalleryController::create');
        $routes->get('gallery/(:num)/delete', 'Admin\GalleryController::delete/$1');

        $routes->get('articles', 'Admin\ArticleController::index');
        $routes->get('articles/new', 'Admin\ArticleController::new');
        $routes->post('articles', 'Admin\ArticleController::create');
        $routes->get('articles/(:num)/edit', 'Admin\ArticleController::edit/$1');
        $routes->post('articles/(:num)', 'Admin\ArticleController::update/$1');
        $routes->get('articles/(:num)/delete', 'Admin\ArticleController::delete/$1');

        $routes->get('bookings', 'Admin\BookingController::index');
        $routes->get('bookings/(:num)/status/(:segment)', 'Admin\BookingController::setStatus/$1/$2');
        $routes->get('bookings/(:num)/delete', 'Admin\BookingController::delete/$1');

        $routes->get('settings', 'Admin\SettingController::index');
        $routes->post('settings', 'Admin\SettingController::update');

        $routes->get('account', 'Admin\Account::index');
        $routes->post('account/password', 'Admin\Account::changePassword');
    });
});
