<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Combination;

class ImportPrice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $stringPrice = file_get_contents(storage_path('app/import/prices.json'));
        $jsonPrices = json_decode($stringPrice);
        //dd($jsonPrices);
        
         foreach ($jsonPrices->price as $jsonPrice) {
            $combination = Combination::where('sku', $jsonPrice->sku)->first();
            if ($combination) {
                $combination->price = isset( $jsonPrice->price) ? str_replace(",",".", $jsonPrice->price ) : null;
                $combination->save();
            }
    }
    }
}
