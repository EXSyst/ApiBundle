<?php

namespace EXSyst\Bundle\RestBundle;

use EXSyst\Bundle\RestBundle\DependencyInjection\Compiler\SerializerConfigurationPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class EXSystRestBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new SerializerConfigurationPass());
    }
}
