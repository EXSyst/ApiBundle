<?php

namespace EXSyst\Bundle\RestBundle\Tests\Functional\Bundle\TestBundle\Controller;

use EXSyst\Bundle\RestBundle\Controller\RestController;
use JMS\Serializer\SerializationContext;

class JMSSerializerController extends RestController
{
    public function xmlAction()
    {
        $context = new SerializationContext();

        return $this->serialize(['foo' => 'bar', 'bar' => 'foo', 'foobar' => null], $context);
    }

    public function jsonAction()
    {
        $context = new SerializationContext();

        return $this->serialize(['foo' => 'bar', 'bar' => 'foo', 'foobar' => null], $context, 'json');
    }
}
