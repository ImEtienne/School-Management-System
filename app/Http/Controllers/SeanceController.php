<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Etudiants;
use App\Models\Presences;
use App\Models\Seances;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeanceController extends Controller
{
    //Affiche la liste des séances
    public function showSeance(){
        $cour = Cours::all();
        $etudiant = Etudiants::all();
        return view('gestionnaire.Seances.homeSeance', ['cours'=>$cour, 'etudiants'=>$etudiant]);
    }

    public function showSeanceCours(){
        $seance= Seances::all();
        return view('gestionnaire.Seances.index', ['seances'=>$seance]);
    }

    public function createForm($id){
        $cour = Cours::findOrFail($id);
        return view('gestionnaire.Seances.CreationSeance', ['cours'=>$cour]);
    }

    public function createSeance(Request $request){
        $request->validate([
            'cours' => 'required|string|max:40',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
        ]);
        $seance = new Seances();
        $seance->date_debut = $request->date_debut;
        $seance->date_fin = $request->date_fin;
        $seance->cours_id = $request->id;
        $seance->save();
        $request->session()->flash('etat', 'Séance crée avec succès');
        return redirect()->route('gestionnaire.seance.index');
    }

    public function searchEtudiant(){
        $q = request()->input('q');
        $etudiant = Etudiants::where('nom', 'like', "%$q%")->where('prenom', 'like', "%$q%")
            ->orwhere('noet', 'like', "%$q%")->paginate(5);
        return view('gestionnaire.index', ['etudiants'=>$etudiant]);
    }

    public function editFormSeance($id){
        $seance = Seances::findOrFail($id);
        return view('gestionnaire.Seances.editSeance', ['seances'=>$seance]);
    }

    //Modifier La date du debut et de la fin des séances
    public function editSeance(Request $request, $id){
        $validated=$request->validate([
            'cours' => 'required|string|max:40',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date'
        ]);
        $seance = Seances::findOrFail($id);
        $seance->date_debut = $validated['date_debut'];
        $seance->date_fin = $validated['date_fin'];
        $seance->cours_id=$validated['cours'];
        $seance->save();
        $request->session()->flash('etat', 'modification de la séance réussie');
        return redirect()->route('gestionnaire.seance.afficheList');
    }

    //Supprimer une séance
    public function deleteSeance(Request $request, $id){
        DB::delete('delete from presences where seance_id = ?', [$id]);
        $supprimer = Seances::findOrFail($id);
        $supprimer->delete($id);
        $request->session()->flash('etat', 'la suppression a été effectuée avec succès');
        return redirect()->route('gestionnaire.seance.afficheList');
    }
    /*$cour=DB::table('cours')
           -> where('id', $request->$id)
           -> update(['id' => $request->id]);*/
    //$request->session()->flash('etat', 'l\'étudiant' .$etudiant->nom. ' ' .$etudiant->prenom. ' ' .'a été attaché au cours'. ' '.$cour->intutile);

    //Liste des séances pour un cours
    public function showList(Request $request, $id){
        //$seance = DB::table('seances')->where('cours_id', '=', $id)->get();
        $seance = Seances::with('cours')->where('cours_id', $id)->get();
        return view('gestionnaire.Seances.afficheListSeanceUncours', ['seances'=>$seance]);
    }

    //Affiche le formulaire d'association des étudiants à un cours
    public function asssocieEtudantForm($id){
        $cour = Cours::findOrFail($id);
        $et = Etudiants::all();
        return view('gestionnaire.Seances.associeEtudiant',['cours'=>$cour, 'etudiants'=>$et]);
    }

    //Fais l'association unique à l'étudiant au cours
    public function associeEtudiant(Request $request){
        $request->validate([
            'intitule' => 'required', //l'intitulé du cours
            'id' => 'required', //l'ID du cours
            'id_etudiant' => 'required' // ID de l'étudiant
            ]);

        $etudiantsAssos = DB::table('cours_etudiants')->get();

        foreach( $etudiantsAssos as $asso) {
            if (($asso->cours_id == $request->id && $asso->etudiant_id == $request->id_etudiant)) {
                return back()->withErrors([
                    'errors' => 'Erreur: vous êtes déjà associé à ce cours'
                ]);
            }
        }
        $etudiant = Etudiants::where('id', $request->id_etudiant)->first();
        $cour = Cours::where('id', $request->id)->first();
        $etudiant->cours()->attach($cour);
        $etudiant->save();
        $request->session()->flash('etat', 'assignation réussie');
        return redirect()->route('gestionnaire.seance.index', ['cours'=>$cour, 'etudiants'=>$etudiant]);
    }

    //Dissocier Etudiant
    public function dissocierEtudiantForm(){
        $cour = Cours::all();
        $et = Etudiants::all();
        return view('gestionnaire.Seances.DissocierEtudiant',['cours'=>$cour, 'etudiants'=>$et]);
    }

    //Dissocier Etudiant
    public function dissocierEtudiant(Request $request){
        $etudiantsDiss = DB::table('cours_etudiants')->get();

        foreach( $etudiantsDiss as $asso) {
            if (($asso->cours_id == $request->id && $asso->etudiant_id == $request->id_etudiant)) {
                return back()->withErrors([
                    'errors' => 'Erreur: vous êtes déjà dissocié à ce cours'
                ]);
            }
        }

        $etudiant = Etudiants::where('id', $request->id_etudiant)->first();
        $cour = Cours::where('id', $request->cours_id)->first();
        $etudiant->cours()->detach($cour);
        $etudiant->save();
        $request->session()->flash('etat', 'Dissociation réussie');
        return redirect()->route('gestionnaire.seance.index');
    }


    //Affiche le formulaire d'association des enseignant
    public function asssocieEnseignantForm($id){ //fonction à revoir
        $cour = Cours::findOrFail($id);
        $user = User::where('type', '=', 'enseignant')->get();
        return view('gestionnaire.Seances.associeEnseignant',['cours'=>$cour, 'users'=>$user]);
    }

    //Fais l'associé unique à l'enseignant
    public function asssocieEnseignant(Request $request){
        $request->validate([
            'intitule' => 'required', //l'intitulé du cours
            'id' => 'required', //l'ID du cours
            'id_users' => 'required' // ID de l'étudiant
        ]);
        $enseignantsAssos = DB::table('cours_users')->get();

        foreach( $enseignantsAssos as $asso) {
            if (($asso->cours_id == $request->id && $asso->user_id == $request->id_users)) {
                return back()->withErrors([
                    'errors' => 'Erreur: vous êtes déjà associé à ce cours'
                ]);
            }
        }

        $user = User::where('id', $request->id_users)->first();
        $cour = Cours::where('id', $request->id)->first();
        $user->cours()->attach($cour);
        $user->save();
        $request->session()->flash('etat', 'assignation Enseignant cours réussie');
        return redirect()->route('gestionnaire.seance.index', ['cours'=>$cour, 'users'=>$user]);
    }

    //Dissocier Enseignant
    public function dissocierEnseignantForm(){
        $cour = Cours::all();
        $user = User::where('type', '=', 'enseignant')->get();
        return view('gestionnaire.Seances.DissocierEnseignant',['cours'=>$cour, 'users'=>$user]);
    }

    //Dissocier Enseignant
    public function dissocierEnseignant(Request $request){
        $enseignantsDiss = DB::table('cours_users')->get();

        foreach( $enseignantsDiss as $asso) {
            if (($asso->cours_id != $request->id && $asso->user_id != $request->id_users)) {
                return back()->withErrors([
                    'errors' => 'Erreur: vous êtes déjà Dissocié à ce cours'
                ]);
            }
        }

        $user = User::where('id', $request->id_users)->first();
        $cour = Cours::where('id', $request->id)->first();
        $user->cours()->detach($cour);
        $user->save();
        $request->session()->flash('etat', 'Dissociation Enseignant réussie');
        return redirect()->back();
    }

    //Liste des associations d'étudiants à un cours
    public function showListAssociation($id){ //affiche les associations d'étudiants pour un cours
        $cour = Cours::findOrFail($id);
        $et = $cour->Etudiants;
        return view('gestionnaire.showAssociationEtudiant', ['etudiants' =>$et, 'cours'=>$cour]);
    }

    //Liste des associations Enseignant à un cours
    public function showListAssociationEns($id){ //affiche les associations des enseignants pour un cours
        $cour = Cours::findOrFail($id);
        $et = $cour->User;
        return view('gestionnaire.Seances.listeUserEnseignant', ['users' =>$et, 'cours'=>$cour]);
    }

    //Liste des enseignants pour l'association
    public function ListeEnseignantPourAssociation(){
        $u = User::where('type', '=', 'enseignant')->get();
        return view('gestionnaire.Seances.listeUserEnseignant', ['users'=>$u]);
    }

    //Associer Plusieurs Etudiant d'un coup
    public function asssocieEtudantPlusieursForm(){
        $cour = Cours::all();
        $et = Etudiants::all();
        return view('gestionnaire.Seances.associeEtudiantPlusieurs',['cours'=>$cour, 'etudiants'=>$et]);
    }

    //Associer Plusieurs Etudiant d'un coup
    public function asssocieEtudantPlusieurs(Request $request){//la fonction fait bien l'association sauf que si l'étudiant est déjà associé, il y a une erreur
        $request->validate([
            //'intitule' => 'required', //l'intitulé du cours
            'id' => 'required', //l'ID du cours
            'id_etudiant' => 'required' // ID de l'étudiant
        ]);
        $etudiantsAssos = DB::table('cours_etudiants')->get();

        foreach( $etudiantsAssos as $asso) {
            if (($asso->cours_id == $request->id && $asso->etudiant_id == $request->id_etudiant)) {
                return back()->withErrors([
                    'errors' => 'Erreur: vous êtes déjà associé à ce cours'
                ]);
            }
        }

        $etudiants = Etudiants::findOrFail($request->id_etudiant);
        $cour = Cours::where('id', $request->id)->first();

            foreach($etudiants as $etudiant){
                $etudiant->cours()->attach($cour);
                $etudiant->save();
            }
        $request->session()->flash('etat', 'assignation plusieurs réussie');

        return redirect()->route('gestionnaire.seance.index', ['cours'=>$cour, 'etudiants'=>$etudiant]);
    }

    //Dissocier Plusieurs Etudiant d'un coup
    public function dissocieEtudantPlusieursForm(){
        $cour = Cours::all();
        $et = Etudiants::all();
        return view('gestionnaire.Seances.dissocieEtudiantPlusieurs',['cours'=>$cour, 'etudiants'=>$et]);
    }

    //Dissocier Plusieurs Etudiant d'un coup
    public function dissocieEtudantPlusieurs(Request $request){ // la fonction fait bien la dissociation sauf que si l'étudiant est déjà dissocié, il y a une erreur
        $request->validate([
            //'intitule' => 'required', //l'intitulé du cours
            'id' => 'required', //l'ID du cours
            'id_etudiant' => 'required' // ID de l'étudiant
        ]);
        $etudiantsDisso = DB::table('cours_etudiants')->get();

        foreach( $etudiantsDisso as $asso) {
            if (($asso->cours_id == $request->id && $asso->etudiant_id == $request->id_etudiant)) {
                return back()->withErrors([
                    'errors' => 'Erreur: vous êtes déjà dissocié à ce cours'
                ]);
            }
        }
        $etudiants = Etudiants::findOrFail($request->id_etudiant);
        $cour = Cours::where('id', $request->id)->first();
        foreach($etudiants as $etudiant){
            $etudiant->cours()->detach($cour);
            $etudiant->save();
        }
        $request->session()->flash('etat', 'plusieurs dissociations réussie');

        return redirect()->route('gestionnaire.seance.index');
    }

    //Liste de présences détaillée (par étudiant).
    public function showListePresenceDetaille($id){
        $etudiant = Etudiants::findOrFail($id);

        $presences = DB::table('presences')
            ->join('seances', 'presences.seance_id', '=', 'seances.id') // ← clé correcte ici
            ->join('cours', 'seances.cours_id', '=', 'cours.id')
            ->where('presences.etudiant_id', $id)
            ->select(
                'presences.*',
                'seances.date_debut',
                'seances.date_fin',
                'cours.intitule as intitule_cours'
            )
            ->get();

        return view('gestionnaire.Seances.presenceDetailleeParEtudiant', [
            'presences' => $presences,
            'etudiants' => $etudiant
        ]);
    }

    //Liste des présences (des étudiants) par séance.
    public function showListePresencesParSeance($id, Request $request){
        $s = Seances::findOrFail($id);

        $presences = DB::table('presences')
            ->join('etudiants', 'presences.etudiant_id', '=', 'etudiants.id')
            ->where('presences.seance_id', $id)
            ->select('presences.*', 'etudiants.nom', 'etudiants.prenom')
            ->get();

        return view('gestionnaire.Seances.presenceEtudiantParSeance', [
            'presences' => $presences,
            'seances' => $s
        ]);
    }

}

