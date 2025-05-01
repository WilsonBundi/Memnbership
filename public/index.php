<?php
session_start();
require_once __DIR__.'/../app/controllers/AuthController.php';
require_once __DIR__.'/../app/controllers/FamilyController.php';
require_once __DIR__.'/../app/controllers/MemberController.php';

// Get clean request path
$basePath = '/Membership/public';
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$cleanRequest = str_replace($basePath, '', $requestUri);

switch ($cleanRequest) {
    case '/':
    case '/login':
        (new AuthController())->login();
        break;
    
    case '/families':
        (new FamilyController())->index();
        break;
        
    case '/families/create':
        (new FamilyController())->create();
        break;
        
    case '/families/store':
        (new FamilyController())->store();
        break;
        
    case '/members':
        (new MemberController())->index();
        break;
        
    case '/logout':
        (new AuthController())->logout();
        break;
        
    default:
        http_response_code(404);
        include __DIR__.'/../app/views/errors/404.php';
        exit();
}