<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MOM Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
        integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        #tooltip {
            transition: opacity 0.2s ease;
            opacity: 0;
        }

        #tooltip:not(.hidden) {
            opacity: 1;
        }

        #tooltip {
            display: flex;
            justify-content: flex-end;
        }

        /* Ensure the header and content are stacked vertically */
        /* Ensure the tooltip uses Flexbox to stack elements vertically */
        #tooltip {
            display: flex;
            flex-direction: column;
        }

        /* Style adjustments */
        .tooltip-header {
            margin-bottom: 12px;
            /* Space between title and content */
        }

        .tooltip-content p {
            margin: 0;
            /* Ensure no extra margin in the content */
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav style="background-color: #F9F9F9;" class="fixed w-full shadow-md h-20 top-0 left-0 z-[9999]">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
            <div class="flex items-center justify-between h-full">
                <!-- Navbar image -->
                <div class="flex-shrink-0 mr-auto h-12">
                    <a href="/">
                        <img src="{{ asset('images/pepito-logo.png') }}" alt="Navbar Logo" class="h-12 w-auto ml-2"
                            src="/">
                    </a>
                </div>
                <!-- Icons Section -->
                <div class="flex items-center space-x-4">
                    <!-- Notification Icon -->
                    <div class="relative flex items-center justify-center h-full">
                        <button type="button" class="text-gray-700 hover:text-gray-900 focus:outline-none"
                            id="notificationButton">
                            <i class="zmdi zmdi-notifications text-4xl"></i>
                            <span id="notificationDot"
                                class="hidden absolute top-0 right-0 h-3 w-3 rounded-full bg-red-500"></span>
                        </button>
                        <!-- Dropdown for notifications -->
                        <div id="notificationDropdown"
                            class="hidden absolute right-0 mt-56 w-96 bg-white rounded-md shadow-lg z-[9999] max-h-[181px]">
                            <div class="flex">
                                <!-- Notifications container -->
                                <div id="carousel" class="flex-grow overflow-hidden max-h-[181px]">
                                    <div id="notificationsList"
                                        class="pl-4 pr-1 py-3 transition-transform duration-300 ease-in-out">
                                        <!-- Notifications will be dynamically inserted here -->
                                    </div>
                                </div>

                                <!-- Vertical dots for navigation -->
                                <div id="dotsContainer" class="flex flex-col justify-center items-center ml-2 pr-1">
                                    <!-- Dots will be dynamically inserted here -->
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- User Icon -->
                    <div class="relative">
                        <button type="button" id="userMenuButton"
                            class="flex items-center text-gray-700 hover:text-gray-900 focus:outline-none">
                            <i class="zmdi zmdi-account text-gray-700 text-4xl"></i>
                        </button>
                        <!-- Dropdown Menu -->
                        <div id="userDropdown"
                            class="hidden absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg z-[9999]">
                            <div class="flex items-center px-4 py-3">
                                <div class="rounded-full h-full bg-gray-300 p-2">
                                    <i class="fa-regular fa-user text-gray-700 text-2xl"></i>
                                </div>
                                <div class="ml-4">
                                    <span class="block text-gray-700 font-semibold">{{ Auth::user()->name }}</span>
                                    <span class="block text-gray-600 text-sm">{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                            <div class="border-t border-gray-200"></div>
                            <div class=" px-4 py-2 hover:bg-gray-100 transition-colors duration-300 rounded-md">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left text-gray-700 hover:text-gray-900">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </nav>

    <a href="{{ route('notulens.index') }}"
        class="bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 mx-6 text-white px-4 py-2 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out min-[1380px]:absolute flex items-center justify-center space-x-2">
        <i class="fas fa-home"></i>
        <span>Back to Home</span>
    </a>

    <div class="mx-auto mt-24 ml-10 px-0 absolute bg-white shadow-md rounded-lg mb-6 w-96">
        <!-- Manual Title -->
        <h1 class="text-2xl font-bold text-center py-4">View MoM Details</h1>

        <!-- Overview Section -->
        <section class="p-4">
            <h2 class="text-xl font-semibold mb-2">Overview</h2>
            <p class="text-sm text-gray-700">
                The "View MoM Details" page allows users to review detailed information about a specific Minutes of
                Meeting (MoM) entry. This page presents key meeting information, participants, tasks, and more, enabling
                users to get a comprehensive view of the meeting's content and status.
            </p>
        </section>

        <!-- Steps to View MoM Details -->
        <section class="p-4">
            <h2 class="text-xl font-semibold mb-2">Steps to View MoM Details</h2>
            <ol class="list-decimal pl-5 text-sm text-gray-700">
                <li><strong>View Meeting Information:</strong> The top section displays the meeting title, department,
                    date, time, location, and scripter.</li>
                <li><strong>Review Participants:</strong> Check the list of participants and their details, including
                    ID, name, and email.</li>
                <li><strong>Review Guests:</strong> Check the list of guests invited to the meeting with their names and
                    emails.</li>
                <li><strong>Examine Agenda, Discussion, and Decisions:</strong> Review the meeting agenda, discussion
                    points, and final decisions made during the meeting.</li>
                <li><strong>Manage Tasks:</strong> View and manage tasks assigned during the meeting. The tasks section
                    includes details like topic, PIC (Person In Charge), due date, status, description, and attachments.
                    You can also update task details using the provided options.</li>
                <li><strong>Distribute MoM:</strong> If the MoM status is active, you can click the "Distribute" button
                    to send out the MoM to relevant parties.</li>
            </ol>
        </section>

        <!-- Features Section -->
        <section class="p-4">
            <h2 class="text-xl font-semibold mb-2">Features</h2>
            <ul class="list-disc pl-5 text-sm text-gray-700">
                <li><strong>Detailed Meeting View:</strong> Provides a comprehensive overview of all meeting details,
                    including participants, guests, and tasks.</li>
                <li><strong>Task Management:</strong> Easily view and manage tasks, including updating their status and
                    attachments.</li>
                <li><strong>Real-Time Status Updates:</strong> The MoM status is updated in real-time, and the
                    "Distribute" button is only available if the MoM is active.</li>
                <li><strong>Modal for Task Updates:</strong> Use the modal to update task details, add attachments, and
                    mark tasks as complete.</li>
            </ul>
        </section>
    </div>

    <!-- Tooltip element -->
    <div id="tooltip"
        class="fixed top-4 right-4 mt-24 mr-4 bg-white shadow-md rounded-lg w-96 p-4 text-sm text-gray-700 hidden">
        <div id="tooltip-heading-container" class="tooltip-header">
            <h1 id="tooltip-heading" class="text-2xl font-bold">Tooltip <i class="fas fa-info-circle"></i></h1>
        </div>
        <div id="tooltip-content-container" class="tooltip-content">
            <p></p>
        </div>
    </div>



    <div class="container mx-auto mt-24 min-[1380px]:px-80">

        <div class="bg-white shadow-[0_0px_50px_-15px_rgba(0,0,0,0.3)] rounded-lg overflow-hidden mb-8 p-4">
            <div class="p-4">
                <div class="text-white p-4"
                    style="
                background: linear-gradient(135deg, #FF9D03 0%, #FFB75E 100%);
                border-radius: 0.5rem;
            ">
                    <h2 class="text-2xl font-semibold mb-0">{{ $notulen->meeting_title }}</h2>
                </div>

            </div>
            <div class="p-4">
                <div class="p-6 bg-white shadow-lg rounded-md">
                    <div class="has-tooltip"
                        data-tooltip="This section provides detailed information about the meeting. It includes the scheduled date, time, location, and the scripter responsible for documenting the meeting notes.">
                        <div class="flex flex-wrap justify-between items-start mb-6">
                            <!-- Left side: Department, Date & Time -->
                            <div class="w-full md:w-1/2 md:pr-4">
                                <!-- Department -->
                                <label for="department" class="block text-gray-800 text-sm font-semibold mb-2">
                                    <i class="fas fa-building mr-2"></i> Department
                                </label>
                                <div
                                    class="shadow appearance-none border border-gray-300 rounded-md py-2 px-4 text-gray-700 bg-gray-100 leading-tight focus:outline-none focus:shadow-outline cursor-pointer">
                                    <p>
                                        @if (is_array(json_decode($notulen->department)))
                                            {{ implode(', ', json_decode($notulen->department)) }}
                                        @else
                                            {{ $notulen->department }}
                                        @endif
                                    </p>
                                </div>

                                <!-- Date & Time -->
                                <div class="flex mt-4">
                                    <div class="w-1/2 pr-2">
                                        <label for="date" class="block text-gray-800 text-sm font-semibold mb-2">
                                            <i class="fas fa-calendar-alt mr-2"></i> Date
                                        </label>
                                        <div
                                            class="shadow appearance-none border border-gray-300 rounded-md py-2 px-4 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline cursor-pointer">
                                            <p>{{ $notulen->meeting_date }}</p>
                                        </div>
                                    </div>

                                    <div class="w-1/2 pl-2">
                                        <label for="time" class="block text-gray-800 text-sm font-semibold mb-2">
                                            <i class="fas fa-clock mr-2"></i> Time
                                        </label>
                                        <div
                                            class="shadow appearance-none border border-gray-300 rounded-md py-2 px-4 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline cursor-pointer">
                                            <p>{{ $notulen->meeting_time }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right side: Location & Scripter -->
                            <div class="w-full md:w-1/2 md:pl-4">
                                <div class="mb-4">
                                    <label for="location" class="block text-gray-800 text-sm font-semibold mb-2">
                                        <i class="fas fa-map-marker-alt mr-2"></i> Location
                                    </label>
                                    <div
                                        class="shadow appearance-none border border-gray-300 rounded-md py-2 px-4 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline cursor-pointer">
                                        <p>{{ $notulen->meeting_location }}</p>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="scripter" class="block text-gray-800 text-sm font-semibold mb-2">
                                        <i class="fas fa-user-edit mr-2"></i> Scripter
                                    </label>
                                    <div
                                        class="shadow appearance-none border border-gray-300 rounded-md py-2 px-4 bg-gray-100 text-gray-700 leading-tight focus:outline-none focus:shadow-outline cursor-pointer">
                                        <p>{{ $notulen->scripter->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                @if ($notulen->participants->isNotEmpty())
                    <h3 class="text-xl font-semibold mt-6">Participants</h3>
                    <table
                        class="has-tooltip w-full mt-4 border-collapse border border-gray-300 shadow-md rounded-md overflow-hidden bg-white text-sm"
                        data-tooltip="This table provides details about the participants of the meeting. Each row includes the participant's unique ID, their full name, and their email address. This information helps in identifying and contacting the participants as needed.">
                        <thead>
                            <tr class="bg-gradient-to-r from-green-400 to-green-600 text-white">
                                <th class="border border-gray-300 p-2">ID</th>
                                <th class="border border-gray-300 p-2">Name</th>
                                <th class="border border-gray-300 p-2">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notulen->participants as $participant)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="border border-gray-300 p-2">{{ $participant->id }}</td>
                                    <td class="border border-gray-300 p-2">{{ $participant->name }}</td>
                                    <td class="border border-gray-300 p-2">{{ $participant->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>



                @endif

                @if ($notulen->guests->isNotEmpty())
                    <h3 class="text-xl font-semibold mt-6">Guests</h3>
                    <table
                        class="has-tooltip w-full mt-4 border-collapse border border-gray-300 shadow-md rounded-md overflow-hidden bg-white text-sm"
                        data-tooltip="This table lists the guests attending the meeting. Each row provides the guest's full name and their email address, helping to identify and contact them if needed.">
                        <thead>
                            <tr class="bg-gradient-to-r from-green-400 to-green-600 text-white">
                                <th class="border border-gray-300 p-2">Name</th>
                                <th class="border border-gray-300 p-2">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notulen->guests as $guest)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="border border-gray-300 p-2">{{ $guest->name }}</td>
                                    <td class="border border-gray-300 p-2">{{ $guest->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                @endif

                <div class="has-tooltip mt-4"
                    data-tooltip="This section provides a summary of the meeting content. It includes the agenda, which outlines the topics to be discussed; the discussion, which provides details on the conversations and key points raised during the meeting; and the decisions, which summarize the conclusions and actions agreed upon. This information is crucial for understanding the meeting's objectives, outcomes, and next steps.">
                    <p class="pb-4"><strong>Agenda:</strong> <br> {!! nl2br(e($notulen->agenda)) !!}</p>
                    <p class="pb-4"><strong>Discussion:</strong> <br>{!! nl2br(e($notulen->discussion)) !!}</p>
                    <p class="pb-4"><strong>Decisions:</strong> <br> {!! nl2br(e($notulen->decisions)) !!}</p>
                </div>

                {{-- Distrubute Button --}}
                @if (Auth::user()->id == $notulen->scripter_id)
                    <div class="flex justify-end">
                        <button id="distributeButton"
                            class="has-tooltip 
                        @if ($notulen->status === 'Inactive') bg-gradient-to-r from-gray-400 to-gray-500 cursor-not-allowed 
                        @else 
                            bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 @endif 
                        text-white px-4 py-2 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out"
                            @if ($notulen->status === 'Inactive') disabled 
                        data-tooltip="This MoM is inactive and cannot be distributed. Only the scripter can distribute the MoM, but it is currently disabled."
                    @else 
                        data-tooltip="You are the scripter. You can distribute this MoM to all participants via email." @endif>
                            Distribute
                        </button>
                    </div>
                @endif






            </div>
        </div>


        @if ($notulen->tasks->isNotEmpty())
            <div class="has-tooltip all-tasks"
                data-tooltip="This section displays all the tasks associated with the current MoM (Minutes of Meeting). Each task is listed with its topic, the person(s) in charge (PIC), due date, current status, description, and any associated attachments. Use this table to review the tasks, their progress, and ensure all actions are being tracked effectively. The table helps to keep everyone on the same page and facilitates follow-up on pending or completed tasks. Click on 'View Attachment' to see any files related to a task.">
                {{-- <h3 class="text-xl font-semibold mt-6">All Tasks</h3> --}}
                <div class="bg-white shadow-[0_0px_50px_-15px_rgba(0,0,0,0.3)] rounded-lg overflow-hidden mb-8 p-4">
                    <div
                        class="bg-white shadow-[0_0px_50px_-15px_rgba(0,0,0,0.3)] rounded-lg overflow-hidden mb-8 p-4">
                        <div class="p-4">
                            <div class="text-white p-4"
                                style="
                    background: linear-gradient(135deg, #FF9D03 0%, #FFB75E 100%);
                    border-radius: 0.5rem;
                ">
                                <h2 class="text-2xl font-semibold mb-0">All Tasks</h2>
                            </div>

                            <div class="p-4">
                                <table
                                    class="w-full mt-4 border-collapse border border-gray-300 shadow-md rounded-md overflow-hidden bg-white text-sm">
                                    <thead>
                                        <tr class="bg-gradient-to-r from-green-400 to-green-600 text-white">
                                            <th class="border border-gray-300 p-2">Topic</th>
                                            <th class="border border-gray-300 p-2">PIC</th>
                                            <th class="border border-gray-300 p-2">Due Date</th>
                                            <th class="border border-gray-300 p-2">Status</th>
                                            <th class="border border-gray-300 p-2">Completion</th>
                                            <th class="border border-gray-300 p-2">Description</th>
                                            <th class="border border-gray-300 p-2">Attachment</th>
                                            <th class="border border-gray-300 p-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($notulen->tasks as $task)
                                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                <td class="border border-gray-300 p-2">{{ $task->task_topic }}</td>
                                                <td class="border border-gray-300 p-2">
                                                    @php
                                                        $taskPics = json_decode($task->task_pic, true);
                                                        $picNames = App\Models\User::whereIn('id', $taskPics)
                                                            ->pluck('name')
                                                            ->toArray();

                                                        // Combine PIC names with guest PIC names
                                                        $allNames = array_merge($picNames, $task->guestPicNames);
                                                        echo implode(', ', $allNames);
                                                    @endphp

                                                </td>
                                                <td class="border border-gray-300 p-2">{{ $task->task_due_date }}</td>
                                                <td class="border border-gray-300 p-2"
                                                    style="background-color: {{ $task->status === 'Complete' ? '#b3e6ac' : ($task->status === 'In Progress' ? '#63c6ff' : ($task->status === 'Due Today' ? '#ffeb3b' : ($task->status === 'Past Due' ? '#f44336' : 'transparent'))) }}">
                                                    {{ $task->status }}
                                                </td>
                                                <td class="border border-gray-300 p-2">{{ $task->completion }}</td>
                                                <td class="border border-gray-300 p-2">{{ $task->description }}</td>
                                                <td class="border border-gray-300 p-2">
                                                    @if ($task->attachment)
                                                        <a href="{{ asset('storage/' . $task->attachment) }}"
                                                            target="_blank" class="text-blue-500 hover:underline">View
                                                            Attachment</a>
                                                    @else
                                                        No Attachment
                                                    @endif
                                                </td>
                                                <td class="border border-gray-300 p-2">
                                                    <button onclick="openLogsModal({{ $task->id }})"
                                                        class="has-tooltip bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white px-4 py-2 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out"
                                                        data-tooltip="Click this button to view detailed logs for the selected task. A modal will open displaying all the logs related to this task, including any updates, comments, and other relevant information. You can review the task history to understand its progress and any actions taken. Use the Close button in the modal to exit and return to the main task list.">
                                                        Logs
                                                    </button>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
        @endif


        @if ($userTasks->isNotEmpty())

            <div class="has-tooltip my-tasks"
                data-tooltip="This section lists all the tasks assigned to you from the current MoM (Minutes of Meeting). Review your tasks, check due dates, update statuses, and ensure that you are on track with your responsibilities. This personalized view helps you stay organized and manage your workload efficiently.">
                {{-- <h3 class="text-xl font-semibold mt-6">My Tasks</h3> --}}

                <div class="bg-white shadow-[0_0px_50px_-15px_rgba(0,0,0,0.3)] rounded-lg overflow-hidden mb-8 p-4">
                    <div class="text-white p-4"
                        style="
                background: linear-gradient(135deg, #FF9D03 0%, #FFB75E 100%);
                border-radius: 0.5rem;
            ">
                        <h2 class="text-2xl font-semibold mb-0">My Tasks</h2>
                    </div>

                    <div class="p-4">
                        <table
                            class="w-full mt-4 border-collapse border border-gray-300 shadow-md rounded-md overflow-hidden bg-white text-sm">
                            <thead>
                                <tr class="bg-gradient-to-r from-green-400 to-green-600 text-white">
                                    <th class="border border-gray-300 p-2">Topic</th>
                                    <th class="border border-gray-300 p-2">PIC</th>
                                    <th class="border border-gray-300 p-2">Due Date</th>
                                    <th class="border border-gray-300 p-2">Status</th>
                                    <th class="border border-gray-300 p-2">Completion</th>
                                    <th class="border border-gray-300 p-2">Description</th>
                                    <th class="border border-gray-300 p-2">Attachment</th>
                                    <th class="border border-gray-300 p-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userTasks as $task)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="border border-gray-300 p-2">{{ $task->task_topic }}</td>
                                        <td class="border border-gray-300 p-2">
                                            @php
                                                $taskPics = json_decode($task->task_pic, true);
                                                $picNames = App\Models\User::whereIn('id', $taskPics)
                                                    ->pluck('name')
                                                    ->toArray();

                                                // Combine PIC names with guest PIC names
                                                $allNames = array_merge($picNames, $task->guestPicNames);
                                                echo implode(', ', $allNames);
                                            @endphp

                                        </td>
                                        <td class="border border-gray-300 p-2">{{ $task->task_due_date }}</td>
                                        <td class="border border-gray-300 p-2"
                                            style="background-color: {{ $task->status === 'Complete' ? '#b3e6ac' : ($task->status === 'In Progress' ? '#63c6ff' : ($task->status === 'Due Today' ? '#ffeb3b' : ($task->status === 'Past Due' ? '#f44336' : 'transparent'))) }}">
                                            {{ $task->status }}
                                        </td>
                                        <td class="border border-gray-300 p-2">{{ $task->completion }}</td>
                                        <td class="border border-gray-300 p-2">{{ $task->description }}</td>
                                        <td class="border border-gray-300 p-2">
                                            @if ($task->attachment)
                                                @if (Str::endsWith($task->attachment, ['.jpg', '.jpeg', '.png', '.gif']))
                                                    <a href="{{ asset('storage/' . $task->attachment) }}"
                                                        target="_blank" class="text-blue-500 hover:underline">View
                                                        Image</a>
                                                @elseif (Str::endsWith($task->attachment, ['.pdf', '.docx', '.pptx']))
                                                    <a href="{{ asset('storage/' . $task->attachment) }}"
                                                        target="_blank" class="text-blue-500 hover:underline">View
                                                        Document</a>
                                                @else
                                                    <a href="{{ asset('storage/' . $task->attachment) }}"
                                                        target="_blank" class="text-blue-500 hover:underline">Download
                                                        File</a>
                                                @endif
                                            @else
                                                No Attachment
                                            @endif
                                        </td>
                                        <td class="border border-gray-300 p-2">
                                            @if ($notulen->status !== 'Inactive')
                                                <button
                                                    class="has-tooltip bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white px-4 py-2 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out update-task-btn"
                                                    data-task-id="{{ $task->id }}"
                                                    data-task-topic="{{ $task->task_topic }}"
                                                    data-task-description="{{ $task->description }}"
                                                    data-task-status="{{ $task->status }}"
                                                    data-task-attachment="{{ $task->attachment }}"
                                                    data-task-completion="{{ $task->completion }}"
                                                    data-tooltip="Click to update the selected task. This will open a modal where you can add or modify the task's description, attach files if necessary, and update the status. Ensure that all task information is up-to-date to reflect the current progress.">
                                                    Update
                                                </button>
                                            @else
                                                <button
                                                    class="has-tooltip bg-gradient-to-r from-gray-400 to-gray-500 text-white px-4 py-2 rounded-md shadow-md cursor-not-allowed hover:shadow-lg transition-all duration-200 ease-in-out"
                                                    disabled
                                                    data-tooltip="This button is disabled because the MoM (Minutes of Meeting) has been marked as inactive. You can no longer update tasks associated with this MoM. If further updates are needed, please consult the administrator or create a new MoM.">
                                                    Update
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        @endif






    </div>

    <!-- Update Task Modal -->
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="updateTaskModal"
        aria-labelledby="updateTaskModalLabel" aria-hidden="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full transition ease-out duration-300 opacity-0 scale-95"
                id="modalContent">
                <div class="bg-gray-100 p-4 flex justify-between items-center">
                    <h5 class="text-xl font-semibold" id="updateTaskModalLabel">Update Task</h5>
                    <button type="button" class="text-gray-600 hover:text-gray-900 close-modal"
                        aria-label="Close">✖</button>
                </div>
                <form id="updateTaskForm" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="task_id" name="task_id">
                    <div class="mb-4">
                        <label for="task_description" class="block text-gray-700 font-medium">Description</label>
                        <textarea
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            id="task_description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="task_attachment" class="block text-gray-700 font-medium">Attachment</label>
                        <input type="file"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                            id="task_attachment" name="attachment">
                    </div>
                    <div class="mb-4 flex items-center hidden">
                        <input type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded"
                            id="task_complete" name="complete">
                        <label for="task_complete" class="ml-2 block text-gray-700">Mark as complete</label>
                    </div>
                    @isset($task)
                        <div class="mb-4">
                            <label for="task_complete" class="ml-2 block text-gray-700">Mark as complete</label>
                        </div>
                        <div class="mb-4">
                            <label for="task_completion" class="block text-gray-700 font-medium">Completion</label>
                            <select id="task_completion" name="completion"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <option value="0%" {{ $task->completion == '0%' ? 'selected' : '' }}>0%</option>
                                <option value="25%" {{ $task->completion == '25%' ? 'selected' : '' }}>25%</option>
                                <option value="50%" {{ $task->completion == '50%' ? 'selected' : '' }}>50%</option>
                                <option value="75%" {{ $task->completion == '75%' ? 'selected' : '' }}>75%</option>
                                <option value="100%" {{ $task->completion == '100%' ? 'selected' : '' }}>100%</option>
                            </select>
                        </div>
                    @endisset





                    <div class="flex justify-end">
                        <button type="button"
                            class="bg-gradient-to-r from-gray-400 to-gray-600 hover:from-white-500 hover:to-white-700 text-white px-4 py-2 rounded mr-2 close-modal">
                            Close
                        </button>
                        <button type="submit"
                            class="bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white px-4 py-2 rounded">
                            Update Task
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Logs Modal Structure -->
    <div id="logsModal"
        class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center hidden transition-opacity duration-300 ease-out opacity-0">
        <div
            class="bg-white rounded-lg shadow-lg max-w-lg w-full p-4 transform transition-transform transition-opacity duration-300 ease-out scale-90 opacity-0">
            <div class="flex justify-between items-center pb-2 border-b">
                <h3 class="text-lg font-semibold">Task Logs</h3>
                <button onclick="closeLogsModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="logsModalContent" class="mt-4 max-h-80 overflow-y-auto">
                <!-- Task logs will be loaded here -->
            </div>
            <div class="mt-4 flex justify-end">
                <button onclick="closeLogsModal()"
                    class="bg-gradient-to-r from-gray-400 to-gray-600 text-white text-sm font-medium py-1.5 px-3 rounded-md shadow-md hover:from-gray-500 hover:to-gray-700 transition">
                    Close
                </button>
            </div>
        </div>
    </div>








    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

document.addEventListener('DOMContentLoaded', function() {
    const notificationDropdown = document.getElementById('notificationDropdown');

    // Prevent page scroll when scrolling inside notification dropdown
    notificationDropdown.addEventListener('wheel', function(event) {
        // Get the scroll position of the notification dropdown
        const scrollTop = notificationDropdown.scrollTop;
        const scrollHeight = notificationDropdown.scrollHeight;
        const offsetHeight = notificationDropdown.offsetHeight;

        // Prevent page scroll if the dropdown is at its boundaries (top or bottom)
        if (
            (event.deltaY < 0 && scrollTop === 0) || // Scrolling up at the top
            (event.deltaY > 0 && scrollTop + offsetHeight >= scrollHeight) // Scrolling down at the bottom
        ) {
            event.preventDefault();
        }

        event.stopPropagation(); // Stop the wheel event from propagating to the page
    });
});

        document.addEventListener('DOMContentLoaded', (event) => {
            const updateTaskButtons = document.querySelectorAll('.update-task-btn');
            const updateTaskModal = document.getElementById('updateTaskModal');
            const modalContent = document.getElementById('modalContent');
            const updateTaskForm = document.getElementById('updateTaskForm');
            const taskIdInput = document.getElementById('task_id');
            const taskDescriptionInput = document.getElementById('task_description');
            const taskCompleteInput = document.getElementById('task_complete');
            const taskCompletionSelect = document.getElementById('task_completion');
            const closeModalButtons = document.querySelectorAll('.close-modal');

            updateTaskButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const taskId = button.getAttribute('data-task-id');
                    const taskDescription = button.getAttribute('data-task-description');
                    const taskStatus = button.getAttribute('data-task-status');
                    const taskCompletion = button.getAttribute('data-task-completion');

                    taskIdInput.value = taskId;
                    taskDescriptionInput.value = taskDescription;
                    taskCompleteInput.checked = (taskStatus ===
                        'Complete'); // Set checked based on task status
                    taskCompletionSelect.value = taskCompletion; // Set the completion percentage
                    updateTaskForm.action = `/notulens/tasks/${taskId}`;

                    updateTaskModal.classList.remove('hidden');
                    setTimeout(() => {
                        modalContent.classList.remove('opacity-0', 'scale-95');
                        modalContent.classList.add('opacity-100', 'scale-100');
                    }, 10); // small delay to trigger transition
                });
            });


            closeModalButtons.forEach(button => {
                button.addEventListener('click', () => {
                    modalContent.classList.remove('opacity-100', 'scale-100');
                    modalContent.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => {
                        updateTaskModal.classList.add('hidden');
                    }, 300); // match duration with transition
                });
            });
            updateTaskForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: this.action,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Task Updated',
                            text: 'The task has been successfully updated.',
                        }).then(() => {
                            location.reload(); // Reload the page to reflect changes
                        });
                    },
                    error: function(error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'There was an error updating the task. Please try again.',
                        });
                    }
                });
            });

            document.addEventListener('click', function(event) {
                var userMenuButton = document.getElementById('userMenuButton');
                var userDropdown = document.getElementById('userDropdown');

                // If the clicked element is not the dropdown or the button, hide the dropdown
                if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
                    userDropdown.classList.add('hidden');
                }
            });

            document.getElementById('userMenuButton').addEventListener('click', function(event) {
                var userDropdown = document.getElementById('userDropdown');
                var notificationDropdown = document.getElementById(
                    'notificationDropdown'); // Get the notification dropdown element
                userDropdown.classList.toggle('hidden');
                // Close notification dropdown if open
                if (!notificationDropdown.classList.contains('hidden')) {
                    notificationDropdown.classList.add('hidden');
                }

                event
            .stopPropagation(); // Prevent the document click event from immediately hiding the dropdown
            });

            document.getElementById('distributeButton').addEventListener('click', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will send the meeting details to all participants!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, send it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // AJAX call to trigger email sending
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('distribute.mom', $notulen->id) }}', // Pass the notulen_id as a parameter
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Sent!',
                                    'The meeting details have been sent to all participants.',
                                    'success'
                                );
                            },
                            error: function(error) {
                                Swal.fire(
                                    'Error!',
                                    'There was an error sending the emails. Please try again.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });



        });

        // tooltip
        document.addEventListener('DOMContentLoaded', () => {
            const tooltip = document.getElementById('tooltip');
            const tooltipElements = document.querySelectorAll('.has-tooltip');
            const tooltipHeading = document.getElementById('tooltip-heading');

            tooltipElements.forEach(element => {
                element.addEventListener('mouseenter', (event) => {
                    // Update the tooltip heading or content as needed

                    // Set the tooltip content from the data-tooltip attribute
                    const tooltipContent = event.target.getAttribute('data-tooltip');
                    tooltip.querySelector('p').innerText = tooltipContent;

                    // Show the tooltip
                    tooltip.classList.remove('hidden');
                });

                element.addEventListener('mouseleave', () => {
                    // Hide the tooltip
                    tooltip.classList.add('hidden');
                });
            });
        });

        function openLogsModal(taskId) {
            fetch(`/task/${taskId}/logs`)
                .then(response => response.json())
                .then(data => {
                    if (data.logs.length > 0) {
                        let logsModalContent = document.getElementById('logsModalContent');
                        logsModalContent.innerHTML = `
                    <ul class="space-y-2">
                        ${data.logs.map(log => `
                                        <li class="p-2 border rounded-md bg-gray-50">
                                            <strong>Updated By:</strong> ${log.user_name}<br>
                                            <strong>Description:</strong> ${log.update_description}<br>
                                            <strong>Date:</strong> ${log.updated_at}
                                        </li>`).join('')}
                    </ul>`;

                        const logsModal = document.getElementById('logsModal');
                        const modalBox = logsModal.querySelector('.transform');
                        logsModal.classList.remove('hidden');

                        setTimeout(() => {
                            logsModal.classList.remove('opacity-0');
                            logsModal.classList.add('opacity-100');
                            modalBox.classList.remove('scale-90', 'opacity-0');
                            modalBox.classList.add('scale-100', 'opacity-100');
                        }, 10);
                    } else {
                        Swal.fire('No logs', 'There is no log for the task', 'info');
                    }
                })
                .catch(error => {
                    console.error('Error fetching task logs:', error);
                    Swal.fire('Error', 'Could not fetch logs', 'error');
                });
        }

        function closeLogsModal() {
            const logsModal = document.getElementById('logsModal');
            const modalBox = logsModal.querySelector('.transform');
            modalBox.classList.remove('scale-100', 'opacity-100');
            modalBox.classList.add('scale-90', 'opacity-0');

            logsModal.classList.remove('opacity-100');
            logsModal.classList.add('opacity-0');

            setTimeout(() => {
                logsModal.classList.add('hidden');
                // Clear the modal content
                document.getElementById('logsModalContent').innerHTML = '';
            }, 300); // Wait for the transition to complete before hiding
        }

        document.addEventListener('DOMContentLoaded', function() {
            const notificationButton = document.getElementById('notificationButton');
            const notificationDropdown = document.getElementById('notificationDropdown');
            const notificationDot = document.getElementById('notificationDot');
            const notificationsList = document.getElementById('notificationsList');

            // Fetch notifications when the page loads
            fetchNotifications();

            // Show notifications when clicking the button
            notificationButton.addEventListener('click', function(event) {
                notificationDropdown.classList.toggle('hidden');

                // Hide the user dropdown if it's open
                if (!userDropdown.classList.contains('hidden')) {
                    userDropdown.classList.add('hidden');
                }
                event.stopPropagation(); // Prevent click event from propagating to the document

                // Mark notifications as read
                if (!notificationDropdown.classList.contains('hidden')) {
                    markNotificationsAsRead();
                }
            });

            // Close the notification dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!notificationDropdown.contains(event.target) && !notificationButton.contains(event
                        .target)) {
                    notificationDropdown.classList.add('hidden');
                }
            });

            // Fetch notifications from the server
            function fetchNotifications() {
                fetch('/notifications')
                    .then(response => response.json())
                    .then(data => {
                        const {
                            notifications,
                            unreadCount
                        } = data;
                        const notificationDot = document.querySelector('#notificationDot');
                        const notificationsList = document.querySelector('#notificationsList');
                        const dotsContainer = document.querySelector('#dotsContainer');
                        let currentIndex = 0;
                        let isScrolling = false; // Prevent multiple scrolls during transition
                        let scrollDelta = 0; // Track the cumulative scroll distance
                        const maxDotsPerPage = 10; // Max number of dots per page
                        let currentPage = 0; // Track current page for dot pagination

                        if (unreadCount > 0) {
                            notificationDot.classList.remove('hidden');
                        }

                        // Populate the dropdown with notifications
                        notificationsList.innerHTML = notifications.map(notification => {
                            const link = notification.link || '#';
                            const highlightClass = notification.isHighlighted ? 'bg-yellow-100' :
                                ''; // Highlight unread notifications

                            return `
                    <a href="${link}" class="notification-item block mt-2 px-4 py-3 ${highlightClass} hover:bg-gray-100 rounded-md transition duration-200 ease-in-out shadow-sm border-b border-gray-200">
                        <div class="icon bg-blue-500 text-white rounded-full p-2 w-10 h-10 flex items-center justify-center mx-auto mb-2">
                            <i class="fas fa-bell"></i>
                        </div>
                        <div class="content text-center">
                            <strong class="text-sm font-semibold text-gray-800">${notification.notification_topic}</strong>
                            <p class="text-xs text-gray-600 mt-1">${notification.notification_message}</p>
                            <span class="text-xs text-gray-400">${new Date(notification.created_at).toLocaleDateString()}</span>
                        </div>
                    </a>
                    <div class="pt-3"></div>
                `;
                        }).join('');

                        // Function to render dots with pagination controls
                        const renderDots = (page) => {
                            const startIndex = page * maxDotsPerPage;
                            const endIndex = Math.min(startIndex + maxDotsPerPage, notifications.length);
                            const dotsHtml = notifications.slice(startIndex, endIndex).map((notification,
                                index) => {
                                const globalIndex = startIndex + index;
                                const dotColor = globalIndex === currentIndex ?
                                    'bg-blue-500' // Always blue if it's the current index
                                    :
                                    (notification.isHighlighted ?
                                        'bg-orange-500' // Otherwise, orange if highlighted
                                        :
                                        'bg-gray-300'); // Default gray for others

                                return `<div class="dot w-2 h-2 rounded-full mb-2 ${dotColor}"></div>`;
                            }).join('');


                            // Add dots and pagination controls
                            dotsContainer.innerHTML = `
                    ${dotsHtml}
                    ${notifications.length > maxDotsPerPage ? `
                                <div class="flex justify-between mt-2 hidden">
                                    <button id="prevPage" class="px-2 py-1 bg-gray-200 rounded ${page === 0 ? 'opacity-50 cursor-not-allowed' : ''}" ${page === 0 ? 'disabled' : ''}>Prev</button>
                                    <button id="nextPage" class="px-2 py-1 bg-gray-200 rounded ${page === Math.ceil(notifications.length / maxDotsPerPage) - 1 ? 'opacity-50 cursor-not-allowed' : ''}" ${page === Math.ceil(notifications.length / maxDotsPerPage) - 1 ? 'disabled' : ''}>Next</button>
                                </div>
                            ` : ''}
                `;
                        };

                        // Handle carousel navigation
                        const updateCarousel = (index) => {
                            isScrolling = true; // Disable scrolling during transition
                            notificationsList.style.transform =
                                `translateY(-${index * 161}px)`; // Adjusting for notification item height

                            // Ensure the correct dot is highlighted
                            const dots = dotsContainer.querySelectorAll('.dot');
                            dots.forEach((dot, dotIndex) => {
                                const globalIndex = currentPage * maxDotsPerPage + dotIndex;
                                dot.classList.toggle('bg-blue-500', globalIndex === index);
                                dot.classList.toggle('bg-gray-300', globalIndex !== index && !
                                    notifications[globalIndex]?.isHighlighted);
                                dot.classList.toggle('bg-orange-500', globalIndex !== index &&
                                    notifications[globalIndex]?.isHighlighted);
                            });

                            // Re-enable scrolling after transition
                            setTimeout(() => {
                                isScrolling = false; // Allow scrolling again after the transition
                                scrollDelta = 0; // Reset scroll delta after each scroll
                            }, 1001); // Adjust to the same duration as the CSS transition (1001ms)
                        };

                        // Scroll handler (only trigger when the cumulative scroll exceeds 164px)
                        const handleScroll = (event) => {
                            if (isScrolling) return; // Prevent scrolling while animation is happening

                            // Accumulate scroll delta
                            scrollDelta += event.deltaY;

                            // Only trigger the scroll if the accumulated delta exceeds 164px
                            if (Math.abs(scrollDelta) >= 164) {
                                if (scrollDelta > 0 && currentIndex < notifications.length - 1) {
                                    // Scroll down (next notification)
                                    currentIndex++;
                                } else if (scrollDelta < 0 && currentIndex > 0) {
                                    // Scroll up (previous notification)
                                    currentIndex--;
                                }

                                // Check if currentIndex goes out of current page
                                const startIndex = currentPage * maxDotsPerPage;
                                const endIndex = startIndex + maxDotsPerPage;
                                if (currentIndex < startIndex) {
                                    currentPage--;
                                    renderDots(currentPage);
                                } else if (currentIndex >= endIndex) {
                                    currentPage++;
                                    renderDots(currentPage);
                                }

                                // Update carousel
                                updateCarousel(currentIndex);
                            }
                        };

                        // Add scroll event listener to the notifications list
                        notificationsList.addEventListener('wheel', handleScroll);

                        // Add event listeners for dot navigation
                        dotsContainer.addEventListener('click', (e) => {
                            if (e.target.classList.contains('dot')) {
                                const targetDot = Array.from(dotsContainer.querySelectorAll('.dot'))
                                    .indexOf(e.target);
                                if (targetDot >= 0) {
                                    currentIndex = targetDot + currentPage * maxDotsPerPage;
                                    updateCarousel(currentIndex);
                                }
                            }
                        });

                        // Event listeners for pagination buttons
                        dotsContainer.addEventListener('click', (e) => {
                            if (e.target.id === 'prevPage' && currentPage > 0) {
                                currentPage--;
                                renderDots(currentPage);
                            } else if (e.target.id === 'nextPage' && currentPage < Math.ceil(
                                    notifications.length / maxDotsPerPage) - 1) {
                                currentPage++;
                                renderDots(currentPage);
                            }
                        });

                        // Initial render of dots and carousel
                        renderDots(currentPage);
                        updateCarousel(currentIndex);
                    })
                    .catch(error => console.error('Error fetching notifications:', error));
            }

            // Mark all notifications as read
            function markNotificationsAsRead() {
                const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');

                if (!csrfTokenMeta) {
                    console.error('CSRF token not found.');
                    return;
                }

                fetch('/notifications/mark-all-as-read', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfTokenMeta.getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                }).then(() => {
                    notificationDot.classList.add('hidden'); // Hide red dot
                }).catch(error => {
                    console.error('Error marking notifications as read:', error);
                });
            }

        });
    </script>
</body>

</html>
