@extends('layouts.front')

@section('title')
    Checkout
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container collection">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">الصفحة الرئيسية</a> /
                <a href="{{ url('checkout/') }}">الدفع</a>
            </h6>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <form action="{{url('place-order')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-7 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h6>التفاصيل الأساسية</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <label for="firstName">الاسم الاول</label>
                                    <input type="text" value="{{ Auth::user()->name }}" name="fname" class="form-control mt-2 firstname" placeholder="ادخل الاسم الاول">
                                    <span id="fname_error" class="text-danger" style="font-size: 12px;"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName">الاسم الاخير</label>
                                    <input type="text" value="{{ Auth::user()->lname }}" name="lname" class="form-control mt-2 lastname" placeholder="ادخل الاسم الاخير">
                                    <span id="lname_error" class="text-danger" style="font-size: 12px;"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="Email">بريد الإلكتروني</label>
                                    <input type="email" value="{{ Auth::user()->email }}" name="email" class="form-control mt-2 email" placeholder="example@out.com">
                                    <span id="email_error" class="text-danger" style="font-size: 12px;"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="phoneNum">رقم الهاتف</label>
                                    <input type="text" value="{{ Auth::user()->phone }}" name="phone_num" class="form-control mt-2 phone" placeholder="ادخل رقم الهاتف">
                                    <span id="phone_error" class="text-danger" style="font-size: 12px;"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="address1">العنوان 1</label>
                                    <input type="text" value="{{ Auth::user()->address1 }}" name="addr1" class="form-control mt-2 address1" placeholder="ادخل العنوان 1">
                                    <span id="address1_error" class="text-danger" style="font-size: 12px;"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="address2">العنوان 2</label>
                                    <input type="text" value="{{ Auth::user()->address2 }}" name="addr2" class="form-control mt-2 address2" placeholder="ادخل العنوان 2">
                                    <span id="address2_error" class="text-danger" style="font-size: 12px;"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="city">المدينة</label>
                                    <input type="text" value="{{ Auth::user()->city }}" name="city" class="form-control mt-2 city" placeholder="ادخل المدينة">
                                    <span id="city_error" class="text-danger" style="font-size: 12px;"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="state">الولاية</label>
                                    <input type="text" value="{{ Auth::user()->state }}" name="state" class="form-control mt-2 state" placeholder="ادخل الولاية">
                                    <span id="state_error" class="text-danger" style="font-size: 12px;"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="country">الدولة</label>
                                    <input type="text" value="{{ Auth::user()->country }}" name="country" class="form-control mt-2 country" placeholder="ادخل الدولة">
                                    <span id="country_error" class="text-danger" style="font-size: 12px;"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="pincode">رمز البريدي</label>
                                    <input type="text" value="{{ Auth::user()->pincode }}" name="pincode" class="form-control mt-2 pincode" placeholder="ادخل رمز البريدي">
                                    <span id="pincode_error" class="text-danger" style="font-size: 12px;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>تفاصيل الطلب</h6>
                            <hr>
                            @if ($cartitems->count() > 0)
                                <table class="table table-striped table-bordered">
                                    <tbody>

                                        <tr>
                                            <td>اسم</td>
                                            <td>الكمية</td>
                                            <td>السعر</td>
                                        </tr>

                                            @foreach ($cartitems as $item)
                                                    <tr>
                                                        <td>{{ $item->products->name }}</td>
                                                        <td>{{ $item->prod_qty }}</td>
                                                        <td>{{ $item->products->selling_price }}</td>
                                                    </tr>
                                                    {{-- <span style="color:#625858d9; font-w"></span> --}}
                                            @endforeach
                                    </tbody>
                                </table>
                                <h6 class="px-2">السعر الإجمالي: <span class="float-start">${{$grandTotal}}</span></h6>
                                <hr>
                                <button type="submit" class="btn btn-secondary float-start w-100">تأكيد الطلب | الدفع نقدا</button>
                                <button type="button" class="btn btn-primary float-start w-100 mt-3 razorpay_btn">Pay with Razorpay</button>
                                <button type="button" class="btn btn-warning float-start w-100 mt-3"><img src="{{asset('frontend/PayPal.svg.webp')}}" style="width: 125px;
                                    height: 26px;" alt="paypal"></button>
                            @else
                                <h4>لاتوجد منتجات في عربة التسوق الخاصة بك</h4>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
