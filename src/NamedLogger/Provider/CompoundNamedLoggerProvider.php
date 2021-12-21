<?php

namespace Merophp\LogManager\NamedLogger\Provider;

use Merophp\LogManager\NamedLogger\NamedLoggerInterface;

/**
 * @author Robert Becker
 */
class CompoundNamedLoggerProvider implements NamedLoggerProviderInterface
{
    /**
     * @var NamedLoggerProviderInterface[]
     */
    protected array $loggerProviders = [];

    public function attach(NamedLoggerProviderInterface $loggerProvider)
    {
        $this->loggerProviders[] = $loggerProvider;
    }

    /**
     * @param string $name
     * @return NamedLoggerInterface|null
     */
    public function findByName(string $name): ?NamedLoggerInterface
    {
        foreach($this->loggerProviders as $loggerProvider){
            $v = $loggerProvider->findByName($name);
            if($v) return $v;
        }
        return null;
    }

    /**
     * @return iterable
     */
    public function getAll(): iterable
    {
        foreach($this->loggerProviders as $loggerProvider){
            yield from $loggerProvider->getAll();
        }
    }
}
