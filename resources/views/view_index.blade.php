<!DOCTYPE html>
<head>
    @vite('resources/js/app.js')
</head>
<html>
<body>

    {{-- @foreach ($users as $user)
        <p>Bonjour {{ $user->first_name }} {{ $user->last_name }}, vous avez l'id numéro {{ $user->id }}.
        </p>
    @endforeach --}}

</body>
    <example-component>:x={{$users}}</example-component>
</html>