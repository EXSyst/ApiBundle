<?php

/*
 * This file is part of the ApiBundle package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Bundle\ApiBundle\Tests\Fixtures;

use EXSyst\Bundle\ApiBundle\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as SfRoute;

/**
 * @Route(
 *  "/annotated",
 *  host="example.com",
 *  defaults={"foo"="bar"},
 *  requirements={"foobar"="foo"}
 * )
 */
class AnnotatedController
{
    public function getAction()
    {
        return new Response('get');
    }

    public function barAction()
    {
        return new Response('bar');
    }

    /**
     * @SfRoute(path="/foo-bar", name="foo_bar")
     * @Route(path="/foo-of-bar", name="foo_of_bar")
     */
    public function barFooAction()
    {
        return new Response('barFoo');
    }

    protected function fooBarAction()
    {
        return new Response('fooBar');
    }

    private function fooAction()
    {
        return new Response('foo');
    }
}
