<?php

use Illuminate\Database\Seeder;
use App\News;
use App\User;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Naredi 3 novice, katerih je lastnik uporabnik z ID = 1.
        factory(News::class, 3)->create([
            'user_id' => 1
        ]);

        $randomUsers = User::all()->random(3);
        // Naredi 10 novic in vsaki dodeli enega od 3 nakljucnih uporabnikov.
        factory(News::class, 10)->make()->each(function($news_ins) use ($randomUsers){
            $news_ins->user_id = $randomUsers->random()->id;
            $news_ins->save();
        });
    }
}
