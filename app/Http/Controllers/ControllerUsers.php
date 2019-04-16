<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Customer;
use App\Adress;
use Illuminate\Support\Facades\Session;

class ControllerUsers extends Controller

{
    public function create(Request $request){

        return view('user.create');
    }

    public function store (Request $request)
    {
        $customer = new Customer;
        $customer->last_name = $request->last_name;
        $customer->first_name = $request->first_name;
        $customer->user_id = $request->user_id;
        $customer->save();

        $adress = new Adress;
        $adress->last_name = $request->last_name;
        $adress->first_name = $request->first_name;
        $adress->num_street = $request->num_street;
        $adress->street = $request->street;
        $adress->comp = $request->comp;
        $adress->zip_code = $request->zip_code;
        $adress->city= $request->city;
        $adress->country= $request->country;
        $adress->customer_id= $customer->id;
        $adress->save();

        if ($request->session()->get('lastRoute') == 'basket'){
            Session::put('customerId', $customer->id);
            Session::put('adressId', $adress->id);
            return redirect(route('basket'));

        } else if ($request->session()->get('lastRoute') == 'users/index') {

            return redirect(route('userUpdate', Auth::id()));

        } else {
            return view('user.confirmSave', ['customerName' => $customer->last_name], ['lastRoute' => $request->session()->get('lastRoute')]);
        }
    }

    public function login (){
        return view('user.login');
    }

    public function myAccount()
    {
        return redirect(route('userAccount'));
    }

    public function index(Request $request)
    {
        Session::put('lastRoute', $request->path());
        return view('user.index', ['user' => Auth::user()]);
    }
    public function update($id)
    {
        $user = Auth::user($id);
        $customer = Auth::user()->customers()->first();
        $adress = $customer->adress()->first();
        $userComplet=array($user, $customer, $adress);

        return view('user.update', ['userComplet' => $userComplet]);
    }

    public function updating($id)
    {
        return redirect(route('userUpdate', ['id' => $id]));
    }

    public function orders($id)
    {

        return view('user.orders');
    }

}


