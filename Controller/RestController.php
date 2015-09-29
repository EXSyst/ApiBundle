<?php

namespace EXSyst\Bundle\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
abstract class RestController extends Controller
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
            $format = $this->getParameter('exsyst_rest.serializer.default_format');
        }

        $serializer = $this->get('exsyst_rest.serializer');

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
        if ($response === null) {
            $response = new Response();
        }
        $serializedValue = $this->serializeView($value, $context, $format);
        $response->setContent($serializedValue);

        $etagGenerator = $this->get('exsyst_rest.etag_generator');
        $response->setEtag(
            $etagGenerator->generate($response->getContent())
        );

        $response->isNotModified();

        return $response;
    }
}
