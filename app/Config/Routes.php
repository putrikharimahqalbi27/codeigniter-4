<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 * 
 */
$routes->get('/', 'Home::index');
$routes->setAutoRoute(true);
$routes->get('surat/upload', 'Peminjaman::uploadView'); // Untuk menampilkan form upload
$routes->post('surat/upload', 'Peminjaman::surat'); // Untuk memproses upload file
