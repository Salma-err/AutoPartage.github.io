@extends('layouts.app')

@section('content')
    <div class="container">
       <div>
        <h2>Mettre à jour les informations de la véhicule <small>{{$veh->mcu}}</small></h2><br>
        </div>
            <form class="row" action="{{url('vehicules/'.$veh->id)}}" method="post">
                 {{  csrf_field() }}
                 <input type="hidden" name="_method" value="PUT"> 
                  <div class="col-md-4">
                      <label for="">MCU</label>
                      <input type="text" name="mcu" class="form-control @if($errors->get('mcu')) is-invalid @endif" value="{{$veh->mcu}}">
                      @if($errors->get('mcu'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('mcu') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                      @endif
                  </div>
                  <div class="col-md-4">
                      <label for="">Matricule</label>
                      <input type="text" name="mtr" class="form-control @if($errors->get('mtr')) is-invalid @endif" value="{{$veh->matricule}}">
                      @if($errors->get('mtr'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('mtr') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                      @endif
                  </div>
                  <div class="col-md-4">
                      <label for="">Marque</label>
                      <input type="text" name="mrq" class="form-control @if($errors->get('mrq')) is-invalid @endif" value="{{$veh->marque}}">
                      @if($errors->get('mrq'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('mrq') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                      @endif
                  </div>
                  <div class="col-md-4">
                      <label for="">Modèle</label>
                      <input type="text" name="mdl" class="form-control @if($errors->get('mdl')) is-invalid @endif" value="{{$veh->modele}}">
                      @if($errors->get('mdl'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('mdl') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                      @endif
                  </div>
                  <div class="col-md-4">
                      <label for="">Type</label>
                      <input type="text" name="type" class="form-control @if($errors->get('type')) is-invalid @endif" value="{{$veh->type}}">
                      @if($errors->get('type'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('type') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                      @endif
                  </div>
                  <div class="col-md-4">
                      <label for="">Couleur</label>
                      <input type="text" name="clr" class="form-control @if($errors->get('clr')) is-invalid @endif" value="{{$veh->couleur}}">
                      @if($errors->get('clr'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('clr') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                      @endif
                  </div>
                  <div class="col-md-12">
                      <label for="">Statut de la véhicule</label>
                      <textarea name="statut" class="form-control @if($errors->get('statut')) is-invalid @endif">{{$veh->statut}}</textarea>
                      @if($errors->get('statut'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('statut') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                      @endif
                  </div>
                  <div class="col-md-6">
                      <label for="">Numéro du cello</label>
                      <div class="input-group">
                      <input type="text" name="numo" class="form-control @if($errors->get('numo')) is-invalid @endif" list="browsers" aria-describedby="button-addon1" value="{{$cello->num}}">
                      <input type="hidden" name="idc" value="{{$cello->id}}">
                      <datalist id="browsers">
                          @foreach($cellos as $cello)
                          <option>{{$cello->num}}
                          @endforeach
                      </datalist>
                      @if($errors->get('numo'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('numo') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                      @endif
                      <a id="button-addon1" class="btn btn-dark" href="{{url('cellos/create')}}">Ajouter un cello</a>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <label for="">Nom du client</label>
                      <div class="input-group">
                      <input type="text" name="nomc" class="form-control @if($errors->get('nomc')) is-invalid @endif" list="browser" aria-describedby="button-addon2" value="{{$client->nom}}">
                      <datalist id="browser">
                          @foreach($clients as $client)
                          <option>{{$client->nom}}
                          @endforeach
                      </datalist>
                      @if($errors->get('nomc'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('nomc') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                      @endif
                      <a id="button-addon2" class="btn btn-dark" href="{{url('clients/create')}}">Ajouter un client</a>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <label for="">Installateur</label>
                      <input type="text" name="instl" class="form-control @if($errors->get('instl')) is-invalid @endif" value="{{$veh->installateur}}">
                      @if($errors->get('instl'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('instl') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul> 
                      @endif
                  </div>
                  <div class="d-flex col-md-6">
                  <div class="col-md-8" >
                      <label for="">Date d'installation</label>
                      <input type="date" name="dtInst" class="form-control @if($errors->get('dtInst')) is-invalid @endif" v-model="mydate" value={{$date[0]}}>
                            @if($errors->get('dtInst'))
                                    <ul style="list-style-type:none;">
                                    @foreach($errors->get('dtInst') as $message)
                                    <li>{{$message }}</li>  
                                    @endforeach
                                    </ul>
                            @endif
                  </div>
                  <div class="col-md-4">
                      <label for="">Heure d'installation</label>
                      <input type="time" name="tmInst" class="form-control @if($errors->get('tmInst')) is-invalid @endif" v-model="mytime" value={{$date[1]}}>
                            @if($errors->get('tmInst'))
                                    <ul style="list-style-type:none;">
                                    @foreach($errors->get('tmInst') as $message)
                                    <li>{{$message }}</li>  
                                    @endforeach
                                    </ul>
                            @endif
                  </div>
                  </div><br>
                  <div class="col-md-12 mt-3">
                      <input type="submit" class="form-control btn btn-warning" value="Mettre à jour">
                  </div>
            </form>
    </div>
@endsection