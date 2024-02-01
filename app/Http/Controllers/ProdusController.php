<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Combination;
use App\Models\Image;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;

class ProdusController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $combinations = Combination::paginate(40);

        foreach ($combinations as $combination) {
            $product = Product::where('id', $combination->product_id)->first();
            $combination->product = $product;

            $images = Image::where('combination_id', $combination->id)->get();
            $combination->images = $images;
        }

        //dd($combinations[0]);
        return view('produse.index', [
            'combinations' => $combinations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $combination = Combination::findOrFail($id);
        $product = Product::where('id', $combination->product_id)->first();
        $combination->product = $product;

        $images = Image::where('combination_id', $combination->id)->get();
        $combination->images=$images;

        return view('produse.show', [
            'combination' => $combination
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }
}
