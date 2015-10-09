<?php

/*
 * This file is part of the RestBundle package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
