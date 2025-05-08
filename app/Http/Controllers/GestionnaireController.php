<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Etudiants;
use App\Models\Seances;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GestionnaireController extends Controller
{

    //Modifier le mot de passe gestionnaire
    public function editFormMdp(){
        return view('gestionnaire.account.edit_Mdp');
    }

    //modifier le mot de passe gestionnaire
    public function edit(Request $request){
        $request -> validate([
            'mdp_old' => 'required|string',
            'mdp' => 'required|string|confirmed'
        ]);
        $user = Auth::user();
        if(Hash::check($request->mdp_old, $user->mdp)){
            $user->fill(['mdp' => Hash::make($request->mdp)])->save();
            $request->session()->flash('etat', 'Mot de passe changé');
            return redirect()->route('gestionnaire.home');
        }
        $request->session()->flash('etat','votre mot de passe n\'est pas correct, Veuillez réessayer');

        return redirect()->route('gestionnaire.home');
    }

    //Modifier le nom et prenom du gestionnaire
    public function editForm_NomPrenom($id){
        $edit = User::find($id);
        return view('gestionnaire.account.editNamePrenom', ['users'=>$edit]);
    }

    //Modifier le nom et prenom du gestionnaire
    public function editName(Request $request, $id){
        $validated=$request->validate([
            'nom'=>'required|alpha|max:50',
            'prenom'=>'required|string|max:265',
        ]);
        $user = User::find($id);
        $user->nom=$validated['nom'];
        $user->prenom=$validated['prenom'];
        $user->save();
        $request->session()->flash('etat', 'la modification a été effectuée avec succès');
        return redirect()->route('gestionnaire.home',['users' => $user]);
    }

    //affiche la liste des étudiants
    public function show(){
        $etudiant = Etudiants::paginate(5);
        return view('gestionnaire.index', ['etudiants' =>$etudiant]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function addForm(){
        return view('gestionnaire.add');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request){
        $validated=$request->validate([
            'nom'=>'required|alpha|max:50',
            'prenom'=>'required|string|max:50',
            'noet'=>'required|numeric:unique'
        ]);
        $etudiant = new Etudiants();
        $etudiant->nom=$validated['nom'];
        $etudiant->prenom=$validated['prenom'];
        $etudiant->noet=$validated['noet'];
        $etudiant->created_at = Carbon::now();
        $etudiant->save();
        $request->session()->flash('etat', 'l\'étudiant a été effectué avec succès');
        return redirect()->route('gestionnaire.etudiant.index');
    }

    //Editer un étudiant
    public function editForm($id){
        $p = Etudiants::find($id);
        return view('gestionnaire.edit', ['etudiants'=>$p]);
    }

    //Editer un étudiant
    public function editEtudiant(Request $request, $id){
        $validated=$request->validate([
            'nom'=>'required|alpha|max:50',
            'prenom'=>'required|string|max:265',
            'noet'=>'required|numeric:unique',
        ]);
        $etudiant = Etudiants::find($id);
        $etudiant->nom=$validated['nom'];
        $etudiant->prenom=$validated['prenom'];
        $etudiant->noet=$validated['noet'];
        $etudiant->updated_at=Carbon::now();
        $etudiant->save();
        $request->session()->flash('etat', 'l\'étudiant a été effectué avec succès');
        return redirect()->route('gestionnaire.etudiant.index',['etudiants' => $etudiant]);
    }

    //supprimer un étudiant
    /*public function deleteForm($id){
        $p = Etudiants::find($id);
        return view('gestionnaire.delete', ['etudiants'=>$p]);


    $supprimer = Etudiants::findOrFail($id);
        $supprimer->delete($id);
        $request->session()->flash('etat', 'la suppression de l\'étudiant a été effectuée avec succès');
        return redirect()->route('gestionnaire.etudiant.index');
    }*/

    //supprimer un étudiant
    public function deleteEtudiant(Request $request, $id){
        DB::delete('delete from presences where etudiant_id = ?', [$id]);
        DB::delete('delete from cours_etudiants where etudiant_id = ?', [$id]);
        DB::delete('delete from etudiants where id = ?', [$id]);

        $request->session()->flash('etat', 'la suppresion de l\'etudiant a été effectuée avec succès');
        return redirect()->route('gestionnaire.etudiant.index');
    }

}
