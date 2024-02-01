@extends('layout.main')

@section('content')
<div class="card" style="width: 18rem;">
    @if ($produs->image_url)
        <img src="{{ $produs->image_url }}" class="card-img-top" alt="Product Image">
    @else
        <img src="{{ asset('default_image_url.jpg') }}" class="card-img-top" alt="Default Image">
    @endif
  <div class="card-body">
    <h1 class="card-title">{{$produs->titlu}}</h1>
    <h1 class="card-title">{{$produs->sku}}</h1>
    <p class="card-text"> {{$produs->long_description}}</p>
    <p class="card-text fw-bold">Pret: {{$produs->pret}}</p>
    <p class="card-text">Dimensiune: {{$produs->dimensions}}</p>
    <p class="card-text">Provenienta: {{$produs->country_of_origin}}</p>
    
  </div>
<a href="{{route('produse.index')}}" class="btn btn-success float-end">Inapoi</a>
@endsection