<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 4/4/16
 * Time: 8:41 PM
 */

namespace Vain\Logger\Dynamic;

use Vain\Http\Request\Event\Listener\RequestEventListenerInterface;
use Vain\Http\Response\Event\Listener\ResponseEventListenerInterface;

interface DynamicLoggerInterface extends
    RequestEventListenerInterface,
    ResponseEventListenerInterface
{

}