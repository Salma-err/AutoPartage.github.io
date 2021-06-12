@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-md-4">Liste des cellos</h1>
        <form class="d-flex col-md-4" action="{{url('cellos')}}" type="get">
            <input class="form-control" type="search" placeholder="rechercher par numero" name="query" value="{{old('query')}}">
            <button class="btn btn-outline-success" type="submit" name="sub" style="height:38px;">Rechercher</button>
        </form> 
        <form class="d-flex col-md-4" action="{{url('cellos')}}" type="get">
            <input class="form-control" type="search" placeholder="rechercher par état" name="quer" value="{{old('quer')}}">
            <button class="btn btn-outline-success" type="submit" name="sub" style="height:38px;">Rechercher</button>
        </form>
     </div>
     <a href="{{url('cellos/create')}}" class="btn btn-success"  style="float:right; margin-bottom:20px;"><img src="{{asset('icons/add.png')}}" style="width:20px;height:20px;"></a> 
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Numéro du Cello</th>
            <th scope="col">Version</th>
            <th scope="col">Type</th>
            <th scope="col">Etat</th>
            <th scope="col">Numéro de la carte SIM</th>
            <th scope="col">Date de création</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cellos as $cello)
            <tr>
            <td>{{$cello->num}} </td>
            <td>{{$cello->version}}</td>
            @foreach($types as $type)
                 @if($type->id == $cello->cello_type_id)
                     <td>{{$type->type_cello}}</td>
                 @endif
            @endforeach
            <td>{{$cello->etat}}</td>
            @foreach($cartes as $carte)
                 @if($carte->id == $cello->carte_id)
                     <td>{{$carte->numero}}</td>
                 @endif
            @endforeach
            <td>{{$cello->created_at}}</td>
            <td>
                <form action="{{'cellos/'.$cello->id}}" method="post">
                      {{csrf_field()}}
                      {{method_field('DELETE')}} 
                      <a href="{{url('cellos/'.$cello->id.'/edit')}}" class="btn btn-warning"><img src="{{asset('icons/edit.png')}}" style="width:20px;height:20px;"></a>
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