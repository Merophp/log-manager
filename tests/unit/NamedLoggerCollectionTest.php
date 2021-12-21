<?php

use Merophp\LogManager\NamedLogger\NamedLoggerInterface;
use PHPUnit\Framework\TestCase;
use Merophp\LogManager\NamedLogger\Collection\NamedLoggerCollection;

/**
 * @covers Merophp\LogManager\NamedLogger\Collection\NamedLoggerCollection
 */
class NamedLoggerCollectionTest extends TestCase
{
    protected static NamedLoggerCollection $loggerCollectionInstance;

    public static function setUpBeforeClass(): void
    {
        self::$loggerCollectionInstance = new NamedLoggerCollection;
    }

    public function test()
    {
        $loggerMock = Mockery::mock(NamedLoggerInterface::class);
        $this->assertTrue(self::$loggerCollectionInstance->isEmpty());

        self::$loggerCollectionInstance->addMultiple([$loggerMock]);
        $this->assertFalse(self::$loggerCollectionInstance->isEmpty());

        $this->assertTrue(self::$loggerCollectionInstance->has($loggerMock));
    }
}
