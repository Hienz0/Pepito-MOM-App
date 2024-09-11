<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Meeting Minutes Created</title>
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

        <h1>You've Been Added to New Meeting Minutes</h1>

        <p>Dear Guest,</p>
        <p>The meeting minutes for "<strong>{{ $notulen->meeting_title }}</strong>" have been created and finalized. You will find the minutes attached to this email for your review.</p>

        <p>Please take a moment to go through the document, which includes a detailed summary of discussions, key decisions, and tasks assigned during the meeting.</p>

        <p>Thank you for your participation and contributions.</p>
        <p>Best regards,<br>Pepito Meeting Coordination Team</p>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Pepito. All rights reserved.</p>
    </div>
</body>
</html>
