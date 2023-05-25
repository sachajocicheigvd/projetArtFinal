<!DOCTYPE html>
<head></head>
<html>
<body>

    @foreach ($users as $user)
        <p>Bonjour {{ $user->first_name }} {{ $user->last_name }}, vous avez l'id numéro {{ $user->id }}.
        </p>
    @endforeach

</body>
</html>