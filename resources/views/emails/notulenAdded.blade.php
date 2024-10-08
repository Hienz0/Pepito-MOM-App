<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Notulen Added</title>
</head>

<style>

a {
        color: #ffffff; /* Inherit the text color from the parent element */
        text-decoration: none; /* Remove the underline */
    }
</style>
<body>
    <h1>New Notulen Added</h1>
    <p>A new notulen has been added with the following details:</p>

    <p><strong>Meeting Title:</strong> {{ $notulen->meeting_title }}</p>
    <p><strong>Date:</strong> {{ $notulen->meeting_date }}</p>
    <p><strong>Time:</strong> {{ $notulen->meeting_time }}</p>
    <p><strong>Agenda:</strong> {{ $notulen->agenda }}</p>
    <p><strong>Discussion:</strong> {{ $notulen->discussion }}</p>
    <p><strong>Decisions:</strong> {{ $notulen->decisions }}</p>

    <h3>Participants:</h3>
    <ul>
        @foreach ($participants as $participant)
            <li>{{ $participant }}</li>
        @endforeach
    </ul>
</body>
</html>
