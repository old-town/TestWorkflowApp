<?php
/**
 * @link https://github.com/old-town/workflow-zf2
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace Application\PhpUnit\TestData;



/**
 * Class TestPaths
 *
 * @package OldTown\Workflow\ZF2\PhpUnit\TestData
 */
class TestPaths
{
    /**
     * Путь до дефалтового конфига приложения
     *
     * @return string
     */
    public static function getPathToDefaultAppConfig()
    {
        return __DIR__ . '/../../../config/application.config.php';
    }

    /**
     * Путь до дефалтового конфига приложения
     *
     * @return string
     */
    public static function getPathToCreateWorkflowFromConfig()
    {
        return __DIR__ . '/../../../config/autoload/';
    }



}
