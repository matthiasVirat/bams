@extends('master')

@section('title')
    Mon compte
@endsection

@section('content')

    <div class="acceuil">
        <h2>Bienvenue {{$user->name}}</h2>
    </div><br/>

    <div class="users">
        <a href="{{route('userUpdate', $user->id)}}"><button class="bouton">Mes informations</button></a>
    </div><br>

    <div class="users">
        <a href="{{route('userOrders')}}"> <button class="bouton">Mes commandes</button></a>
    </div><br>




@endsection