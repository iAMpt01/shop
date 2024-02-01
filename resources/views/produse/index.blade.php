@extends('layout.main')

@section('content')

<div class="row row-cols-xl-5 row-cols-lg-4 g-2">
@foreach($produse as $index =>$produs)
    <div class="col">
        <div class="card" style="width: 18rem;">
             <img src="{{ $produs->image_url }}" class="card-img-top" alt="Product Image">
          <div class="card-body">
           <a href="{{ route('produse.show', [$produs->id]) }}" class="card-title">{{$produs->name}}</a>
            <p class="card-text">{{$produs->short_description}}</p>
             <p class="card-text fw-bold">Pret: {{$produs->pret_in_lei}} Lei</p>
          </div>
        </div>
    </div>

@endforeach
</div>



<div class="row">
    <div class="col-md-2">
    {{ $produse->onEachSide(1)->withQueryString()->links('pagination::bootstrap-4') }}
    </div>
</div>


</div>

@endsection
