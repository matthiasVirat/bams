@extends('master')

@section('title')
    votre panier validé
@endsection

@section('content')

    <h1>Votre commande {{$orderId}} est bien enregistrée.<a href="/produit"> retour à la liste des produits</a></h1>

@endsection