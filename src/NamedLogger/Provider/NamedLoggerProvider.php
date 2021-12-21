<?php

namespace Merophp\LogManager\NamedLogger\Provider;

use Merophp\LogManager\NamedLogger\Collection\NamedLoggerCollection;
use Merophp\LogManager\NamedLogger\NamedLoggerInterface;

/**
 * @author Robert Becker
 */
class NamedLoggerProvider implements NamedLoggerProviderInterface
{
    protected NamedLoggerCollection $loggerCollection;

    public function __construct(NamedLoggerCollection $namedLoggerCollection)
    {
        $this->loggerCollection = $namedLoggerCollection;
    }

    /**
     * @param string $name
     * @return NamedLoggerInterface|null
     */
    public function findByName(string $name): ?NamedLoggerInterface
    {
        foreach($this->loggerCollection as $logger){
            if($logger->getName() == $name) return $logger;
        }
        return null;
    }

    /**
     * @return iterable
     */
    public function getAll(): iterable
    {
        yield from $this->loggerCollection;
    }
}
