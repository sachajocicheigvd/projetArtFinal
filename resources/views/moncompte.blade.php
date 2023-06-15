@extends('template')

@section('title')
<title>Mon compte</title>
<link rel="stylesheet" href="{{ asset('public/css/monProfil.css') }}">
@endsection

@section('header')
<h1 class="page-header">Profil</h1>
<form method="post" action="{{ url('/logout') }}">
                      @csrf
<input type="submit" class="svgSubmit" value="">
</form>

@endsection

@section('contenu')
<input type="hidden" id="user-email" value="<?= $users->email ?>">
<form method="post" action="{{ url('/mon-compte') }}">
        @csrf
        <br/>
        <br/>
        @if ($messageModification)
                <div class="alert alert-modification">
                        {{ $messageModification }}
                </div>
        @endif
        <h2>{{ $users->username }}</h2>
        <p>{{ $users->first_name }} {{ $users->last_name }}</p>
        <input type="email" id="email" class="secondaire mailInput" name="email" placeholder="{{ $users->email }}"><br/>
        @error('email')
                <span class="error">{{ $message }}</span>
        @enderror<br/>
        <input type="password" id="password" class="secondaire passwordInput" name="password" placeholder="●●●●●●●●"><br/>
        @error('password')
                <span class="error">{{ $message }}</span>
        @enderror<br/>
        <button type="button" id="derouleur" class="secondaire collapsible">Genres Musicaux<svg id="boutonPlus" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="#767676" class="w-6 h-6" width="24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
        </button>
        <div class="content">
                <div class="containerForm">
                        <div class="containerGenre">
                                @foreach ($genres as $genre)
                                <div class="musique {{$genre->name}}">
                                        <label>
                                        <input type="checkbox" name="genres[]" value="{{ $genre->id }}" <?php 
                                        if (in_array($genre->id, $user->genres->pluck('id')->toArray())) {
                                                echo 'checked';
                                        }
                                        ?>>
                                        <span>{{ $genre->name }}</span>
                                        </label>
                                </div>
                                @endforeach
                        </div>
                </div>
        </div>
        <input class="primaire enregistrer" type="submit" value="Enregistrer">
        </form>
        @if (Auth::check() && Auth::user()->role_id == 2)
        <a href="/createadmin"><button class="addAdmin secondaire"> Crée Admin</button></a>
        @endif
<script>

        // Selectionne des éléments du DOM
        let coll = document.getElementsByClassName("collapsible");
        let svgElement = document.getElementById("boutonPlus");

        // Boucle sur les éléments du DOM
        for (let i = 0; i < coll.length; i++) {
                // Ajoute un événement au clic sur le bouton
                coll[i].addEventListener("click", function () {

                // Ajoute la classe "active" au bouton qui a été cliqué
                this.classList.toggle("active");

                // Récupère le contenu du bouton
                let content = this.nextElementSibling;

                if (content.style.maxHeight) {
                        content.style.maxHeight = null;
                        svgElement.style.stroke = "#767676";
                } else {
                        content.style.maxHeight = content.scrollHeight + "px";
                        svgElement.style.stroke = "#27eb42";
                }
                });
        }

        // Selectionne des éléments du DOM
        let emailUser = document.getElementById("user-email").value;
        let emailElement = document.getElementById("email");

        // Ajoute un événement au focus sur l'input
        emailElement.addEventListener("focus", function () {
        emailElement.removeAttribute("placeholder");
        });

        // Ajoute un événement au blur sur l'input
        emailElement.addEventListener("blur", function () {
        emailElement.setAttribute("placeholder", emailUser);
        });

        // Selectionne des éléments du DOM
        let passwordElement = document.getElementById("password");

        // Ajoute un événement au focus sur l'input
        passwordElement.addEventListener("focus", function () {
        passwordElement.removeAttribute("placeholder");
        });

        // Ajoute un événement au blur sur l'input
        passwordElement.addEventListener("blur", function () {
        passwordElement.setAttribute("placeholder", `●●●●●●●●`);
        });
</script>
@endsection

