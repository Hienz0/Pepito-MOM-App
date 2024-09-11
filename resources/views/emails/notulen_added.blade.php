<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Meeting Minutes Notification</title>
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
            background-color: #218838;
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
        <!-- Directly embedded logo -->
        <img src="{{ $message->embed(public_path('images/pepito-logo.png')) }}" alt="Pepito Logo" class="logo">

        <h1>You've Been Added to New Meeting Minutes</h1>

        <p>Dear Participant,</p>
        <p>You have been added to the minutes of the meeting titled "<strong>{{ $notulen->meeting_title }}</strong>". You can review the full details by accessing the link below. A summary of the meeting, along with key decisions and tasks, is also attached for your reference.</p>

        <p>The document includes a summary of the discussions held, decisions made, and the tasks assigned to various participants. It also provides an overview of other attendees and guests involved in the meeting.</p>

        <a href="{{ $notulenUrl }}" class="cta-button" style="color: #ffffff; text-decoration: none;">Review Meeting Minutes</a>

        <p>Thank you for your involvement and contributions.</p>
        <p>Warm regards,<br>Pepito Meeting Coordination Team</p>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Pepito. All rights reserved.</p>
    </div>
</body>
</html>
