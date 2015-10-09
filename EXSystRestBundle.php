<?php

/*
 * This file is part of the EXSyst package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
