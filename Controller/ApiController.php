<?php

/*
 * This file is part of the ApiBundle package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Bundle\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
abstract class ApiController extends Controller
{
    /**
     * @param mixed  $value   to be serialized
     * @param mixed  $context Serialization context
     * @param string $format
     *
     * @return string
     */
    protected function serializeView($value, $context, $format = null)
    {
        if ($format === null) {
            $format = $this->getParameter('exsyst_api.serializer.default_format');
        }

        $serializer = $this->get('exsyst_api.serializer');

        return $serializer->serialize($value, $format, $context);
    }

    /**
     * @param mixed  $value   to be serialized
     * @param mixed  $context Serialization context
     * @param string $format
     *
     * @return Response
     */
    protected function serialize($value, $context, $format = null, Response $response = null)
    {
        $request = $this->get('request_stack')->getCurrentRequest();
        if ($format === null) {
            $format = $this->getParameter('exsyst_api.serializer.default_format');
        }
        if ($response === null) {
            $response = new Response();
        }
        $serializedValue = $this->serializeView($value, $context, $format);
        $response->setContent($serializedValue);
        $response->headers->set('Content-Type', $request->getMimeType($format));

        $etagGenerator = $this->get('exsyst_api.etag_generator');
        $etag = $etagGenerator->generate($response->getContent());
        if ($etag !== false) {
            $response->setEtag($etag->getValue(), $etag->isWeak());
            $response->isNotModified(
                $request
            );
        }

        return $response;
    }
}
