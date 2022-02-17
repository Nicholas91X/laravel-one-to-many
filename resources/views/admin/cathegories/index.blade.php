@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Lista Categorie</h2></div>

                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{route("cathegories.create")}}"><button class="btn btn-success">Aggiungi Categoria</button></a>
                    </div>
                    <table class="table table-dark table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Slug</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cathegories as $cathegory)
                                <tr>
                                    <td>{{$cathegory->id}}</td>
                                    <td>{{$cathegory->name}}</td>
                                    <td>{{$cathegory->slug}}</td>
                                    <td>
                                        <a href="{{route("cathegories.edit", $cathegory->id)}}"><button class="btn btn-warning">Modifica</button></a>
                                    </td>
                                    <td>
                                        <form action="{{route("cathegories.destroy", $cathegory->id)}}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button class="btn btn-danger" type="submit">Elimina</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mb-3">
                        <a href="{{route("posts.index")}}"><button class="btn btn-primary">Torna ai Post</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection