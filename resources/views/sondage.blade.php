@extends('template')
<head>
        @vite('resources/js/app.js')

</head>
@section('title')
<title>Sondage</title>
@endsection

@section('header')

<h1 class="page-header"><a href="">Sondage</a></h1>
@endsection

@section('contenu')
        <p>Vous êtes sur la page des sondages</p>
        <div id="app"></div>
@endsection
