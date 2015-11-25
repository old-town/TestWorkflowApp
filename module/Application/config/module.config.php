<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

use OldTown\Workflow\Spi\Memory\MemoryWorkflowStore;
use OldTown\Workflow\Loader\ArrayWorkflowFactory;
use OldTown\Workflow\Util\DefaultVariableResolver;
use OldTown\Workflow\Basic\BasicWorkflow;
use Application\Listener\TestViewHandler;

return array(

    'workflow_zf2'    => [
        'configurations' => [
            'default' => [
                'persistence' => [
                    'name' => MemoryWorkflowStore::class,
                    'options' => [
                    ]
                ],
                'factory' => [
                    'name' => ArrayWorkflowFactory::class,
                    'options' => [
                        'reload' => true,
                        'workflows' => [
                            'test' => [
                                'location' =>  __DIR__ . '/../../../config/workflow/example.xml'
                            ]
                        ]
                    ]
                ],
                'resolver' => DefaultVariableResolver::class,
            ]
        ],
        'managers' => [
            'manager_for_test' => [
                'configuration' => 'default',
                'name' => BasicWorkflow::class
            ]
        ]
    ],
    'workflow_zf2_view' => [
        'view' => [
            'test' => [
                'template' => 'application/test-zf2-view/test-view',
                'handler' => TestViewHandler::class,
                //'captureTo' => 'content'
            ]
        ]
    ],
    'workflow_zf2_view_handler' => [
        'invokables'         => [
            TestViewHandler::class => TestViewHandler::class
        ]
    ],


    'console' => array(
        'router' => array(
            'routes' => array(
                'test_workflow' => array(
                    'type' => 'simple',
                    'options' => array(
                        'route' => 'workflow',
                        'defaults' => array(
                            'controller' => 'Application\Controller\Workflow',
                            'action' => 'test'
                        )
                    )
                )
            )
        )
    ),
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Workflow' => 'Application\Controller\WorkflowController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

);
