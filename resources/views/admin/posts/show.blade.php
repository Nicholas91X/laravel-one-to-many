@extends('layouts.app')


@section('content')

<div class="container d-flex justify-content-center">
    <div class="card" style="width: 24rem;">
        <img src="{{$post->image}}" class="card-img-top" alt="{{$post->title}}">
        <div class="card-body">
            <h5 class="card-title">{{$post->title}}</h5>
            <p class="card-text">{{$post->description}}</p>
        </div>
        <ul class="list-group list-group-flush">
            @if ($post->cathegory)
                <li class="list-group-item"><strong>Categoria: </strong><span class="badge bg-primary">{{$post->cathegory->slug}}</span></li>
            @endif
            <li class="list-group-item"><strong>Slug: </strong>{{$post->slug}}</li>
            <li class="list-group-item">
                <strong>Stato: </strong>
                @if ($post->published)
                    <span class="badge rounded-pill bg-success">Pubblicato</span>
                @else
                    <span class="badge rounded-pill bg-secondary">In lavorazione</span>
                @endif
            </li>
        </ul>
        <div class="card-body d-flex justify-content-start">
            <div class="mr-3">
                <a href="{{route("posts.edit", $post->id)}}" class="card-link"><button class="btn btn-warning">Modifica</button></a>
            </div>
            <div>
                <form action="{{route("posts.destroy", $post->id)}}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button class="btn btn-danger" type="submit">Elimina</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection