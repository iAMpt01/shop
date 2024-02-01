<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Combination;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class ImportPrice extends Command {

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
    public function handle() {
        $stringPrice = file_get_contents(storage_path('app/import/prices.json'));
        $jsonPrices = json_decode($stringPrice);

        $euroToRonRate = $this->getEuroToRonRate();
        
        foreach ($jsonPrices->price as $jsonPrice) {
            $combination = Combination::where('sku', $jsonPrice->sku)->first();
            
            if ($combination) {
                $euroPrice = isset($jsonPrice->price) ? str_replace(",", ".", $jsonPrice->price) : null;

                $leiPrice = $this->convertToLeiFromEuro($euroPrice, $euroToRonRate);

                $combination->price = $leiPrice;
                $combination->save();
            }
        }
    }
    
    private function getEuroToRonRate() {
     
        $response = Http::get('https://www.bnr.ro/nbrfxrates.xml');
        $xml = new SimpleXMLElement($response->body());

        foreach ($xml->Body->Cube->Rate as $rate) {
            if ((string) $rate['currency'] === 'EUR') {
                return (float) $rate;
            }
        }
    }

    private function convertToLeiFromEuro($priceInEuro, $euroToRonRate) {
        
        $priceInLei = $priceInEuro * $euroToRonRate;

        return number_format($priceInLei, 2, '.', '');
    }
    
}
