<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Listener;

use \OldTown\Workflow\ZF2\View\Handler\AbstractHandler;
use OldTown\Workflow\ZF2\View\Handler\Context\ContextInterface;


/**
 * Class TestViewHandler
 *
 * @package Application\Listener
 */
class TestViewHandler extends AbstractHandler
{
    /**
     * Пред обработка данных
     *
     * @param ContextInterface $context
     *
     * @return array|void
     */
    public function dispatch(ContextInterface $context)
    {
        return [
            'testData' => '!!!!!!!!!!!!!!'
        ];
    }
}
