<?php

/*
 * This file is part of the ApiBundle package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
    new \JMS\SerializerBundle\JMSSerializerBundle(),
    new \EXSyst\Bundle\ApiBundle\EXSystApiBundle(),
    new \EXSyst\Bundle\ApiBundle\Tests\Functional\Bundle\TestBundle\TestBundle(),
];
