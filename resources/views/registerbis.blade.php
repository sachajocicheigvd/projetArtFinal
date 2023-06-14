@extends('template')


@section('title')
<title>Mon Compte</title>
@endsection

@section('header')
<h1 class="page-header">Choisissez vos genres</h1>
@endsection

@section('contenu')

<p>Continuons la création de votre compte {{$user->username}}</p>
<div class="containerForm">
<form method="post" action="{{route('registerbis')}}" accept-charset="UTF-8">
        @csrf
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
        <input class="primaire validButton" type="submit" value="Créer le compte">
</div>
</form>
@endsection

