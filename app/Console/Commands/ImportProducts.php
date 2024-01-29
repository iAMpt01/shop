<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\Category;
use App\Models\Combination;

class ImportProducts extends Command
{
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
    public function handle()
    {
        $stringProducts = file_get_contents(storage_path('app/import/products.json'));
        $jsonProducts= json_decode($stringProducts);
        
        foreach ($jsonProducts as $jsonProduct)
        {
            $category= Category::where('name', $jsonProduct->product_class)->first();
            if(!$category)
            {
                $category = new Category();
                $category->name= $jsonProduct->product_class;
                $category->save();
            }
            
            
            $product=Product::where('sku',  $jsonProduct->master_code)->first();
            if(!$product){
            $product = new Product();
            $product->sku = $jsonProduct->master_code;
            $product->short_description=$jsonProduct->short_description;
            $product->long_description=$jsonProduct->long_description;
            $product->dimensions=$jsonProduct->dimensions;
            $product->brand=$jsonProduct->brand;
            $product->country_of_origin=$jsonProduct->country_of_origin;
            $product->material=$jsonProduct->material;
            $product->printable=$jsonProduct->printable == 'yes' ? true : false;
            $product->category_id=$category->id;
            $product->save();
            }
            
            $combination=Combination::where('sku',  $jsonProduct->sku)->first();
            if(!$combination){
            $combination=new Combination();
            $combination->product_id=$product->id;
            $combination->sku=$jsonProduct->sku;
            $combination->color_description=$jsonProduct->color_description;
            $combination->color_group=$jsonProduct->color_group;
            $combination->size_textile=$jsonProduct->size_textile;
            $combination->save();
            }
            
            $file=File::where('sku',  $jsonProduct->sku)->first();
            if(!$file){
            $file=new File();
            $file->product_id=$product->id;
            $file->url=$jsonProduct->url;
            $file->save();
            }
            dd('gata');
            
        }
    }
}
