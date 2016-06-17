<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-logger
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-logger
 */

namespace Vain\Logger\Handler\Dynamic;

use Vain\Http\Request\Event\Listener\RequestEventListenerInterface;
use Vain\Http\Response\Event\Listener\ResponseEventListenerInterface;

/**
 * Interface DynamicHandlerInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DynamicHandlerInterface extends RequestEventListenerInterface, ResponseEventListenerInterface
{

}