<!DOCTYPE html>
<html>
<head>
    <title>New Meeting Minutes Available</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            color: #555;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        p {
            line-height: 1.6;
            text-align: center;
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 150px; /* Adjust the size as needed */
        }
    </style>
</head>
<body>
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/pepito-logo.png'))) }}" alt="Company Logo" class="logo">
    
    <h1>Meeting Minutes: {{ $notulen->meeting_title }}</h1>
    <p>Dear Participant,</p>
    <p>We are pleased to inform you that the official meeting minutes for "<strong>{{ $notulen->meeting_title }}</strong>" have been finalized and are now available for your review.</p>
    <p>You have been added as a participant in the meeting minutes. The document includes a detailed summary of the meeting, covering key discussion points, decisions made, and any tasks assigned. It also contains information on other participants and guests, if applicable.</p>
    <p>Please review the attached document at your earliest convenience.</p>
    <p><a href="{{ $notulenUrl }}" class="cta-button">View Meeting Minutes</a></p>
    <p>Thank you for your participation and valuable contributions.</p>
    <p>Best regards,<br>Your Meeting Coordination Team</p>
</body>
</html>
