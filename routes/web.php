<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\GestionnaireController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(Auth::check()){
        $type=Auth::User()->type;
        return view('home', ['type'=>$type]);
    } else {
        return view('home');
    }
});

Route::view('/home','home')->middleware('auth')
    ->name('home');

/*===================== Admin ============================*/
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::view('/admin', 'admin.home')->name('admin.home');
    Route::get('/admin/users/index', [UserController::class, 'show'])->name('admin.users.index');
    Route::get('/admin/users/indexAll', [UserController::class, 'showAll'])->name('admin.users.indexAll');
    Route::get('/admin/users/indexGestionnaire', [UserController::class, 'showGestionnaire'])->name('admin.users.indexGestionnaire');
    Route::get('/admin/users/indexEnseignant', [UserController::class, 'showEnseignant'])->name('admin.users.indexEnseignant');
    Route::get('/admin/users/search', [UserController::class, 'recherche'])->name('admin.users.search');
    Route::get('/admin/users/edit/{id}', [UserController::class, 'editForm'])->name('admin.users.edit');
    Route::post('/admin/users/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::get('/admin/users/delete/{id}', [UserController::class, 'deleteForm'])->name('admin.users.delete');
    Route::post('/admin/users/delete/{id}', [UserController::class, 'delete'])->name('admin.users.delete');
    Route::get('/admin/cours/index', [CoursController::class, 'show'])->name('admin.cours.index');
    Route::get('/admin/cours/add', [CoursController::class, 'addForm'])->name('admin.cours.add');
    Route::post('/admin/cours/add', [CoursController::class, 'add'])->name('admin.cours.add');
    Route::get('/admin/cours/searchIntitule', [CoursController::class, 'search'])->name('admin.cours.search');
    Route::get('/admin/cours/edit/{id}',[CoursController::class, 'editForm'])->name('admin.cours.edit');
    Route::post('/admin/cours/edit/{id}',[CoursController::class, 'edit'])->name('admin.cours.edit');
    Route::get('/admin/cours/delete/{id}',[CoursController::class, 'deleteForm'])->name('admin.cours.delete');
    //Route::post('/admin/cours/delete/{id}',[CoursController::class, 'delete'])->name('admin.cours.delete');
    Route::get('/admin/user/addAdmin', [UserController::class, 'addUserForm'])->name('admin.user.createAdmin');
    Route::post('/admin/user/addAdmin', [UserController::class, 'addUserAdmin'])->name('admin.user.createAdmin');
    Route::get('/admin/user/addEnseignant', [UserController::class, 'addUserForm'])->name('admin.user.createEnseignant');
    Route::post('/admin/user/addEnseignant', [UserController::class, 'addUserEnseignant'])->name('admin.user.createEnseignant');
    Route::get('/admin/user/addGestionnaire', [UserController::class, 'addUserForm'])->name('admin.user.createGestionnaire');
    Route::post('/admin/user/addGestionnaire', [UserController::class, 'addUserGestionnaire'])->name('admin.user.createGestionnaire');
    Route::get('/admin/editMdp',[UserController::class, 'editForm_Mdp'])->name('admin.account.edit');
    Route::post('/admin/editMdp',[UserController::class, 'editMdp'])->name('admin.account.edit');
    Route::get('/admin/editNonEtPrenom/{id}',[UserController::class, 'editFormNomPrenom'])->name('admin.account.editNomPrenom');
    Route::post('/admin/editNonEtPrenom/{id}',[UserController::class, 'editNomPrenom'])->name('admin.account.editNomPrenom');

});


