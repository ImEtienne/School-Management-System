<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //affiche type null
    public function show(){
        $user = User::where('type', '=', null)->get();
        return view('admin.users.index', ['users'=>$user]);
    }

    //filtre all users
    public function showAll(){
        $user = User::all();
        return view('admin.users.index', ['users'=>$user]);
    }

    //filtre gestionnaire
    public function showGestionnaire(){
        $user = User::where('type', '=', 'gestionnaire')->get();;
        return view('admin.users.index', ['users'=>$user]);
    }

    //filtre enseignant
    public function showEnseignant(){
        $user = User::where('type', '=', 'enseignant')->get();
        return view('admin.users.index', ['users'=>$user]);
    }

    //Recherche par nom et prenom pour l'admin
    public function recherche(){
        $q = request()->input('q');
        $user = User::where('login', 'like', "%$q%")->where('nom', 'like', "%$q%")
                    ->orwhere('prenom', 'like', "%$q%")->get();
        return view('admin.users.index', ['users'=>$user]);
    }

    //Modifier le nom et prenom de l'admin
    public function editFormNomPrenom($id){
        $edit = User::find($id);
        return view('admin.account.editNomPrenom', ['users'=>$edit]);
    }

    //Modifier le mot de passe admin
    public function editForm_Mdp(){
        return view('admin.account.editMdp');
    }

    //modifier le mot de passe admin
    public function editMdp(Request $request){
        $request -> validate([
            'mdp_old' => 'required|string',
            'mdp' => 'required|string|confirmed'
        ]);
        $user = Auth::user();
        if(Hash::check($request->mdp_old, $user->mdp)){
            $user->fill(['mdp' => Hash::make($request->mdp)])->save();
            $request->session()->flash('etat', 'Mot de passe changé');
            return redirect()->route('admin.home');
        }
        $request->session()->flash('etat','votre mot de passe n\'est pas correct, Veuillez réessayer');

        return redirect()->route('admin.home');
    }

    //Modifier le nom et prenom de l'admin
    public function editNomPrenom(Request $request, $id){
        $validated=$request->validate([
           'nom'=>'required|alpha|max:50',
            'prenom'=>'required|string|max:265',
        ]);
        $user = User::find($id);
        $user->nom=$validated['nom'];
        $user->prenom=$validated['prenom'];
        $user->save();
        $request->session()->flash('etat', 'la modification a été effectuée avec succès !!!!');
        return redirect()->route('admin.home',['users' => $user]);
    }

    //Refuser ou accepter un user auto-crée
    public function editForm($id){
        $user = User::find($id);
        return view('admin.users.edit', ['users' => $user]);
    }

    //Refuser ou accepter un user auto-crée
    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if($request->has('Accepter')){
            $validated = $request->validate([
                'nom' => 'required|alpha|max:50',
                'prenom' => 'required|alpha|max:50',
                'type' => 'required|string'
            ]);

            $user->nom = $validated['nom'];
            $user->prenom = $validated['prenom'];

            if ($validated['type'] == 'admin' && empty($request->input('admin'))) {
                $user->type = $request->input('admin');
            } else if ($validated['type'] == 'enseignant' && empty($request->input('enseignant'))) {
                $user->type = $request->input('enseignant');
            } elseif ($validated['type'] == 'gestionnaire' && empty($request->input('gestionnaire'))) {
                $user->type = $request->input('gestionnaire');
            } else {
                return back()->withErrors([
                    'errors' => 'Erreur: action refusée'
                ]);
            }
            $user->type = $validated['type'];
            $user->save();
            $request->session()->flash('etat', 'modification effectuéé. Utilisateur validé !');
            //return view('mod_form',['nom' => $user]);

        }elseif($request->has('Refuser')) {
            $user->delete($id);
            $request->session()->flash('etat', 'Refusé: Utilisateur supprimé');

        }else{
            $request->session()->flash('etat', 'Aucune action effectuée' );
        }
        return redirect()->route('admin.users.index', ['id'=>$user->id]);
    }

    //supprimer user
    public function deleteForm($id){
        $p = User::find($id);
        return view('admin.users.delete', ['users'=>$p]);
    }

    //supprimer user
    public function delete(Request $request, $id){
        $supprimer = User::findOrFail($id);

        if($request->has('Supprimer')){
            $supprimer->delete($id);
            $request->session()->flash('etat', 'la suppression a été effectuée avec succès');
        } else {
            $request->session()->flash('etat', 'Supprission annulée' );
        }
        return redirect()->route('admin.users.index');
    }

    //form register
    public function addUserForm(){
        return view('auth.AddUser');
    }

    //create user admin
    public function addUserAdmin(Request $request){
        $request->validate([
            'login' => 'required|string|max:255|unique:users',
            'nom'=>'required|string|max:255',
            'prenom'=>'required|string',
            'mdp' => 'required|string|confirmed'//|min:8',
        ]);

        $user = new User();
        $user->login = $request->login;
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->mdp = Hash::make($request->mdp);
        $user->type= 'admin';
        $user->save();

        session()->flash('etat','Utilisateur admin ajouté avec succès !');

        return redirect()->route('admin.users.index');
    }

    //create user gestionnaire
    public function addUserGestionnaire(Request $request){
        $request->validate([
            'login' => 'required|string|max:255|unique:users',
            'nom'=>'required|string|max:255',
            'prenom'=>'required|string',
            'mdp' => 'required|string|confirmed'//|min:8',
        ]);

        $user = new User();
        $user->login = $request->login;
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->mdp = Hash::make($request->mdp);
        $user->type= 'gestionnaire';
        $user->save();

        session()->flash('etat','AUtilisateur gestionnaire ajouté avec succès !');

        return redirect()->route('admin.users.index');
    }

    //create user enseignant
    public function addUserEnseignant(Request $request){
        $request->validate([
            'login' => 'required|string|max:255|unique:users',
            'nom'=>'required|string|max:255',
            'prenom'=>'required|string',
            'mdp' => 'required|string|confirmed'//|min:8',
        ]);

        $user = new User();
        $user->login = $request->login;
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->mdp = Hash::make($request->mdp);
        $user->type= 'enseignant';
        $user->save();

        session()->flash('etat','Utilisateur enseignant ajouté avec succès !');

        return redirect()->route('admin.users.index');
    }
}
