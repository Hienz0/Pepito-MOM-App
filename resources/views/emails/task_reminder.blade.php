<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Reminder</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f4f7;
            color: #555;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            color: #333;
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            color: #555;
            font-size: 16px;
            text-align: left;
            margin-bottom: 20px;
            text-align: justify;
        }
        ul {
            margin: 20px 0;
            padding: 0;
            list-style-type: none;
        }
        li {
            margin-bottom: 10px;
        }
        .cta-button {
            display: inline-block;
            background-color: #28a745;
            color: #ffffff;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            text-align: center;
            margin: 20px auto;
            display: block;
            width: max-content;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            margin-top: 20px;
        }
        a {
        color: #ffffff; /* Inherit the text color from the parent element */
        text-decoration: none; /* Remove the underline */
    }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Task Reminder: {{ ucfirst($reminderType) }}</h1>

        <p>Dear {{ $task->user->name ?? 'Valued User' }},</p>
        <p>This is a reminder that the following task is {{ $reminderType }}:</p>
        <ul>
            <li><strong>Task Topic:</strong> {{ $task->task_topic }}</li>
            <li><strong>Due Date:</strong> {{ $task->task_due_date }}</li>
            <li><strong>Description:</strong> {{ $task->description }}</li>
        </ul>
        <p>Please ensure that you complete the task as soon as possible.</p>
        <a href="{{ $notulenUrl }}" class="cta-button" style="color: #ffffff; text-decoration: none;">View Notulen Details</a>
        <p>Best regards,<br>Pepito Meeting Coordination Team</p>


    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Pepito. All rights reserved.</p>
    </div>
</body>
</html>
