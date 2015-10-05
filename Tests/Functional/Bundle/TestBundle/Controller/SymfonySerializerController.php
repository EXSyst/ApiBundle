<?php

namespace EXSyst\Bundle\RestBundle\Tests\Functional\Bundle\TestBundle\Controller;

use EXSyst\Bundle\RestBundle\Controller\RestController;

class SymfonySerializerController extends RestController
{
    public function xmlAction() {
        return $this->serialize(['foo' => 'bar', 'bar' => 'foo', 'foobar' => null], ['groups' => 'Default']);
    }

    public function jsonAction() {
        return $this->serialize(['foo' => 'bar', 'bar' => 'foo', 'foobar' => null], ['groups' => 'Default'], 'json');
    }
}
