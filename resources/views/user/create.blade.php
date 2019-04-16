@extends('master')

@section('title')
    Formulaire création d'utilisateur
@endsection

@section('content')
    {{--@dd()--}}
    <h1>Formulaire création d'utilisateur</h1>
    <form method="post" action={{route('userStore', Auth::id())}}>
        @csrf
        <h2>Client :</h2>
        <label for="last_name">votre nom : </label><input type="text" id="last_name" name="last_name"/><br/>
        <label for="first_name">votre prenom : </label><input type="text" id="first_name" name="first_name"/><br/>
        <h2>Adresse</h2>
        <label for="num_street">numéro : </label><input type="text" id="num_street" name="num_street"/><br/>
        <label for="street">rue : </label><input type="text" id="street" name="street"/><br/>
        <label for="comp">complement : </label><input type="text" id="comp" name="comp"/><br/>
        <label for="zip_code">code postal : </label><input type="text" id="zip_code" name="zip_code"/><br/>
        <label for="city">ville : </label><input type="text" id="city" name="city"/><br/>
        <label for="country">Pays : </label><input type="text" id="country" name="country"/>

        <button type="submit" name="user_id" value="{{Auth::id()}}">CREER</button>

    </form>


@endsection