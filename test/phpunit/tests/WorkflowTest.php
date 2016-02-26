<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\PhpUnit\Test;


use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Application\PhpUnit\TestData\TestPaths;;
use OldTown\Workflow\ZF2\ServiceEngine\Workflow;
use OldTown\Workflow\ZF2\Event\WorkflowEvent;


/**
 * Class ManageTest
 *
 * @package OldTown\Workflow\ZF2\PhpUnit\Test\Manager
 */
class WorkflowTest extends AbstractHttpControllerTestCase
{
    /**
     * Проверка создания менеджера
     *
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     * @throws \Zend\ServiceManager\Exception\ServiceNotCreatedException
     * @throws \Zend\ServiceManager\Exception\RuntimeException
     */
    public function testCreateManager()
    {
        /** @noinspection PhpIncludeInspection */
        $applicationConfig = include TestPaths::getPathToDefaultAppConfig();
        $this->setApplicationConfig($applicationConfig);

        /** @var Workflow $service */
        $service = $this->getApplication()->getServiceManager()->get(Workflow::class);
        $service->getEventManager()->attach('initialize', function(WorkflowEvent $event) use (&$entryId) {
            $entryId = $event->getEntryId();
        });

        $this->dispatch('/workflow/engine/manager/manager_for_test/action/Start_Workflow/name/test');


        $this->dispatch(sprintf('/workflow/engine/manager/manager_for_test/action/Finish_First_Draft/entry/%s', $entryId));

    }
}
