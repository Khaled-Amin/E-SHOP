<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>فاتورة مشتريات</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

        .ind {
            width: 100%;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="invoice-box rtl">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="7">
                    <table>
                        <tr>

                            <td>
                                رقم الفاتورة #:33<br />
                                تاريخ طباعة الفاتورة:{{ $IdInvoices->invoice_date }}<br />
                                تاريخ: {{ Carbon\Carbon::now()->format('Y-m-d') }}<br />
                            </td>

                            <td class="title">
                                <img src="https://sparksuite.github.io/simple-html-invoice-template/images/logo.png"
                                    style="width: 100%; max-width: 300px" />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <hr>
            <br />
            <br />

            <tr class="information">
                <td colspan="7">
                    <table>
                        <tr>
                            <td>
                                اسم العميل:khaled<br />
                                رقم هاتف:11111111<br />
                                بريد الالكتروني:example@gmail.com
                            </td>



                        </tr>
                    </table>
                </td>
            </tr>
            <hr>
            <table style="width: 100%;">
                <tbody>
                    <tr>
                        <td>اسم الصنف</td>
                        <td>
                            ddddd
                        </td>
                    </tr>

                    <tr>
                        <td>ماركة</td>
                        <td>
                            ddddda
                        </td>
                    </tr>

                    <tr>
                        <td>الكمية</td>
                        <td>
                            3
                        </td>
                    </tr>

                    <tr>
                        <td>السعر</td>
                        <td>
                            500
                        </td>
                    </tr>

                    <tr>
                        <td>اجمالي</td>
                        <td>
                            1000
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- DivTable.com -->


            {{-- @isset($invoices)
                    @foreach ($invoices as $item)
                        <td>{{$item->product->name}}</td>
                    @endforeach

                @endisset --}}
            {{-- @isset($invoices)
                    @foreach ($invoices as $item)

                        <tr class="item">
                            <td colspan="3">{{$item->product->name}}</td>
                            <td>{{$item->brand}}</td>
                            <td>{{$item->qty}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->total_price}} {{__('EGP')}}</td>
                            <td>{{$item->total}} {{__('EGP')}}</td>
                        </tr>

                    @endforeach
                @endisset --}}

            <br>
            <br>
            {{-- <tr class="total">
                    <td colspan="4">المجموع الكلي</td>
                    <td></td>
                    <td></td>
					<td>
                        {{$IdInvoices->total}}{{',EGP'}}
                    </td>
				</tr> --}}
        </table>
    </div>
</body>

</html>
