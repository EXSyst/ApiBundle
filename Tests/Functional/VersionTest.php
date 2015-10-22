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
class VersionTest extends WebTestCase
{
    public function setUp()
    {
        $this->client = $this->createClient(['test_case' => 'Version', 'root_config' => 'config.yml']);
    }

    public function testUriVersion()
    {
        $this->client->request('GET', '/v2/version');
        $response = $this->client->getResponse();
        $this->assertEquals('v2', $response->getContent());
    }

    public function testQueryVersion()
    {
        $this->client->request('GET', '/version?version=1');
        $response = $this->client->getResponse();
        $this->assertEquals('v1.1', $response->getContent());
    }

    public function testConstraintVersion()
    {
        $this->client->request('GET', '/version', [], [], ['HTTP_X-Accept-Version' => '>=1.0 <2.4']);
        $response = $this->client->getResponse();
        $this->assertEquals('v2.3', $response->getContent());
    }
}
