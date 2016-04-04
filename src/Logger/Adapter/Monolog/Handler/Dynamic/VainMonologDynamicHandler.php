<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 3/29/16
 * Time: 9:26 AM
 */

namespace Vain\Logger\Adapter\Monolog\Handler\Dynamic;

use Monolog\Formatter\FormatterInterface;
use Monolog\Handler\HandlerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Vain\Logger\Adapter\Monolog\Handler\Composite\VainMonologCompositeHandlerInterface;

class VainMonologDynamicHandler implements
    VainMonologCompositeHandlerInterface,
    VainMonologDynamicHandlerInterface
{
    /**
     * @var HandlerInterface[]
     */
    private $handlers = [];
    
    private $originalLevels = [];
    
    private $logHeader;

    /**
     * VainMonologCompositeHandler constructor.
     * @param FormatterInterface $formatter
     * @param HandlerInterface[] $handlers
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

    public function addHandler(HandlerInterface $handler)
    {
        $this->originalLevels[spl_object_hash($handler)] = $handler;
        
        return $this;
    }

    public function removeHandler(HandlerInterface $handler)
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