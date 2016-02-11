<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace DispatchWorkflow\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use OldTown\Workflow\ZF2\ServiceEngine\Workflow\TransitionResult;


/**
 * Class TestController
 *
 * @package DispatchWorkflow\Controller
 */
class TestController extends AbstractActionController
{
    /**
     * @return array
     */
    public function viewResultInitAction()
    {
        /** @var  TransitionResult $transitionResult */
        $transitionResult = $this->getEvent()->getParam('transitionResult');

        return [
            'transitionResult' => $transitionResult
        ];
    }
}
