<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minutes of Meeting Details</title>
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
        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 120px; /* Adjust the size as needed */
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
        <!-- Directly embedded logo -->
        <img src="{{ $message->embed(public_path('images/pepito-logo.png')) }}" alt="Company Logo" class="logo">
        
        <h1>Minutes of Meeting Distributed: {{ $notulen->meeting_title }}</h1>
        <p>Dear Participant,</p>
        <p>I hope this message finds you well. The latest update on the minutes of our recent meeting titled "<strong>{{ $notulen->meeting_title }}</strong>" is now available for your review.</p>
        <p>Please find the attached PDF file which includes a comprehensive summary of the meeting discussions, decisions, and action items. This document reflects the current state of the minutes of meeting.</p>
        <p>For more details, visit the <a href="{{ $notulenUrl }}" class="cta-button" style="color: #ffffff; text-decoration: none;">Review Meeting Minutes</a> page.</p>
        <p>Thank you for your attention to this matter.</p>
        <p>Best regards,<br>Pepito Meeting Coordination Team</p>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Pepito. All rights reserved.</p>
    </div>
</body>
</html>
