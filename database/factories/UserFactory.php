<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $sex        = ['Mr', 'Ms'];
    $girl_level = ['1', '2', '3', '4', '5'];
    $date_time  = $faker->date . ' ' . $faker->time;
    return [
        'name'           => $faker->name,
        'username'           => $faker->randomNumber,
        //'email' => $faker->unique()->safeEmail,
        //'email_verified_at' => now(),
        'password'       => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'tel'            => $faker->phoneNumber,
        'sex'            => $faker->randomElement($sex),
        'girl_level'     => $faker->randomElement($girl_level),
        'info'           => $faker->text(),
        'created_at'     => $date_time,
        'updated_at'     => $date_time,
        'total_fee'      => $faker->randomFloat($nbMaxDecimals = 8, $min = 0, $max = 1000000),
        'huobi_addr'     => $faker->md5,
        'local_addr'     => $faker->md5,
        'idcard'         => $faker->swiftBicNumber,
        'avatar'         => $faker->imageUrl(),
        'weixin_openid'  => $faker->md5,
        'weixin_unionid' => $faker->md5,
    ];
});
