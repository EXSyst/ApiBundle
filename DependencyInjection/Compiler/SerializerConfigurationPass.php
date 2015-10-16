<?php

/*
 * This file is part of the ApiBundle package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Bundle\ApiBundle\DependencyInjection\Compiler;

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
        if ($container->has('exsyst_api.serializer') || !$container->hasParameter('exsyst_api.serializer.default_format')) {
            return;
        }

        if ($container->has('serializer')) {
            $container->setAlias('exsyst_api.serializer', 'serializer');
        } elseif ($container->has('jms_serializer.serializer')) {
            $container->setAlias('exsyst_api.serializer', 'jms_serializer.serializer');
        } else {
            throw new \LogicException('EXSystApiBundle can\'t determine which serializer to use. You must define a service called "serializer" or "jms_serializer.serializer" or "exsyst_api.serializer".');
        }
    }
}
