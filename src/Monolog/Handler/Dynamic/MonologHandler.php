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
namespace Vain\Logger\Monolog\Handler\Dynamic;

use Monolog\Formatter\FormatterInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Monolog\Handler\HandlerInterface as MonologHandlerInterface;
use Vain\Logger\Handler\Dynamic\DynamicHandlerInterface;
use Vain\Logger\Monolog\Handler\Composite\CompositeHandlerInterface;

/**
 * Class MonologCompositeHandler
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class MonologCompositeHandler implements CompositeHandlerInterface, DynamicHandlerInterface
{
    /**
     * @var CompositeHandlerInterface[]
     */
    private $handlers = [];
    
    private $originalLevels = [];
    
    private $logHeader;

    /**
     * VainMonologCompositeHandler constructor.
     * @param FormatterInterface $formatter
     * @param CompositeHandlerInterface[] $handlers
     * @param int $logHeader
     */
    public function __construct(FormatterInterface $formatter, array $handlers, $logHeader)
    {
        foreach ($handlers as $handler) {
            $this->addHandler($handler);
            $handler->setFormatter($formatter);
        }
        
        $this->logHeader = $logHeader;
    }

    /**
     * @inheritDoc
     */
    public function addHandler(MonologHandlerInterface $handler)
    {
        $this->originalLevels[spl_object_hash($handler)] = $handler;
        
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function removeHandler(MonologHandlerInterface $handler)
    {
        $hash = spl_object_hash($handler);
        if (false === array_key_exists($hash, $this->handlers)) {
            return $this;
        }
        
        unset($this->originalLevels[$hash]);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isHandling(array $record)
    {
        foreach ($this->handlers as $handler) {
            if ($handler->isHandling($record)) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * @inheritDoc
     */
    public function handle(array $record)
    {
        foreach ($this->handlers as $handler) {
            $handler->handle($record);
        }
        
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function handleBatch(array $records)
    {
        foreach ($this->handlers as $handler) {
            $handler->handleBatch($records);
        }
        
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function pushProcessor($callback)
    {
        foreach ($this->handlers as $handler) {
            $handler->pushProcessor($callback);
        }
    }

    /**
     * @inheritDoc
     */
    public function popProcessor()
    {
        foreach ($this->handlers as $handler) {
            $handler->popProcessor();
        }
        
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setFormatter(FormatterInterface $formatter)
    {
        foreach ($this->handlers as $handler) {
            $handler->setFormatter($formatter);
        }
        
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getFormatter()
    {
        foreach ($this->handlers as $handler) {
            return $handler->getFormatter();
        }
        
        return null;
    }

    /**
     * @inheritDoc
     */
    public function onRequest(RequestInterface $request)
    {
        if (false === $request->hasHeader($this->logHeader)) {
            return $this;
        }
        
        $logLevel = $request->getHeader($this->logHeader);
        foreach ($this->handlers as $handler) {
            if (false === method_exists($handler, 'getLevel') && method_exists($handler, 'setLevel')) {
                continue;
            }
            $this->originalLevels[spl_object_hash($handler)] = $handler->getLevel();
            $handler->setLevel($logLevel);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function onResponse(ResponseInterface $response)
    {
        if ([] === $this->originalLevels) {
            return $this;
        }
        
        foreach ($this->handlers as $handler) {
            if (false === method_exists($handler, 'setLevel')) {
                continue;
            }
            
            $hash = spl_object_hash($handler);
            if (false === array_key_exists($hash, $this->originalLevels)) {
                continue;
            }
            $handler->setLevel($this->originalLevels[$hash]);
        }
        $this->originalLevels = [];
        
        return $this;
    }


}