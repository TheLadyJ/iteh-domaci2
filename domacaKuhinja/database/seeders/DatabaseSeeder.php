<?php

namespace Database\Seeders;

use App\Models\Kategorija;
use App\Models\Recept;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Kategorija::truncate();
        User::truncate();
        Recept::truncate();

        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $kat1 = Kategorija::create(['naziv_kategorije'=>'dorucak']);
        $kat2 = Kategorija::create(['naziv_kategorije'=>'predjelo']);
        $kat3 = Kategorija::create(['naziv_kategorije'=>'rucak']);
        $kat4 = Kategorija::create(['naziv_kategorije'=>'vecera']);
        $kat5 = Kategorija::create(['naziv_kategorije'=>'dezert']);
        

        Recept::factory(3)->create([
            'user_id'=>$user1->id,
            'kategorija_id'=>$kat1->id,
        ]);
        Recept::factory(2)->create([
            'user_id'=>$user1->id,
            'kategorija_id'=>$kat2->id,
        ]);

        Recept::factory(3)->create([
            'user_id'=>$user2->id,
            'kategorija_id'=>$kat3->id,
        ]);
        Recept::factory(1)->create([
            'user_id'=>$user2->id,
            'kategorija_id'=>$kat4->id,
        ]);
        Recept::factory(1)->create([
            'user_id'=>$user2->id,
            'kategorija_id'=>$kat5->id,
        ]);
    }
}
