@extends('template')


@section('title')
<title>Mon compte</title>
@endsection

@section('header')
<h1 class="page-header">Profil</h1>
@vite('resources/css/buttons.css')
@endsection

@section('contenu')
        <h2>{{ $users->username }}</h2>
        <p>{{ $users->first_name }} {{ $users->last_name }}</p>
        <p>{{ $users->email }}</p>
        <button type="button" class="collapsible">Genres Musicaux</button>
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

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    }
  });
}
</script>
@endsection

