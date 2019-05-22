<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\TeHelper;
use Carbon\Carbon;
class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $controller = new TeHelper();
        $date1 = Carbon::parse('2000-01-01 00:00:00');
        $date2 = Carbon::parse('2000-01-01 09:00:00');
        echo $controller->willExpireAt( $date1,$date2 );
        $this->assertTrue(true);
    }
}
