<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterventionRequest;
use App\Models\Intervention;
use App\Models\User;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InterventionController extends Controller
{
    public function index() {
        $intr = Intervention::all();
        $vehs = Vehicule::all();
        $users = User::all();

        if(isset($_GET['queri'])){
            $query = $_GET['queri'];
            $ints = Intervention::where('reparateur' , 'LIKE' , '%'.$query.'%')->get();

            if(count($ints) > 0){
                return view('projet.indexInterv',['intervs' => $ints , 'vehs' =>$vehs , 'users' => $users ]); 
            }
            else{
                session()->flash('warning',"Aucune intervention n'est effectuée par un réparateur qui apporte le nom ou l'ensemble ".$query." !!!"); 
                return redirect('interventions');
            } 
        }
        else{
            return view('projet.indexInterv',['intervs' => $intr , 'vehs' =>$vehs , 'users' => $users ]);
        } 
    }

    public function create() {
        $vehs = Vehicule::all();
        return view('projet.createInterv',['vehs' => $vehs]);
    }

    public function store(InterventionRequest $request) {
        
        $intrv = new Intervention();
        $lsInt = Intervention::all();
        foreach($lsInt as $intr){
            $veh = Vehicule::find($intr->vehicule_id);
            if($request->input('mcu') == $veh->mcu && $request->input('dtdec').' '.$request->input('tmdec') == $intr->dtDeclr){
                session()->flash('warning',"l'intervention ".$request->input('id').' est déja disponible dans la base de données !!!');
                return redirect('interventions/create');
            }
        }
        
        $dateD = $request->input('dtdec'); 
        $timeD = $request->input('tmdec');
        $dateI = $request->input('dtIntr'); 
        $timeI = $request->input('tmIntr');
        $dateF = $request->input('dtfin'); 
        $timeF = $request->input('tmfin');

        $veh = DB::table('vehicules')->where('mcu',$request->input('mcu'))->first();

        $intrv->vehicule_id = $veh->id;
        $intrv->panne = $request->input('pan');
        $intrv->etat = $request->input('et');
        $intrv->reparateur = $request->input('rep');
        $intrv->memo_repr = $request->input('memo');
        $intrv->user_id = Auth::user()->id;
        $intrv->dtDeclr = $dateD.' '.$timeD;

        if($dateI == null && $timeI == null){
            $intrv->dtInterv = null;     
        }
        else{
            $intrv->dtInterv = $dateI.' '.$timeI;
        }
        if($dateF == null && $timeF == null){
            $intrv->dtFinInterv = null; 
        }
        else{
            $intrv->dtFinInterv = $dateF.' '.$timeF;
        }
        
        $intrv->save();

        session()->flash('success',"l'intervention du véhicule ".$request->input('mcu')." est bien enregistrée !!!");
        return redirect('interventions');
    }

    public function edit(Request $request, $id) {
        $intrv = Intervention::find($id);

        $dateD = Str::of($intrv->dtDeclr)->explode(' ');

        if($intrv->dtInterv == null){
            $dateI = null;   
        }
        else{
            $dateI = Str::of($intrv->dtInterv)->explode(' ');
        }
        if($intrv->dtFinInterv == null){
            $dateF = null; 
        }
        else{
            $dateF = Str::of($intrv->dtFinInterv)->explode(' ');
        }

        $veh = Vehicule::find($intrv->vehicule_id);
        $vehs = Vehicule::all();

        return view('projet.editInterv',['intrv' => $intrv , 'vh' => $veh , 'vehs' => $vehs , 'dateD' => $dateD , 'dateI' => $dateI , 'dateF' => $dateF ]);
    }

    public function update(InterventionRequest $request, $id) {
        $intrv = Intervention::find($id);
        $lsInt = Intervention::all();

        foreach($lsInt as $intr){
            $veh = Vehicule::find($intr->vehicule_id);
            if($intr!=$intrv && $request->input('mcu') == $veh->mcu && $request->input('dtdec').' '.$request->input('tmdec') == $intr->dtDeclr){
                session()->flash('warning',"l'intervention du véhicule ".$veh->mcu." est déja disponible dans la base de données !!!");
                return redirect('interventions/'.$id.'/edit');
            }
        }
        
        $dateD = $request->input('dtdec'); 
        $timeD = $request->input('tmdec');
        $dateI = $request->input('dtIntr'); 
        $timeI = $request->input('tmIntr');
        $dateF = $request->input('dtfin'); 
        $timeF = $request->input('tmfin');

        $veh = DB::table('vehicules')->where('mcu',$request->input('mcu'))->first();

        $intrv->vehicule_id = $veh->id;
        $intrv->panne = $request->input('pan');
        $intrv->etat = $request->input('et');
        $intrv->reparateur = $request->input('rep');
        $intrv->memo_repr = $request->input('memo');
        $intrv->dtDeclr = $dateD.' '.$timeD;

        if($dateI == null && $timeI == null){
            $intrv->dtInterv = null;    
        }
        else{
            $intrv->dtInterv = $dateI.' '.$timeI;
        }
        if($dateF == null && $timeF == null){
            $intrv->dtFinInterv = null; 
        }
        else{
            $intrv->dtFinInterv = $dateF.' '.$timeF;
        }

        $intrv->save();

        session()->flash('success',"l'intervention du véhicule ".$request->input('mcu')." est bien mise à jour !!!");
        return redirect('interventions');
    }

    public function destroy(Request $request,$id) {
        $intrv = Intervention::find($id);
        $veh  = Vehicule::find($intrv->vehicule_id);
        $intrv->delete();
        session()->flash('success',"l'intervention du véhicule ".$veh->mcu." est bien supprimée !!!");
        return redirect('interventions');
    }
}
