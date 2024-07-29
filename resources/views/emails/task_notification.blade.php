<!DOCTYPE html>
<html>
<head>
    <title>New Task Assigned</title>
</head>
<body>
    <h1>{{ $task['task_topic'] }}</h1>
    <p>You have been assigned a new task for the meeting "{{ $notulen->meeting_title }}"</p>
    <p>Due Date: {{ $task['task_due_date'] }}</p>
    <p>
        <a href="{{ $notulenUrl }}">View Meeting Details and Task</a>
    </p>
</body>
</html>
