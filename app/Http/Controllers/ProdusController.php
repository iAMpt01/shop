<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Combination;
use App\Models\Image;

class ProdusController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $produse = Product::paginate(40);

        foreach ($produse as $produs) {
            $combination = Combination::where('product_id', $produs->id)->first();

            if ($combination) {
                $produs->pret = $combination->price;

                $image = Image::where('combination_id', $combination->id)->first();

                if ($image) {
                    $produs->image_url = $image->url;
                } else {
                    $produs->image_url = 'image.jpg';
                }
            } else {
                $produs->pret = 0;
                $produs->image_url = 'image.jpg';
            }
        }

        return view('produse.index', [
            'produse' => $produse
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
        $produs = Product::find($id);

    if ($produs) {
        $combination = Combination::where('product_id', $produs->id)->first();

        if ($combination) {
            $produs->pret = $combination->price;

            $image = Image::where('combination_id', $combination->id)->first();

            if ($image) {
                $produs->image_url = $image->url_highress;
            } else {
                $produs->image_url = 'Imaginea nu a fost gasita';
            }
        } else {
            $produs->pret = 0;
            $produs->image_url = 'Imaginea nu a fost gasita';
        }

        return view('produse.show', [
            'produs' => $produs
        ]);
    } else {
        abort(404, 'Produsul nu a fost găsit');
    }

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
