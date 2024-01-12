<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>CountryBoot</h1>
    <h5>#Invoice number:{{random_int(1111, 9999)}}</h5>
    <hr>
    <div class="col-md-6 order-details">
        <h4>Shipping details</h4>
        <hr>
        <table border="1">
            <thead>
                <tr>
                    <th>Field</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>First Name</td>
                    <td>{{ $orders->fname }}</td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td>{{ $orders->lname }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $orders->email }}</td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td>{{ $orders->phone }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $orders->address1 }}, {{ $orders->address2 }}, {{ $orders->city }}, {{ $orders->state }}, {{ $orders->country }}</td>
                </tr>
                <tr>
                    <td>Postal Code</td>
                    <td>{{ $orders->pincode }}</td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
        <h4>Order details</h4>
        <hr>
        <table border="1">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Price</th>
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
                            <td>{{ $item->products->name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ $test->color->name }}</td>
                            <td>{{ $test->size->value }}</td>
                            <td>{{ $item->price }}</td>
                        </tr>
                    @endforeach
                @endisset
            </tbody>
        </table>
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
</body>
</html>
