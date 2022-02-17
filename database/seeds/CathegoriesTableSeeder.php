<?php

use App\Cathegory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CathegoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cathegories = ["Funzionale", "Alimentazione", "Attrezzi", "Cardio",];

        foreach($cathegories as $cathegory) {
            $newCathegory = new Cathegory;
            $newCathegory->name = $cathegory;
            $newCathegory->slug = Str::of($newCathegory->name)->slug("-");
            $newCathegory->save();
        }
    }
}
