<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Task Assigned</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f0f0f5;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.7;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        .logo {
            display: block;
            margin: 0 auto;
            width: 150px;
            padding-bottom: 25px;
        }
        h1 {
            color: #222;
            font-size: 26px;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
        }
        p {
            color: #555;
            font-size: 16px;
            text-align: left;
            margin-bottom: 20px;
            text-align: justify;
        }
        .cta-button {
            display: block;
            background-color: #28a745;
            color: #ffffff;
            padding: 14px 25px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 18px;
            text-align: center;
            margin: 25px auto;
            width: max-content;
        }
        .cta-button:hover {
            background-color: #0056b3;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 30px;
        }
        a {
        color: #ffffff; /* Inherit the text color from the parent element */
        text-decoration: none; /* Remove the underline */
    }
    </style>
</head>
<body>
    <div class="email-container">
        <img src="{{ $message->embed(public_path('images/pepito-logo.png')) }}" alt="Pepito Logo" class="logo">

        <h1>New Task Assigned: {{ $task['task_topic'] }}</h1>

        <p>Dear Participant,</p>
        <p>You have been assigned a new task for the meeting titled "<strong>{{ $notulen->meeting_title }}</strong>". Please review the task details and complete it by the due date listed below.</p>

        <p><strong>Due Date:</strong> {{ $task['task_due_date'] }}</p>

        <a href="{{ $notulenUrl }}" class="cta-button" style="color: #ffffff; text-decoration: none;">View Task and Meeting Details</a>

        <p>Thank you for your dedication to the project and timely contributions.</p>
        <p>Best regards,<br>Pepito Meeting Coordination Team</p>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Pepito. All rights reserved.</p>
    </div>
</body>
</html>
