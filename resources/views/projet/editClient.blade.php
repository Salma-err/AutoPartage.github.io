@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        <h2>Mettre à jour les données du client <small><i>{{$client->nom}}</i></small></h2>
            <div class="col-md-12">
            <form action="{{url('clients/'.$client->id)}}" method="post">
                 {{  csrf_field() }}
                 <input type="hidden" name="_method" value="PUT">
                  <div class="form-group">
                      <label for="">Nom</label>
                      <input type="text" name="nom" class="form-control @if($errors->get('nom')) is-invalid @endif" value="{{$client->nom}}">
                      @if($errors->get('nom'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('nom') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                      @endif                   
                  </div>
                  <div class="form-group">
                      <label for="">Email</label>
                      <input type="text" name="email" class="form-control @if($errors->get('email')) is-invalid @endif" value="{{$client->email}}">
                      @if($errors->get('email'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('email') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                      @endif
                  </div>
                  <div class="form-group">
                      <label for="">Téléphone</label>
                      <input type="text" name="tel" class="form-control @if($errors->get('tel')) is-invalid @endif" value="{{$client->tel}}">
                      @if($errors->get('tel'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('tel') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                      @endif
                  </div>
                  <div class="form-group">
                      <label for="">Adresse</label>
                      <input type="text" name="adr" class="form-control @if($errors->get('adr')) is-invalid @endif" value="{{$client->adresse}}">
                      @if($errors->get('adr'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('adr') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                      @endif
                  </div>
                  <div class="form-group">
                      <label for="">Type du client</label>
                      <div class="input-group">
                          @foreach($types as $type)
                            @if($type->id == $client->client_type_id)
                          <input type="text" id="tp" name="typeC" class="form-control @if($errors->get('typeC')) is-invalid @endif" value="{{$type->niveau_client}}" list="browser" aria-describedby="button-addon1">
                          <datalist id="browser">
                              @foreach($types as $tp)
                                  <option>{{$tp->niveau_client}}
                              @endforeach
                          </datalist>
                             @endif
                          @endforeach
                          @if($errors->get('typeC'))
                              <ul style="list-style-type:none;">
                              @foreach($errors->get('typeC') as $message)
                                  <li>{{$message }}</li>  
                              @endforeach
                            </ul>
                          @endif
                          <a class="btn btn-dark" id="button-addon1" onclick="document.getElementById('ty').style.display='block';  document.getElementById('tp').value=null; ">Ajouter un type</a>  
                      </div>  <br>
                      <div class="form-group" style="display:none;" id="ty">
                          <label for="">Tapez un nouveau type de client</label>
                          <input type="text" name="typ" class="form-control @if($errors->get('typ')) is-invalid @endif">
                          @if($errors->get('typ'))
                              <ul style="list-style-type:none;">
                              @foreach($errors->get('typ') as $message)
                                  <li>{{$message }}</li>  
                              @endforeach
                            </ul>
                          @endif
                      </div>
                  </div><br>
                  <div class="form-group">
                      <input type="submit" class="form-control btn btn-warning" value="Mettre à jour">
                  </div>
            </form>
            </div>
        </div>
    </div>
@endsection