@extends('template')


@section('title')
<title>Mon compte</title>
@endsection

@section('header')
<h1 class="page-header">Profil</h1>
<svg xmlns="http://www.w3.org/2000/svg" id="porte" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#767676" class="w-6 h-6" width="35">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
</svg>
@endsection

@section('contenu')
        <h2>{{ $users->username }}</h2>
        <p>{{ $users->first_name }} {{ $users->last_name }}</p>
        <input type="email" id="email" class="secondaire mailInput" name="email" placeholder="{{$users->email}}"><br/>

        <button type="button" id="derouleur" class="collapsible">Genres Musicaux<svg id="boutonPlus" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="#767676" class="w-6 h-6" width="24">
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
        <script>

var coll = document.getElementsByClassName("collapsible");
var i;
var svgElement = document.getElementById('boutonPlus');

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
      svgElement.style.stroke = '#767676';
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
      svgElement.style.stroke = '#27eb42';
    }
  });
}

var inputElement = document.getElementById('email');

inputElement.addEventListener('focus', function() {
  inputElement.removeAttribute('placeholder');
});

inputElement.addEventListener('blur', function() {
  inputElement.setAttribute('placeholder', '{{$users->email}}');
});
</script>
@endsection

