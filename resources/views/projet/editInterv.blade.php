@extends('layouts.app')

@section('content')
    <div class="container">
    <h2>Mettre à jour les données d'intervention du véhicule <small>{{$vh->mcu}}</small></h2><br>
            <form action="{{url('interventions/'.$intrv->id)}}" method="post" class="row">
                 {{  csrf_field() }}
                 <input type="hidden" name="_method" value="PUT">
                  <div class="col-md-12">
                      <label for="">MCU du véhicule</label>
                      <input type="text" name="mcu" class="form-control @if($errors->get('mcu')) is-invalid @endif" value="{{$vh->mcu}}" list="brow">
                      <datalist id="brow">
                         @foreach($vehs as $veh)
                            <option> {{$veh->mcu}} </option>  
                         @endforeach
                      </datalist>
                      @if($errors->get('mcu'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('mcu') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                      @endif
                  </div>
                  <div class="col-md-12">
                      <label for="">Panne</label>
                      <textarea name="pan" class="form-control @if($errors->get('pan')) is-invalid @endif">{{$intrv->panne}}</textarea>
                      @if($errors->get('pan'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('pan') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                      @endif
                  </div>
                  <div class="col-md-6">
                      <label for="">Etat d'intervention</label>
                      <select name="et" class="form-select form-control @if($errors->get('et')) is-invalid @endif" aria-label="Default select example" >
                            <option name="et" value="déclarée" @if($veh->etat == 'déclarée') selected @endif >déclarée</option>
                            <option name="et" value="en cours de réparation" @if($veh->etat == 'en cours de réparation') selected @endif >en cours de réparation</option>
                            <option name="et" value="réparé" @if($veh->etat == 'réparée') selected @endif >réparé</option>
                      </select>
                      @if($errors->get('et'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('et') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                      @endif
                  </div>
                  <div class="col-md-6">
                      <label for="">Réparateur</label>
                      <input type="text" name="rep" class="form-control @if($errors->get('rep')) is-invalid @endif" value="{{$intrv->reparateur}}">
                      @if($errors->get('rep'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('rep') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                      @endif
                  </div>
                  <div class="col-md-12">
                      <label for="">Memo du réparateur</label>
                      <textarea name="memo" class="form-control @if($errors->get('memo')) is-invalid @endif">{{$intrv->memo_repr}}</textarea>
                      @if($errors->get('memo'))
                            <ul style="list-style-type:none;">
                            @foreach($errors->get('memo') as $message)
                            <li>{{$message }}</li>  
                            @endforeach
                            </ul>
                      @endif
                  </div>
                 <div class="col-md-4">
                      <label for="">Date de déclaration</label>
                      <input type="date" name="dtdec" class="form-control @if($errors->get('dtdec')) is-invalid @endif" v-model="mydate" @if($dateD != null) value={{$dateD[0]}} @endif>
                            @if($errors->get('dtdec'))
                                    <ul style="list-style-type:none;">
                                    @foreach($errors->get('dtdec') as $message)
                                    <li>{{$message }}</li>  
                                    @endforeach
                                    </ul>
                            @endif
                  </div>
                  <div class="col-md-2">
                      <label for="">Heure de déclaration</label>
                      <input type="time" name="tmdec" class="form-control @if($errors->get('tmdec')) is-invalid @endif" v-model="mytime" @if($dateD != null) value={{$dateD[1]}} @endif>
                            @if($errors->get('tmdec'))
                                    <ul style="list-style-type:none;">
                                    @foreach($errors->get('tmdec') as $message)
                                    <li>{{$message }}</li>  
                                    @endforeach
                                    </ul>
                            @endif
                  </div>
                  <div class="col-md-4">
                      <label for="">Date d'intervention</label>
                      <input type="date" name="dtIntr" class="form-control @if($errors->get('dtIntr')) is-invalid @endif" v-model="mydate" @if($dateI != null) value={{$dateI[0]}} @endif>
                            @if($errors->get('dtIntr'))
                                    <ul style="list-style-type:none;">
                                    @foreach($errors->get('dtIntr') as $message)
                                    <li>{{$message }}</li>  
                                    @endforeach
                                    </ul>
                            @endif
                  </div>
                  <div class="col-md-2">
                      <label for="">Heure d'intervention</label>
                      <input type="time" name="tmIntr" class="form-control @if($errors->get('tmIntr')) is-invalid @endif " v-model="mytime" @if($dateI != null) value={{$dateI[1]}} @endif>
                            @if($errors->get('tmIntr'))
                                    <ul style="list-style-type:none;">
                                    @foreach($errors->get('tmIntr') as $message)
                                    <li>{{$message }}</li>  
                                    @endforeach
                                    </ul>
                            @endif
                  </div><div class="col-md-8">
                      <label for="">Date de fin d'intervention</label>
                      <input type="date" name="dtfin" class="form-control @if($errors->get('dtfin')) is-invalid @endif" v-model="mydate" @if($dateF != null) value={{$dateF[0]}} @endif>
                            @if($errors->get('dtfin'))
                                    <ul style="list-style-type:none;">
                                    @foreach($errors->get('dtfin') as $message)
                                    <li>{{$message }}</li>  
                                    @endforeach
                                    </ul>
                            @endif
                  </div>
                  <div class="col-md-4">
                      <label for="">Heure de fin d'intervention</label>
                      <input type="time" name="tmfin" class="form-control @if($errors->get('tmfin')) is-invalid @endif" v-model="mytime" @if($dateF != null) value={{$dateF[1]}} @endif>
                            @if($errors->get('tmfin'))
                                    <ul style="list-style-type:none;">
                                    @foreach($errors->get('tmfin') as $message)
                                    <li>{{$message }}</li>  
                                    @endforeach
                                    </ul>
                            @endif
                  </div>
                  <br>
                  <div class="col-md-12 mt-3">
                      <input type="submit" class="form-control btn btn-warning" value="Mettre à jour">
                  </div>
            </form>
    </div>
@endsection