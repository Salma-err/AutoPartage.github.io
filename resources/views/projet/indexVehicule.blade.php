@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-md-4">Liste des véhicules</h1>
        <form class="d-flex col-md-4" action="{{url('vehicules')}}" type="get">
            <input class="form-control" type="search" placeholder="rechercher par MCU" name="querm" value="{{old('querm')}}">
            <button class="btn btn-outline-success" type="submit" name="sub" style="height:38px;">Rechercher</button>
        </form> 
        <form class="d-flex col-md-4" action="{{url('vehicules')}}" type="get">
            <input class="form-control" type="search" placeholder="rechercher par matricule" name="quert" value="{{old('quert')}}">
            <button class="btn btn-outline-success" type="submit" name="sub" style="height:38px;">Rechercher</button>
        </form>       
    </div>
    <a href="{{url('vehicules/create')}}" class="btn btn-success"  style="float:right; margin-bottom:20px;"><img src="{{asset('icons/add.png')}}" style="width:20px;height:20px;"></a>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">MCU</th>
            <th scope="col">Matricule</th>
            <th scope="col">Marque et Modèle</th>
            <th scope="col">Type</th>
            <th scope="col">Couleur</th>
            <th scope="col">statut</th>
            <th scope="col">Numéro du cello</th>
            <th scope="col">Nom du client</th>
            <th scope="col">Déclarée par</th>
            <th scope="col">Installateur</th>
            <th scope="col">Date d'installation</th>
            <th scope="col">actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($vehs as $veh)
            <tr>
            <td>{{$veh->mcu}}</td>
            <td>{{$veh->matricule}}</td>
            <td>{{$veh->marque}}  {{$veh->modele}}</td>
            <td>{{$veh->type}} </td>
            <td>{{$veh->couleur}}</td>
            <td>{{$veh->statut}}</td>
            @foreach($cellos as $cello)
               @if($cello->id == $veh->cello_id)
               <td>{{$cello->num}}</td>
               @endif
            @endforeach
            @foreach($clients as $client)
               @if($client->id == $veh->client_id)
            <td>{{$client->nom}}</td> 
               @endif
            @endforeach
            @foreach($users as $user)
               @if($user->id == $veh->user_id)
            <td> {{$user->name}}</td>
               @endif
            @endforeach
            <td>{{$veh->installateur}}</td>
            <td>{{$veh->date_instl}}</td>
            <td>
                <form action="{{'vehicules/'.$veh->id}}" method="post">
                      {{csrf_field()}}
                      {{method_field('DELETE')}} 
                      <a href="{{url('vehicules/'.$veh->id.'/edit')}}" class="btn btn-warning"><img src="{{asset('icons/edit.png')}}" style="width:20px;height:20px;"></a>
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="submit" class="btn btn-danger"><img src="{{asset('icons/delete.png')}}" style="width:20px;height:20px;"></button>
                </form>
            </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection