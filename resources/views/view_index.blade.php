<!DOCTYPE html>
<head>
    @vite('resources/js/app.js')
</head>
<html>
<body>
<div id="app">
    @foreach ($users as $user)
        <p>Bonjour {{ $user->first_name }} {{ $user->last_name }}, vous avez l'id numéro {{ $user->id }}.
        </p>
    @endforeach
</div>
</body>
</html>