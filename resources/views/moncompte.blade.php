@extends('template')


@section('title')
<title>Mon compte</title>
<link rel="stylesheet" href="{{ asset('resources/css/monProfil.css') }}">
<script src="{{ asset('resources/js/monProfil.js') }}" defer></script>
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
@endsection

