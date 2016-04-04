<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 3/29/16
 * Time: 9:25 AM
 */

namespace Vain\Logger\Monolog\Handler\Composite;

use Monolog\Handler\HandlerInterface;

interface CompositeMonologHandlerInterface extends HandlerInterface
{
    /**
     * @param HandlerInterface $handler
     *
     * @return CompositeMonologHandlerInterface
     */
    public function addHandler(HandlerInterface $handler);

    /**
     * @param HandlerInterface $handler
     *
     * @return CompositeMonologHandlerInterface
     */
    public function removeHandler(HandlerInterface $handler);
}