<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\PrettyJsonResponse;
use Illuminate\Http\JsonResponse;

class CoinMapController extends Controller
{
    public function getCoinATM(): JsonResponse 
    {
        
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://coinmap.org/api/v1/venues",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return new PrettyJsonResponse($response);
        }

    }

    public function paymentPage() {
        return view('payment.payment');
    }

    public function payment() {
        $data = [
            'currency' => 'INR',
            'amount' => 5000,
            'method' => 'Credit Card',
            'receipt' => 'Billing',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/orders');
        curl_setopt($ch, CURLOPT_USERPWD, config('payment.razor_pay_id').':'.config('payment.razor_pay_secret'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_POST, false);

        $result = curl_exec($ch);
        
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        } else {
            return $result;
        }

        curl_close($ch);
    }
}
