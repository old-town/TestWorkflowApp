<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

use DispatchWorkflow\Controller\TestController;

return [

    'router'       => [
        'routes' => [
            'workflow' => [
                'child_routes' => [
                    'dispatch' => [
                        'child_routes' => [
                            'test' => [
                                'type'    => 'segment',
                                'options' => [
                                    'route' => 'wfManager/:workflowManagerName/wfAction/:workflowActionName/[wfName/:workflowName/][wfEntryId:entryId/]action/:action',
                                    'defaults'    => [
                                        'controller' => TestController::class
                                    ],
                                ],

                            ]
                        ]
                    ]
                ]
            ]
        ],
    ],

    'controllers'  => [
        'invokables' => [
            TestController::class => TestController::class,
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

];
