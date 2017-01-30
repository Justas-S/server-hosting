<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ServiceOrder;
use App\Service;
use Log;
use App\PaySera\PaySeraAPI;
use Auth;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::byGame()->get();
        return view('service.list', compact('services'));
    }

    public function order(Service $service)
    {
        return view('service.order', compact('service'));
    }   

    public function orderPost(Service $service, ServiceOrder $request)
    {
        $user = Auth::user();
        $order = $user->orders()->create([
            'service_id'    => $service->id,
            'duration'      => $request->input('duration') * 30,
            'is_completed'  => 0,
        ]);
        PaySeraAPI::redirectToPayment(['amount' => $service->price * 100, 'orderid' => $order->id]);
    }   
}
