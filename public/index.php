<?php

	ini_set('display_errors', 1);
	ini_set('display_starup_error', 1);
	error_reporting(E_ALL);

	require_once '../vendor/autoload.php';

	session_start();

	$dotenv = new Dotenv\Dotenv(__DIR__.'/..');
	$dotenv->load();

	use Illuminate\Database\Capsule\Manager as Capsule;
	use Aura\Router\RouterContainer;

	$capsule = new Capsule;

	$capsule->addConnection([
	    'driver'    => getenv('DB_DRIVER'),
	    'host'      => getenv('DB_HOST'),
	    'database'  => getenv('DB_NAME'),
	    'username'  => getenv('DB_USER'),
	    'password'  => getenv('DB_PASS'),
	    'charset'   => 'utf8',
	    'collation' => 'utf8_unicode_ci',
	    'prefix'    => '',
	]);

	// Make this Capsule instance available globally via static methods... (optional)
	$capsule->setAsGlobal();

	// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
	$capsule->bootEloquent();

	$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
	    $_SERVER,
	    $_GET,
	    $_POST,
	    $_COOKIE,
	    $_FILES
	);

	$routerContainer = new RouterContainer();
	$map = $routerContainer->getMap();

	$map->get('index', '/portafolio/', [
		'controller' => 'App\Controllers\IndexController',
		'action' => 'indexAction'
	]);

	$map->get('addJobs', '/portafolio/jobs/add', [
		'controller' => 'App\Controllers\JobsController',
		'action' => 'getAddJobAction',
		'auth' => true
	]);

	$map->post('saveJobs', '/portafolio/jobs/add', [
		'controller' => 'App\Controllers\JobsController',
		'action' => 'getAddJobAction',
		'auth' => true
	]);

	$map->get('addProjects', '/portafolio/projects/add', [
		'controller' => 'App\Controllers\ProjectsController',
		'action' => 'getAddProjectAction',
		'auth' => true
	]);

	$map->post('saveProjects', '/portafolio/projects/add', [
		'controller' => 'App\Controllers\ProjectsController',
		'action' => 'getAddProjectAction',
		'auth' => true
	]);

	$map->get('addUsers', '/portafolio/users/add', [
		'controller' => 'App\Controllers\UsersController',
		'action' => 'saveUser'
	]);

	$map->post('saveUsers', '/portafolio/users/add', [
		'controller' => 'App\Controllers\UsersController',
		'action' => 'saveUser'
	]);

	$map->get('loginForm', '/portafolio/login', [
		'controller' => 'App\Controllers\AuthController',
		'action' => 'getLogin'
	]);

	$map->get('logout', '/portafolio/logout', [
		'controller' => 'App\Controllers\AuthController',
		'action' => 'getLogout',
		'auth' => true
	]);

	$map->post('auth', '/portafolio/auth', [
		'controller' => 'App\Controllers\AuthController',
		'action' => 'postLogin',
		'auth' => true
	]);

	$map->get('admin', '/portafolio/admin', [
		'controller' => 'App\Controllers\AdminController',
		'action' => 'getIndex',
		'auth' => true
	]);

	$matcher = $routerContainer->getMatcher();
	$route = $matcher->match($request);

	if(!$route){
		echo 'No route';
	}else{
		$handlerData = $route->handler;
		$needsAuth = $handlerData['auth'] ?? false;

		$sessionUserId = $_SESSION['userId'] ?? null;

		if($needsAuth && !$sessionUserId){
			$controllerName = 'App\Controllers\AuthController';
			$actionName = 'getLogout';
		}else{
			$controllerName = $handlerData['controller'];
			$actionName = $handlerData['action'];	
		}

		$controller = new $controllerName;
		$response = $controller->$actionName($request);

		foreach ($response->getHeaders() as $name => $values) {
			foreach ($values as $value) {
				header(sprintf('%s: %s', $name, $value), false);
			}
		}

		http_response_code($response->getStatusCode());
		echo $response->getBody();
	}
	

