<?php

namespace Merophp\LogManager\NamedLogger\Provider;

use Merophp\LogManager\NamedLogger\NamedLoggerInterface;

interface NamedLoggerProviderInterface
{
    /**
     * @param string $name
     * @return NamedLoggerInterface|null
     */
    public function findByName(string $name): ?NamedLoggerInterface;

    /**
     * @return iterable
     */
    public function getAll(): iterable;
}
