<?php

/*
 * This file is part of the ApiBundle package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Bundle\ApiBundle\Tests\Routing\Loader;

use Doctrine\Common\Annotations\AnnotationReader;
use EXSyst\Bundle\ApiBundle\Routing\Loader\ApiClassLoader;
use EXSyst\Bundle\ApiBundle\Tests\Fixtures\AnnotatedController;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Routing\Route;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class ApiClassLoaderTest extends \PHPUnit_Framework_TestCase
{
    private static $reader;
    private $loader;

    public static function setUpBeforeClass()
    {
        self::$reader = new AnnotationReader();
    }

    public function setUp()
    {
        $this->loader = new ApiClassLoader(self::$reader);
    }

    public function testInterface()
    {
        $this->assertInstanceof(LoaderInterface::class, $this->loader);
    }

    public function testRouteLoading()
    {
        $collection = $this->loader->load(AnnotatedController::class);
        $defaultOptions = [
            'host'         => 'example.com',
            'defaults'     => ['foo'    => 'bar'],
            'requirements' => ['foobar' => 'foo'],
        ];
        $this->assertEquals([
            'foo_bar' => $this->createRoute(
                '/annotated/foo-bar',
                $defaultOptions,
                ['defaults' => ['_controller' => AnnotatedController::class.'::barFooAction']]
            ),
            'foo_of_bar' => $this->createRoute(
                '/annotated/foo-of-bar',
                $defaultOptions,
                ['defaults' => ['_controller' => AnnotatedController::class.'::barFooAction']]
            ),
            'exsyst_api_tests_fixtures_annotated_get' => $this->createRoute(
                '/annotated',
                $defaultOptions,
                ['defaults' => ['_controller' => AnnotatedController::class.'::getAction'], 'methods' => ['GET']]
            ),
            'exsyst_api_tests_fixtures_annotated_bar_1' => $this->createRoute(
                '/annotated',
                $defaultOptions,
                ['defaults' => ['_controller' => AnnotatedController::class.'::barAction'], 'methods' => ['BAR']]
            ),
        ], (array) $collection->getIterator());
    }

    /**
     * @dataProvider namespaceProvider
     */
    public function testSupports($namespace)
    {
        $this->assertTrue($this->loader->supports($namespace, 'api'));
        $this->assertFalse($this->loader->supports($namespace, 'annotation'));
    }

    public function namespaceProvider()
    {
        return [
            ['EYt8zÞn5\t\_7áhF\Bc5f\Û3'],
            ['Ô3sbá\yPqZ2S'],
            ['\_4D'],
            ['r7h6wy_¯S62¯O8'],
            ['\YvmÚPvM3'],
            ['Váa_pRÏ_Þ521\ùtHÂ_®_8a_O_p\W_Wh_bl7Mj_1'],
            ['kBZuU\Âb66bsf__sl8\_H\ÿE_ð_j'],
            ['vb9i9_b_4_AkuDÊ'],
            ['_G_x\«R\q_yÿn_D0Ì__C'],
            ['A_____'],
            ['å\W2l__Z\qG0_\Å×_t_t'],
            ['\xZ7_·Z9\W¡5'],
            ['\_Z\êRY6fNgo4_C¾F7'],
            ['\Cýb_z7\i3__ô÷93þvÍÀ'],
            ['NX8_yoJ\Z2_n_Ìq_tæS5\_x_\d2FQl\_P'],
            ['\24_´t6\oU_t1_Q_\í·ô\_iqZ'],
            ['_ËiGs_q2Vd_V5_8W_SvÃ9__2\__h6F\ý1'],
            ['_6V0B_'],
            ['S__\ß\Û'],
            ['_3_´WÍkh4¨k\KxRb_ap\¨åooCY\o__'],
            ['_9s'],
            ['kwYet_¥\z_1fxU4y2O_w0M9z'],
            ['___4Æ1cÕag_voa_'],
            ['\_d__ºGzx8_qxá\m·O±b_'],
            ['\t29Ð\â_LXt\Q_\q_M'],
            ['\ôï\î½6_4ÍHL7B_\n__¥N76qaT¸_3\X7_'],
            ['yy0_0TX_5Õªf÷'],
            ['sÈ_ý'],
            ['\Lp6_6_91\qì7_nJÓNc'],
            ['eX½_ZC\_z_\LæÚWYi_nÐ_i'],
        ];
    }

    private function createRoute($path, array $globals, array $options = [])
    {
        foreach ($globals as $k => $v) {
            if (is_array($v) && isset($options[$k])) {
                $options[$k] = array_merge($v, $options[$k]);
            } else {
                $options[$k] = isset($options[$k]) ? $options[$k] : $v;
            }
        }

        $route = new Route($path);
        if (isset($options['host'])) {
            $route->setHost($options['host']);
        }
        if (isset($options['defaults'])) {
            $route->setDefaults($options['defaults']);
        }
        if (isset($options['requirements'])) {
            $route->setRequirements($options['requirements']);
        }
        if (isset($options['methods'])) {
            $route->setMethods($options['methods']);
        }

        return $route;
    }
}
