<?php

/*
 * This file is part of the ApiBundle package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Bundle\ApiBundle\Routing\Loader;

use Symfony\Component\Routing\Loader\AnnotationClassLoader;
use Symfony\Component\Routing\Route;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class ApiClassLoader extends AnnotationClassLoader
{
    /**
     * {@inheritdoc}
     */
    public function load($class, $type = null)
    {
        $collection = parent::load($class, $type);

        $class = new \ReflectionClass($class);
        $globals = $this->getGlobals($class);

        foreach ($class->getMethods() as $method) {
            // Manual route definition
            if (null !== $this->reader->getMethodAnnotation($method, $this->routeAnnotationClass) || !$method->isPublic() || !preg_match('/^(.*)Action$/', $method->name, $matches)) {
                continue;
            }

            $actionName = &$matches[1];
            $route = $this->createRoute(
                $globals['path'],
                $globals['defaults'],
                $globals['requirements'],
                $globals['options'],
                $globals['host'],
                $globals['schemes'],
                [strtoupper($actionName)], // Method
                $globals['condition']
            );
            $this->configureRoute($route, $class, $method, null);
            $collection->add($this->getDefaultRouteName($class, $method), $route);
        }

        return $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($resource, $type = null)
    {
        return is_string($resource) && preg_match('/^(?:\\\\?[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)+$/', $resource) && $type === 'api';
    }

    /**
     * {@inheritdoc}
     */
    protected function configureRoute(Route $route, \ReflectionClass $class, \ReflectionMethod $method, $annot)
    {
        $route->setDefault('_controller', $class->name.'::'.$method->name);
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaultRouteName(\ReflectionClass $class, \ReflectionMethod $method)
    {
        $routeName = parent::getDefaultRouteName($class, $method);

        return preg_replace([
            '/(bundle|controller)_/',
            '/action(_\d+)?$/',
            '/__/',
        ], [
            '_',
            '\\1',
            '_',
        ], $routeName);
    }
}
