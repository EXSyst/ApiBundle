<?php

/*
 * This file is part of the ApiBundle package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Bundle\ApiBundle\DependencyInjection;

use Composer\Semver\Semver;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class EXSystApiExtension extends Extension
{
    /**
     * Loads the services based on your application configuration.
     *
     * @param array            $configs
     * @param ContainerBuilder $container
     *
     * @throws \InvalidArgumentException
     * @throws \LogicException
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $loader->load('etag.yml');

        $this->loadSerialization($config, $loader, $container);
        $this->loadRouting($config, $loader, $container);
        $this->loadVersioning($config, $loader, $container);
        $this->loadParameterValidation($config, $loader, $container);
    }

    private function loadSerialization(array $config, YamlFileLoader $loader, ContainerBuilder $container)
    {
        if ($config['serialization']['enabled']) {
            $container->setParameter('exsyst_api.serializer.default_format', $config['serialization']['default_format']);
        }
    }

    private function loadRouting(array $config, YamlFileLoader $loader, ContainerBuilder $container)
    {
        if ($config['routing']['enabled']) {
            $loader->load('routing.yml');
        }
    }

    private function loadVersioning(array $config, YamlFileLoader $loader, ContainerBuilder $container)
    {
        if ($config['versioning']['enabled']) {
            if (!class_exists('Composer\Semver\Semver')) {
                throw new \LogicException('You must install composer/semver to use the EXSyst Api versioning.');
            }

            $loader->load('versioning.yml');

            $container->getDefinition('exsyst_api.version.listener')
                ->replaceArgument(1, $config['versioning']['attributeName'])
                ->addMethodCall('setDefaultVersion', [$config['versioning']['default']]);

            $versions = Semver::rsort(array_keys($config['versioning']['versions']));
            $container->getDefinition('exsyst_api.version.resolver.request_attribute_resolver')->replaceArgument(0, $versions);
            $container->getDefinition('exsyst_api.version.resolver.query_parameter_resolver')->replaceArgument(0, $versions);
            $container->getDefinition('exsyst_api.version.resolver.constraint_resolver')->replaceArgument(0, $versions);

            $resolvers = [];
            if ($config['versioning']['resolvers']['uri']) {
                $resolvers[] = new Reference('exsyst_api.version.resolver.request_attribute_resolver');
            } else {
                $container->removeDefinition('exsyst_api.version.resolver.request_attribute_resolver');
            }
            if ($config['versioning']['resolvers']['query']) {
                $resolvers[] = new Reference('exsyst_api.version.resolver.query_parameter_resolver');
            } else {
                $container->removeDefinition('exsyst_api.version.resolver.query_parameter_resolver');
            }
            if ($config['versioning']['resolvers']['constraint']) {
                $resolvers[] = new Reference('exsyst_api.version.resolver.constraint_resolver');
            } else {
                $container->removeDefinition('exsyst_api.version.resolver.constraint_resolver');
            }

            $container->getDefinition('exsyst_api.version.resolver.chain_resolver')->replaceArgument(0, $resolvers);
        }
    }

    private function loadParameterValidation(array $config, YamlFileLoader $loader, ContainerBuilder $container)
    {
        if ($config['parameter']['validation']['enabled']) {
            $loader->load('parameter_validation.yml');

            $container->getDefinition('exsyst_api.parameter.validation_listener')->replaceArgument(2, $config['parameter']['validation']['attributeName']);
        }
    }

    public function getAlias()
    {
        return 'exsyst_api';
    }
}
