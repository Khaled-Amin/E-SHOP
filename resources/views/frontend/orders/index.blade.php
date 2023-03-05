@extends('layouts.front')

@section('title')
    طلباتي
@endsection

@section('content')

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>طلباتي</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>رقم التتبع</th>
                                    <th>السعر الكلي</th>
                                    <th>الحالة</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $item)
                                    <tr>
                                        <td>{{$item->tracking_no}}</td>
                                        <td>{{$item->total_price}}</td>
                                        <td>{{$item->status == '0' ? 'معلق' : 'مكتمل'}}</td>
                                        <td>
                                            <a href="{{url('view-order/' . $item->id)}}" class="btn btn-primary">عرض</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" style="text-align:center;">لايوجد طلبات لعرضها</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
