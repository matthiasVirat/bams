
@extends('master')

@section('title')
    Liste des commandes
@endsection

@section('content')

    @dump($order)
    <h1>Liste des commandes d'un user</h1>

    {{$order->num_line}}<br>
    {{$order->date_order}}<br>
    {{$order->status}}<br>
    {{$order->delivery_cost}}<br>
    {{$order->adr_delivery}}<br>
    {{$order->adr_invoice}}<br>
    {{$order->customer_id}}



@endsection