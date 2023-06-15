<meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
   <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

    @extends('template')

    @section('title')
    <title>Live Chat</title>
    @endsection

    @section('header')
    <h1 class="page-header">Chat</h1>
    @endsection

    @section('contenu')
    @if (Auth::check())
    <div id="chatpopup"></div>
    @endif
   
    <div class="app" id="chatContainer">

        @guest
        <p>Vous devez être connecté.</p>
    
        @else
        <div class="row">
    
            <div class="col-sm-10 offset-sm-3 my-4 d-none" style="display:none">
                <input type="text" class="form-control" name="username" id="username" value="{{ Auth::user()->first_name }}">
            </div>
    
          
    
  <div class="presentation">
                 <img src="{{ asset('storage/images/saucisse9.png') }}" alt="Image de présentation">
                 <span class="espace">&nbsp;</span>
                 <div class ="presentationTexte">
                 <p class ="textePres">En live</p>
                 <p class = "textePres" id="titreEmissionEnDirect">Saucisse 9</p>
                 </div>
            </div>


        
     


            <div class="col-sm-6 offset-sm-3">
                <div class="box box-primary direct-chat direct-chat-primary">
            
    
                    <div class="box-body">
                  <div id="zonemess">
                        <div class="direct-chat-messages" id="messages" >
                       
                          @foreach($messages as $message)
    <div class="encadree {{ $message->user->id === Auth::user()->id ? 'monEncadree' : ''}}">
       
    <p  class="message {{ $message->user->id === Auth::user()->id ? 'moi' : '' }}">
       
        
            <strong class="user">{{$message->user->first_name}}</strong> {{ $message->content }}
                 @foreach($message->user->genres as $index => $genre)
            @if($index < 3)
            <div id="genresUtilisateurs">
                <p class="musique {{$genre->name}} genreMusiqueMessage"> <span>{{$genre->name}}</span></p>
            </div>
            @endif
        @endforeach
        </p>

        <strong id="minutesEnvoie"> {{ \Carbon\Carbon::parse($message->created_at)->format('H:i') }} </strong>
    </div>
@endforeach

            </div>
                        </div>

                            <form action="#" method="post" id="message_form">
                            <div class="input-group" id="messageAEnvoyer">
                                <input class="ecritMessage" type="text" name="message" id="message" placeholder="Envoyer un message" class="form-control">
                               
                                <span class="encadressBoutonEnvoie input-group-btn">
                                    <button type="submit" id="send_message" class="btn btn-primary btn-flat boutonEnvoieMessage">
                                         <svg id="boutonPourEnvoyer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" fill="currentColor" class="w-1000 h-1000">
                                        <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z" />
                                        </svg>
                                    </button>
                                </span>
                          
                        
                            </div>
                            </form>


                            
                            
                        </div>
                    </div>

             <div id="encadreeMessage">
    
                    <div class="box-footer">
                        
                        
                    </div>
    
                </div>
            </div>
    
        </div>
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