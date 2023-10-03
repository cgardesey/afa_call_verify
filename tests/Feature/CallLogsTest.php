<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CallLogsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_make_calls()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $attributes = [
            'caller_phonenumber' => '0240000000',
            'callee_phonenumber' => '0540000000',
            'user_id' => $user->id
        ];
        $response = $this->post('/group-call', $attributes);


        $this->assertDatabaseHas('call_logs', $attributes);
    }

    /** @test */
    public function a_call_log_has_caller_ponenumber_and_callee_phonenumber()
    {
        factory(User::class)->create();
        $attributes = ['user_id' => factory(User::class)->create()->id];
        $response = $this->post('group-call', $attributes);
        $response->assertSessionHasErrors(['caller_phonenumber', 'callee_phonenumber']);
    }
}
