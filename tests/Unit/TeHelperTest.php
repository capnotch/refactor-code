<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\TeHelper;
use Carbon\Carbon;

class TeHelperTest extends TestCase
{
    /**
     * A basic unit test DifferenceIs90.
     *
     * @return void
     */
    public function testDifferenceIs90()
    {
        $controller = new TeHelper();
        $due_time = Carbon::parse('2000-01-01 00:00:00');
        $created_at = Carbon::parse('2000-01-01 09:00:00');
        $response = $controller->willExpireAt( $due_time,$created_at );
        $this->assertEquals($response,$due_time);
    }

    /**
     * A basic unit test Differenceis24.
     *
     * @return void
     */
    public function testDifferenceis24()
    {
        $controller = new TeHelper();
        $due_time = Carbon::parse('2000-01-02 00:00:00');
        $created_at = Carbon::parse('2000-01-01 00:00:00');
        
        $response = $controller->willExpireAt( $due_time,$created_at );
        
        $this->assertEquals($response,$due_time);
    }
    /**
     * A basic unit test DifferenceBetween90And72.
     *
     * @return void
     */
    public function testDifferenceBetween90And72()
    {
        $controller = new TeHelper();
        $due_time = Carbon::parse('2000-01-03 00:00:00');
        $created_at = Carbon::parse('2000-01-01 00:00:00');
        
        $response = $controller->willExpireAt( $due_time,$created_at );
        
        $this->assertEquals($response,$due_time);
    }
    /**
     * A basic unit test DefaultCondition.
     *
     * @return void
     */
    public function testDefaultCondition()
    {
        $controller = new TeHelper();
        $due_time = Carbon::parse('2000-01-05 00:00:00');
        $created_at = Carbon::parse('2000-01-01 00:00:00');
        
        $response = $controller->willExpireAt( $due_time,$created_at );
        
        $this->assertEquals($response,$due_time->subHours(48));
    }
}
