@extends('layout.main')

@section('content')
<div class="card" style="width: 18rem;">
    <div id="carouselExampleControls" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($combination->images as $image) 
            <div class="carousel-item active">
                @if( !strpos($image->url_highress, ".eps"))
                    <img src="{{ $image->url_highress }}" class="d-block w-100" alt="...">
                @else
                <img src="{{asset('images/not_available.png')}}" class="d-block w-100" alt="...">
                @endif
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<div class="card-body">
    <h1 class="card-title">{{ $combination->product->name }}</h1>
    <p class="card-text">Cos produs: {{ $combination->product->sku }}</p>
    <p class="card-text">Descriere produs: {{ $combination->product->long_description }}</p>
    <p class="card-text fw-bold">Pret: {{ $combination->price }} lei</p>
    <p class="card-text">Dimensiune: {{ $combination->product->dimensions }}</p>
    <p class="card-text">Provenienta: {{ $combination->product->country_of_origin }}</p>
    <p class="card-text">Material: {{ $combination->product->material }}</p>
</div>
<a href="{{ route('produse.index') }}" class="btn btn-success float-end">Inapoi</a>
@endsection
