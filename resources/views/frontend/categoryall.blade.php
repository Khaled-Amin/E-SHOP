@extends('layouts.front')

@section('title')
    التصنيفات
@endsection

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <h2>All Categories:</h2>
                        @foreach ($getCate as $getCategoryy)
                        <div class="col-md-4 mt-3">
                            <a href="{{route('productBycategory', [$getCategoryy->slug])}}" class="text-decoration-none">
                                <div class="card">
                                    <img src="{{asset('uploading/'.$getCategoryy->image)}}" alt="صورة التصنيف">
                                    <div class="card-body">
                                        <h5 class="text-dark">{{$getCategoryy->name}}</h5>
                                        <p class="text-secondary">
                                            {{$getCategoryy->description}}
                                        </p>

                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
