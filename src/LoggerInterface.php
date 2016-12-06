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

namespace Vain\Logger;

use Psr\Log\LoggerInterface as PsrLoggerInterface;

/**
 * Interface LoggerInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface LoggerInterface extends PsrLoggerInterface
{
    /**
     * @param int $level
     *
     * @return LoggerInterface
     */
    public function overrideLevel($level);

    /**
     * @return LoggerInterface
     */
    public function restoreLevel();
}