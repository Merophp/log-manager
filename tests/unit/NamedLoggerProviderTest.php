<?php

use Merophp\LogManager\NamedLogger\Collection\NamedLoggerCollection;
use Merophp\LogManager\NamedLogger\NamedLoggerInterface;
use PHPUnit\Framework\TestCase;
use Merophp\LogManager\NamedLogger\Provider\NamedLoggerProvider;

/**
 * @covers Merophp\LogManager\NamedLogger\Provider\NamedLoggerProvider
 */
class NamedLoggerProviderTest extends TestCase
{
    protected static NamedLoggerProvider $loggerProviderInstance;

    public static function setUpBeforeClass(): void
    {
        $collection = new NamedLoggerCollection();
        $loggerMock = Mockery::mock(NamedLoggerInterface::class);
        $loggerMock->expects('getName')->andReturn('foo');
        $collection->add($loggerMock);
        self::$loggerProviderInstance = new NamedLoggerProvider($collection);
    }

    public function test()
    {
        $this->assertNull(self::$loggerProviderInstance->findByName('bar'));

        $this->assertInstanceOf(NamedLoggerInterface::class, self::$loggerProviderInstance->findByName('foo'));

        $this->assertIsIterable(self::$loggerProviderInstance->getAll());
    }
}
