EXSystApiBundle
===============
This bundle provides several tools to help build API's & symfony applications.

This bundle includes:
- A custom route loader to rapidly generate url's for the different http methods.
- A parameter validation listener to check the request parameters.
- A version listener to determine from the request which version of the API to use.

[![Build Status](https://travis-ci.org/EXSyst/ApiBundle.svg?branch=master)](https://travis-ci.org/EXSyst/ApiBundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/EXSyst/ApiBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/EXSyst/ApiBundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/EXSyst/ApiBundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/EXSyst/ApiBundle/?branch=master)
[![Total Downloads](https://poser.pugx.org/EXSyst/api-bundle/downloads.svg)](https://packagist.org/packages/EXSyst/api-bundle)
[![Latest Stable Version](https://poser.pugx.org/EXSyst/api-bundle/v/stable.svg)](https://packagist.org/packages/EXSyst/api-bundle)

Documentation
=============

[Read the Documentation](https://github.com/EXSyst/ApiBundle/blob/master/Resources/doc/index.srt)

Please see the [UPGRADING.md](https://github.com/EXSyst/ApiBundle/blob/master/UPGRADING.md) for any
relevant instructions when upgrading to a newer version.


Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require exsyst/api-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
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
```
