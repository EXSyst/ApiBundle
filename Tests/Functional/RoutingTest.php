<?php

/*
 * This file is part of the ApiBundle package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Bundle\ApiBundle\Tests\Functional;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class RoutingTest extends WebTestCase
{
    public function setUp()
    {
        $this->client = $this->createClient(['test_case' => 'Routing', 'root_config' => 'config.yml']);
    }

    public function testRouteLoading()
    {
        $this->client->request('GET', '/annotated', [], [], ['HTTP_HOST' => 'example.com']);
        $this->assertEquals(
            'get',
            $this->client->getResponse()->getContent()
        );

        $this->client->request('BAR', '/annotated', [], [], ['HTTP_HOST' => 'example.com']);
        $this->assertEquals(
            'bar',
            $this->client->getResponse()->getContent()
        );

        $this->client->request('POST', '/annotated/foo-bar', [], [], ['HTTP_HOST' => 'example.com']);
        $this->assertEquals(
            'barFoo',
            $this->client->getResponse()->getContent()
        );
    }

    /**
     * @expectedException Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
     * @expectedExceptionMessage (Allow: GET, HEAD, BAR)
     */
    public function testInvalidMethod()
    {
        $this->client->request('FOO', '/annotated', [], [], ['HTTP_HOST' => 'example.com']);
    }

    /**
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testInvalidHost()
    {
        $this->client->request('FOO', '/annotated', [], [], ['HTTP_HOST' => 'foo.com']);
    }
}
