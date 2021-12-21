<?php

use Merophp\LogManager\LogManager;
use Merophp\LogManager\NamedLogger\NamedLoggerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

/**
 * @covers \Merophp\LogManager\LogManager
 */
class LogManagerTest extends TestCase
{
    protected static LogManager $logManagerInstance;

    public static function setUpBeforeClass(): void
    {
        self::$logManagerInstance = new LogManager;
    }

    public function testGetLogger()
    {
        $oldErrorLevel = error_reporting();
        error_reporting(E_ERROR);

        $logger = self::$logManagerInstance->getLogger('ghost');
        $this->assertInstanceOf(NullLogger::class, $logger);

        $namedLoggerMock = Mockery::mock(NamedLoggerInterface::class);
        $namedLoggerMock->expects('getName')->andReturn('foo');
        self::$logManagerInstance->addLogger($namedLoggerMock);
        $logger = self::$logManagerInstance->getLogger('foo');
        $this->assertInstanceOf(NamedLoggerInterface::class, $logger);

        error_reporting($oldErrorLevel);
    }

    public function testGetLoggers()
    {
        $this->assertIsIterable(self::$logManagerInstance->getLoggers());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testMagic()
    {
        $oldErrorLevel = error_reporting();
        error_reporting(E_ERROR);
        self::$logManagerInstance->info('ghost', 'message');

        error_reporting($oldErrorLevel);
    }
}
