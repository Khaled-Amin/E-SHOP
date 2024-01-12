@extends('layouts.front')

@section('title')
    Checkout
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container collection">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">Home</a> /
                <a href="{{ url('checkout/') }}">Pay</a>
            </h6>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <form action="{{ url('place-order') }}" method="POST">
            @csrf
            <div class="row">
                @if (count($errors) > 0)
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li class="text-danger">
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                @endif
                <div class="col-md-7 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>Contact</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <label for="firstName">First name</label>
                                    <input type="text" value="{{ Auth::user()->name }}" name="fname"
                                        class="form-control mt-2 firstname" placeholder="First Name">
                                    <span id="fname_error" class="text-danger" style="font-size: 12px;"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName">Last name</label>
                                    <input type="text" value="{{ Auth::user()->lname }}" name="lname"
                                        class="form-control mt-2 lastname" placeholder="Last Name">
                                    <span id="lname_error" class="text-danger" style="font-size: 12px;"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="Email">Email</label>
                                    <input type="email" value="{{ Auth::user()->email }}" name="email"
                                        class="form-control mt-2 email" placeholder="example@out.com">
                                    <span id="email_error" class="text-danger" style="font-size: 12px;"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="phoneNum">Phone Number</label>
                                    <input type="text" value="{{ Auth::user()->phone }}" name="phone_num"
                                        class="form-control mt-2 phone" placeholder="Phone Number">
                                    <span id="phone_error" class="text-danger" style="font-size: 12px;"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="address1">Address 1</label>
                                    <input type="text" value="{{ Auth::user()->address1 }}" name="addr1"
                                        class="form-control mt-2 address1" placeholder="Address 1">
                                    <span id="address1_error" class="text-danger" style="font-size: 12px;"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="address2">Address 2</label>
                                    <input type="text" value="{{ Auth::user()->address2 }}" name="addr2"
                                        class="form-control mt-2 address2" placeholder="Address 2">
                                    <span id="address2_error" class="text-danger" style="font-size: 12px;"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="city">City</label>
                                    <input type="text" value="{{ Auth::user()->city }}" name="city"
                                        class="form-control mt-2 city" placeholder="City">
                                    <span id="city_error" class="text-danger" style="font-size: 12px;"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="state">Province</label>
                                    <input type="text" value="{{ Auth::user()->state }}" name="state"
                                        class="form-control mt-2 state" placeholder="Province">
                                    <span id="state_error" class="text-danger" style="font-size: 12px;"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="country">Country</label>
                                    <input type="text" value="{{ Auth::user()->country }}" name="country"
                                        class="form-control mt-2 country" placeholder="Country">
                                    <span id="country_error" class="text-danger" style="font-size: 12px;"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="pincode">Postal code</label>
                                    <input type="text" value="{{ Auth::user()->pincode }}" name="pincode"
                                        class="form-control mt-2 pincode" placeholder="Postal code">
                                    <span id="pincode_error" class="text-danger" style="font-size: 12px;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Order details</h6>
                            <hr>

                            @if ($cartitems->count() > 0)
                                <table class="table table-striped table-bordered">
                                    <tbody>

                                        <tr>
                                            <td>name</td>
                                            <td>colour</td>
                                            <td>size</td>
                                            <td>quantity</td>
                                            <td>price</td>
                                        </tr>

                                        @foreach ($cartitems as $item)
                                            @php
                                                $test = \App\Models\ProductColorSize::with('color', 'size')
                                                    ->where('product_id', $item->prod_id)
                                                    ->where('color_id', $item->colorID)
                                                    ->where('size_id', $item->sizeID)
                                                    ->first();
                                            @endphp

                                            <tr>
                                                <td>{{ $item->products->name }}</td>
                                                <td>{{ $test->color->name }}</td>
                                                <td>{{ $test->size->value }}</td>
                                                <td>{{ $item->prod_qty }}</td>
                                                <td>{{ $item->products->selling_price }}</td>
                                            </tr>
                                            {{-- <span style="color:#625858d9; font-w"></span> --}}
                                        @endforeach
                                    </tbody>
                                </table>
                                <h6 class="px-2">Total Price Without Shipping Costs: <span
                                        class="float-end">{{ $grandTotal }} $</span></h6>
                                <h6>Shipping expenses:</h6>
                                @isset($shipping)
                                    <select name="shipping" id="shippingSelection">
                                        <option value="">Choose the place of order</option>
                                        @foreach ($shipping as $item)
                                            <option value="{{ $item->price }}">{{ $item->name }}: {{ $item->price }}
                                            </option>
                                        @endforeach

                                    </select>
                                @endisset


                                <hr>
                                <button type="submit" class="btn btn-secondary float-start w-100">Confirm order | pay
                                    cash</button>
                                <button type="button" class="btn btn-primary float-start w-100 mt-3 razorpay_btn">Pay
                                    with Razorpay</button>
                                <button type="button" class="btn btn-warning float-start w-100 mt-3"><img
                                        src="{{ asset('frontend/PayPal.svg.webp') }}"
                                        style="width: 125px;
                                    height: 26px;"
                                        alt="paypal"></button>
                            @else
                                <h4>There are no products in your shopping cart</h4>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
