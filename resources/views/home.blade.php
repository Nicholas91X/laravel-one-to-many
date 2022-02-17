@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Home</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Benvenuto <strong>{{Auth::user()->name}}</strong>! Hai eseguito il login 😉

                    <hr>

                    Vai alla sezione <a href="{{route("posts.index")}}">Post</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
