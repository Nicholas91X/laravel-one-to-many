@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card" style="width: 36rem;">
            <div class="card-body">
                <h2 class="card-header">Modifica Categoria</h2>
                <p class="card-text">Modifica Categoria: {{$cathegory->name}}</p>
            </div>
            <div class="card-body">
                <form action="{{route("cathegories.update", $cathegory->id)}}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci un nome" value="{{old('name') ? old('name') : $cathegory->name}}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-warning">Modifica</button>
                    </div>
                </form>
                <div class="mb-3">
                    <a href="{{route("cathegories.index")}}"><button class="btn btn-secondary">Annulla</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection