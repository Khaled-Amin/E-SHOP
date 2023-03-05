@extends('layouts.front')

@section('title')
    {{$category->name}}
@endsection

@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container part-index-product">
        <h6 class="mb-0">
            <a href="{{url('/')}}">الصفحة الرئيسية</a>/
            <a href="{{url('category')}}">التصنيفات</a>/
            <a href="{{url('view-category/' . $category->slug)}}">{{$category->name}}</a>
        </h6>

    </div>
</div>

<div class="py-5 prod">
    <div class="container">
        <div class="row">
            <h2>{{$category->name}}</h2>
            @foreach ($products as $item)
                <div class="col-md-3 mt-3">
                    <div class="card">
                        <a href="{{url('category/' . $category->slug . '/' . $item->slug)}}">
                            <div class="refact">
                                <img src="{{asset('uploading/'.$item->image)}}" alt="">
                            </div>
                            <div class="card-body">
                                <h5 class="text-dark">{{$item->name}}</h5>
                                <span class="float-start text-dark">{{$item->selling_price}}</span>
                                <span class="float-end text-dark"><s>{{$item->original_price}}</s></span>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
