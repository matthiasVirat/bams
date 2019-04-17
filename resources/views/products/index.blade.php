
    @extends($content)


@section('title')
Catalogue
@endsection

@section('content')


    <h1>Catalogue</h1>



    {{--<p>Classement par : </p>--}}
    <div class="article">
        <p>Classement par : </p>
        @if ($content == 'master')
            <a href="/produit?sort=price&order=asc"><button type="button" class="btn btn-primary">Prix croissant</button> </a>
            <a href="/produit?sort=price&order=desc"><button type="button" class="btn btn-primary">Prix décroissant</button> </a>
            <a href="/produit?sort=name&order=asc"><button type="button" class="btn btn-primary">Nom</button> </a>
        @elseif($content == 'masterAdmin')
            <a href="/admin/produit?sort=price&order=asc"><button type="button" class="btn btn-primary">Prix croissant</button> </a>
            <a href="/admin/produit?sort=price&order=desc"><button type="button" class="btn btn-primary">Prix décroissant</button> </a>
            <a href="/admin/produit?sort=name&order=asc"><button type="button" class="btn btn-primary">Nom</button> </a>
            <a href="#"><button type="button" id="addProduct" class="btn btn-primary">Créer nouveau</button></a>
        @endif
{{--        {{route('createPrd')}}--}}
    </div>

    <div class="addProduct-form">
        <form method ="post" action="{{route('addProd')}}">
            @csrf
            <div class="form-group">
                <label>nom du produit</label>
                <input type="text" class="form-control" name="name" placeholder="nom">
            </div>

            <div class="form-group">
                <label>prix du produit</label>
                <input type="number" class="form-control" name="price" placeholder="prix">
            </div>

            <div class="form-group">
                <label>image produit</label>
                <input type="text" class="form-control" name="imgUrl" placeholder="image">
            </div>

            <div class="form-group">
                <label>description</label>
                <input type="text" class="form-control" name="description" placeholder="description">
            </div>

            <div class="form-group">
                <label>poid</label>
                <input type="number" class="form-control" name="weight" placeholder="poid">
            </div>

            <div class="form-group">
                <label>stock</label>
                <input type="number" class="form-control" name="stock" placeholder="stock">
            </div>

            <div class="form-group">
                <label>categorie</label>
                <input type="text" class="form-control" name="prd_category_id" placeholder="ID_category">
            </div>

            <input type="submit" value="Envoyer" />
            <button class="cancel-btn">Annuler</button>
        </form>
    </div>

    @foreach($produits as $produit)
            <div class="article">
                {{$produit->name}}<br>
                {{number_format((($produit -> price)/100), 2, ',', ' '). '€'}}
                <img src="{{asset('image/'.$produit -> imgUrl)}}" alt="{{asset('image/'.$produit -> imgUrl)}}" class="photo">
                {{$produit->description}}<br>
                Nombre de commande : {{$produit->orders->count()}}
                @if ($content == 'master')
                    <a href="{{route('fiche',$produit->id)}}" class="article btn btn-link"> Fiche produit </a>
                    <a href="{{route('addPrd',$produit->id)}}" class="article btn btn-link"> Ajouter </a>
                @else
                    <a href="{{route('adminFichePrd',$produit->id)}}" class="article btn btn-link"> Fiche produit </a>
                    <a href="{{route('preDestroy',$produit->id)}}" class="article btn btn-link"> Supprimer </a>
                    <a href="{{route('edit',$produit->id)}}" class="article btn btn-link"> Modifier produit </a>
                @endif

               {{--<a href="{{route('mise a jour',$produit->id)}}" class="border border-dark test"> Details </a>--}}
            </div>



        <br>
    @endforeach



@endsection

@section('script')
    <script src="{{asset('js/products.js')}}"></script>
@endsection