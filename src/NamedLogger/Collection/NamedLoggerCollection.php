<?php

namespace Merophp\LogManager\NamedLogger\Collection;

use ArrayIterator;
use IteratorAggregate;
use Merophp\LogManager\NamedLogger\NamedLoggerInterface;

/**
 * @author Robert Becker
 */
class NamedLoggerCollection implements IteratorAggregate
{
    /**
     * @var array
     */
    public array $loggers = [];

    /**
     * @param NamedLoggerInterface $logger
     */
    public function add(NamedLoggerInterface $logger)
    {
        $this->loggers[] = $logger;
    }

    /**
     * @param iterable $loggers
     */
    public function addMultiple(iterable $loggers)
    {
        foreach ($loggers as $logger) {
            $this->add($logger);
        }
    }

    public function has(NamedLoggerInterface $logger): bool
    {
        return in_array($logger, $this->loggers);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return !(bool)count($this->loggers);
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->loggers);
    }
}
