@extends('layouts.front')

@section('title')
    طلباتي
@endsection

@section('content')

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white" style="display: flex;
                        justify-content: space-between;
                        align-items: center;">
                            <span>View a purchase order</span>
                            <a href="{{url('my-orders')}}" class="btn btn-warning text-white float-start">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order-details">
                                <h4>Shipping details</h4>
                                <hr>
                                <label for="" class="py-2">First name</label>
                                <div class="border">{{$orders->fname}}</div>
                                <label for="" class="py-2">Last name</label>
                                <div class="border">{{$orders->lname}}</div>
                                <label for="" class="py-2">Email</label>
                                <div class="border">{{$orders->email}}</div>
                                <label for="" class="py-2">Phone Number</label>
                                <div class="border">{{$orders->phone}}</div>
                                <label for="" class="py-2">Address</label>
                                <div class="border">
                                    {{$orders->address1}},<br>
                                    {{$orders->address2}},<br>
                                    {{$orders->city}},<br>
                                    {{$orders->state}},
                                    {{$orders->country}}
                                </div>
                                <label for="">Postal code</label>
                                <div class="border">{{$orders->pincode}}</div>
                            </div>
                            <div class="col-md-6">
                                <h4>Order details</h4>
                                <hr>
                                <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>color</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Picture</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($orders)


                                        @foreach ($orders->orderitems as $item)
                                            @php
                                                $test = \App\Models\ProductColorSize::with('color','size')
                                                    ->where('product_id', $item->prod_id)
                                                    ->where('color_id', $item->colorID)
                                                    ->where('size_id', $item->sizeID)
                                                    ->first();
                                            @endphp
                                            <tr>
                                                <td>{{$item->products->name}}</td>
                                                <td>{{$item->qty}}</td>
                                                <td>{{$test->color->name}}</td>
                                                <td>{{$test->size->value}}</td>
                                                <td>{{$item->price}}</td>
                                                <td style="width:80px;">
                                                    <img src="{{asset('uploading/'. $item->products->image )}}" height="50px" alt="Image Product">
                                                </td>

                                            </tr>
                                        @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                                </div>
                                <h6 class="px-2">
                                    Shipping Costs:
                                    {{$orders->shipping_costs}}
                                </h6>
                                <h4 class="px-2" style="display: flex;
                                justify-content: space-between;
                                align-items: center;">
                                    <span>Total Price With Shipping Costs:</span>
                                    <span class="float-start">{{$orders->total_price}}</span></h4>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
