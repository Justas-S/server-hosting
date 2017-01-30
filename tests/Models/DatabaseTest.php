<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DatabaseTest extends TestCase
{
    public function testIsExpired()
    {
        $database = factory(App\Database::class)->create();
        $this->assertFalse($database->is_expired);

        $database->expired_on = \Carbon\Carbon::yesterday();

        $this->assertTrue($database->is_expired);

        $database->expired_on = \Carbon\Carbon::tomorrow();
        $this->assertFalse($database->is_expired);

        $database->expired_on = \Carbon\Carbon::now();
        $this->assertTrue($database->is_expired);
    }
}
