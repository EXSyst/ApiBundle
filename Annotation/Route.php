<?php

/*
 * This file is part of the RestBundle package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Bundle\RestBundle\Annotation;

use Symfony\Component\Routing\Annotation\Route as BaseRoute;

/**
 * {@inheritdoc}
 *
 * @Annotation
 * @Target({"CLASS", "METHOD"})
 *
 * @author Ener-Getick <egetick@gmail.com>
 */
class Route extends BaseRoute
{
}
