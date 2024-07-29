<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Reminder</title>
</head>
<body>
    <h1>Task Reminder: {{ ucfirst($reminderType) }}</h1>
    <p>Dear {{ $task->user->name }},</p>
    <p>This is a reminder that the following task is {{ $reminderType }}:</p>
    <ul>
        <li><strong>Task Topic:</strong> {{ $task->task_topic }}</li>
        <li><strong>Due Date:</strong> {{ $task->task_due_date }}</li>
        <li><strong>Description:</strong> {{ $task->description }}</li>
    </ul>
    <p>Please ensure that you complete the task as soon as possible.</p>
    <p>For more details, visit the <a href="{{ $notulenUrl }}">Notulen Details</a> page.</p>
    <p>Thank you.</p>
</body>
</html>
