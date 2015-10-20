<?php

/*
 * This file is part of the ApiBundle package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Bundle\ApiBundle\Tests\Functional\Bundle\TestBundle\Controller;

use EXSyst\Bundle\ApiBundle\Controller\ApiController;
use EXSyst\Component\Api\Annotation;
use Symfony\Component\Validator\Constraints;

class ParameterValidationController extends ApiController
{
    /**
     * @Annotation\RequestParameter("foo", constraints={@Constraints\Email()})
     * @Annotation\QueryParameter("bar", constraints={@Constraints\NotBlank()}, optional=false)
     */
    public function validateAction(array $apiErrors)
    {
        $errors = array_map(function ($v) {
            return (string) $v;
        }, $apiErrors);

        return $this->serialize($errors);
    }
}
