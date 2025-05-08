<?php

namespace App\Http\Controllers;

use App\Models\Etudiants;
use App\Models\Seances;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EnseignantController extends Controller
{
    //Modifier le mot de passe enseignant
    public function editFormMdp(){
        return view('enseignant.account.editMdp');
    }

    //Modifier le mot de passe enseignant
    public function edit(Request $request){
        $request -> validate([
            'mdp_old' => 'required|string',
            'mdp' => 'required|string|confirmed'
        ]);
        $user = Auth::user();
        if(Hash::check($request->mdp_old, $user->mdp)){
            $user->fill(['mdp' => Hash::make($request->mdp)])->save();
            $request->session()->flash('etat', 'Mot de passe changé');
            return redirect()->route('enseignant.home');
        }
        $request->session()->flash('etat','votre mot de passe n\'est pas correct, Veuillez réessayer');

        return redirect()->route('enseignant.home');
    }

    //Moidifier le nom et prenom de l'enseignant
    public function editForm_NomPrenom($id){
        $edit = User::find($id);
        return view('enseignant.account.editNomPrenom', ['users'=>$edit]);
    }

    //Modifier le nom et prenom de l'enseignant
    public function editName(Request $request, $id){
        $validated=$request->validate([
            'nom'=>'required|alpha|max:50',
            'prenom'=>'required|string|max:265',
        ]);
        $user = User::findOrfail($id);
        $user->nom=$validated['nom'];
        $user->prenom=$validated['prenom'];
        $user->save();
        $request->session()->flash('etat', 'la modification a été effectuée avec succès');
        return redirect()->route('enseignant.home');
    }

    //Pointer un Etudiant
    public function pointageEtudiantForm($id){
        $seance = Seances::findOrFail($id);
        $etudiant = Etudiants::all();
        return view('enseignant.pointage.pointageEtudiant',['seances'=>$seance, 'etudiants'=>$etudiant]);
    }

    //Pointer Un étudiant
    public function pointageEtudiant(Request $request){
        $request->validate([
            'id' => 'required', //l'ID de la séance
            'id_etudiant' => 'required' // ID de l'étudiant
        ]);
        $etudiantsAssos = DB::table('presences')->get();

        foreach( $etudiantsAssos as $asso) {
            if (($asso->seance_id == $request->id && $asso->etudiant_id == $request->id_etudiant)) {
                return back()->withErrors([
                    'errors' => 'Erreur: vous êtes déjà pointé à ce cours'
                ]);
            }
        }
        $etudiant = Etudiants::where('id', $request->id_etudiant)->first();
        $seance = Seances::where('id', $request->id)->first();
        $etudiant->seances()->attach($seance);
        $etudiant->save();
        $request->session()->flash('etat', "Pointage réussie: " .$etudiant->nom. " ".$etudiant->prenom. " present pour la séance");
        return redirect()->back();
    }

    //Affiche la séance des cours
    public function showSeance(){
        $p = Seances::all();
        return view('enseignant.pointage.ListeSeanceCours', ['seances'=>$p]);
    }

    //Pointer Plusieurs étudiants
    public function pointageEtudiantPlusieursForm(){
        $seance = Seances::all();
        $etudiant = Etudiants::all();
        return view('enseignant.pointage.pointageEtudiantPlusieurs',['seances'=>$seance, 'etudiants'=>$etudiant]);
    }

    //Pointer Plusieurs étudiants
    public function pointageEtudiantPlusieurs(Request $request){// la fonction marche bien sauf qu'il ne gère pas le cas où l'étudiant a déjà été pointé dans la base de donnée
        $request->validate([
            'id' => 'required', //l'ID de la séance
            'id_etudiant' => 'required' // ID de l'étudiant
        ]);
        $etudiants = Etudiants::findOrFail($request->id_etudiant);
        $seance = Seances::where('id', $request->id)->first();
        foreach($etudiants as $etudiant){
            $etudiant->seances()->attach($seance);
            $etudiant->save();
        }
        $request->session()->flash('etat', "Pointage Plusieurs Etudiant réussie: présent pour la séance");
        return redirect()->back();
    }

    //Voir la liste des cours associés à un enseignant 1.1. Voir la liste des cours associés.
    public function showEnseignantList($id){
        $u = User::findOrFail($id);
        $g = $u->cours;
        return view('enseignant.VoirListeCoursEnseignant',['cours'=>$g]);
    }
}
