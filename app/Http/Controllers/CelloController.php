<?php

namespace App\Http\Controllers;

use App\Http\Requests\CelloRequest;
use App\Models\Carte;
use App\Models\Cello;
use App\Models\Cello_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CelloController extends Controller
{
    public function index() {
        $listcel = Cello::all();
        $listtp = Cello_type::all();
        $listcr = Carte::all();

        if(isset($_GET['query'])){
            $query = $_GET['query'];
            $cellos = Cello::where('num' , 'LIKE' , '%'.$query.'%')->get();
            if(count($cellos) > 0){
                return view('projet.indexCello',['cellos' => $cellos , 'types' => $listtp , 'cartes' => $listcr]); 
            }
            else{
                session()->flash('warning',"Aucun cello n'a un numéro qui apporte l'ensemble ".$query." !!!"); 
                return redirect('cellos');
            } 
        }
        else{
            if(isset($_GET['quer'])){
                $query = $_GET['quer'];
                $cellos = Cello::where('etat' , 'LIKE' , '%'.$query.'%')->get();
                if(count($cellos) > 0){
                    return view('projet.indexCello',['cellos' => $cellos , 'types' => $listtp , 'cartes' => $listcr]); 
                }
                else{
                    session()->flash('warning',"Aucun cello n'a une état qui apporte l'ensemble ".$query." !!!"); 
                    return redirect('cellos');
                } 
            }
            return view('projet.indexCello',['cellos' => $listcel , 'types' => $listtp , 'cartes' => $listcr]);
        }
    }

    public function create() {
        $tpCellos = Cello_type::all();
        $cartes = Carte::all();
        return view('projet.createCello',['types' => $tpCellos , 'cartes' => $cartes]);
    }

    public function store(CelloRequest $request) {
        $cello = new Cello();
        
        $cello->num = $request->input('num');
        $cello->version = $request->input('ver');
        $cello->etat = 'en stock';

        if ($request->input('typeCel') != null) {
            $type = DB::table('cello_types')->where('type_cello', $request->input('typeCel'))->first();
            $cello->cello_type_id = $type->id;
        }else{
            $type = new Cello_type();
            $type->type_cello = $request->input('tp');
            $type->save();
            $cello->cello_type_id = $type->id;
        }

        if ($request->input('sim') != null) {
            $cart = DB::table('cartes')->where('numero', $request->input('sim'))->first();
            $cello->carte_id = $cart->id;
        }else{
            $cart = new Carte();
            $cart->numero = $request->input('nmc');
            $cart->code1 = $request->input('cdc1');
            $cart->code2 = $request->input('cdc2');
            $cart->etat = 'installée';
            $cart->save();
            $cello->carte_id = $cart->id;    
        }

        $cello->save();
        session()->flash('success','le cello '.$request->input('num').' est bien enregistré !!!');
        return redirect('cellos');
    }

    public function edit(Request $request, $id) {
        $cello = Cello::find($id);
        $tpCellos = Cello_type::all();
        $cartes = Carte::all();
        return view('projet.editCello',['cello' => $cello ,'types' => $tpCellos, 'cartes' => $cartes]);
    }

    public function update(CelloRequest $request, $id) {
        $cello = Cello::find($id);

        $cello->num = $request->input('num');
        $cello->version = $request->input('ver');
        $cello->etat= 'en stock';

        if ($request->input('typeCel') != null) {
            $type = DB::table('cello_types')->where('type_cello', $request->input('typeCel'))->first();
            $cello->cello_type_id = $type->id;
        }else{
            $type = new Cello_type();
            $type->type_cello = $request->input('tp');
            $type->save();
            $cello->cello_type_id = $type->id;
        }

        if ($request->input('sim') != null) {
            $cart = DB::table('cartes')->where('numero', $request->input('sim'))->first();
            $cr = Carte::find($request->input('sima'));
            $cr->etat = 'en stock';
            $cr->save();
            $crt = Carte::find($cart->id);
            $crt->etat = 'installée';
            $crt->save();
            $cello->carte_id = $cart->id;
        }else{
            $cart = new Carte();
            $cr = Carte::find($request->input('sima'));
            $cr->etat = 'en stock';
            $cr->save();

            $cart->numero = $request->input('nmc');
            $cart->code1 = $request->input('cdc1');
            $cart->code2 = $request->input('cdc2');
            $cart->etat = 'installée';
            $cart->save();
            $cello->carte_id = $cart->id;    
        }
        $cello->save();
        session()->flash('success','le cello '.$request->input('num').' est bien modifié !!!');
        return redirect('cellos');
    }

    public function destroy(Request $request,$id) {
        $cello = Cello::find($id);
        if($cello->etat == 'installé'){
            session()->flash('warning',"le cello ".$cello->num." est installé, vous devez supprimer l'installation en premier pas  !!!");
            return redirect('cellos');
        }
        $cello->delete();
        session()->flash('success','le cello '.$cello->num.' est bien supprimé !!!');
        return redirect('cellos');
    }
}
