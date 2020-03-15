<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GetArsoImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:arso';

    private $urls;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Iz spletne strani ARSO pridobi slike vremenskih napovedi in pozarne ogrozenosti.';

    protected $folder = 'arso/';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->urls = collect([
            'pozar' => 'http://meteo.arso.gov.si/uploads/probase/www/warning/graphic/warning_si-fire.png',
            'danes' => 'http://meteo.arso.gov.si/uploads/probase/www/fproduct/graphic/sl/fcast_si-neighbours_d1h15.png',
            // 'danes' => 'http://meteo.arso.gov.si/uploads/probase/www/observ/surface/graphic/weatherSat_si_small.png',
            'jutri_dop' => 'http://meteo.arso.gov.si/uploads/probase/www/fproduct/graphic/sl/fcast_si-neighbours_d2h06.png',
            'jutri_pop' => 'http://meteo.arso.gov.si/uploads/probase/www/fproduct/graphic/sl/fcast_si-neighbours_d2h15.png'
        ]);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        print("Getting images -- START.\n");
        
        $this->urls->each(function($url, $key) {
            print('----' . $url . "\n");

            // Get the image from URL. 
            $contents = file_get_contents($url);

            if (strlen($contents) > 1000) {
                // Save image on local media.
                Storage::disk('public')->put($this->folder . $key . '.png', $contents);
                print("--------SAVED\n");
            }
        });
        
        print("Getting images -- STOP.\n");
    }
}
