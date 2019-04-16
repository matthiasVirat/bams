@extends('masterAdmin')

@section('title')
    Suppression d'une commande
@endsection

@section('content')

    <h2>Vous êtes sur le point de supprimer la commande {{$order->id}}</h2>

    <div class="article">
        @foreach($order->products as $product)
            ref produit : {{$product->id}}<br/>
            {{$product->name}}. disponibilité :  {{$product->stock}}<br/>
            quantité : {{$product->pivot->quantity}}
            Prix unitaire : {{number_format((($product->price)/100), 2, ',', ' '). '€' }}<br/>
            Total ligne : {{number_format((($product->pivot->quantity)*(($product->price)/100)), 2, ',', ' '). '€' }}<br/>
            ***<br/>
        @endforeach
            <a href="{{route('destroyOrder',$order->id)}}"> Supprimer </a>
    </div>


@endsection