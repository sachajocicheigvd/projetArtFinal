
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    @extends('template')

    @section('title')
    <title>Chat</title>
    @endsection

    @section('header')
    <h1 class="page-header"><a href="">Chat</a></h1>
    @endsection

    @section('contenu')
   
    <div class="sectionChat" class="app">

        @guest
        <p>Vous devez être connecté.</p>
    
        @else
        <div class="row">
    
            <div class="col-sm-10 offset-sm-3 my-4 d-none">
                <input type="text" class="form-control" name="username" id="username" value="{{ Auth::user()->first_name }}">
            </div>
    
            <div class="col-sm-6 offset-sm-3">
                <div class="box box-primary direct-chat direct-chat-primary">
            
    
                    <div class="box-body">
                        <div class="direct-chat-messages" id="messages">
                            @foreach($messages as $message)
                            <div class = "encadree">

                            @foreach($genres as $index => $genre)
                            @if($index < 3)
                              <p>{{ $genre->name }}</p>
                             @endif
                            @endforeach 
                            <p class="message" class="{{ $message->user->id === Auth::user()->id ? 'moi' : '' }}">
                                <strong class=user>{{$message->user->first_name}}</strong> {{ $message->content }}
                                <span class="text-muted">
                                    {{ \Carbon\Carbon::parse($message->created_at)->format('H:i') }}
                                </span>
                            </p>
                            </div>
                        @endforeach
                        
                            
                            
                        </div>
                    </div>
    
                    <div class="box-footer">
                        <form action="#" method="post" id="message_form">
                            <div class="input-group" id="messageAEnvoyer">
                                <input class="ecritMessage" type="text" name="message" id="message" placeholder="Envoyer un message" class="form-control">
                                <div class ="boutonPourEnvoyer">
                                <span class= "encadreeBoutonEnvoie" class="input-group-btn">
                                    <button type="submit" id="send_message" class="btn btn-primary btn-flat" class="boutonEnvoieMessage" > 
                                        <svg id = "boutonEnvoi" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" fill="currentColor" class="w-1000 h-1000">
                                        <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z" />
                                        </svg>
                                     </button>
                                </span>
                                </div>
                            </div>
                        </form>
                    </div>
    
                </div>
            </div>
    
        </div>
    </div>

<div id="player" class="flex-container">
  <div class="audio-info">
    <img id = "imgCover" src="imgSaucisse9.png" alt="Cover Image">
    <p id = "titreEmission" >Saucisse 9</p>
  </div>
  <audio id="audioPlayer" controls></audio>
   <svg id="playPauseButton" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
    <path fill-rule="evenodd" d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z" clip-rule="evenodd" />
  </svg>
</div>



    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        jQuery(document).ready(function() {
        // Scroll to the bottom of the direct chat messages container
        jQuery('#messages').scrollTop(jQuery('#messages')[0].scrollHeight);

        // Attach event handler to the messages container
        jQuery('#messages').on('DOMNodeInserted', function() {
            jQuery('#messages').scrollTop(jQuery('#messages')[0].scrollHeight);

            // Your code here
            // This code will be executed when a new element is inserted into the messages container
            // You can add your logic or function calls here
        });
    });
    </script>
    @endsection
@endguest