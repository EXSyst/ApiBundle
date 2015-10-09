<?php

/*
 * This file is part of the RestBundle package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
    new \JMS\SerializerBundle\JMSSerializerBundle(),
    new \EXSyst\Bundle\RestBundle\EXSystRestBundle(),
    new \EXSyst\Bundle\RestBundle\Tests\Functional\Bundle\TestBundle\TestBundle(),
];
