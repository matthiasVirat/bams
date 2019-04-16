@extends('master')

@section('title')
    commande
@endsection

@section('content')

    <h1>LES COMMANDES</h1>

    @foreach($order_heads as $commande)

        {{$commande}}<br>
        {{--{{number_format((($produit -> price)/100), 2, ',', ' '). '€'}}--}}
        {{--<img src="{{asset('image/'.$produit -> imgUrl)}}" alt="{{asset('image/'.$produit -> imgUrl)}}" class="photo">--}}
        {{--{{$produit->description}}<br>--}}
    @endforeach


@endsection