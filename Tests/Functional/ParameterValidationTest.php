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
class ParameterValidationTest extends WebTestCase
{
    public function setUp()
    {
        $this->client = $this->createClient(['test_case' => 'ParameterValidation', 'root_config' => 'config.yml']);
    }

    public function testDefaultValidation()
    {
        $this->client->request('GET', '/parameter-validation');
        $response = $this->client->getResponse();
        $this->assertEquals(
            '{"foo":"","bar":"bar:\n    Parameter \"bar\" must be defined.\n"}',
            $response->getContent()
        );
    }

    public function testValidParameters()
    {
        $this->client->request(
            'POST',
            '/parameter-validation?bar=null',
            ['foo' => 'bar@example.com']
        );
        $response = $this->client->getResponse();
        $this->assertEquals(
            '{"foo":"","bar":""}',
            $response->getContent()
        );
    }
}
