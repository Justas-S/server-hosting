<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use Log;
use App\PaySera\PaySeraAPI;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::byGame()->get();
        return view('service.list', compact('services'));
    }

    public function buy(Service $service)
    {
        PaySeraAPI::redirectToPayment(['amount' => $service->price * 100]);
    }   

    public function callback(Request $request) 
    {
        Log::info($request);
        return "OK";
    }

    public function accept(Request $request)
    {
        dd($request, PaySeraAPI::parseResponse($request));
    }

    public function cancel(Request $request) 
    {
        dd($request);
    }
}
