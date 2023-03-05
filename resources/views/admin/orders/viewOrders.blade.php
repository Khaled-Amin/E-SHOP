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
                        <h4 class="text-white"> عرض طلب شراء
                            <a href="{{url('admin/orders')}}" class="btn btn-warning text-white float-start">رجوع</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order-details">
                                <h4>تفاصيل الشحن</h4>
                                <hr>
                                <label for="" class="py-2">الإسم الأول</label>
                                <div class="border">{{$orders->fname}}</div>
                                <label for="" class="py-2">الإسم الأخير</label>
                                <div class="border">{{$orders->lname}}</div>
                                <label for="" class="py-2">بريد الإلكتروني</label>
                                <div class="border">{{$orders->email}}</div>
                                <label for="" class="py-2">رقم الهاتف</label>
                                <div class="border">{{$orders->phone}}</div>
                                <label for="" class="py-2">عنوان الشحن</label>
                                <div class="border">
                                    {{$orders->address1}},<br>
                                    {{$orders->address2}},<br>
                                    {{$orders->city}},<br>
                                    {{$orders->state}},
                                    {{$orders->country}}
                                </div>
                                <label for="">عنوان البريدي</label>
                                <div class="border">{{$orders->pincode}}</div>
                            </div>
                            <div class="col-md-6">
                                <h4>تفاصيل الطلب</h4>
                                <hr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            <th>الكمية</th>
                                            <th>السعر</th>
                                            <th>صورة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders->orderitems as $item)

                                            <tr>
                                                <td>{{$item->products->name}}</td>
                                                <td>{{$item->qty}}</td>
                                                <td>{{$item->price}}</td>
                                                <td style="width:80px;">
                                                    <img src="{{asset('uploading/'. $item->products->image )}}" height="50px" alt="صورة المنتج">
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <h4 class="px-2">السعر الإجمالي: <span class="float-start">${{$orders->total_price}}</span></h4>
                                <div class="mt-3">
                                    <label class="mb-2 mt-2 text-muted" for="">حالة الطلب</label>
                                    <form action="{{route('update.orders' , $orders->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select class="form-select" name="oreder_status">
                                            <option {{$orders->status == '0' ? 'selected': ''}} value="0">معلق</option>
                                            <option {{$orders->status == '1' ? 'selected': ''}} value="1">مكتمل</option>
                                        </select>
                                        <button type="submit" class="mt-2 mb-2 btn float-start btn-primary">تحديث</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
