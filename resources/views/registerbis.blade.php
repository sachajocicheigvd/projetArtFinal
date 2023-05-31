@extends('template')


@section('title')
<title>Mon Compte</title>
@endsection

@section('header')
<h1 class="page-header"><a href="">Mon compte</a></h1>
@endsection

@section('contenu')


<p>Continuons votre création de compte, {{$user->username}}</p>

<form method="post" action="{{route('registerbis')}}" accept-charset="UTF-8">
        @csrf
@foreach ($genres as $genre)
        <label for="{{$genre->name}}">{{$genre->name}} id: {{ $genre->id }} </label>
            <input type="checkbox" name="genres[]" id="{{$genre->name}}" value="{{ $genre->id }}" <?php 
            if (in_array($genre->id, $user->genres->pluck('id')->toArray())) {
                echo 'checked';
            }
            ?>>
            <br>
@endforeach
        <input type="submit" value="Valider">
</form>
@endsection

