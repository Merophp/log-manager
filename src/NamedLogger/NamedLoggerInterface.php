<?php

namespace Merophp\LogManager\NamedLogger;

use Psr\Log\LoggerInterface;

interface NamedLoggerInterface extends LoggerInterface
{
    /**
     * @return string
     */
    public function getName(): string;
}
