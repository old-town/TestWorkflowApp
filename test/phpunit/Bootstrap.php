<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\PhpUnit\Test;

use Zend\Loader\AutoloaderFactory;
use Zend\Loader\StandardAutoloader;
use Zend\Loader\ClassMapAutoloader;
use RuntimeException;

error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);

/**
 * Test bootstrap, for setting up autoloading
 *
 * @subpackage UnitTest
 */
class Bootstrap
{
    /**
     * Настройка тестов
     *
     * @throws \RuntimeException
     */
    public static function init()
    {
        static::initAutoloader();
    }
    /**
     * Инициализация автозагрузчика
     *
     * @return void
     *
     * @throws RuntimeException
     */
    protected static function initAutoloader()
    {
        $vendorPath = static::findParentPath('vendor');

        if (is_readable($vendorPath . '/autoload.php')) {

            /** @noinspection PhpIncludeInspection */
            include $vendorPath . '/autoload.php';
        }

        if (!class_exists(AutoloaderFactory::class)) {
            throw new RuntimeException('Unable to load ZF2. Run `php composer.phar install` or define a ZF2_PATH environment variable.');
        }

        try {
            AutoloaderFactory::factory([
                ClassMapAutoloader::class => [
                    [
                        'Application\\Module' =>  __DIR__ . '/../../module/Application/Module.php',
                        \OldTown\Workflow\PhpUnit\Test\Bootstrap::class => __DIR__ . '/../../vendor/old-town/workflow/test/phpunit/Bootstrap.php',
                        \OldTown\Workflow\Spi\Doctrine\PhpUnit\Test\Bootstrap::class => __DIR__ . '/../../vendor/old-town/workflow-doctrine/test/phpunit/Bootstrap.php',
                        \OldTown\Workflow\Doctrine\ZF2\PhpUnit\Test\Bootstrap::class => __DIR__ .  '/../../vendor/old-town/workflow-doctrine-zf2/test/phpunit/Bootstrap.php',
                        \OldTown\Workflow\ZF2\PhpUnit\Test\Bootstrap::class => __DIR__ . '/../../vendor/old-town/workflow-zf2/test/phpunit/Bootstrap.php',
                        \OldTown\Workflow\ZF2\Service\PhpUnit\Test\Bootstrap::class => __DIR__ . '/../../vendor/old-town/workflow-zf2-service/test/phpunit/Bootstrap.php',
                        \OldTown\Workflow\ZF2\Dispatch\PhpUnit\Test\Bootstrap::class => __DIR__ . '/../../vendor/old-town/workflow-zf2-dispatch/test/phpunit/Bootstrap.php',
                        \OldTown\Workflow\Designer\Server\PhpUnit\Test\Bootstrap::class => __DIR__ . '/../../vendor/old-town/workflow-designer-server/test/phpunit/Bootstrap.php',
                        \OldTown\Workflow\Designer\Client\PhpUnit\Test\Bootstrap::class => __DIR__ . '/../../vendor/old-town/workflow-designer-client/test/phpunit/Bootstrap.php',
                        \OldTown\Workflow\ZF2\Toolkit\PhpUnit\Test\Bootstrap::class => __DIR__ .  '/../../vendor/old-town/workflow-zf2-toolkit/test/phpunit/Bootstrap.php',
                    ]
                ],
                StandardAutoloader::class => [
                    'autoregister_zf' => true,
                    'namespaces' => [
                        'Application\\PhpUnit\\TestData' => __DIR__ . '/_files',
                        __NAMESPACE__ => __DIR__ . '/tests/',
                    ]
                ]


            ]);
            \OldTown\Workflow\PhpUnit\Test\Bootstrap::init();
            \OldTown\Workflow\Spi\Doctrine\PhpUnit\Test\Bootstrap::init();
            \OldTown\Workflow\ZF2\PhpUnit\Test\Bootstrap::init();
            \OldTown\Workflow\ZF2\Service\PhpUnit\Test\Bootstrap::init();
            \OldTown\Workflow\Designer\Server\PhpUnit\Test\Bootstrap::init();
            \OldTown\Workflow\Designer\Client\PhpUnit\Test\Bootstrap::init();
            \OldTown\Workflow\Doctrine\ZF2\PhpUnit\Test\Bootstrap::init();
            \OldTown\Workflow\ZF2\Dispatch\PhpUnit\Test\Bootstrap::init();
            \OldTown\Workflow\ZF2\Toolkit\PhpUnit\Test\Bootstrap::init();

        } catch (\Exception $e) {
            $errMsg = 'Ошибка инициации автолоадеров';
            throw new RuntimeException($errMsg, $e->getCode(), $e);
        }
    }

    /**
     * @param $path
     *
     * @return bool|string
     */
    protected static function findParentPath($path)
    {
        $dir = __DIR__;
        $previousDir = '.';
        while (!is_dir($dir . '/' . $path)) {
            $dir = dirname($dir);
            if ($previousDir === $dir) {
                return false;
            }
            $previousDir = $dir;
        }
        return $dir . '/' . $path;
    }
}

Bootstrap::init();
