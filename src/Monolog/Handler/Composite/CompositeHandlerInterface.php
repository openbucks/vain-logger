<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 3/29/16
 * Time: 9:25 AM
 */

namespace Vain\Logger\Monolog\Handler\Composite;

use \Monolog\Handler\HandlerInterface as MonologHandlerInterface;

interface CompositeHandlerInterface extends MonologHandlerInterface
{
    /**
     * @param MonologHandlerInterface $handler
     *
     * @return CompositeHandlerInterface
     */
    public function addHandler(MonologHandlerInterface $handler);

    /**
     * @param MonologHandlerInterface $handler
     *
     * @return CompositeHandlerInterface
     */
    public function removeHandler(MonologHandlerInterface $handler);
}