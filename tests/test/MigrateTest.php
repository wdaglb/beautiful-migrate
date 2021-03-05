<?php

namespace ke\migrate\tests\test;

use ke\migrate\tests\TestCase;

class MigrateTest extends TestCase
{
    public function testMigrate()
    {
        $this->app->console->call('migrate:run');

        $this->assertTrue(true);
    }
}
