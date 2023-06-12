@extends('template')

@section('header')
<a href="">
        <svg class="iconUser" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
        </svg>
</a>
@endsection
@section('contenu')

<div class="rectangleEmission">
        <img class="imageEmission" src="{{ asset('storage/images/logoSaucisse9.svg') }}">
        <span class="nomEmission">Saucisse 9</span>
</div>
<div class="txt">
        <h1 id="rediffusions">Rediffusions</h1>
        <h3 id="nomEmissionAccueil">3ème Mi-Temps</h3>
</div>

<!-- slider emission 1 -->

<section id="slider">
        <input class="rectangleEmissionPetit" type="radio" name="slider" id="s1">
        <input class="rectangleEmissionPetit" type="radio" name="slider" id="s2">
        <input class="rectangleEmissionPetit" type="radio" name="slider" id="s3" checked>
        <input class="rectangleEmissionPetit" type="radio" name="slider" id="s4">
        <input class="rectangleEmissionPetit" type="radio" name="slider" id="s5">

        <label for="s1" id="slide1" class="rectangleEmissionPetit">
                <img class="imageEmissionPetit" src="{{ asset('storage/images/logo3MiTemps.svg') }}">
                <span class="dateEmissionPetit">14 mai 2023</span>
        </label>
        <label for="s2" id="slide2" class="rectangleEmissionPetit">
                <img class="imageEmissionPetit" src="{{ asset('storage/images/logo3MiTemps.svg') }}">
                <span class="dateEmissionPetit">12 mai 2023</span>
        </label>
        <label for="s3" id="slide3" class="rectangleEmissionPetit">
                <img class="imageEmissionPetit" src="{{ asset('storage/images/logo3MiTemps.svg') }}">
                <span class="dateEmissionPetit">9 mai 2023</span>
        </label>
        <label for="s4" id="slide4" class="rectangleEmissionPetit">
                <img class="imageEmissionPetit" src="{{ asset('storage/images/logo3MiTemps.svg') }}">
                <span class="dateEmissionPetit">6 mai 2023</span>
        </label>
        <label for="s5" id="slide5" class="rectangleEmissionPetit">
                <img class="imageEmissionPetit" src="{{ asset('storage/images/logo3MiTemps.svg') }}">
                <span class="dateEmissionPetit">2 mai 2023</span>
        </label>
</section>  
<!-- 

  <div class="rectangleEmissionPetit">
        <img class="imageEmissionPetit" src="{{ asset('storage/images/logoBrasCasse.svg') }}">
        <span class="dateEmissionPetit">14 mai 2023</span> -->



<style>
        .container {
                height: 0px;
        }
</style>



@endsection