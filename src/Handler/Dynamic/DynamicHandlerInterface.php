<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 4/4/16
 * Time: 9:32 PM
 */

namespace Vain\Logger\Handler\Dynamic;

use Vain\Http\Request\Event\Listener\RequestEventListenerInterface;
use Vain\Http\Response\Event\Listener\ResponseEventListenerInterface;

interface DynamicHandlerInterface extends RequestEventListenerInterface, ResponseEventListenerInterface
{

}