<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class PDFController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function generatePDF($id)
    {
        $mpdf = new Mpdf();
        $orders = Order::with('orderitems')->where('id', $id)->first(); // Use first() instead of get()
        $viewData = [
            'orders' => $orders,
        ];

        $html = view('admin.orders.beta', $viewData)->render();
        $fileName = time() . '.' . 'pdf';
        $mpdf->WriteHTML($html);
        $mpdf->Output($fileName, 'D'); // 'D' indicates that it should be downloaded
        exit;


        // dd($orders);
        // $pdf = Mpdf::loadView('admin.orders.pdd', compact('orders'));
        // $doc = 'Bill';
        // return $pdf->stream($doc . '.pdf');
    }
}
