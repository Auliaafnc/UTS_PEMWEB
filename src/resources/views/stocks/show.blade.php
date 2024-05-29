@extends('main')
@section('section')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ asset('/storage/products/'.$stock->image) }}" target="_blank">
                            <img src="{{ asset('/storage/products/'.$stock->image) }}" class="rounded" style="width: 100%">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3>{{ $stock->title }}</h3>
                        <hr/>
                        <p>{{ "Rp " . number_format($stock->price,2,',','.') }}</p>
                        <code>
                            <p>{!! $stock->description !!}</p>
                        </code>
                        <hr/>
                        <p>Stock : {{ $stock->stock }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection