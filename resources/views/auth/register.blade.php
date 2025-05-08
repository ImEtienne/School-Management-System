@extends('modele')

@section('title', 'SignUp')

@section('contents')
    <div class="center">
        <h1>SignUp</h1>
        <form method="post">
            <div class="txt_field">
                <input type="text" name="login" value="{{old('login')}}" required>
                <span></span>
                <label> Login </label>
            </div>

            <div class="txt_field">
                <input type="text" name="nom" value="{{old('nom')}}" required>
                <span></span>
                <label> Nom </label>
            </div>

            <div class="txt_field">
                <input type="text" name="prenom" value="{{old('prenom')}}" required>
                <span></span>
                <label> Prénom </label>
            </div>

            <div class="txt_field">
                <input type="password" name="mdp" required>
                <span></span>
                <label> password </label>
            </div>

            <div class="txt_field">
                <input type="password" name="mdp_confirmation" required>
                <span></span>
                <label>Confirmation password </label>
            </div>

            <input type="submit" value="S'inscrire">
            @csrf
        </form>
    </div>
@endsection


