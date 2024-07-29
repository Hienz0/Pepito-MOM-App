<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Notification</title>
</head>
<body>
    <p>Hello {{ $task->user->name }},</p>
    <p>{{ $message }}</p>
    <p>Task: {{ $task->task_topic }}</p>
    <p>Due Date: {{ $task->task_due_date }}</p>
    <p>Status: {{ $task->status }}</p>
</body>
</html>
