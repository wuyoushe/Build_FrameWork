<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/27
 * Time: 13:48
 */
namespace Simplex;

use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;

class Framework
{
    protected $matcher;
    protected $resolver;

    public function __construct(UrlMatcherInterface $matcher, ControllerResolverInterface $resolver)
    {
       $this->matcher  = $matcher;
       $this->resolver = $resolver;
    }
}