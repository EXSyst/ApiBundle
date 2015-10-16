<?php

/*
 * This file is part of the ApiBundle package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Bundle\ApiBundle\Tests\Functional\Bundle\TestBundle\Controller;

use EXSyst\Bundle\ApiBundle\Controller\ApiController;
use JMS\Serializer\SerializationContext;

class JMSSerializerController extends ApiController
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
