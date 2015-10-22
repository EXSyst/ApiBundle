Getting Started With EXSystApiBundle
====================================

Prerequisites
-------------

This version of the bundle requires Symfony 2.7+.

Installation
------------

Installation is a quick 3 step process:

1. Download EXSystApiBundle using composer
2. Enable the bundle
3. Enable a serializer

Step 1: Download EXSystApiBundle using composer
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Require the bundle with composer:

.. code-block:: bash

    $ composer require exsyst/api-bundle

Composer will install the bundle to your project's ``vendor/exsyst/api-bundle`` directory.

Step 2: Enable the bundle
~~~~~~~~~~~~~~~~~~~~~~~~~

Enable the bundle in the kernel::

    <?php
    // app/AppKernel.php

    // ...
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                // ...

                new EXSyst\Bundle\ApiBundle\EXSystApiBundle(),
            );

            // ...
        }

        // ...
    }

Step 3: Enable a serializer
~~~~~~~~~~~~~~~~~~~~~~~~~~~
This bundle needs a serializer to work correctly. In most cases,
you'll need to enable a serializer or install one. This bundle tries
the following (in the given order) to determine the serializer to use:

#. The one you configured using the parameter ``exsyst_api.serializer`` (if you did).
#. The `Symfony Serializer`_ if it's enabled (or any service called ``serializer``).
#. The JMS serializer, if the `JMSSerializerBundle`_ is available (and registered).

Configuration reference
~~~~~~~~~~~~~~~~~~~~~~~
- `Configuration reference`_ for a reference on the available configuration options

.. _`Symfony Serializer`: http://symfony.com/doc/current/cookbook/serializer.html
.. _`JMSSerializerBundle`: https://github.com/schmittjoh/JMSSerializerBundle
.. _`Configuration reference`: https://github.com/EXSyst/ApiBundle/tree/master/Resources/doc/configuration_reference.rst
