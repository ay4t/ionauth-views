# ionauth-views
Custom Views with IonAuth Libraries for Codeigniter 4

----------------------------------------------------------------
#REQURMENT:
- ion_auth must be username as Identifier login. If you want to change it as you wish then make the changes yourself
- use Codeigniter 4 installation from composer
- require ion_auth 4 from composer
----------------------------------------------------------------

#STEP INSTALLATION:
1. Install Codeigniter 4 via Composer
```
composer create-project codeigniter4/appstarter codeigniter4
```

2. install ion_auth libraries:

```
composer config minimum-stability dev
composer config repositories.ionAuth vcs git@github.com:benedmunds/CodeIgniter-Ion-Auth.git
composer require benedmunds/CodeIgniter-Ion-Auth:4.x-dev
```

then migrate database and seed database data
```
php spark migrate -n IonAuth
php spark db:seed IonAuth\Database\Seeds\IonAuthSeeder
```
3. install ay4t\ionauth-views view
This plugins use Username as Identifier. You must change default ionAuth Identifier form "email" to "username"
```
composer config repositories.ionauthview vcs git@github.com:ay4t/ionauth-views.git
composer require ay4t/ionauth-views
```

4. add to Config/Routes.php
```sh
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
```

#BOOMS now let's open http://`<domain>`/auth/login