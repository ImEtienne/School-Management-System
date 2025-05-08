<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\CoursEtudiant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoursController extends Controller
{
    //affiche la liste des cours
    public function show(){
        $cour = Cours::all();
        return view('admin.cours.index', ['cours'=>$cour]);
    }

    //ajoute les cours
    public function addForm(){
        return view('admin.cours.add');
    }

    //Ajoute les cours
    public function add(Request $request){
        $validated=$request->validate([
            'intitule' => 'required|alpha|max:50',
        ]);
        $cour = new Cours();
        $cour->intitule=$validated['intitule'];
        $cour->created_at = Carbon::now();
        $cour->save();
        $request->session()->flash('etat', 'l\'ajout a été effectué avec succès');

        return redirect()->route('admin.cours.index');
    }

    //Barre de recherche
    public function search(){ // function qui fait la recherche d'un cours
        $q = request()->input('q');
        $cour = Cours::where('intitule', 'like', "%$q%")->get();

        return view('admin.cours.index', ['cours'=>$cour]);
    }

    //Modifier cours
    public function editForm($id){
        $cour = Cours::find($id);
        return view('admin.cours.edit', ['cours' => $cour]);
    }

    //Modifier cours
    public function edit(Request $request, $id){
        $cour = Cours::findOrFail($id);
        if($request->has('Modifier')){
            $validated=$request->validate([
                'intitule' => 'required|alpha|max:50',
            ]);
            $cour->intitule=$validated['intitule'];
            $cour->updated_at = Carbon::now();
            $cour->save();
            $request->session()->flash('etat', 'modification effectuéé !');

        } else {
            $request->session()->flash('etat', 'modification annulée' );
        }
        return redirect()->route('admin.cours.index', ['id'=>$cour->id]);
    }

    //Supprimer cours
    /*public function deleteForm($id){
        $p = Cours::find($id);
        return view('admin.cours.delete', ['cours' => $p]);
    //////////////////////////////////////////////////////////
    DB::delete('delete from cours_etudiants where cours_id = ?',[$id]);
        DB::delete('delete from cours_users where cours_id = ?',[$id]);
        $p = DB::table('seances')->where('cours_id', $id)->value('seance_id');
        DB::delete('delete from presences where seance_id = ?', [$p]);
        DB::delete('delete from seances where cours_id = ?', [$id]);
        DB::delete('delete from cours where id = ?', [$id]);
    }*/

    //Supprimer Cours
    public function deleteForm(Request $request, $id){
        DB::table('cours_etudiants')->where('cours_id', $id)->delete();
        DB::table('cours_users')->where('cours_id', $id)->delete();
        $p = DB::table('seances')->where('cours_id', $id)->value('seance_id');
        DB::delete('delete from presences where seance_id = ?', [$p]);
        //DB::delete('delete from seances where cours_id = ?', [$id]);
        DB::table('seances')->where('cours_id', $id)->delete();
        $supprimer = Cours::findOrFail($id);
        $supprimer->delete($id);

        $request->session()->flash('etat', 'la suppression a été effectuée avec succès');
        return redirect()->route('admin.cours.index');
    }
}
