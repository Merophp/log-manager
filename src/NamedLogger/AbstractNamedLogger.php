<?php

namespace Merophp\LogManager\NamedLogger;

use Psr\Log\AbstractLogger;

abstract class AbstractNamedLogger extends AbstractLogger implements NamedLoggerInterface
{
    protected string $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
