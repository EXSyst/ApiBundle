<?php

namespace EXSyst\Bundle\RestBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Extract from SymfonyFrameworkBundle tests.
 */
class WebTestCase extends BaseWebTestCase
{
    protected function deleteTmpDir($testCase)
    {
        if (!file_exists($dir = sys_get_temp_dir().'/'.Kernel::VERSION.'/'.$testCase)) {
            return;
        }

        $fs = new Filesystem();
        $fs->remove($dir);
    }

    protected static function getKernelClass()
    {
        require_once __DIR__.'/app/AppKernel.php';

        return 'EXSyst\Bundle\RestBundle\Tests\Functional\app\AppKernel';
    }

    protected static function createKernel(array $options = [])
    {
        $class = self::getKernelClass();

        if (!isset($options['test_case'])) {
            throw new \InvalidArgumentException('The option "test_case" must be set.');
        }

        return new $class(
            $options['test_case'],
            isset($options['root_config']) ? $options['root_config'] : 'config.yml',
            isset($options['environment']) ? $options['environment'] : 'restbundletest'.strtolower($options['test_case']),
            isset($options['debug']) ? $options['debug'] : true
        );
    }
}
