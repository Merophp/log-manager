<?php

namespace Merophp\LogManager;

use Merophp\LogManager\NamedLogger\Collection\NamedLoggerCollection;
use Merophp\LogManager\NamedLogger\NamedLoggerInterface;
use Merophp\LogManager\NamedLogger\Provider\{
    CompoundNamedLoggerProvider,
    NamedLoggerProvider,
    NamedLoggerProviderInterface
};
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * @author Dorian Zinner, Robert Becker
 */
class LogManager
{
    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $fallbackLogger;

    private NamedLoggerProviderInterface $namedLoggerProvider;

    public function __construct()
    {
        $this->fallbackLogger = new NullLogger;
        $this->namedLoggerProvider = new CompoundNamedLoggerProvider();
    }

    /**
     * @param LoggerInterface $fallbackLogger
     */
    public function setFallbackLogger(LoggerInterface $fallbackLogger)
    {
        $this->fallbackLogger = $fallbackLogger;
    }

    /**
     * @param NamedLoggerInterface ...$loggers
     */
    public function addLogger(NamedLoggerInterface ...$loggers)
    {
        $newCollection = new NamedLoggerCollection;
        $newCollection->addMultiple($loggers);
        $newNamedLoggerProvider = new NamedLoggerProvider($newCollection);
        $this->namedLoggerProvider->attach($newNamedLoggerProvider);
    }

    /**
     * @param string $name
     * @return ?LoggerInterface
     */
    public function getLogger(string $name): ?LoggerInterface
    {
        $logger = $this->namedLoggerProvider->findByName($name);
        if (!$logger) {
            trigger_error(
                "A logger with the name '$name' does not exist. 
                The fallback logger will be used instead.",
                E_USER_WARNING
            );

            return $this->fallbackLogger;
        }

        return $logger;
    }

    /**
     * @return iterable
     */
    public function getLoggers(): iterable
    {
        return $this->namedLoggerProvider->getAll();
    }

    /**
     * A magic way to call the logger methods directly.
     *
     * @param $method
     * @param $arguments
     */
    public function __call($method, $arguments)
    {
        $allowedMethods = get_class_methods(LoggerInterface::class);

        if (!in_array($method, $allowedMethods)) {
            trigger_error(
                "Method '$method' does not exist on the logger instance.",
                E_USER_WARNING
            );

            return;
        }

        $loggerName = $arguments[0];

        array_shift($arguments);
        $this->getLogger($loggerName)->$method(...$arguments);
    }
}
