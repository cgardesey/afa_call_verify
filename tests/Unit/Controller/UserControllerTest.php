<?php

namespace Tests\Unit\Controllers;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the show method.
     *
     * @return void
     */
    public function testShow()
    {
        $user = factory(User::class)->create();

        $response = $this->get(route('users.show', $user));

        $response->assertStatus(200)
            ->assertJson($user->toArray());
    }

    /**
     * Test the update method.
     *
     * @return void
     */
    public function testUpdate()
    {
        $user = factory(User::class)->create();
        $data = ['name' => 'Updated Name'];

        $response = $this->put(route('users.update', $user), $data);

        $response->assertStatus(200)
            ->assertJson($data);
    }

    /**
     * Test the updatePassword method.
     *
     * @return void
     */
    /*public function testUpdatePassword()
    {
        $user = factory(User::class)->create();
        $newPassword = 'new_password';

        $response = $this->actingAs($user)
            ->post(route('password.update'), [
                'current_password' => 'password', // The default password set by the factory
                'new_password' => $newPassword,
                'new_password_confirmation' => $newPassword,
            ]);

        $response->assertRedirect(route('login'))
            ->assertSessionHas('success', 'Password changed successfully.');

        // Check if the password was updated
        $this->assertTrue(password_verify($newPassword, $user->fresh()->password));
    }*/

    /**
     * Test the showUpdatePassword method.
     *
     * @return void
     */
    public function testShowUpdatePassword()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('show.password.update', $user));

        $response->assertStatus(200)
            ->assertViewIs('show_password_update');
    }
}
