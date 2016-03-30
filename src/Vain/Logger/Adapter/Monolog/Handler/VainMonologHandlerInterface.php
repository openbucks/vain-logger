<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 3/29/16
 * Time: 9:29 AM
 */

namespace Vain\Logger\Adapter\Monolog\Handler;

use Monolog\Handler\HandlerInterface;

interface VainMonologHandlerInterface extends HandlerInterface
{
    public function setLevel($level);
}