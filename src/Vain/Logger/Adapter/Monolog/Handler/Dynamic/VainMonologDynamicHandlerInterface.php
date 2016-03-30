<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 3/29/16
 * Time: 9:50 AM
 */

namespace Vain\Logger\Adapter\Monolog\Handler\Dynamic;


use Vain\Http\Request\Event\Listener\VainHttpRequestEventListenerInterface;
use Vain\Http\Response\Event\Listener\VainHttpResponseEventListenerInterface;

interface VainMonologDynamicHandlerInterface extends
    VainHttpRequestEventListenerInterface,
    VainHttpResponseEventListenerInterface
{

}