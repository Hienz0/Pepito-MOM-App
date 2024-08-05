<!DOCTYPE html>
<html>
<head>
    <title>New Notulen Created</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        p {
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <h1>Meeting Minutes: {{ $notulen->meeting_title }}</h1>
    <p><strong>Date:</strong> {{ $notulen->meeting_date }}</p>
    <p><strong>Time:</strong> {{ $notulen->meeting_time }}</p>
    <p><strong>Agenda:</strong> {{ $notulen->agenda }}</p>
    <p><strong>Discussion:</strong> {{ $notulen->discussion }}</p>
    <p><strong>Decisions:</strong> {{ $notulen->decisions }}</p>
    
    <p>Thank you for your participation.</p>
</body>
</html>
