<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 3/29/16
 * Time: 9:25 AM
 */

namespace Vain\Logger\Adapter\Monolog\Handler\Composite;

use Monolog\Handler\HandlerInterface;

interface VainMonologCompositeHandlerInterface extends HandlerInterface
{
    public function addHandler(HandlerInterface $handler);
    
    public function removeHandler(HandlerInterface $handler);
}