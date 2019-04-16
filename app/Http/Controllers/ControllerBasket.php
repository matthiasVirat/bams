<?php

namespace App\Http\Controllers;

use App\Product;
use App\Order;
use App\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;


class ControllerBasket extends Controller{

    public function __construct()
    {
        $this->middleware('auth')->only(['validation', 'panier']);
        $this->middleware('userBasket')->only('validation');
    }

    public function ajoutPanier(Request $request ,$id)
    {
    if ( ! $request->session()->has('panier')) {


        $basket = new Order;
        $basket->date_order = Carbon::now()->format('Y-m-d');
        $basket->status = 'P';
        $basket->delivery_cost = 0;
        $basket->save();

        $basket->products()->attach($id, ['quantity' => 1]);

        Session::put('panier', $basket->id);
    } else {
        $basket = Order::find($request->session()->get('panier'));
        $foundProduct = $basket->products->firstWhere('id', $id);

        if($foundProduct) {
            $qty = $foundProduct->pivot->quantity;
            $basket->products()->updateExistingPivot($foundProduct->id, ['quantity' => $qty + 1]);
        } else {
            $basket->products()->attach($id, ['quantity' => 1]);
        }
    }

    return redirect(route('listeProduit'));
    }

    public function suppLine(Request $request, $id)
    {
        $product = Product::find($id);
        $orderId = $request->session()->get('panier');
        $product->orders()->detach($orderId);
        return redirect(route('basket'));
    }

    public function supprimPanier(Request $request){

        $orderId = $request->session()->get('panier');
        $basket = Order::find($orderId);
        $basket->products()->detach();
        $basket->delete();
        $request->session()->forget('panier');

        return view ('basket.delete', ['panierSupp' => $orderId]);
    }

    public function updateQty($orderId, Request $request)
    {
        $basket = Order::find($orderId);
//        dd($basket);
        $products=$basket->products;
        $noMaj = [];
        foreach ($products as $keyPrd => $product) {
            if ($product->stock < $request->get('quantity')[$product->id]) {
                array_push($noMaj, $product->id);
            } else {
                $basket->products()->updateExistingPivot($product->id, ['quantity' => $request->get('quantity')[$product->id]]);
            }
        }
        Session::put([ 'noMaj' => $noMaj]);

        return redirect(route('basket'));
    }

    public function panier(Request $request){

        $basketId = $request->session()->get('panier');
        $basket = Order::find($basketId);

        $noMajs = $request->session()->get('noMaj');
        $request->session()->forget('noMaj');
        Session::put('lastRoute', $request->path());


        return view ('basket.index', ['panier' => $basket], ['noMajs' => $noMajs]);
    }

    public function validation(Request $request)
    {
        //Validation du panier en commande
        $basket = Order::find($request->get('validate'));
        $basket->status = 'V';
        $basket->adr_delivery = $request->session()->get('adressId');
        $basket->adr_invoice = $request->session()->get('adressId');
        $basket->customer_id = $request->session()->get('customerId');
        $basket->save();

        //nettoyage de session
        $request->session()->forget('panier');
        $request->session()->forget('adressId');
        $request->session()->forget('customerId');
        if ($request->session()->has('lastRoute')){
            $request->session()->forget('lastRoute');
        }


        //mise à jour du stock
        $products = $basket->products;
        foreach ($products as $product){
            $product->stock = $product->stock - $product->pivot->quantity;
            $product->save();
        }

        return view('basket.validate', ['orderId' => $basket->id]);
      }

    public function log(){
        return view('auth.logRegister');
     }
}