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

class SymfonySerializerController extends ApiController
{
    public function xmlAction()
    {
        return $this->serialize(['foo' => 'bar', 'bar' => 'foo', 'foobar' => null], ['groups' => 'Default']);
    }

    public function jsonAction()
    {
        return $this->serialize(['foo' => 'bar', 'bar' => 'foo', 'foobar' => null], ['groups' => 'Default'], 'json');
    }
}