/*====================== Enseignant =======================*/
Route::middleware(['auth', 'is_enseignant'])->group(function () {
    Route::view('/enseignant', 'enseignant.home')
        ->name('enseignant.home');
    Route::get('/enseignant/editMdp',[EnseignantController::class, 'editFormMdp'])->name('enseignant.account.edit');
    Route::post('/enseignant/editMdp',[EnseignantController::class, 'edit'])->name('enseignant.account.edit');
    Route::get('/enseignant/editNonPrenom/{id}',[EnseignantController::class, 'editForm_NomPrenom'])->name('enseignant.account.editNomPrenom');
    Route::post('/enseignant/editNonPrenom/{id}',[EnseignantController::class, 'editName'])->name('enseignant.account.editNomPrenom');
    Route::get('/enseignant/seance/AfficheListeSeance', [EnseignantController::class, 'showSeance'])->name('enseignant.showSeance');
    Route::get('/enseignant/seance/pointerUnEtudiant/{id}', [EnseignantController::class, 'pointageEtudiantForm'])->name('enseignant.pointer.etudiant');
    Route::post('/enseignant/seance/pointerUnEtudiant/{id}', [EnseignantController::class, 'pointageEtudiant'])->name('enseignant.pointer.etudiant');
    Route::get('/enseignant/seance/pointerUnEtudiantPlusieurs', [EnseignantController::class, 'pointageEtudiantPlusieursForm'])->name('enseignant.pointer.etudiantPlusieurs');
    Route::post('/enseignant/seance/pointerUnEtudiantPlusieurs', [EnseignantController::class, 'pointageEtudiantPlusieurs'])->name('enseignant.pointer.etudiantPlusieurs');
    Route::get('/enseignant/seance/showListeEnseignant/{id}', [EnseignantController::class,'showEnseignantList'])->name('gestionnaire.seance.ListEnseignant'); //1.1 voir les cours associés à l'enseignant (partie ens.)
});

