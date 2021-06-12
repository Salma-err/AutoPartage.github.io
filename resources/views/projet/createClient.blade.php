@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        <h2>Ajouter les données d'un client</h2><br>
            <div class="col-md-12">
            <form action="{{url('clients')}}" method="post">
                 {{  csrf_field() }}
                  <div class="form-group">
                      <label for="">Nom</label>
                      <input type="text" name="nom" class="form-control @if($errors->get('nom')) is-invalid @endif" value="{{old('nom')}}">
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
                      <input type="text" name="email" class="form-control @if($errors->get('email')) is-invalid @endif" value="{{old('email')}}">
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
                      <input type="text" name="tel" class="form-control @if($errors->get('tel')) is-invalid @endif" value="{{old('tel')}}">
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
                      <input type="text" name="adr" class="form-control @if($errors->get('adr')) is-invalid @endif" value="{{old('adr')}}">
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
                          <input type="text" name="typeC" class="form-control @if($errors->get('typeC')) is-invalid @endif" value="{{old('typeC')}}" list="browser" aria-describedby="button-addon1">
                          <datalist id="browser">
                              @foreach($types as $tp)
                                  <option>{{$tp->niveau_client}}
                              @endforeach
                          </datalist>
                          @if($errors->get('typeC'))
                              <ul style="list-style-type:none;">
                              @foreach($errors->get('typeC') as $message)
                                  <li>{{$message }}</li>  
                              @endforeach
                            </ul>
                          @endif
                          <a class="btn btn-success" id="button-addon1" onclick="document.getElementById('ty').style.display='block'">Ajouter un type</a>  
                      </div>  <br>
                      <div class="form-group" style="display:none;" id="ty">
                          <label for="">Nouveau type de client</label>
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
                      <input type="submit" class="form-control btn btn-primary" value="Enregistrer">
                  </div>
            </form>
            </div>
        </div>
    </div>
@endsection