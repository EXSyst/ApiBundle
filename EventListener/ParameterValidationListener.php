<?php

/*
 * This file is part of the ApiBundle package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Bundle\ApiBundle\EventListener;

use EXSyst\Component\Api\Parameter\ParameterReader;
use EXSyst\Component\Api\Parameter\ParameterValidator;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class ParameterValidationListener
{
    /**
     * @var ParameterReader
     */
    private $parameterReader;
    /**
     * @var ParameterValidator
     */
    private $parameterValidator;

    /**
     * Constructor.
     *
     * @param ParameterReader    $parameterReader
     * @param ParameterValidator $parameterValidator
     * @param string             $attributeName
     */
    public function __construct(ParameterReader $parameterReader, ParameterValidator $parameterValidator, $attributeName)
    {
        $this->parameterReader = $parameterReader;
        $this->parameterValidator = $parameterValidator;
        $this->attributeName = $attributeName;
    }

    /**
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $request = $event->getRequest();

        $controller = $event->getController();
        if (is_callable($controller) && method_exists($controller, '__invoke')) {
            $controller = [$controller, '__invoke'];
        }

        $parameters = $this->parameterReader->read(
            new \ReflectionMethod($controller[0], $controller[1])
        );
        $errors = $this->parameterValidator->validateParameters($parameters);

        $request->attributes->set($this->attributeName, $errors);
    }
}
