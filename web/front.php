<?php
// example.com/web/front.php
//require_once __DIR__.'/../vendor/autoload.php';
//require_once __DIR__.'/../vendor/.composer/autoload.php';
//添加路由版本
//require_once __DIR__.'/../vendor/autoload.php';
//
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing;
//
//$request = Request::createFromGlobals();
//$routes = include __DIR__.'/../src/app.php';
//
//$context = new Routing\RequestContext();
//$context->fromRequest($request);
//$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
//
//try {
//    extract($matcher->match($request->getPathInfo()), EXTR_SKIP);
//    ob_start();
//    include sprintf(__DIR__.'/../src/pages/%s.php', $_route);
//
//    $response = new Response(ob_get_clean());
//} catch (Routing\Exception\ResourceNotFoundException $exception) {
//    $response = new Response('Not Found', 404);
//} catch (Exception $exception) {
//    $response = new Response('An error occurred', 500);
//}
//
//$response->send();

/*********************************************添加模板****************************/

// example.com/web/front.php
//require_once __DIR__.'/../vendor/autoload.php';
//
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing;
//
//function render_template($request)
//{
//    extract($request->attributes->all(), EXTR_SKIP);
//    ob_start();
//    include sprintf(__DIR__.'/../src/pages/%s.php', $_route);
//
//    return new Response(ob_get_clean());
//}
//
//$request = Request::createFromGlobals();
//$routes = include __DIR__.'/../src/app.php';
//
//$context = new Routing\RequestContext();
//$context->fromRequest($request);
//$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
//
//try {
//    $request->attributes->add($matcher->match($request->getPathInfo()));
//    $response = call_user_func($request->attributes->get('_controller'), $request);
//} catch (Routing\Exception\ResourceNotFoundException $exception) {
//    $response = new Response('Not Found', 404);
//} catch (Exception $exception) {
//    $response = new Response('An error occurred', 500);
//}
//
//$response->send();

/*********************************************添加http-kernel*****************/
// example.com/web/front.php
//require_once __DIR__.'/../vendor/autoload.php';
//
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing;
//use Symfony\Component\HttpKernel;
//
//function render_template(Request $request)
//{
//    extract($request->attributes->all(), EXTR_SKIP);
//    ob_start();
//    include sprintf(__DIR__.'/../src/pages/%s.php', $_route);
//
//    return new Response(ob_get_clean());
//}
//
//$request = Request::createFromGlobals();
//$routes = include __DIR__.'/../src/app.php';
//
//$context = new Routing\RequestContext();
//$context->fromRequest($request);
//$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
//
//$controllerResolver = new HttpKernel\Controller\ControllerResolver();
//$argumentResolver = new HttpKernel\Controller\ArgumentResolver();
//
//try {
//    $request->attributes->add($matcher->match($request->getPathInfo()));
//
//    $controller = $controllerResolver->getController($request);
//    $arguments = $argumentResolver->getArguments($request, $controller);
//
//    $response = call_user_func_array($controller, $arguments);
//} catch (Routing\Exception\ResourceNotFoundException $exception) {
//    $response = new Response('Not Found', 404);
//} catch (Exception $exception) {
//    $response = new Response('An error occurred', 500);
//}
//
//$response->send();

/******************/
//require_once __DIR__.'/../vendor/autoload.php';
//
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing;
//use Symfony\Component\HttpKernel;
//
//function render_template(Request $request)
//{
//    extract($request->attributes->all(), EXTR_SKIP);
//    ob_start();
//    include sprintf(__DIR__.'/../src/pages/%s.php', $_route);
//
//    return new Response(ob_get_clean());
//}
//
//$request = Request::createFromGlobals();
//$routes = include __DIR__.'/../src/app.php';
//
//$context = new Routing\RequestContext();
//$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
//
//$controllerResolver = new ControllerResolver();
//$argumentResolver = new ArgumentResolver();
//
//$framework = new Simplex\Framework($matcher, $controllerResolver, $argumentResolver);
//$response = $framework->handle($request);
//
//$response->send();

// example.com/web/front.php
//require_once __DIR__.'/../vendor/autoload.php';
//
//// ...
//
//use Symfony\Component\EventDispatcher\EventDispatcher;
//
//$dispatcher = new EventDispatcher();
//$dispatcher->addListener('response', function (Simplex\ResponseEvent $event) {
//    $response = $event->getResponse();
//
//    if ($response->isRedirection()
//        || ($response->headers->has('Content-Type') && false === strpos($response->headers->get('Content-Type'), 'html'))
//        || 'html' !== $event->getRequest()->getRequestFormat()
//    ) {
//        return;
//    }
//
//    $response->setContent($response->getContent().'GA CODE');
//});
//
//$controllerResolver = new ControllerResolver();
//$argumentResolver = new ArgumentResolver();
//
//$framework = new Simplex\Framework($dispatcher, $matcher, $controllerResolver, $argumentResolver);
//$response = $framework->handle($request);
//
//$response->send();

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;

function render_template(Request $request)
{
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    include sprintf(__DIR__.'/../src/pages/%s.php', $_route);

    return new Response(ob_get_clean());
}

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/app.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

try {
    $request->attributes->add($matcher->match($request->getPathInfo()));

    $controller = $controllerResolver->getController($request);
    $arguments = $argumentResolver->getArguments($request, $controller);

    $response = call_user_func_array($controller, $arguments);
} catch (Routing\Exception\ResourceNotFoundException $e) {
    $response = new Response('Not Found', 404);
} catch (Exception $e) {
    $response = new Response('An error occurred', 500);
}

$response->send();


















