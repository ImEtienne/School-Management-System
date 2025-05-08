@extends('modele')
@section('title', 'Login')
@section('contents')
    <div class="center">
        <h1>login</h1>
        <form method="post">
            <div class="txt_field">
                <input type="text" name="login" value="{{old('login')}}" required>
                <span></span>
                <label> Login </label>
            </div>

            <div class="txt_field">
                <input type="password" name="mdp" required>
                <span></span>
                <label> password </label>
            </div>

            <div class="pass">Forgot Password ?</div>
            <input type="submit" value="Connexion">
            <div class="signup_link">
                <p>Not a member ? <a href="{{route('register')}}">Signup</a></p>
            </div>
            @csrf
        </form>
    </div>
@endsection


