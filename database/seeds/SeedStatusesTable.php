<?php

use Illuminate\Database\Seeder;

class SeedStatusesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("statuses")->insert(
            [
                ["name"=>"Ожидает"],
                ["name"=>"В работе"],
                ["name"=>"Завершен"],
                ["name"=>"Требует внимания"]
            ]
        );
    }
}
