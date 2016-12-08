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

namespace Vain\Logger\Monolog;

use Monolog\Handler\AbstractHandler;
use Monolog\Handler\HandlerInterface;
use Monolog\Logger as MonologInstance;
use Vain\Logger\LoggerInterface;

/**
 * Class MonologAdapter
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class MonologAdapter implements LoggerInterface
{

    private $originalLevels = [];

    private $monologInstance;

    /**
     * MonologAdapter constructor.
     *
     * @param MonologInstance $monologInstance
     */
    public function __construct(MonologInstance $monologInstance)
    {
        $this->monologInstance = $monologInstance;
    }

    /**
     * @inheritDoc
     */
    public function emergency($message, array $context = [])
    {
        return $this->monologInstance->emergency($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function alert($message, array $context = [])
    {
        return $this->monologInstance->alert($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function critical($message, array $context = [])
    {
        return $this->monologInstance->critical($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function error($message, array $context = [])
    {
        return $this->monologInstance->error($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function warning($message, array $context = [])
    {
        return $this->monologInstance->warning($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function notice($message, array $context = [])
    {
        return $this->monologInstance->notice($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function info($message, array $context = [])
    {
        return $this->monologInstance->info($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function debug($message, array $context = [])
    {
        return $this->monologInstance->debug($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function log($level, $message, array $context = [])
    {
        return $this->monologInstance->log($level, $message, $context);
    }

    /**
     * @inheritDoc
     */
    public function addHandler(HandlerInterface $handler)
    {
        $this->monologInstance->pushHandler($handler);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function overrideLevel($level)
    {
        /**
         * @var AbstractHandler[] $handlers
         */
        $handlers = $this->monologInstance->getHandlers();

        foreach ($handlers as $handler) {
            $this->originalLevels[spl_object_hash($handler)] = $handler->getLevel();
            $handler->setLevel($level);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function restoreLevel()
    {
        if ([] === $this->originalLevels) {
            return $this;
        }

        /**
         * @var AbstractHandler[] $handlers
         */
        $handlers = $this->monologInstance->getHandlers();

        foreach ($handlers as $handler) {
            if (false === array_key_exists(spl_object_hash($handler), $this->originalLevels)) {
                continue;
            }
            $handler->setLevel($this->originalLevels[spl_object_hash($handler)]);
        }

        return $this;
    }
}
