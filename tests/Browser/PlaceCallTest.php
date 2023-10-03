<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PlaceCallTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_login_correctly()
    {
        $this->browse(function (Browser $browser)
        {
            $user = factory('App\User')->create();
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertSee('Call Verify');
        });
    }

    /** @test */
    public function a_user_can_make_calls()
    {
        $this->browse(function (Browser $browser)
        {
            $user = factory('App\User')->create();

            $browser->loginAs($user)
                ->visit('/')
                ->type('caller_phonenumber', env("TEST_NUMBER_1"))
                ->type('callee_phonenumber', env("TEST_NUMBER_2"))
                ->press('Call')
                ->waitForText('Call successfully initiated')
                ->assertSee('Call Verify');
        });
    }
}
