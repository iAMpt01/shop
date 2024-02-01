@extends('layout.main')

@section('content')
<div class="card" style="width: 18rem;">
        <img src="{{ $produs->image_url }}" class="card-title" alt="Product Image">
    </div>
  <div class="card-body">
    <h1 class="card-title">{{$produs->short_description}}</h1>
     <p class="card-text">Cos produs: {{ $produs->sku}}</p>
    <p class="card-text">Descriere produs: {{$produs->long_description}}</p>
    <p class="card-text fw-bold">Pret: {{$produs->pret_in_lei}} Lei</p>
    <p class="card-text">Dimensiune: {{$produs->dimensions}}</p>
    <p class="card-text">Provenienta: {{$produs->country_of_origin}}</p>
    <p class="card-text">Material: {{$produs->material}}</p>
    
  </div>
<a href="{{route('produse.index')}}" class="btn btn-success float-end">Inapoi</a>
@endsection