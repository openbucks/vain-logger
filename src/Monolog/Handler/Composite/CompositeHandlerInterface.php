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
declare(strict_types = 1);

namespace Vain\Logger\Monolog\Handler\Composite;

use \Monolog\Handler\HandlerInterface as MonologHandlerInterface;

/**
 * Interface CompositeHandlerInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface CompositeHandlerInterface extends MonologHandlerInterface
{
    /**
     * @param MonologHandlerInterface $handler
     *
     * @return CompositeHandlerInterface
     */
    public function addHandler(MonologHandlerInterface $handler) : CompositeHandlerInterface;

    /**
     * @param MonologHandlerInterface $handler
     *
     * @return CompositeHandlerInterface
     */
    public function removeHandler(MonologHandlerInterface $handler) : CompositeHandlerInterface;
}