<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Category;
use App\Models\Combination;
use App\Models\File;
use App\Models\Image;

class ImportProducts extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-products';

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
        $stringProducts = file_get_contents(storage_path('app/import/products.json'));
        $jsonProducts = json_decode($stringProducts);

        $total = 0;
        foreach ($jsonProducts as $jsonProduct) {
            $category = Category::where('name', $jsonProduct->product_class)->first();
            if (!$category) {
                $category = new Category();
                $category->name = $jsonProduct->product_class;
                $category->save();
            }


            $product = Product::where('sku', $jsonProduct->master_code)->first();
            if (!$product) {
                $product = new Product();
                $product->sku = $jsonProduct->master_code;
                $product->name = isset($jsonProduct->product_name) ? $jsonProduct->product_name : null ;
                $product->short_description = $jsonProduct->short_description;
                $product->long_description = isset($jsonProduct->long_description) ? $jsonProduct->long_description : null  ;
                $product->dimensions = isset( $jsonProduct->dimensions ) ? $jsonProduct->dimensions : null;
                $product->brand = isset( $jsonProduct->brand) ? $jsonProduct->brand : null ;
                $product->country_of_origin = isset($jsonProduct->country_of_origin ) ? $jsonProduct->country_of_origin : null ;
                $product->material = isset($jsonProduct->material) ? $jsonProduct->material : null;
                $product->printable = $jsonProduct->printable == 'yes' ? true : false;
                $product->category_id = $category->id;
                $product->save();
                
                $total++;
                $this->info($total . ' New product: ' . $product->name );
            }

            foreach ($jsonProduct->digital_assets as $digital_asset) {
                $file = File::where('url', $digital_asset->url)->first();
                if (!$file) {
                    $file = new File();
                    $file->product_id = $product->id;
                    $file->url = $digital_asset->url;
                    $file->save();
                }
            }

            foreach ($jsonProduct->variants as $variant) {
                $combination = Combination::where('sku', $variant->sku)->first();
                if (!$combination) {
                    $combination = new Combination();
                    $combination->product_id = $product->id;
                    $combination->sku = $variant->sku;
                    $combination->color_description = isset( $variant->color_description) ?  $variant->color_description : null;
                    $combination->color_group = isset($variant->color_group) ? $variant->color_group : null ;
                    $combination->size_textile = isset($variant->size_textile) ? $variant->size_textile : null;
                    $combination->save();
                }
                foreach ($variant->digital_assets as $digital_asset){
                    $image = Image::where('url', $digital_asset->url)->first();
                    if (!$image) {
                        $image = new Image();
                        $image->combination_id = $combination->id;
                        $image->url = $digital_asset->url;
                        $image->url_highress = $digital_asset->url_highress;
                        $image->save();
                    }
                }
            }
        }
    }
}
