@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        <h2>Mettre à jour les informations du cello <small>{{$cello->num}}</small></h2>
            <div class="col-md-12">
            <form action="{{url('cellos/'.$cello->id)}}" method="post">
                 {{  csrf_field() }}
                  <input type="hidden" name="_method" value="PUT"> 
                  <div class="form-group">
                      <label for="">Numéro du cello</label>
                      <input type="text" name="num" class="form-control @if($errors->get('num')) is-invalid @endif" value="{{$cello->num}}">
                      @if($errors->get('num'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('num') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                      @endif
                  </div>
                  <div class="form-group">
                      <label for="">Version</label>
                      <input type="text" name="ver" class="form-control @if($errors->get('ver')) is-invalid @endif" value="{{$cello->version}}">
                      @if($errors->get('ver'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('ver') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                      @endif
                  </div>
                  <div class="form-group">
                      <label for="">Type du cello</label>
                      <div class="input-group">
                      @foreach($types as $type)
                          @if($type->id == $cello->cello_type_id)
                          <input type="text" id="tp" name="typeCel" class="form-control @if($errors->get('typeCel')) is-invalid @endif" value="{{$type->type_cello}}" list="browser" aria-describedby="button-addon1">
                          @endif
                      @endforeach
                          <datalist id="browser">
                              @foreach($types as $tp)
                                  <option>{{$tp->type_cello}}
                              @endforeach
                          </datalist>
                          @if($errors->get('typeCel'))
                              <ul style="list-style-type:none;">
                              @foreach($errors->get('typeCel') as $message)
                                  <li>{{$message }}</li>  
                              @endforeach
                            </ul>
                          @endif
                          <a class="btn btn-dark" id="button-addon1" onclick="document.getElementById('ty').style.display='block'; document.getElementById('tp').value=null; ">Ajouter un type</a>  
                      </div>
                      <div class="form-group" style="display:none;" id="ty">
                          <label for="">Nouveau type du cello</label>
                          <input type="text" name="tp" class="form-control @if($errors->get('tp')) is-invalid @endif">
                          @if($errors->get('tp'))
                              <ul style="list-style-type:none;">
                              @foreach($errors->get('tp') as $message)
                                  <li>{{$message }}</li>  
                              @endforeach
                            </ul>
                          @endif
                          <hr>
                      </div>
                  </div>
                  <div class="form-group">
                  <label for="">Numéro de la carte SIM</label>
                      <div class="input-group">
                      @foreach($cartes as $carte)
                          @if($carte->id == $cello->carte_id)
                          <input type="text" id="sm" name="sim" class="form-control @if($errors->get('sim')) is-invalid @endif" value="{{$carte->numero}}" list="brows" aria-describedby="button-addon2">
                          @endif
                      @endforeach
                          <datalist id="brows">
                              @foreach($cartes as $crt)
                                  <option>{{$crt->numero}}
                              @endforeach
                          </datalist>
                          @if($errors->get('sim'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('sim') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                          @endif
                          <input type="hidden" name="sima" value="{{$cello->carte_id}}">
                          <a class="btn btn-dark" id="button-addon2" onclick="document.getElementById('cr').style.display='block'; document.getElementById('sm').value=null; ">Ajouter une carte SIM</a>  
                      </div>
                      <div id="cr" style="display:none;">
                      <div class="form-group">
                          <label for="">Numéro de la nouvelle carte SIM</label>
                          <input type="text" name="nmc" class="form-control @if($errors->get('nmc')) is-invalid @endif">
                          @if($errors->get('nmc'))
                              <ul style="list-style-type:none;">
                              @foreach($errors->get('nmc') as $message)
                                  <li>{{$message }}</li>  
                              @endforeach
                            </ul>
                          @endif
                      </div>
                      <div class="form-group">
                          <label for="">Premier code de la nouvelle carte SIM</label>
                          <input type="text" name="cdc1" class="form-control @if($errors->get('cdc1')) is-invalid @endif">
                          @if($errors->get('cdc1'))
                              <ul style="list-style-type:none;">
                              @foreach($errors->get('cdc1') as $message)
                                  <li>{{$message }}</li>  
                              @endforeach
                            </ul>
                          @endif
                      </div>
                      <div class="form-group">
                          <label for="">Deuxième code de la nouvelle carte SIM</label>
                          <input type="text" name="cdc2" class="form-control @if($errors->get('cdc2')) is-invalid @endif">
                          @if($errors->get('cdc2'))
                              <ul style="list-style-type:none;">
                              @foreach($errors->get('cdc2') as $message)
                                  <li>{{$message }}</li>  
                              @endforeach
                            </ul>
                          @endif
                      </div>
                      <hr>
                  </div><br>
                  <div class="form-group">
                      <input type="submit" class="form-control btn btn-warning" value="Mettre à jour">
                  </div>
            </form>
            </div>
        </div>
    </div>
@endsection