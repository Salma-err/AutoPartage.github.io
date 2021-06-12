@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="margin-top:100px;">
            <h1 style="text-align:center;">Soyez la bienvenue dans votre système de gestion d'auto-partage !</h1><br><br><br>
            <a class="btn btn-success float-left" href="{{url('vehicules/create')}}">Pour remplir le formulaire d'installation</a>
            <a class="btn btn-success float-right" href="{{url('interventions/create')}}">Pour remplir le formulaire d'intervention</a>
        </div>
    </div>
</div>
@endsection
