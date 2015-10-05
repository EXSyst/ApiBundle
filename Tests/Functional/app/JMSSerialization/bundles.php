<?php

return [
    new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
    new \JMS\SerializerBundle\JMSSerializerBundle(),
    new \EXSyst\Bundle\RestBundle\EXSystRestBundle(),
    new \EXSyst\Bundle\RestBundle\Tests\Functional\Bundle\TestBundle\TestBundle(),
];
