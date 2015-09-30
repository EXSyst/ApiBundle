<?php

namespace EXSyst\Bundle\RestBundle;

use EXSyst\Bundle\RestBundle\DependencyInjection\Compiler\SerializerConfigurationPass;
use EXSyst\Bundle\RestBundle\DependencyInjection\EXSystRestExtension;
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

    /** {@inheritdoc} */
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EXSystRestExtension();
        }
        if ($this->extension) {
            return $this->extension;
        }
    }
}
