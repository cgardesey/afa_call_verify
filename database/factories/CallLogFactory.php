<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CallLog;
use App\User;
use Faker\Generator as Faker;

$factory->define(CallLog::class, function (Faker $faker) {
    return [
        'caller_phonenumber' => $this->faker->phoneNumber,
        'callee_phonenumber' => $this->faker->phoneNumber,
        'call_id' => $this->faker->uuid,
        'user_id' => function () {
            factory(User::class)->create()->id;
        },
    ];
});
