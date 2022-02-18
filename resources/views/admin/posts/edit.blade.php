@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card" style="width: 36rem;">
            <div class="card-body">
                <h2 class="card-header">Modifica Post</h2>
                <p class="card-text">Modifica Post: {{$post->title}}</p>
            </div>
            <div class="card-body">
                <form action="{{route("posts.update", $post->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="mb-3">
                        <label for="title" class="form-label">Titolo</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Inserisci un titolo" value="{{old('title') ? old('title') : $post->title}}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6" placeholder="Inserisci una descrizione">{{old('description') ? old('description') : $post->description}}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <label for="image" class="form-label">Immagine</label>
                        <input class="form-control @error('image') is-invalid @enderror" id="image" name="image" rows="6" placeholder="Inserisci il percorso dell'immagine" value="{{old('image') ? old('image') : $post->image}}">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="input-group mb-3">
                        @if ($post->image)
                            <img id="uploadPreview" width="100" src="{{asset("storage/{$post->image}")}}" class="card-img-top" alt="{{$post->title}}">
                        @endif
                        <label class="input-group-text" for="image">Modifica l'immagine</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="PreviewImage()">

                        <script type="text/javascript">

                            function PreviewImage() {
                                var oFReader = new fileReader();
                                oFReader.readAsDataUrl(document.getElementById("image").files[0]);

                                oFReader.onload = function (oFREvent) {
                                    document.getElementById("uploadPreview").src = oFREvent.target.result;
                                };
                            };
                        </script>
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cathegory">Categoria</label>
                        <select name="cathegory_id" id="cathegory" class="custom-select @error('cathegory_id') is-invalid @enderror">
                            <option value="">Seleziona una Categoria</option>
                            @foreach ($cathegories as $cathegory)
                                <option value="{{$cathegory->id}}" {{old("cathegory_id", $post->cathegory_id) == $cathegory->id ? "selected" : ""}}>{{$cathegory->name}}</option>   
                            @endforeach
                        </select>
                        @error('cathegory_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 ml-4">
                        @php
                            $published = old('published') ? old('published') : $post->published;    
                        @endphp
                        <input type="checkbox" class="form-check-input @error('published') is-invalid @enderror" id="published" name="published" {{$published ? "checked" : ""}}>
                        <label for="published" class="form-check-label">Pubblicato</label>
                        @error('published')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-warning">Modifica</button>
                    </div>
                </form>
                <div class="mb-3">
                    <a href="{{route("posts.index")}}"><button class="btn btn-secondary">Annulla</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection