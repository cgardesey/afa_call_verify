<?php

namespace Tests\Unit;

use App\CallLog;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CallLogTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = factory(User::class)->create();
        $callLog = factory(CallLog::class)->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $callLog->user);
        $this->assertEquals($user->id, $callLog->user->id);
    }
}
