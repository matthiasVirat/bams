<?php

namespace App\Http\Controllers;

use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ControllerOrder extends Controller
{
    function search(){
        return view('orders.search');
    }

    public function index (Request $request)
    {
        $sort = "id";
        $order = "desc";
        if (null !== $request->get('sort') && (null !== $request->get('order'))) {
            $sort = $request->get('sort');
            $order = $request->get('order');
        }
        Session::forget('lastRoute');
        Session::put('lastRoute', $request->path());
        if($request->path() == 'admin/commandes'){
            $orders = Order::orderby($sort, $order)->get();
            $from = 'admin';
        } else {
            $customer = Auth::user()->customers()->first();
            $orders = $customer->orders;
            $from = 'user';
        }

        $today = Carbon::now()->format('Y-m-d');
        Session::put($request->path());


        return view('orders.list', ['orders' => $orders, 'today' => $today, 'from' => $from]);


    }

    public function preDestroy($id)
    {

        $order = Order::find($id);
        return view('orders.predestroy', ['order' => $order]);
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->products()->detach();
        $order->delete();

        return redirect(route('orderList'));
    }

    function reorder (){
        return view('orders.reorder');
    }

    function cancel(){
        return view('orders.cancel');
    }

    function testUrl($orderId){
        return view('orders.index', ['fromUrl' => $orderId]);
    }

    public function show(Request $request, $id)
    {
        $lastRoute = $request->session()->get('lastRoute');
        $order = Order::where('id', $id)->first();
        $today = Carbon::now()->format('Y-m-d');
        if ($lastRoute == 'users/orders') {
            $customer = Auth::user()->customers()->first();
            if ($customer->id != $order->customer_id) {
                return abort(403, 'Unauthorized action.');
            }
        }
            return view('orders.detail', ['order' => $order, 'today' => $today]);

    }
}
