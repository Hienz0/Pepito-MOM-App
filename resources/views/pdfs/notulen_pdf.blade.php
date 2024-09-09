{{-- <!DOCTYPE html>
<html>
<head>
    <title>Meeting Minutes: {{ $notulen->meeting_title }}</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            color: #333;
            margin: 30px;
            background-color: #f5f5f5;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        h1 {
            color: #2c3e50;
            text-align: center;
        }
        h2 {
            color: #34495e;
            border-bottom: 2px solid #ccc;
            padding-bottom: 5px;
        }
        p, th, td {
            line-height: 1.6;
            font-size: 14px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            font-size: 14px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #2c3e50;
            color: white;
            text-align: left;
        }
        .center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Meeting Minutes: {{ $notulen->meeting_title }}</h1>
    
    <h2>Details</h2>
    <p><strong>Date:</strong> {{ $notulen->meeting_date }}</p>
    <p><strong>Time:</strong> {{ $notulen->meeting_time }}</p>
    <p><strong>Agenda:</strong> {{ $notulen->agenda }}</p>
    <p><strong>Discussion:</strong> {{ $notulen->discussion }}</p>
    <p><strong>Decisions:</strong> {{ $notulen->decisions }}</p>
    
    @if($notulen->participants && count($notulen->participants) > 0)
        <h2>Participants</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notulen->participants as $participant)
                    <tr>
                        <td>{{ $participant->name }}</td>
                        <td>{{ $participant->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if($notulen->guests && count($notulen->guests) > 0)
        <h2>Guests</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notulen->guests as $guest)
                    <tr>
                        <td>{{ $guest->name }}</td>
                        <td>{{ $guest->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if($notulen->tasks && count($notulen->tasks) > 0)
        <h2>Tasks</h2>
        <table class="tasks-table">
            <thead>
                <tr>
                    <th>Topic</th>
                    <th>PIC</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Completion</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notulen->tasks as $task)
                    <tr class="hover-bg-gray">
                        <td>{{ $task->task_topic }}</td>
                        <td>
                            @php
                                $taskPics = json_decode($task->task_pic, true);
                                $picNames = App\Models\User::whereIn('id', $taskPics)
                                    ->pluck('name')
                                    ->toArray();
                                $allNames = array_merge($picNames, $task->guestPicNames);
                                echo implode(', ', $allNames);
                            @endphp
                        </td>
                        <td>{{ $task->task_due_date }}</td>
                        <td class="{{ $task->status === 'Complete' ? 'status-complete' : ($task->status === 'In Progress' ? 'status-in-progress' : ($task->status === 'Due Today' ? 'status-due-today' : ($task->status === 'Past Due' ? 'status-past-due' : ''))) }}">
                            {{ $task->status }}
                        </td>
                        <td>{{ $task->completion }}</td>
                        <td>{{ $task->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <p class="center">Thank you for your participation.</p>
</body>
</html> --}}
