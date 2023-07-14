<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Employee;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Employee::class, function (Faker $faker) {
    $randomNumber = $faker->numberBetween(1, 100);
    $employeeID = str_pad($randomNumber, 5, '0', STR_PAD_LEFT);
    return [
        'emp_id' => $faker->numberBetween(100001, 100010),
        'emp_name' => $faker->name,
        'password' => Hash::make('admin123'),
  
    ];
});
