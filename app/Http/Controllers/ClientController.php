<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\Client_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index() { 
        $listcl = Client::all();
        $listtp = Client_type::all();
        
        if(isset($_GET['query'])){
            $query = $_GET['query'];
            $clients = Client::where('nom' , 'LIKE' , '%'.$query.'%')->get();
            if(count($clients) > 0){
                return view('projet.indexClient',['clients' => $clients , 'types' => $listtp]); 
            }
            else{
                session()->flash('warning',"Aucun client n'apporte le nom ou l'ensemble ".$query." !!!"); 
                return redirect('clients');
            } 
        }
        else{
            return view('projet.indexClient',['clients' => $listcl , 'types' => $listtp]);
        } 
    }

    public function create() {
        $tpClients = Client_type::all();
        return view('projet.createClient',['types' => $tpClients]);
    }

    public function store(ClientRequest $request) {
        $client = new Client();
        $lsclient = Client::all();
        $lstp = Client_type::all();
        foreach($lsclient as $cl){
            if($request->input('nom')==$cl->nom){
                session()->flash('warning','Le client '.$request->input('nom').' est déja disponible dans la base de données !!!');
                return redirect('clients/create');
            }
        }
        $client->nom = $request->input('nom');
        $client->email = $request->input('email');
        $client->tel = $request->input('tel');
        $client->adresse = $request->input('adr');

        if ($request->input('typeC') != null) {
            $type = DB::table('client_types')->where('niveau_client', $request->input('typeC'))->first();
            $client->client_type_id = $type->id;
        }else{
            $type = new Client_type();
            foreach ($lstp as $typ) {
                if ($request->input('typ')==$typ->niveau_client) {
                    session()->flash('warning', 'le type '.$request->input('typ').' est déja disponible dans la base de données !!!');
                    return redirect('clients/create');
                }
            }
            $type->niveau_client = $request->input('typ');
            $type->save();
            $client->client_type_id = $type->id;
        }
        $client->save();
        session()->flash('success','le client '.$request->input('nom').' est bien enregistré !!!');
        return redirect('clients');
    }

    public function edit(Request $request, $id) {
        $client = Client::find($id);
        $tpClients = Client_type::all();
        return view('projet.editClient',['client' => $client ,'types' => $tpClients]);
    }

    public function update(ClientRequest $request, $id) {
        $client = Client::find($id);
        $lsclient = Client::all();
        $lstp = Client_type::all();
        foreach($lsclient as $cl){
            if($request->input('nom')==$cl->nom && $cl != $client){
                session()->flash('warning','le client '.$request->input('nom').' est déja disponible dans la base de données !!!');
                return redirect('clients/'.$id.'/edit');
            }
        }
        $client->nom = $request->input('nom');
        $client->email = $request->input('email');
        $client->tel = $request->input('tel');
        $client->adresse = $request->input('adr');

        if ($request->input('typeC') != null) {
            $type = DB::table('client_types')->where('niveau_client', $request->input('typeC'))->first();
            $client->client_type_id = $type->id;
        }else{
            $type = new Client_type();
            foreach ($lstp as $typ) {
                if ($request->input('typ')==$typ->niveau_client) {
                    session()->flash('warning', 'le type '.$request->input('typ').' est déja disponible dans la base de données !!!');
                    return redirect('clients/'.$id.'/edit');
                }
            }
            $type->niveau_client = $request->input('typ');
            $type->save();
            $client->client_type_id = $type->id;    
        }
        $client->save();
        session()->flash('success','le client '.$request->input('nom').' est bien mis à jour !!!');
        return redirect('clients');
    }

    public function destroy(Request $request,$id) {
        $client = Client::find($id);
        $client->delete();
        session()->flash('success','le client '.$client->nom.' est bien supprimé !!!');
        return redirect('clients');
    }
    
}
