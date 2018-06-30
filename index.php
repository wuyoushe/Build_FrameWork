<?php
//framework/index

//require_once __DIR__.'/vendor/autoload.php';

//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;

//createFromGlobals()方法会根据当前的PHP的全局变量生成一个Request对象
//$request = Request::createFromGlobals();


// $input = isset($_GET['name']) ? $_GET['name'] ? 'World';

// header('Content-Type: text/html;charset=utf-8')

// printf('Hello %s', htmpspecialchars($input, ENT_QUOTES, 'UTF-8')); 

// $input = $request->get('name', 'World');

// $response = new Response(sprintf(
// 	'Hello %s',
// 	htmpspecialchars($input, ENT_QUOTES, 'UTF-8')
// ));

// //send()方法返回Reponse对象里的内容到客户端(先根据内容发送HTTP头信息)
// $response->send();

//信任的ip获取
// if ($myIp == $_SERVER['HTTP_X_FORWARDED_FOR'] || $myIp == $_SERVER['REMOTE_ADDR']) {
	//被信任的IP,给一些权限
// //}
//Request::setTrustedProxies(array('10.0.0.1'));

//Request::getClientIp()始终可以获取正确的用户IP
// $request = Request::createFromGlobals();
// if ($myIp == $request->getClientIp()) {}

/**
* 首页重构
*/
//require_once __DIR__.'/init.php';
//
//$input = $request->get('name', 'World');
//
//$response = new Response(sprintf(
//	'Hello %s',
//	htmpspecialchars($input, ENT_QUOTES, 'UTF-8')
//));
//
////send()方法返回Reponse对象里的内容到客户端(先根据内容发送HTTP头信息)
//$response->send();






















