<?php

/*
 * This file is part of the RestBundle package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Bundle\RestBundle\Tests\Functional;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class JMSSerializationTest extends WebTestCase
{
    public function testXmlSerialization()
    {
        $client = $this->createClient(['test_case' => 'JMSSerialization', 'root_config' => 'config.yml']);

        $client->request('GET', '/jms-serializer/xml');
        $response = $client->getResponse();
        $expectedContent = '<?xml version="1.0" encoding="UTF-8"?>
<result xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <entry><![CDATA[bar]]></entry>
  <entry><![CDATA[foo]]></entry>
  <entry xsi:nil="true"/>
</result>
';
        $this->assertEquals(
            $expectedContent,
            $response->getContent()
        );
        $this->assertEquals('"'.md5($expectedContent).'"', $response->getEtag());
    }

    public function testJsonSerialization()
    {
        $client = $this->createClient(['test_case' => 'JMSSerialization', 'root_config' => 'config.yml']);

        $client->request('GET', '/jms-serializer/json');
        $response = $client->getResponse();
        $expectedContent = '{"foo":"bar","bar":"foo"}';
        $this->assertEquals(
            $expectedContent,
            $client->getResponse()->getContent()
        );
        $this->assertEquals('"'.md5($expectedContent).'"', $response->getEtag());
    }
}
