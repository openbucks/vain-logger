<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 3/29/16
 * Time: 9:29 AM
 */

namespace Vain\Logger\Monolog\Handler;

use Monolog\Handler\HandlerInterface;

interface MonologHandlerInterface extends HandlerInterface
{
    /**
     * @param int $level
     *
     * @return MonologHandlerInterface
     */
    public function setLevel($level);
}