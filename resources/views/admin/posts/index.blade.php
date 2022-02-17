@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>Lista Post</h2></div>

                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{route("posts.create")}}"><button class="btn btn-success">Aggiungi Post</button></a>
                    </div>
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Titolo</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Stato</th>
                                <th scope="col">Categoria</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td><a href="{{route("posts.show", $post->id)}}">{{$post->title}}</a></td>
                                    <td>{{$post->slug}}</td>
                                    <td>
                                        @if ($post->published)
                                        <span class="badge rounded-pill bg-success">Pubblicato</span>
                                        @else
                                        <span class="badge rounded-pill bg-secondary">In lavorazione</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($post->cathegory)
                                        <span class="badge rounded-pill bg-primary">{{$post->cathegory->name}}</span>
                                        @else
                                        <span class="badge rounded-pill bg-light text-dark">Nessuna</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route("posts.edit", $post->id)}}"><button class="btn btn-warning">Modifica</button></a>
                                    </td>
                                    <td>
                                        <form action="{{route("posts.destroy", $post->id)}}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button class="btn btn-danger" type="submit">Elimina</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection