<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use OldTown\Workflow\Basic\BasicWorkflow;

class WorkflowController extends AbstractActionController
{
    public function testAction()
    {
        \OldTown\Workflow\Config\DefaultConfiguration::addDefaultPathToConfig(__DIR__ . '/../../../../../config/workflow');

        $wf = new BasicWorkflow('johndoe');
        $id = $wf->initialize('holiday', 1, null);



        return new ViewModel();
    }
}
