<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehiculeRequest;
use App\Models\Cello;
use App\Models\Client;
use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VehiculeController extends Controller
{
    public function index() {
        $veh = Vehicule::all();
        $clients = Client::all();
        $cellos = Cello::all();
        $users = User::all();

        if(isset($_GET['querm'])){
            $query = $_GET['querm'];
            $vehs = Vehicule::where('mcu' , 'LIKE' , '%'.$query.'%')->get();
            if(count($vehs) > 0){
                return view('projet.indexVehicule',['vehs' => $vehs , 'clients' => $clients , 'cellos' => $cellos , 'users' => $users]); 
            }
            else{
                session()->flash('warning',"Aucun véhicule n'a un MCU qui est égal ou qui apporte l'ensemble ".$query." !!!"); 
                return redirect('vehicules');
            } 
        }
        else{
            if(isset($_GET['quert'])){
                $query = $_GET['quert'];
                $vehs = Vehicule::where('matricule' , 'LIKE' , '%'.$query.'%')->get();
                if(count($vehs) > 0){
                    return view('projet.indexVehicule',['vehs' => $vehs , 'clients' => $clients , 'cellos' => $cellos , 'users' => $users]); 
                }
                else{
                    session()->flash('warning',"Aucun véhicule n'a un matricule qui est égal ou qui apporte l'ensemble ".$query." !!!"); 
                    return redirect('vehicules');
                } 
            }
            return view('projet.indexVehicule',['vehs' => $veh , 'clients' => $clients , 'cellos' => $cellos , 'users' => $users]);
        }
    }

    public function create() {
        $client = Client::all();
        $cello = DB::table('cellos')->where('etat','en stock')->get();
        return view('projet.createVehicule',['clients' => $client , 'cellos'=> $cello]);
    }

    public function store(VehiculeRequest $request) {
        
        $veh = new Vehicule();
        
        $date = $request->input('dtInst'); 
        $time = $request->input('tmInst');

        $cl = DB::table('clients')->where('nom',$request->input('nomc'))->first();
        $cel = DB::table('cellos')->where('num',$request->input('numo'))->first(); 

        if($cel->etat == 'installé'){
            session()->flash('warning','le cello '.$request->input('numo').' est déja installé dans un véhicule !!!');
            return redirect('vehicules/create');
        }
    
        $cello = Cello::find($cel->id);
        $cello->etat = 'installé';
        $cello->save();

        $veh->mcu = $request->input('mcu');
        $veh->matricule = $request->input('mtr');
        $veh->marque = $request->input('mrq');
        $veh->modele = $request->input('mdl');
        $veh->type = $request->input('type');
        $veh->couleur = $request->input('clr');
        $veh->statut = $request->input('statut');
        $veh->cello_id = $cel->id;
        $veh->client_id = $cl->id;
        $veh->installateur = $request->input('instl');
        $veh->date_instl = $date.' '.$time;
        $veh->user_id = Auth::user()->id;
        $veh->save();

        session()->flash('success','le véhicule '.$request->input('mcu').' est bien enregistré !!!');
        return redirect('vehicules');
    }

    public function edit(Request $request, $id) {
        $veh = Vehicule::find($id);

        $date = Str::of($veh->date_instl)->explode(' ');
       /* $date = date('d/m/Y',strtotime($dt[0]));
        $time = $dt[1];
        dd($dt[0]);*/

        $clients = Client::all();
        $cellos = DB::table('cellos')->where('etat','en stock')->get();
        $client = Client::find($veh->client_id);
        $cello = Cello::find($veh->cello_id);

        return view('projet.editVehicule',['veh' => $veh , 'client' => $client , 'cello' => $cello , 'clients' =>$clients , 'cellos'=>$cellos , 'date' => $date]);
    }

    public function update(VehiculeRequest $request, $id) {
        $veh = Vehicule::find($id);
        $lsVh = Vehicule::all();

        foreach($lsVh as $vh){
            if($request->input('mcu') == $vh->mcu && $vh != $veh){
                session()->flash('warning','le véhicule '.$request->input('mcu').' est déja disponible dans la base de données !!!');
                return redirect('vehicules/'.$id.'/edit');
            }
        }
        
        $date = $request->input('dtInst'); 
        $time = $request->input('tmInst');

        $cello = Cello::find($request->input('idc'));
        $cello->etat = 'en stock';
        $cello->save();

        $cl = DB::table('clients')->where('nom',$request->input('nomc'))->first();
        $cel = DB::table('cellos')->where('num',$request->input('numo'))->first(); 
        $cello = Cello::find($cel->id);
        $cello->etat = 'installé';
        $cello->save();

        $veh->mcu = $request->input('mcu');
        $veh->matricule = $request->input('mtr');
        $veh->marque = $request->input('mrq');
        $veh->modele = $request->input('mdl');
        $veh->type = $request->input('type');
        $veh->couleur = $request->input('clr');
        $veh->statut = $request->input('statut');
        $veh->cello_id = $cel->id;
        $veh->client_id = $cl->id;
        $veh->installateur = $request->input('instl');
        $veh->date_instl = $date.' '.$time;

        $veh->save();
        session()->flash('success','le véhicule '.$request->input('mcu').' est bien mis à jour !!!');
        return redirect('vehicules');
    }

    public function destroy(Request $request,$id) {
        $veh = Vehicule::find($id);
        $cello = Cello::find($veh->cello_id);
        $cello->etat = 'en stock';
        $cello->save();
        $veh->delete();
        session()->flash('success','le véhicule '.$veh->mcu.' est bien supprimé !!!');
        return redirect('vehicules');
    }
}
