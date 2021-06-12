@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-md-7">Liste des interventions</h1>
        <form class="d-flex col-md-4" action="{{url('interventions')}}" type="get">
            <input class="form-control" type="search" placeholder="rechercher par le réparateur" name="queri" value="{{old('queri')}}">
            <button class="btn btn-outline-success" type="submit" name="sub" style="height:38px;">Rechercher</button>
        </form> 
        <a href="{{url('interventions/create')}}" class="btn btn-success"  style="float:right; margin-bottom:20px;"><img src="{{asset('icons/add.png')}}" style="width:20px;height:20px;"></a>
    </div>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">MCU du véhicule</th>
            <th scope="col">Panne</th>
            <th scope="col">Etat d'intervention</th>
            <th scope="col">Réparateur</th>
            <th scope="col">Memo du réparateur</th>
            <th scope="col">Déclarée par</th>
            <th scope="col">Date de déclaration</th>
            <th scope="col">Date d'intervention</th>
            <th scope="col">Date de fin d'intervention</th>
            <th scope="col">actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($intervs as $intrv)
            <tr>
            @foreach($vehs as $veh)
               @if($veh->id == $intrv->vehicule_id)
               <td>{{$veh->mcu}} </td>
               @endif
            @endforeach
            <td>{{$intrv->panne}}</td>
            <td>{{$intrv->etat}} </td>
            <td>{{$intrv->reparateur}}</td>
            <td>{{$intrv->memo_repr}}</td>
            @foreach($users as $user)
               @if($user->id == $intrv->user_id)
               <td>{{$user->name}} </td>
               @endif
            @endforeach
            <td>{{$intrv->dtDeclr}}</td>
            <td>{{$intrv->dtInterv}}</td>
            <td>{{$intrv->dtFinInterv}}</td>
            <td>
                <form action="{{'interventions/'.$intrv->id}}" method="post">
                      {{csrf_field()}}
                      {{method_field('DELETE')}} 
                      <a href="{{url('interventions/'.$intrv->id.'/edit')}}" class="btn btn-warning"><img src="{{asset('icons/edit.png')}}" style="width:20px;height:20px;"></a>
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