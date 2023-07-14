<?php

use App\Model\ItemsUpload;
use Illuminate\Database\Seeder;

class ItemUploadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ItemsUpload::class, 1)->create();
    }
}
