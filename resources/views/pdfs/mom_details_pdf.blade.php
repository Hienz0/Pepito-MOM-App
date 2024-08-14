<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minutes of Meeting Details</title>
</head>
<body>
    <h1>{{ $notulen->meeting_title }}</h1>
    <p><strong>Department:</strong> {{ $notulen->department }}</p>
    <p><strong>Date:</strong> {{ $notulen->meeting_date }}</p>
    <p><strong>Time:</strong> {{ $notulen->meeting_time }}</p>
    <p><strong>Location:</strong> {{ $notulen->meeting_location }}</p>
    <p><strong>Scripter:</strong> {{ $notulen->scripter->name }}</p>
    <p><strong>Agenda:</strong> {{ $notulen->agenda }}</p>
    <p><strong>Discussion:</strong> {{ $notulen->discussion }}</p>
    <p><strong>Decisions:</strong> {{ $notulen->decisions }}</p>
    <p><strong>Tasks:</strong></p>
    <ul>
        @foreach ($notulen->tasks as $task)
            <li>{{ $task->task_topic }} - {{ $task->status }}</li>
        @endforeach
    </ul>
    <p><strong>Participants:</strong></p>
    <ul>
        @foreach ($notulen->participants as $participant)
            <li>{{ $participant->name }}</li>
        @endforeach
    </ul>
    <p><strong>Guests:</strong></p>
    <ul>
        @foreach ($notulen->guests as $guest)
            <li>{{ $guest->name }}</li>
        @endforeach
    </ul>
</body>
</html>
