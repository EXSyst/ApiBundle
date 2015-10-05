<?php

namespace EXSyst\Bundle\RestBundle\Tests\Functional;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class SymfonySerializationTest extends WebTestCase
{
    public function setUp()
    {
        $this->client = $this->createClient(['test_case' => 'SymfonySerialization', 'root_config' => 'config.yml']);
    }
    
    public function testXmlSerialization()
    {
        $this->client->request('GET', '/symfony-serializer/xml');
        $expectedContent = '<?xml version="1.0"?>
<response><foo>bar</foo><bar>foo</bar><foobar/></response>
';
        $response = $this->client->getResponse();
        $this->assertEquals(
            $expectedContent,
            $response->getContent()
        );
    }

    public function testJsonSerialization()
    {
        $this->client->request('GET', '/symfony-serializer/json');
        $response = $this->client->getResponse();
        $this->assertEquals(
            $expectedContent = '{"foo":"bar","bar":"foo","foobar":null}',
            $response->getContent()
        );
        $this->assertEquals('"'.md5($expectedContent).'"', $response->getEtag());
    }

    public function testCachedResponse()
    {
        $expectedContent = '{"foo":"bar","bar":"foo","foobar":null}';

        $this->client->request('GET', '/symfony-serializer/json', [], [], ['HTTP_if_none_match' => '"'.md5($expectedContent).'"']);

        $response = $this->client->getResponse();
        $this->assertEquals(304, $response->getStatusCode());
    }
}
