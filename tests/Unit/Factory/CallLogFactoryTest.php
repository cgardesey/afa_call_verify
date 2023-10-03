<?php

namespace Tests\Unit\Factories;

use App\CallLog;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CallLogFactoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_creates_a_valid_call_log_instance()
    {
        $user = factory(User::class)->create();
        $callLog = factory(CallLog::class)->create([
            'user_id' => $user->id
        ]);

        $this->assertInstanceOf(CallLog::class, $callLog);
        $this->assertDatabaseHas('call_logs', [
            'callee_phonenumber' => $callLog->callee_phonenumber,
            'call_id' => $callLog->call_id,
            'user_id' => $callLog->user_id,
        ]);
    }
}