/*===================== Gestionnaire =======================*/
Route::middleware(['auth', 'is_gestionnaire'])->group(function () {
    Route::view('/gestionnaire', 'gestionnaire.home')
        ->name('gestionnaire.home');
    Route::get('/gestionnaire/editMdp',[GestionnaireController::class, 'editFormMdp'])->name('gestionnaire.account.edit');
    Route::post('/gestionnaire/editMdp',[GestionnaireController::class, 'edit'])->name('gestionnaire.account.edit');
    Route::get('/gestionnaire/editNonEtPrenom/{id}',[GestionnaireController::class, 'editForm_NomPrenom'])->name('gestionnaire.account.editNomPrenom');
    Route::post('/gestionnaire/editNonEtPrenom/{id}',[GestionnaireController::class, 'editName'])->name('gestionnaire.account.editNomPrenom');
    Route::get('/gestionnaire/etudiant/index',[GestionnaireController::class, 'show'])->name('gestionnaire.etudiant.index');
    Route::get('/gestionnaire/etudiant/add',[GestionnaireController::class, 'addForm'])->name('gestionnaire.etudiant.add');
    Route::post('/gestionnaire/etudiant/add',[GestionnaireController::class, 'add'])->name('gestionnaire.edutiant.add');
    Route::get('/gestionnaire/etudiant/edit/{id}',[GestionnaireController::class, 'editForm'])->name('gestionnaire.etudiant.edit');
    Route::post('/gestionnaire/etudiant/edit/{id}',[GestionnaireController::class, 'editEtudiant'])->name('gestionnaire.edutiant.edit');
    Route::get('/gestionnaire/etudiant/delete/{id}',[GestionnaireController::class, 'deleteEtudiant'])->name('gestionnaire.etudiant.delete');
    //Route::post('/gestionnaire/etudiant/delete/{id}',[GestionnaireController::class, 'deleteEtudiant'])->name('gestionnaire.edutiant.delete');
    Route::get('/gestionnaire/etudiant/searchEtudiant', [SeanceController::class, 'searchEtudiant'])->name('gestionnaire.etudiant.search');
    Route::get('/gestionnaire/seances/index',[SeanceController::class, 'showSeance'])->name('gestionnaire.seance.index'); //Index de l'accueil
    Route::get('/gestionnaire/seance/create/{id}',[SeanceController::class, 'createForm'])->name('gestionnaire.seance.create');
    Route::post('/gestionnaire/seance/create/{id}',[SeanceController::class, 'createSeance'])->name('gestionnaire.seance.create');
    Route::get('/gestionnaire/seance/index',[SeanceController::class, 'showSeanceCours'])->name('gestionnaire.seance.afficheList');
    Route::get('/gestionnaire/seance/edit/{id}',[SeanceController::class, 'editFormSeance'])->name('gestionnaire.seance.edit');
    Route::post('/gestionnaire/seance/edit/{id}',[SeanceController::class, 'editSeance'])->name('gestionnaire.seance.edit');
    Route::get('/gestionnaire/seance/delete/{id}',[SeanceController::class, 'deleteSeance'])->name('gestionnaire.seance.delete');
    Route::get('/gestionnaire/seance/listePourUnCours/{id}',[SeanceController::class, 'showList'])->name('gestionnaire.seance.afficheListSeanceUncours');
    Route::get('/gestionnaire/seance/associeEtudiant/{id}',[SeanceController::class, 'asssocieEtudantForm'])->name('gestionnaire.etudiant.associe');
    Route::post('/gestionnaire/seance/associeEtudiant/{id}',[SeanceController::class, 'associeEtudiant'])->name('gestionnaire.etudiant.associe');
    Route::get('/gestionnaire/seance/showAssociationEtudiant/{id}', [SeanceController::class,'showListAssociation'])->name('gestionnaire.seance.showListAssociationEtudaint');
    Route::get('/gestionnaire/seance/ListeDesEnseignant', [SeanceController::class, 'ListeEnseignantPourAssociation'])->name('gestionnaire.liste.enseignant');//partie show liste enseignant
    Route::get('/gestionnaire/seance/DissocierEtudiant', [SeanceController::class, 'dissocierEtudiantForm'])->name('gestionnaire.dissocier');//partie dissocier etuddiant
    Route::post('/gestionnaire/seance/DissocierEtudiant', [SeanceController::class, 'dissocierEtudiant'])->name('gestionnaire.dissocier');
    Route::get('/gestionnaire/seance/associerEnseignant/{id}', [SeanceController::class, 'asssocieEnseignantForm'])->name('gestionnaire.associer.enseignant');//partie association enseignant
    Route::post('/gestionnaire/seance/associerEnseignant/{id}', [SeanceController::class, 'asssocieEnseignant'])->name('gestionnaire.associer.enseignant');
    Route::get('/gestionnaire/seance/dissocierEnseignant', [SeanceController::class, 'dissocierEnseignantForm'])->name('gestionnaire.dissocier.enseignant');//partie association enseignant
    Route::post('/gestionnaire/seance/dissocierEnseignant', [SeanceController::class, 'dissocierEnseignant'])->name('gestionnaire.dissocier.enseignant');
    Route::get('/gestionnaire/seance/showAssociationEnseignant/{id}', [SeanceController::class,'showListAssociationEns'])->name('gestionnaire.seance.showListAssociationEnseignant');
    Route::get('/gestionnaire/seance/associeEtudiantPlusieurs',[SeanceController::class, 'asssocieEtudantPlusieursForm'])->name('gestionnaire.etudiant.associePlusieurs');
    Route::post('/gestionnaire/seance/associeEtudiantPlusieurs',[SeanceController::class, 'asssocieEtudantPlusieurs'])->name('gestionnaire.etudiant.associePlusieurs');
    Route::get('/gestionnaire/seance/dissocieEtudiantPlusieurs',[SeanceController::class, 'dissocieEtudantPlusieursForm'])->name('gestionnaire.etudiant.dissociePlusieurs');
    Route::post('/gestionnaire/seance/dissocieEtudiantPlusieurs',[SeanceController::class, 'dissocieEtudantPlusieurs'])->name('gestionnaire.etudiant.dissociePlusieurs');
    Route::get('/gestionnaire/seance/listePresenceDetaille/{id}', [SeanceController::class,'showListePresenceDetaille'])->name('gestionnaire.listePresenceDetaille');
    Route::get('/gestionnaire/seance/listePresencesParSeance/{id}', [SeanceController::class,'showListePresencesParSeance'])->name('gestionnaire.listePresencesParSeance');
});


/*===================== Login & Logout ===========================*/
Route::get('/login', [AuthenticatedSessionController::class,'showForm'])
    ->name('login');
Route::post('/login', [AuthenticatedSessionController::class,'login']);
Route::get('/logout', [AuthenticatedSessionController::class,'logout'])
    ->name('logout')->middleware('auth');


/*============================= Register ========================*/
Route::get('/register', [RegisterUserController::class,'showForm'])
    ->name('register');
Route::post('/register', [RegisterUserController::class,'store']);
