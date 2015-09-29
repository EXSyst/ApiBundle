<?php

namespace EXSyst\Bundle\RestBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Checks if a serializer is either set or can be auto-configured.
 *
 * @author Ener-Getick <egetick@gmail.com>
 */
class SerializerConfigurationPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if ($container->has('exsyst_rest.serializer')) {
            return;
        }

        if ($container->has('serializer')) {
            $container->setAlias('exsyst_rest.serializer', 'serializer');
        } elseif ($container->has('jms_serializer.serializer')) {
            $container->setAlias('exsyst_rest.serializer', 'jms_serializer.serializer');
        } else {
            throw new \LogicException('EXSystRestBundle can\'t determine which serializer to use. You must define a service called "serializer" or "jms_serializer.serializer" or "exsyst_rest.serializer".');
        }
    }
}
