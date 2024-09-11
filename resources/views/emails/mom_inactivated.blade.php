<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoM Inactivated Notification</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f4f7;
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
            background-color: #26913f;
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

        <h1>Minutes of Meeting Inactivated: {{ $notulen->meeting_title }}</h1>

        <p>Hello,</p>
        <p>The Minutes of Meeting (MoM) titled "<strong>{{ $notulen->meeting_title }}</strong>", which was scheduled on <strong>{{ $notulen->meeting_date }}</strong>, has been inactivated. You can view the details using the link below.</p>

        <a href="{{ $inactivatedMoMUrl }}" class="cta-button" style="color: #ffffff; text-decoration: none;">View Inactivated MoM</a>

        <p>If you have any questions, please feel free to contact us.</p>

        <p>Thank you for your attention to this matter.</p>
        
        <p>Best regards,<br>Pepito Meeting Coordination Team</p>

    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Pepito. All rights reserved.</p>
    </div>
</body>
</html>
