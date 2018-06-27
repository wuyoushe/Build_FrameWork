<?php
// example.com/web/front.php
require_once __DIR__.'/../src/autoload.php';
//require_once __DIR__.'/../vendor/.composer/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;

function render_template($request)
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
$resoler = new HttpKernel\Controller\ControllerResolver();

//try {
//    extract($matcher->match($request->getPathInfo()), EXTR_SKIP);
//    ob_start();
//    include sprintf(__DIR__.'/../src/pages/%s.php', $_route);
//
//    $response = new Response(ob_get_clean());
//} catch (Routing\Exception\ResourceNotFoundException $e) {
//    $response = new Response('Not Found', 404);
//} catch (Exception $e) {
//    $response = new Response('An error occurred', 500);
//}

//把每个路由规则都加上控制器属性
//当然，在控制器代码里面，你还是可以使用写好的 render_template 方法：
//$routes->add('hello', new Routing\Route('/hello/{name}', array(
//    'name'          => 'World',
//    '_controller'   => function ($request) {
//        return render_template($request);
//    },
//)));

try {
   $request->attributes->add($matcher->match($request->getPathInfo()));

   $controller = $resolver->getController($request);
   $arguments  = $resolver->getArguments($request, $controller);

   $response = call_user_func($request->attributes->get('_controller'), $request);
} catch(Routing\Exception\ResourceNotFoundException $e){
    $response = new Response('Not Found', 404);
} catch(Exception $e) {
    $response = new Response('An error occurred', 500);
}

$response->send();

















