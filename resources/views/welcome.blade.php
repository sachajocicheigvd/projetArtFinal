

@extends('template')

@section('title')
<title>Accueil</title>
@vite('resources/js/essaipopup.js')
@endsection

@section('header')
<h1 class="page-header"><a href="">Accueil</a></h1>
@vite('resources/js/essaipopup.js')

@vite('resources/js/components/PopupComponent.vue')
@endsection

@section('contenu')
        <p>Vous êtes à l'accueil du site</p>
        <button type="button" class="btn btnjorane">Primary</button>
        <div id="app">
    <popup-component>
        <p>Ciao bello</p>
    </popup-component>
</div>

  <!-- Scripts JS -->
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
@endsection
 