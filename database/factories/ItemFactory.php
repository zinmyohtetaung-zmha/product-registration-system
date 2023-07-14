<?php

use App\Model\Category;
use App\Model\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    static $currentNumber = 10001;

    return [
        'category_id' => function () {
            return Category::inRandomOrder()->first()->id;
        },
        'item_id' => $currentNumber++,
        'item_code' => $faker->numberBetween(101, 110),
        'item_name' => $faker->name,
        'safety_stock' => $faker->numberBetween(5000, 10000),
        'received_date' => $faker->dateTimeThisDecade(),
        'description' => $faker->paragraph,
    ];
});
