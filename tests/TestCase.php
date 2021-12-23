<?php
declare(strict_types=1);

use Symfony\Component\Process\Process;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{

    /**
     * @var Process
     */
    private static $webServerProcess;

    /**
     * @var string
     */
    protected static $hostAndPort = "localhost:80";

    public static function setUpBeforeClass(): void
    {
        self::$webServerProcess = new Process([
            "php",
            "-S",
            self::$hostAndPort,
            "-t",
            realpath(__DIR__) . "/website"
        ]);
        self::$webServerProcess->start();
        sleep(2);
    }

    public static function tearDownAfterClass(): void
    {
        self::$webServerProcess->stop();
    }

}