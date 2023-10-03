<?php

namespace Tests\Unit;

use App\User;
use App\CallLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_hides_password_and_remember_token()
    {
        $user = factory(User::class)->create();

        $this->assertArrayNotHasKey('password', $user->toArray());
        $this->assertArrayNotHasKey('remember_token', $user->toArray());
    }

    /** @test */
    public function it_has_call_logs_relationship()
    {
        $user = factory(User::class)->create();
        $callLogs = factory(CallLog::class, 3)->create(['user_id' => $user->id]);

        $this->assertInstanceOf(CallLog::class, $user->callLogs->first());
        $this->assertCount(3, $user->callLogs);
    }
}
