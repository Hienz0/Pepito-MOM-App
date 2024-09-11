<!DOCTYPE html>
<html>

<head>
    <title>Meeting Minutes: {{ $notulen->meeting_title }}</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            color: #333;
            background-color: #f0f0f5;
            padding: 30px;
            margin: 0;
        }

        .container {
            max-width: 850px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
            position: relative;
        }

        h1 {
            color: #1c4e80;
            font-size: 32px;
            margin-bottom: 10px; /* Reduced to make space for date/time */
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .meeting-info {
            /* position: absolute; */
            top: 100px;
            right: 40px;
            text-align: right;
            font-size: 14px;
            color: #666;
        }

        .meeting-info p {
            margin: 0;
        }

        h2 {
            color: #2d3e50;
            font-size: 24px;
            margin-top: 30px;
            border-bottom: 2px solid #22c55e;
            padding-bottom: 8px;
        }

        p {
            font-size: 16px;
            line-height: 1.8;
            margin: 10px 0;
        }

        table {
            width: 100%;
            margin-top: 25px;
            border-collapse: collapse; /* Changed to make tables fit better */
            border-spacing: 0;
            font-size: 12px; /* Reduced overall table font size */
        }

        th,
        td {
            padding: 8px; /* Reduced padding */
            border: 1px solid #e2e2e2;
            text-align: left;
            vertical-align: middle;
            font-size: 12px; /* Reduced font size */
        }

        th {
            background-color: #02A34A;
            color: white;
            font-size: 14px; /* Slightly larger for headers */
            letter-spacing: 1px;
        }

        td {
            background-color: #f9f9f9;
        }

        .status-complete {
            color: #2ecc71;
            font-weight: bold;
        }

        .status-in-progress {
            color: #f39c12;
            font-weight: bold;
        }

        .status-due-today {
            color: #e74c3c;
            font-weight: bold;
        }

        .status-past-due {
            color: #c0392b;
            font-weight: bold;
        }

        .center {
            text-align: center;
            margin-top: 50px;
            font-style: italic;
        }

        .logo {
            float: right;
            width: 120px;
            position: fixed;
            right: 30px;
            top: 50px;
        }

        .highlight {
            background-color: #effaf5;
            border-left: 6px solid #16a34a;
            padding: 15px;
            margin: 15px 0;
        }

        .shadow-box {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        .rounded-corners {
            border-radius: 12px;
            overflow: hidden;
        }

        a {
            color: #ffffff; /* Inherit the text color from the parent element */
            text-decoration: none; /* Remove the underline */
        }

        .timestamp {
            /* position: absolute; */
            bottom: 20px;
            right: 40px;
            font-size: 12px;
            color: #555;
            text-align: right;
        }

        .no-page-break {
    page-break-inside: avoid;
}

    </style>
</head>

<body>
    <div class="container">
        <img src="{{ public_path('images/pepito-logo.png') }}" alt="Pepito Logo" class="logo">
        <h1>MoM of: {{ $notulen->meeting_title }}</h1>

        <!-- Date and Time moved to top right -->
        <div class="meeting-info">
            <p><strong>{{ \Carbon\Carbon::parse($notulen->meeting_date)->format('F j, Y') }}</strong></p>
            <p><strong>{{ \Carbon\Carbon::parse($notulen->meeting_time)->format('h:i A') }}</strong></p>
        </div>

        <h2>Meeting Details</h2>
        {{-- <div class="highlight"> --}}
        <div class="">
            <p><strong>Department:</strong>
                @if (is_array(json_decode($notulen->department)))
                    {{ implode(', ', json_decode($notulen->department)) }}
                @else
                    {{ $notulen->department }}
                @endif
            </p>
            <p><strong>Location:</strong> {{ $notulen->meeting_location }}</p>

            <p><strong>Agenda:</strong> <br>{!! nl2br(e($notulen->agenda)) !!}</p>
        </div>
        <p><strong>Discussion:</strong> <br>{!! nl2br(e($notulen->discussion)) !!}</p>
        <p><strong style="margin-top: 20px;">Decisions:</strong> <br>{!! nl2br(e($notulen->decisions)) !!}</p>

        @if ($notulen->participants && count($notulen->participants) > 0)
        <div class="no-page-break">

            <h2>Participants</h2>
            <div class="">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notulen->participants as $participant)
                            <tr>
                                <td>{{ $participant->name }}</td>
                                <td>{{ $participant->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @endif

        @if ($notulen->guests && count($notulen->guests) > 0)
        {{-- <div class="no-page-break"> --}}
        <div class="">

            <h2>Guests</h2>
            <div class="">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notulen->guests as $guest)
                            <tr>
                                <td>{{ $guest->name }}</td>
                                <td>{{ $guest->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @endif

        @if ($notulen->tasks && count($notulen->tasks) > 0)
            <h2>Tasks</h2>
            <div class="">
                <table>
                    <thead>
                        <tr>
                            <th>Topic</th>
                            <th>PIC</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Completion</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notulen->tasks as $task)
                        <tr>
                            <td>{{ $task->task_topic }}</td>
                            <td>
                                @php
                                    // Decode the task_pic field (internal users)
                                    $taskPics = json_decode($task->task_pic, true);
                                    $taskPics = is_array($taskPics) ? $taskPics : [];
                    
                                    // Fetch names of internal users
                                    $picNames = App\Models\User::whereIn('id', $taskPics)->pluck('name')->toArray();
                    
                                    // Decode the guest_pic field (guest users)
                                    $guestPics = json_decode($task->guest_pic, true);
                                    $guestPics = is_array($guestPics) ? $guestPics : [];
                    
                                    // Fetch names of guest users and append "(Guest)" to each guest name
                                    $guestNames = App\Models\Guest::whereIn('id', $guestPics)->pluck('name')->map(function($name) {
                                        return $name . ' (Guest)';
                                    })->toArray();
                    
                                    // Combine internal and guest names
                                    $allNames = array_merge($picNames, $guestNames);
                    
                                    // Output the combined names as a comma-separated string
                                    echo implode(', ', $allNames);
                                @endphp
                            </td>
                            <td>{{ \Carbon\Carbon::parse($task->task_due_date)->format('F j, Y') }}</td>
                            <td class="{{ $task->status === 'Complete' ? 'status-complete' : ($task->status === 'In Progress' ? 'status-in-progress' : ($task->status === 'Due Today' ? 'status-due-today' : ($task->status === 'Past Due' ? 'status-past-due' : ''))) }}">
                                {{ $task->status }}
                            </td>
                            <td>{{ $task->completion }}</td>
                            <td>{{ $task->description }}</td>
                        </tr>
                    @endforeach
                    
                    </tbody>
                </table>
            </div>
        @endif


        <p class="center">Thank you for your participation.</p>
                        <!-- Timestamp -->
                        <p class="timestamp">
                            Minutes of Meeting submitted at: <br>
                            {{ \Carbon\Carbon::parse($notulen->created_at)->format('F j, Y h:i A') }}
                        </p>
        
    </div>
</body>

</html>



{{-- <!DOCTYPE html>
<html>

<head>
    <title>Meeting Minutes: {{ $notulen->meeting_title }}</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            color: #333;
            background-color: #f0f0f5;
            padding: 30px;
            margin: 0;
        }

        .container {
            max-width: 850px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
            position: relative;
        }

        h1 {
            color: #1c4e80;
            font-size: 32px;
            margin-bottom: 10px; /* Reduced to make space for date/time */
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .meeting-info {
            position: absolute;
            top: 100px;
            right: 40px;
            text-align: right;
            font-size: 14px;
            color: #666;
        }

        .meeting-info p {
            margin: 0;
        }

        h2 {
            color: #2d3e50;
            font-size: 24px;
            margin-top: 30px;
            border-bottom: 2px solid #22c55e;
            padding-bottom: 8px;
        }

        p {
            font-size: 16px;
            line-height: 1.8;
            margin: 10px 0;
        }

        table {
            width: 100%;
            margin-top: 25px;
            border-collapse: collapse; /* Changed to make tables fit better */
            border-spacing: 0;
            font-size: 12px; /* Reduced overall table font size */
        }

        th,
        td {
            padding: 8px; /* Reduced padding */
            border: 1px solid #e2e2e2;
            text-align: left;
            vertical-align: middle;
            font-size: 12px; /* Reduced font size */
        }

        th {
            background-color: #02A34A;
            color: white;
            font-size: 14px; /* Slightly larger for headers */
            letter-spacing: 1px;
        }

        td {
            background-color: #f9f9f9;
        }

        .status-complete {
            color: #2ecc71;
            font-weight: bold;
        }

        .status-in-progress {
            color: #f39c12;
            font-weight: bold;
        }

        .status-due-today {
            color: #e74c3c;
            font-weight: bold;
        }

        .status-past-due {
            color: #c0392b;
            font-weight: bold;
        }

        .center {
            text-align: center;
            margin-top: 50px;
            font-style: italic;
        }

        .logo {
            float: right;
            width: 120px;
            position: absolute;
            right: 30px;
            top: 50px;
        }

        .highlight {
            background-color: #effaf5;
            border-left: 6px solid #16a34a;
            padding: 15px;
            margin: 15px 0;
        }

        .shadow-box {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        .rounded-corners {
            border-radius: 12px;
            overflow: hidden;
        }

        a {
            color: #ffffff; /* Inherit the text color from the parent element */
            text-decoration: none; /* Remove the underline */
        }

        .timestamp {
            /* position: absolute; */
            bottom: 20px;
            right: 40px;
            font-size: 12px;
            color: #555;
            text-align: right;
        }

        .section-without-break {
    page-break-inside: avoid;
}

.heading-no-break {
    page-break-before: always;
}

.first-row-no-break {
    page-break-inside: avoid;
}


    </style>
</head>

<body>
    <div class="container">
        <img src="{{ public_path('images/pepito-logo.png') }}" alt="Pepito Logo" class="logo">
        <h1>MoM of: {{ $notulen->meeting_title }}</h1>

        <!-- Date and Time moved to top right -->
        <div class="meeting-info">
            <p><strong>{{ \Carbon\Carbon::parse($notulen->meeting_date)->format('F j, Y') }}</strong></p>
            <p><strong>{{ \Carbon\Carbon::parse($notulen->meeting_time)->format('h:i A') }}</strong></p>
        </div>

        <h2>Meeting Details</h2>
        {{-- <div class="highlight"> --}}
        {{-- <div class="">
            <p><strong>Department:</strong>
                @if (is_array(json_decode($notulen->department)))
                    {{ implode(', ', json_decode($notulen->department)) }}
                @else
                    {{ $notulen->department }}
                @endif
            </p>
            <p><strong>Location:</strong> {{ $notulen->meeting_location }}</p>

            <p><strong>Agenda:</strong> <br>{!! nl2br(e($notulen->agenda)) !!}</p>
        </div>
        <p><strong>Discussion:</strong> <br>{!! nl2br(e($notulen->discussion)) !!}</p>
        <p><strong style="margin-top: 20px;">Decisions:</strong> <br>{!! nl2br(e($notulen->decisions)) !!}</p>

        @if ($notulen->participants && count($notulen->participants) > 0)
        <div class="no-page-break">

            <h2>Participants</h2>
            <div class="">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notulen->participants as $participant)
                            <tr>
                                <td>{{ $participant->name }}</td>
                                <td>{{ $participant->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @endif
        @if ($notulen->guests && count($notulen->guests) > 0)
        <div class="section-without-break">
            <h2 class="heading-no-break">Guests</h2>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notulen->guests as $index => $guest)
                            @if ($index === 0)
                                <tr class="first-row-no-break">
                            @else
                                <tr>
                            @endif
                                    <td>{{ $guest->name }}</td>
                                    <td>{{ $guest->email }}</td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    

        @if ($notulen->tasks && count($notulen->tasks) > 0)
            <h2>Tasks</h2>
            <div class="">
                <table>
                    <thead>
                        <tr>
                            <th>Topic</th>
                            <th>PIC</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Completion</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notulen->tasks as $task)
                        <tr>
                            <td>{{ $task->task_topic }}</td>
                            <td>
                                @php
                                    // Decode the task_pic field (internal users)
                                    $taskPics = json_decode($task->task_pic, true);
                                    $taskPics = is_array($taskPics) ? $taskPics : [];
                    
                                    // Fetch names of internal users
                                    $picNames = App\Models\User::whereIn('id', $taskPics)->pluck('name')->toArray();
                    
                                    // Decode the guest_pic field (guest users)
                                    $guestPics = json_decode($task->guest_pic, true);
                                    $guestPics = is_array($guestPics) ? $guestPics : [];
                    
                                    // Fetch names of guest users and append "(Guest)" to each guest name
                                    $guestNames = App\Models\Guest::whereIn('id', $guestPics)->pluck('name')->map(function($name) {
                                        return $name . ' (Guest)';
                                    })->toArray();
                    
                                    // Combine internal and guest names
                                    $allNames = array_merge($picNames, $guestNames);
                    
                                    // Output the combined names as a comma-separated string
                                    echo implode(', ', $allNames);
                                @endphp
                            </td>
                            <td>{{ \Carbon\Carbon::parse($task->task_due_date)->format('F j, Y') }}</td>
                            <td class="{{ $task->status === 'Complete' ? 'status-complete' : ($task->status === 'In Progress' ? 'status-in-progress' : ($task->status === 'Due Today' ? 'status-due-today' : ($task->status === 'Past Due' ? 'status-past-due' : ''))) }}">
                                {{ $task->status }}
                            </td>
                            <td>{{ $task->completion }}</td>
                            <td>{{ $task->description }}</td>
                        </tr>
                    @endforeach
                    
                    </tbody>
                </table>
            </div>
        @endif


        <p class="center">Thank you for your participation.</p>
                        <!-- Timestamp -->
                        <p class="timestamp">
                            Minutes of Meeting submitted at: <br>
                            {{ \Carbon\Carbon::parse($notulen->created_at)->format('F j, Y h:i A') }}
                        </p>
        
    </div>
</body>

</html> --}}
