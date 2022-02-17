@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card" style="width: 36rem;">
            <div class="card-body">
                <h2 class="card-header">Nuova Categoria</h2>
                <p class="card-text">Crea una nuova Categoria</p>
            </div>
            <div class="card-body">
                <form action="{{route("cathegories.store")}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Nome</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci un nome per la categoria" value="{{old('name')}}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <a href="{{route("cathegories.store")}}"><button type="submit" class="btn btn-success">Crea</button></a>
                    </div>
                </form>
                <div class="mb-3">
                    <a href="{{route("cathegories.index")}}"><button class="btn btn-secondary">Annulla</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection