<?php 

namespace App\PaySera;

use Illuminate\Http\Request;

require(app_path('PaySera/WebToPay.php'));

class PaySeraAPI 
{

    public static function redirectToPayment($data)
    {
        $wat = \WebToPay::buildRequest(array_merge($data, [
            'projectid'     => env('PAYSERA_PROJECTID', '0'),
                'orderid'       => 3,
                'accepturl'     => route('service.accept'),
                'cancelurl'     => route('service.cancel'),
                'callbackurl'   => route('service.callback'),
                'sign_password' => env('PAYSERA_PASSWORD', '0'),
                'currency'      => 'EUR',
                'test'          => env('PAYSERA_TEST', '1'),
        ]));
        dd($wat);
    }

    public static function parseResponse(Request $request)
    {
        return \WebToPay::checkResponse($request->all(), [
            'projectid' => env('PAYSERA_PROJECTID', '0'),
            'sign_password' => env('PAYSERA_PASSWORD', '0'),
        ]);
    }
}