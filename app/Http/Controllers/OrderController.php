<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaySera\PaySeraAPI;
use App\Order;
use App\Jobs\CreateUsers;
use App\Game;
use App\GameServer;
use Log;
use App\Http\Requests\OrderStore;
use Auth;


class OrderController extends Controller
{
    public function create(Game $game, Request $request)
    {   
        $gameservers = GameServer::where('game_id', $game->id)->get();
        $ip = $request->get('ip');
        return view('order.create', compact(['game', 'gameservers', 'ip']));
    }

    public function store(OrderStore $request)
    {
        $gameserver = GameServer::where('ip', $request->input('ip'))->firstOrFail();
        $duration = $request->input('duration');
        $user = Auth::user();
        $price = $gameserver->getPrice($duration);

        $order = $user->orders()->create([
            'game_server_id'    => $gameserver->id,
            'duration'          => $duration,
            'price'             => $price,
        ]); 

        return PaySeraAPI::redirectToPayment(['amount' => $price, 'orderid' => $order->id]);
    }

    public function callback(Request $request) 
    {
        Log::info($request);
        $data = PaySeraAPI::parseResponse($request);
        $order = Order::first($data['orderid']);
        
        if($data['status'] == 1 && $order->is_completed === '0' && $data['amount'] === $order->gameserver->getPrice($order->duration))
        {
            if($data['test'] !== '1') 
                $order->is_completed = 1;
            $order->country = $data['payer_country'];
            $order->email = $data['p_email'];
            $oder->save();

            $this->dispatch(new CreateUsers($order->service->server, $username));
        }
        return "OK";
    }

    public function accept(Request $request)
    {
        $data = PaySeraAPI::parseResponse($request);
        $order = Order::findOrFail($data['orderid']);
        return view('order.accepted', compact('order'));
    }

    public function cancel() 
    {
        return view('order.cancelled', compact('order'));
    }
}
