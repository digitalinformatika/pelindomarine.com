<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Company
$routes->get('company/about-us', 'Home::aboutUs');
$routes->get('company/regulatory', 'Home::regulatory');
$routes->get('company/news', 'Home::news');
$routes->get('company/news/(:any)', 'Home::news/$1');
$routes->get('company/readnews/(:any)', 'Home::readnews/$1');
$routes->get('company/careers', 'Home::careers');
$routes->get('profile/(:any)', 'Home::profiles');
$routes->get('line-of-business/(:any)', 'Home::lineOfBusiness');

// Services
$routes->match(['GET', 'POST'], 'services/vessel', 'Home::vessel');
$routes->match(['GET', 'POST'], 'services/vessel/(:any)', 'Home::vessel/$1');
$routes->match(['GET', 'POST'], 'services/vessel/(:any)/(:any)', 'Home::vessel/$1/$2');
$routes->get('services/service', 'Home::service');
$routes->get('services/shipyard', 'Home::shipyard');

// Lain-lain
$routes->match(['GET', 'POST'], 'marine-care', 'Home::marinecare');
$routes->get('ppid', 'Home::ppid');
$routes->get('language', 'Home::language');
$routes->post('search', 'Home::search');

// Chatbot Marime
$routes->post('chat', 'Chat::respond');

// Form E-PPID (submit via AJAX)
$routes->post('ppid/ajax-requestPost', 'FormWizard::ajaxRequestPost');

// File statis upload warisan lama
$routes->get('main/uploads/(:any)', static function (string $path) {
    $cleanPath = str_replace(['..', "\0"], '', rawurldecode($path));
    $real = FCPATH . 'uploads/' . $cleanPath;
    if (! is_file($real)) {
        $real = FCPATH . 'upload/' . $cleanPath;
    }
    if (is_file($real)) {
        return service('response')
            ->setHeader('Content-Type', mime_content_type($real) ?: 'application/octet-stream')
            ->setHeader('Cache-Control', 'public, max-age=86400')
            ->setBody(file_get_contents($real));
    }
    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
});
