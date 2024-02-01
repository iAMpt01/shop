@extends('layout.main')

@section('content')

<div class="row row-cols-xl-5 row-cols-lg-4 g-2">
    @foreach($combinations as $index =>$combination)
    <div class="col">
        <div class="card" style="width: 18rem;">
            <img src="{{$combination->images->first()->url }}" class="d-block w-100">

            <div class="card-body">
                <a href="{{ route('produse.show', [$combination->id]) }}" class="card-title">{{$combination->product->name}}</a>
                <p class="card-text">{{$combination->product->short_description}}</p>
                <p class="card-text fw-bold">Pret: {{$combination->price}} lei</p>
            </div>
        </div>
    </div>

    @endforeach
</div>



<div class="row">
    <div class="col-md-2">
        {{ $combinations->onEachSide(1)->withQueryString()->links('pagination::bootstrap-4') }}
    </div>
</div>


</div>

@endsection
