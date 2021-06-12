@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-md-7">Liste des clients</h1>
        <form class="d-flex col-md-4" action="{{url('clients')}}" type="get">
            <input class="form-control" type="search" placeholder="rechercher par nom" name="query" value="{{old('query')}}">
            <button class="btn btn-outline-success" type="submit" name="sub" style="height:38px;">Rechercher</button>
        </form> 
        <a href="{{url('clients/create')}}" class="btn btn-success float-right" style="float:right; margin-bottom:20px;"><img src="{{asset('icons/add.png')}}" style="width:20px;height:20px;"></a>
    </div>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Téléphone</th>
            <th scope="col">Adresse</th>
            <th scope="col">Type</th>
            <th scope="col">Date de création</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
                @foreach($clients as $client)  
                    <tr>
                    <td>{{$client->nom}} </td>
                    <td>{{$client->email}}</td>
                    <td>{{$client->tel}}</td>
                    <td>{{$client->adresse}}</td>
                    @foreach($types as $type)
                        @if($type->id == $client->client_type_id)
                            <td>{{$type->niveau_client}}</td>
                        @endif
                    @endforeach
                    <td>{{$client->created_at}}</td>
                    <td>
                        <form action="{{'clients/'.$client->id}}" method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}} 
                            <a href="{{url('clients/'.$client->id.'/edit')}}" class="btn btn-warning"><img src="{{asset('icons/edit.png')}}" style="width:20px;height:20px;"></a>
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