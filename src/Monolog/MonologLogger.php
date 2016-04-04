<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 3/28/16
 * Time: 12:32 PM
 */

namespace Vain\Logger\Monolog;

use Monolog\Logger as MonologInstance;
use Vain\Logger\LoggerInterface;

class MonologLogger implements LoggerInterface
{
    private $monologInstance;
    
    public function __construct(MonologInstance $monologInstance)
    {
        $this->monologInstance = $monologInstance;
    }

    /**
     * @inheritDoc
     */
    public function emergency($message, array $context = array())
    {
        return $this->monologInstance->emergency($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function alert($message, array $context = array())
    {
        return $this->monologInstance->alert($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function critical($message, array $context = array())
    {
        return $this->monologInstance->critical($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function error($message, array $context = array())
    {
        return $this->monologInstance->error($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function warning($message, array $context = array())
    {
        return $this->monologInstance->warning($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function notice($message, array $context = array())
    {
        return $this->monologInstance->notice($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function info($message, array $context = array())
    {
        return $this->monologInstance->info($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function debug($message, array $context = array())
    {
        return $this->monologInstance->debug($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function log($level, $message, array $context = array())
    {
        return $this->monologInstance->log($level, $message, $context);
    }
}