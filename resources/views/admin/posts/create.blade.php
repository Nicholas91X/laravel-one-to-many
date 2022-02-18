@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card" style="width: 36rem;">
            <div class="card-body">
                <h2 class="card-header">Nuovo Post</h2>
                <p class="card-text">Crea un nuovo Post</p>
            </div>
            <div class="card-body">
                <form action="{{route("posts.store")}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Inserisci un titolo" value="{{old('title')}}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6" placeholder="Inserisci una descrizione">{{old('description')}}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <label for="image" class="form-label">Immagine</label>
                        <input class="form-control @error('image') is-invalid @enderror" id="image" name="image" rows="6" placeholder="Inserisci il percorso dell'immagine" value="{{old('image')}}">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="image">Carica un'immagine</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cathegory">Categoria</label>
                        <select name="cathegory_id" id="cathegory" class="custom-select @error('cathegory_id') is-invalid @enderror">
                            <option value="">Seleziona una Categoria</option>
                            @foreach ($cathegories as $cathegory)
                                <option value="{{$cathegory->id}}" {{old("cathegory_id") == $cathegory->id ? "selected" : ""}}>{{$cathegory->name}}</option>   
                            @endforeach
                        </select>
                        @error('cathegory_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 ml-4">
                        <input type="checkbox" class="form-check-input @error('published') is-invalid @enderror" id="published" name="published" {{old('published') ? "checked" : ""}}>
                        <label for="published" class="form-check-label">Pubblicato</label>
                        @error('published')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <a href="{{route("posts.store")}}"><button type="submit" class="btn btn-success">Crea</button></a>
                    </div>
                </form>
                <div class="mb-3">
                    <a href="{{route("posts.index")}}"><button class="btn btn-secondary">Annulla</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection