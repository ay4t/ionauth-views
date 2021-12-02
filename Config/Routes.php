<?php 
namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Route ay4t Auth Definitions
 * --------------------------------------------------------------------
 */
$routes->group('auth', ['namespace' => 'IonauthView\Controllers'], function ($routes) {
	$routes->get('login', 'Auth::signin');
	$routes->get('signup', 'Auth::signup');
	$routes->get('forgot_password', 'Auth::forgotPassword');
	$routes->get('reset_password/(:hash)', 'Auth::resetPassword/$1');
	$routes->get('logout', 'Auth::signout');
	
	/** ROUTES FOR APIS CALL BY AJAX FORM */
	$routes->post('login', 'AuthHandler::doSignIn');
	$routes->post('signup', 'SignupHandler::create');
	$routes->post('forgot_password', 'ForgotPassHandler::createForgotPassword');
	$routes->post('reset_password', 'ForgotPassHandler::createResetPassword');
}); 