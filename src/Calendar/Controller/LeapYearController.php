<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/27
 * Time: 13:10
 */

use Symfony\Component\Routing;
use Symfony\Component\HttpFoundation\Response;

class LeapYearController
{
    public function indexAction($request)
    {
        if (is_leap_year($request->attributes->get('year'))) {
            return new Response('Yep, this is a leap year!');
        }

        return new Response('Nope, this is not a leap year.');
    }
}