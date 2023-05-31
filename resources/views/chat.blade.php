
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @vite(['resources/css/app.css' , 'resources/js/app.js'])

    @extends('template')

    @section('title')
    <title>Live Chat</title>
    @endsection

    @section('header')
    <h1 class="page-header"><a href="">Accueil</a></h1>
    @endsection

    @section('contenu')
   
    <div class="app">

        @guest
        <p>Vous devez être connecté.</p>
    
        @else
        <div class="row">
    
            <div class="col-sm-6 offset-sm-3 my-2 d-none">
                <input type="text" class="form-control" name="username" id="username" value="{{ Auth::user()->first_name }}">
            </div>
    
            <div class="col-sm-6 offset-sm-3">
                <div class="box box-primary direct-chat direct-chat-primary">
    
                    <div class="box-body">
                        <div class="direct-chat-messages" id="messages"></div>
                    </div>
    
                    <div class="box-footer">
                        <form action="#" method="post" id="message_form">
                            <div class="input-group">
                                <input type="text" name="message" id="message" placeholder="Type Message ..." class="form-control">
                                <span class="input-group-btn">
                                    <button type="submit" id="send_message" class="btn btn-primary btn-flat">Send</button>
                                </span>
                            </div>
                        </form>
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
    </script>
    @endsection
@endguest