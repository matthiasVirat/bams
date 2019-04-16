@extends('masterAdmin')

@section('title')
    <h1>Gestion Categories</h1>
@endsection

@section('content')

    <h1>Gestion Categories</h1>

    <div class="form-group">

    <h2>ajout d'une categorie</h2>

        <form method="post" action="{{route('cat')}}">
            {{csrf_field()}}
            <input type="text" class="form-control" name="name" placeholder="name">
            <input type="submit" value="Envoyer" />
        </form>

    </div>


    <div>

        <h2>suppression d'une categorie</h2>
        <form method="post" action="{{route('supcat')}}">
            {{csrf_field()}}
            <label for="categorie">choisissez le nom de la categorie a supprimer :</label>
            <select name="categorie" id="categorie">
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id}}">{{$categorie->name}}</option>
                @endforeach
            </select>
            <input type="submit" value="Envoyer" />
        </form>

    </div>

    <div>

        <h2>Maj d'une categorie</h2>
        <form method="post" action="{{route('modifcat')}}">
            {{csrf_field()}}
            <label for="categorie">choisissez le nom de la categorie a modifier :</label>
            <select name="categorie" id="categorie">
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id}}">{{$categorie->name}}</option>
                @endforeach
            </select>
            <label>choisissez un nouveau nom pour la catégorie : </label> : <input type="text" class="form-control" name="name" placeholder="name" >
            <input type="submit" value="Envoyer" />
        </form>

    </div>
@endsection

