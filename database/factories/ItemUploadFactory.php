<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Item;
use App\Model\ItemsUpload;
use Faker\Generator as Faker;

$factory->define(ItemsUpload::class, function (Faker $faker) {
    return [
        'item_id' => function () {
            return Item::inRandomOrder()->first()->id;
        },
        'file_path' => "uploadfile/default.png",
        'file_type' => ".jpg",
        'file_size' =>$faker->numberBetween(1, 10),
    ];
});
