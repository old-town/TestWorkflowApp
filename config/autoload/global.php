<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'assetic_configuration' => [ //настройки модуля assetic (загрузка клиентских файлов)
        'debug' => true,
        'cacheEnabled' => false,
        'writeIfChanged' => false,
        'cachePath' => __DIR__ . '/../../data/cache',
        'webPath' => __DIR__ . '/../../public/assets',//папка, куда assetic сохраняет клиентские файлы из всех модулей.
        ///'basePath' => '/contracts/assets',
        'routes' => [
        ],
    ],



    'doctrine' => [
        'configuration' => [
            'orm_default' => [
            ]
        ],
        'eventmanager' => [
            'orm_default' => [
            ],
        ],
        'migrations_configuration' => [
        ],
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [

                ]
            ],
        ],
        'driver' => [
            'orm_default' => [
                'drivers' => [
                    'OldTown\\Workflow\\Spi\\Doctrine\\Entity' => 'WorkflowDoctrineEntity',
                    'OldTown\\Workflow\\ZF2\\Toolkit\\Entity' => 'entityToolkit'
                ],
            ],
        ],
    ],





);
