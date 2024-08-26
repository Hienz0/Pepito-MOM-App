<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Notulen</title>
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
    </style>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav style="background-color: #F9F9F9;" class="fixed w-full shadow-md h-20 top-0 left-0 z-50">
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
                        <button type="button" class="text-gray-700 hover:text-gray-900 focus:outline-none">
                            <i class="zmdi zmdi-notifications text-4xl"></i>
                        </button>
                        <!-- Dropdown for notifications could go here -->
                    </div>
                    <!-- User Icon -->
                    <div class="relative">
                        <button type="button" id="userMenuButton"
                            class="flex items-center text-gray-700 hover:text-gray-900 focus:outline-none">
                            <i class="zmdi zmdi-account text-gray-700 text-4xl"></i>
                        </button>
                        <!-- Dropdown Menu -->
                        <div id="userDropdown" class="hidden absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg]">
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

    <a href="{{ route('notulens.index') }}" class="bg-[#79B51F] hover:bg-[#69A01C] text-white px-4 mx-6 py-2 rounded min-[1380px]:absolute">
        <i class="fas fa-home"></i> Back to Home
    </a>

    <div class="mx-auto mt-24 ml-10 px-0 absolute bg-white shadow-md rounded-lg mb-6 w-96">
        <!-- Manual Title -->
        <h1 class="text-2xl font-bold text-center py-4">Edit MoM</h1>
    
        <!-- Overview Section -->
        <section class="p-4">
            <h2 class="text-xl font-semibold mb-2">Overview</h2>
            <p class="text-sm text-gray-700">
                The "Edit MoM" page enables users to modify existing Minutes of Meeting entries. This page is designed to update meeting details, participants, and tasks, ensuring that the records are accurate and up-to-date.
            </p>
        </section>
    
        <!-- Steps to Edit a MoM -->
        <section class="p-4">
            <h2 class="text-xl font-semibold mb-2">Steps to Edit a MoM</h2>
            <ol class="list-decimal pl-5 text-sm text-gray-700">
                <li><strong>Update Meeting Details:</strong> Edit the meeting title, date, time, and location as needed. These fields are essential for maintaining accurate meeting records.</li>
                <li><strong>Modify the Agenda:</strong> Adjust the "Agenda" field to reflect any changes in the topics discussed during the meeting. This helps in keeping the meeting summary relevant.</li>
                <li><strong>Edit Participants:</strong> Use the "Edit Participants" button to modify the list of participants. You can add new participants or remove existing ones. Ensure that the participant list is accurate.</li>
                <li><strong>Update Guests:</strong> The "Edit Guests" section allows you to adjust the list of external participants. Use the "Edit Guest" button to modify guest details as necessary.</li>
                <li><strong>Revise Action Items:</strong> Update the action items section to reflect any changes in tasks or deadlines. Each task can be edited to update the description, assignee, or due date.</li>
                <li><strong>Save Changes:</strong> Click the "Save" button to apply the updates to the MoM entry. You can also choose to "Save as Draft" if you need to continue editing later.</li>
            </ol>
        </section>
    
        <!-- Features Section -->
        <section class="p-4">
            <h2 class="text-xl font-semibold mb-2">Features</h2>
            <ul class="list-disc pl-5 text-sm text-gray-700">
                <li><strong>Real-Time Updates:</strong> Changes are reflected immediately, ensuring that all modifications are up-to-date.</li>
                <li><strong>Editable Fields:</strong> All fields, including participants and tasks, can be updated to reflect the latest information.</li>
                <li><strong>Validation and Alerts:</strong> The page provides real-time validation to ensure that all required fields are filled out correctly. Alerts will notify you of any issues.</li>
                <li><strong>Responsive Design:</strong> The page is designed to work seamlessly on both desktop and mobile devices, making editing convenient from any device.</li>
            </ul>
        </section>
    </div>
    
    

    {{-- main content --}}
    <div class="container mx-auto mt-24 px-0 min-[1380px]:px-80">



        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-200 text-red-800 p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('notulens.update', $notulen->id) }}" method="POST" enctype="multipart/form-data"
            id="notulenForm">
            @csrf
            @method('PUT')

            <div class="bg-white shadow-[0_0px_50px_-15px_rgba(0,0,0,0.3)] rounded-lg overflow-hidden mb-8 p-4">
                <div class="text-white p-4" style="background-color: #FF9D03">
                    <h1 class="text-2xl font-semibold mb-0">Edit MoM</h1>
                </div>
                <div class="flex flex-wrap mb-4">
                    <div class="w-full md:w-1/2 md:pr-2">
                        <div class="form-group">
                            <label for="meeting_title" class="block text-sm font-medium text-gray-700 mt-4">Meeting
                                Title:</label>
                            <input type="text" id="meeting_title" name="meeting_title"
                                class="shadow appearance-none border rounded w-full md:w-4/5 lg:w-4/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                value="{{ old('meeting_title', $notulen->meeting_title) }}" required>
                        </div>
                        <div class="mt-4 relative">
                            <label for="department"
                                class="block text-gray-700 text-sm font-bold mb-2">Department</label>
                            <div class="shadow appearance-none border rounded w-full md:w-4/5 lg:w-4/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline cursor-pointer flex justify-between items-center"
                                onclick="toggleDropdown()">
                                <span id="dropdown-label" class="truncate">
                                    @php
                                        $selectedDepartments = json_decode(
                                            old('department', $notulen->department),
                                            true,
                                        );
                                        echo empty($selectedDepartments)
                                            ? 'Select Departments'
                                            : implode(', ', $selectedDepartments);
                                    @endphp
                                </span>
                                <svg class="inline w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                            <div id="checkbox-dropdown"
                                class="absolute hidden shadow bg-white border rounded mt-2 w-full md:w-4/5 lg:w-4/5 z-10">
                                <div class="p-2">
                                    @php
                                        $departments = ['HR', 'IT', 'Finance', 'Marketing'];
                                    @endphp

                                    @foreach ($departments as $department)
                                        <div class="flex items-center mb-2">
                                            <input id="department_{{ strtolower($department) }}" name="department[]"
                                                type="checkbox" value="{{ $department }}" class="mr-2"
                                                {{ in_array($department, $selectedDepartments) ? 'checked' : '' }}
                                                onchange="updateLabel()">
                                            <label for="department_{{ strtolower($department) }}"
                                                class="text-gray-700">{{ $department }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <script>
                            function toggleDropdown() {
                                const dropdown = document.getElementById('checkbox-dropdown');
                                dropdown.classList.toggle('hidden');
                            }

                            function updateLabel() {
                                const checkboxes = document.querySelectorAll('input[name="department[]"]:checked');
                                const label = document.getElementById('dropdown-label');
                                const selected = Array.from(checkboxes).map(cb => cb.nextElementSibling.textContent).join(', ');

                                label.textContent = selected.length > 0 ? selected : 'Select Departments';
                            }

                            // Close the dropdown if the user clicks outside of it
                            document.addEventListener('click', function(event) {
                                const dropdown = document.getElementById('checkbox-dropdown');
                                const button = dropdown.previousElementSibling;
                                if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                                    dropdown.classList.add('hidden');
                                }
                            });
                        </script>

                    </div>

                    <div class="mt-4 w-full md:w-1/2 md:pl-2">
                        <div class="flex mb-4 md:w-4/5 lg:w-4/5">
                            <div class="w-1/2 pr-2">
                                <div class="form-group">
                                    <label for="meeting_date" class="block text-sm font-medium text-gray-700">Meeting
                                        Date:</label>
                                    <input type="date" id="meeting_date" name="meeting_date"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        value="{{ old('meeting_date', $notulen->meeting_date) }}" required>
                                </div>
                            </div>
                            <div class="w-1/2 pl-2">
                                <div class="form-group">
                                    <label for="meeting_time" class="block text-sm font-medium text-gray-700">Meeting
                                        Time:</label>
                                    <input type="time" id="meeting_time" name="meeting_time"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        value="{{ old('meeting_time', $notulen->meeting_time) }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <label for="meeting_location" class="block text-sm font-medium text-gray-700">Meeting
                                Location:</label>
                            <select id="meeting_location" name="meeting_location"
                                class="shadow appearance-none border rounded w-full md:w-4/5 lg:w-4/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                                @php
                                    $locations = [
                                        'Conference Room A',
                                        'Conference Room B',
                                        'Main Hall',
                                        'Online',
                                        'Off-site',
                                        'Location 1',
                                        'Location 2',
                                        'Location 3',
                                    ];
                                    $selectedLocation = old('meeting_location', $notulen->meeting_location);
                                @endphp

                                <option value="" disabled {{ !$selectedLocation ? 'selected' : '' }}>Select
                                    Meeting Location</option>

                                @foreach ($locations as $location)
                                    <option value="{{ $location }}"
                                        {{ $location === $selectedLocation ? 'selected' : '' }}>
                                        {{ $location }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>










                    <!-- Existing fields -->
                </div>
                <div class="form-group mt-4">
                    <label for="agenda" class="block text-sm font-medium text-gray-700">Agenda:</label>
                    <textarea id="agenda" name="agenda"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        rows="4" required>{{ old('agenda', $notulen->agenda) }}</textarea>
                </div>

                <div class="form-group mt-4">
                    <label for="discussion" class="block text-sm font-medium text-gray-700">Discussion:</label>
                    <textarea id="discussion" name="discussion"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        rows="4">{{ old('discussion', $notulen->discussion) }}</textarea>
                </div>

                <div class="form-group mt-4">
                    <label for="decisions" class="block text-sm font-medium text-gray-700">Decisions:</label>
                    <textarea id="decisions" name="decisions"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        rows="4">{{ old('decisions', $notulen->decisions) }}</textarea>
                </div>
            </div>



            <div class="bg-white shadow-[0_0px_50px_-15px_rgba(0,0,0,0.3)] rounded-lg overflow-hidden mb-8 p-4">
                <div class="text-white p-4" style="background-color: #FF9D03">
                    <h1 class="text-2xl font-semibold mb-0">Edit Particpant & Guest</h1>
                </div>
                <!-- Add participants section -->
                <div class="form-group mt-4">
                    <label for="participants" class="block text-sm font-medium text-gray-700">Participants:</label>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300 rounded-md shadow-sm">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">ID</th>
                                    <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Name
                                    </th>
                                    <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="participants-container">
                                @foreach ($notulen->participants as $participant)
                                    <tr>
                                        <td class="py-2 px-4 border-b">
                                            <input type="text" name="participants[]"
                                                value="{{ $participant->id }}" readonly
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-200">
                                        </td>
                                        <td class="py-2 px-4 border-b">
                                            <input type="text" value="{{ $participant->name }}" readonly
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-200">
                                        </td>
                                        <td class="py-2 px-4 border-b text-center">
                                            <button type="button"
                                                class="remove-participant bg-red-500 text-white px-2 py-1 rounded-md">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="button" id="add-participant"
                        class="bg-[#79B51F] hover:bg-[#69A01C] text-white font-bold py-2 px-4 my-4 rounded mb-4 focus:outline-none focus:shadow-outline">Add
                        Participant</button>
                </div>

                <!-- Modal -->
                <div id="participant-modal"
                    class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-1/2">
                        <h2 class="text-lg font-medium text-gray-700 mb-4">Select Participants</h2>
                        <!-- Search input -->
                        <div class="mb-4">
                            <input type="text" id="search-participants" placeholder="Search by ID or Name..."
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300 rounded-md shadow-sm">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">ID
                                        </th>
                                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Name
                                        </th>
                                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">
                                            Select</th>
                                    </tr>
                                </thead>
                                <tbody id="modal-participants-container">
                                    @foreach ($users as $participant)
                                        <!-- Changed $allParticipants to $users -->
                                        <tr>
                                            <td class="py-2 px-4 border-b">{{ $participant->id }}</td>
                                            <td class="py-2 px-4 border-b">{{ $participant->name }}</td>
                                            <td class="py-2 px-4 border-b text-center">
                                                <input type="checkbox" class="participant-checkbox"
                                                    value="{{ $participant->id }}"
                                                    data-name="{{ $participant->name }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <button id="add-selected-participants" type="button"
                                class="bg-blue-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-600 hidden">Add
                                Selected</button>
                            <button id="close-modal" type="button"
                                class="ml-2 bg-gray-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-gray-600">Complete</button>
                        </div>

                    </div>
                </div>




                <!-- Add guests section -->
                <div class="form-group">
                    <label for="guests" class="block text-sm font-medium text-gray-700">Guests:</label>
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-300 rounded-md shadow-sm">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Name
                                    </th>
                                    <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Email
                                    </th>
                                    <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="guests-container">
                                @foreach ($notulen->guests as $guest)
                                    <tr>
                                        <td class="py-2 px-4 border-b">
                                            <input type="text" name="guests[{{ $loop->index }}][name]"
                                                value="{{ $guest->name }}"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                placeholder="Guest Name">
                                        </td>
                                        <td class="py-2 px-4 border-b">
                                            <input type="email" name="guests[{{ $loop->index }}][email]"
                                                value="{{ $guest->email }}"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                placeholder="Guest Email">
                                        </td>
                                        <td class="py-2 px-4 border-b text-center">
                                            <button type="button"
                                                class="remove-guest bg-red-500 text-white px-2 py-1 rounded-md">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button type="button" id="open-guest-modal"
                        class="bg-[#79B51F] hover:bg-[#69A01C] text-white font-bold py-2 px-4 my-4 rounded mb-4 focus:outline-none focus:shadow-outline">Add
                        Guest</button>
                </div>
                <!-- Guest Modal -->
                <div id="guest-modal"
                    class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
                    <div class="bg-white p-4 rounded-md shadow-lg w-1/2">
                        <h2 class="text-lg font-medium mb-4">Add Guest</h2>
                        <div class="mb-4">
                            <label for="guest-name" class="block text-sm font-medium text-gray-700">Name:</label>
                            <input type="text" id="guest-name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Guest Name">
                        </div>
                        <div class="mb-4">
                            <label for="guest-email" class="block text-sm font-medium text-gray-700">Email:</label>
                            <input type="email" id="guest-email"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Guest Email">
                        </div>
                        <div class="flex justify-end">
                            <button id="add-guest" type="button"
                                class="bg-blue-500 text-white py-2 px-4 rounded-md">Add Guest</button>
                            <button id="close-guest-modal" type="button"
                                class="ml-2 bg-gray-500 text-white py-2 px-4 rounded-md">Close</button>
                        </div>
                    </div>
                </div>




            </div>






            <div class="bg-white shadow-[0_0px_50px_-15px_rgba(0,0,0,0.3)] rounded-lg overflow-hidden mb-8 p-4">
                <div class="text-white p-4" style="background-color: #FF9D03">
                    <h1 class="text-2xl font-semibold mb-0">Edit Task</h1>
                </div>

                <div class="form-group">
                    <label for="tasks" class="block text-sm font-medium text-gray-700">Tasks:</label>
                    <div id="tasks-container">
                        @foreach ($notulen->tasks as $task)
                            <div class="task-item mb-4 p-4 border border-gray-300 rounded-md">
                                <input type="hidden" name="tasks[{{ $loop->index }}][task_id]"
                                    value="{{ $task->id }}">
                                <div class="flex items-center mb-2">
                                    <input type="text" name="tasks[{{ $loop->index }}][task_topic]"
                                        value="{{ $task->task_topic }}"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        placeholder="Task Topic">
                                    <input type="date" name="tasks[{{ $loop->index }}][task_due_date]"
                                        value="{{ $task->task_due_date }}"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        placeholder="Due Date">
                                    <button type="button"
                                        class="remove-task bg-red-500 text-white px-2 py-1 rounded-md">Remove</button>
                                </div>

                                <div class="mb-2">
                                    <label for="task_pic_{{ $loop->index }}"
                                        class="block text-sm font-medium text-gray-700">Person in Charge (PIC):</label>
                                    <select name="tasks[{{ $loop->index }}][task_pic][]" multiple
                                        class="border border-gray-300 rounded-md shadow-sm w-full"
                                        data-index="{{ $loop->index }}" id="task_pic_{{ $loop->index }}">
                                        @foreach ($notulen->participants as $participant)
                                            <option value="{{ $participant->id }}"
                                                {{ in_array($participant->id, json_decode($task->task_pic)) ? 'selected' : '' }}>
                                                {{ $participant->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="mb-2">
                                    <label for="task_status"
                                        class="block text-sm font-medium text-gray-700">Status:</label>
                                    <select name="tasks[{{ $loop->index }}][task_status]"
                                        class="px-3 py-2 border border-gray-300 rounded-md shadow-sm w-full">
                                        <option value="Pending" {{ $task->status === 'Pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="In Progress"
                                            {{ $task->status === 'In Progress' ? 'selected' : '' }}>In Progress
                                        </option>
                                        <option value="Complete" {{ $task->status === 'Complete' ? 'selected' : '' }}>
                                            Complete</option>
                                    </select>
                                </div>

                                <div class="mb-2">
                                    <label for="task_description"
                                        class="block text-sm font-medium text-gray-700">Description:</label>
                                    <textarea name="tasks[{{ $loop->index }}][description]"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $task->description }}</textarea>
                                </div>

                                <div class="mb-2">
                                    <label for="task_attachments"
                                        class="block text-sm font-medium text-gray-700">Attachments:</label>
                                    <input type="file" name="tasks[{{ $loop->index }}][attachment]"
                                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" id="add-task"
                        class="bg-[#79B51F] hover:bg-[#69A01C] text-white font-bold py-2 px-4 my-4 rounded mb-4 focus:outline-none focus:shadow-outline">Add
                        Task</button>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-[#79B51F] hover:bg-[#69A01C] text-white font-bold py-2 px-4 mb-4 rounded w-full focus:outline-none focus:shadow-outline">Update</button>
            </div>

        </form>

        {{-- <div class="grid gap-4 mb-4">
            </div> --}}



    </div>

    <script>
        // Add Participant
        // Open Modal
        document.getElementById('add-participant').addEventListener('click', function() {
            // Show the modal
            document.getElementById('participant-modal').classList.remove('hidden');

            // Get the list of already selected participant IDs
            const selectedParticipantIds = Array.from(document.querySelectorAll(
                    '#participants-container input[name="participants[]"]'))
                .map(input => input.value);

            // Check the corresponding checkboxes in the modal
            document.querySelectorAll('.participant-checkbox').forEach(function(checkbox) {
                if (selectedParticipantIds.includes(checkbox.value)) {
                    checkbox.checked = true;
                } else {
                    checkbox.checked = false;
                }
            });
        });

        // Close Modal
        document.getElementById('close-modal').addEventListener('click', function() {
            document.getElementById('participant-modal').classList.add('hidden');
        });

        // Add/Remove Participants on Checkbox Change
        // Add/Remove Participants on Checkbox Change
        document.querySelectorAll('.participant-checkbox').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const participantId = checkbox.value;
                const participantName = checkbox.getAttribute('data-name');
                const container = document.getElementById('participants-container');

                // Try to find a select element for PIC, but it's okay if it doesn't exist
                const picSelect = document.querySelector('select[name^="tasks["]');

                if (checkbox.checked) {
                    // Add participant if checked and not already in the list
                    if (!Array.from(container.querySelectorAll('input[name="participants[]"]')).some(
                            input => input.value === participantId)) {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                    <td class="py-2 px-4 border-b">
                        <input type="text" name="participants[]" value="${participantId}" readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-200">
                    </td>
                    <td class="py-2 px-4 border-b">
                        <input type="text" value="${participantName}" readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-200">
                    </td>
                    <td class="py-2 px-4 border-b text-center">
                        <button type="button" class="remove-participant bg-red-500 text-white px-2 py-1 rounded-md">Remove</button>
                    </td>
                `;
                        container.appendChild(row);
                    }

                    // If the PIC select dropdown exists, add the participant to it
                    if (picSelect) {
                        const index = picSelect.getAttribute(
                        'data-index'); // Get the index from the data attribute
                        const specificPicSelect = document.querySelector(
                            `select[name="tasks[${index}][task_pic][]"]`);

                        if (specificPicSelect && !Array.from(specificPicSelect.options).some(option =>
                                option.value === participantId)) {
                            const option = document.createElement('option');
                            option.value = participantId;
                            option.textContent = participantName;
                            specificPicSelect.appendChild(option);
                        }
                    }
                } else {
                    // Remove participant if unchecked
                    const rowToRemove = Array.from(container.querySelectorAll('tr'))
                        .find(row => row.querySelector('input[name="participants[]"]').value ===
                            participantId);
                    if (rowToRemove) {
                        rowToRemove.remove();
                    }

                    // If the PIC select dropdown exists, remove the participant from it
                    if (picSelect) {
                        const index = picSelect.getAttribute(
                        'data-index'); // Get the index from the data attribute
                        const specificPicSelect = document.querySelector(
                            `select[name="tasks[${index}][task_pic][]"]`);

                        if (specificPicSelect) {
                            const optionToRemove = Array.from(specificPicSelect.options)
                                .find(option => option.value === participantId);
                            if (optionToRemove) {
                                optionToRemove.remove();
                            }
                        }
                    }
                }
            });
        });



        // Remove Participant Manually
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-participant')) {
                const row = event.target.closest('tr');
                const participantId = row.querySelector('input[name="participants[]"]').value;

                // Uncheck the corresponding checkbox in the modal
                document.querySelector(`.participant-checkbox[value="${participantId}"]`).checked = false;

                // Remove the participant from the table
                row.remove();
            }
        });

        // JavaScript for searching participants by ID or Name
        document.getElementById('search-participants').addEventListener('input', function() {
            var searchValue = this.value.toLowerCase();
            var rows = document.querySelectorAll('#modal-participants-container tr');

            rows.forEach(function(row) {
                var id = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                var name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                if (id.includes(searchValue) || name.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });


        // Add Task
        document.getElementById('add-task').addEventListener('click', function() {
            const container = document.getElementById('tasks-container');
            const index = container.children.length; // Get the current number of task items
            const item = document.createElement('div');
            item.classList.add('task-item', 'mb-4', 'p-4', 'border', 'border-gray-300', 'rounded-md');
            item.innerHTML = `
        <div class="flex items-center mb-2">
            <input type="text" name="tasks[${index}][task_topic]" class="border border-gray-300 rounded-md shadow-sm w-full mr-2" placeholder="Task Topic">
            <input type="date" name="tasks[${index}][task_due_date]" class="border border-gray-300 rounded-md shadow-sm w-full mr-2" placeholder="Due Date">
            <input type="hidden" name="tasks[${index}][task_id]">
            <button type="button" class="remove-task bg-red-500 text-white px-2 py-1 rounded-md">Remove</button>
        </div>

        <div class="mb-2">
            <label for="task_pic" class="block text-sm font-medium text-gray-700">Person in Charge (PIC):</label>
            <select name="tasks[${index}][task_pic][]" multiple class="border border-gray-300 rounded-md shadow-sm w-full">
                @foreach ($notulen->participants as $participant)
                    <option value="{{ $participant->id }}">{{ $participant->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label for="task_status" class="block text-sm font-medium text-gray-700">Status:</label>
            <select name="tasks[${index}][task_status]" class="border border-gray-300 rounded-md shadow-sm w-full">
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Complete">Complete</option>
            </select>
        </div>

        <div class="mb-2">
            <label for="task_description" class="block text-sm font-medium text-gray-700">Description:</label>
            <textarea name="tasks[${index}][description]" class="border border-gray-300 rounded-md shadow-sm w-full"></textarea>
        </div>

        <div class="mb-4">
            <label for="task_attachment_${index}" class="block text-gray-700 font-medium">Attachment</label>
            <input type="file"
                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                id="task_attachment_${index}" name="tasks[${index}][attachment]">
        </div>
    `;
            container.appendChild(item);
        });

        // Open Modal
        document.getElementById('open-guest-modal').addEventListener('click', function() {
            document.getElementById('guest-modal').classList.remove('hidden');
        });

        // Close Modal
        document.getElementById('close-guest-modal').addEventListener('click', function() {
            document.getElementById('guest-modal').classList.add('hidden');
        });

        // Add Guest
        document.getElementById('add-guest').addEventListener('click', function() {
            const nameInput = document.getElementById('guest-name');
            const emailInput = document.getElementById('guest-email');
            const name = nameInput.value.trim();
            const email = emailInput.value.trim();

            if (name === '' || email === '') {
                alert('Please fill out both fields.');
                return;
            }

            const container = document.getElementById('guests-container');
            const guestIndex = container.querySelectorAll('tr').length; // Get the current index

            // Check if the guest is already in the table
            if (Array.from(container.querySelectorAll('input[name^="guests["][email]')).some(input => input
                    .value === email)) {
                alert('This guest is already added.');
                return;
            }

            // Create a new row
            const row = document.createElement('tr');
            row.innerHTML = `
        <td class="py-2 px-4 border-b">
            <input type="text" name="guests[${guestIndex}][name]" value="${name}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Guest Name">
        </td>
        <td class="py-2 px-4 border-b">
            <input type="email" name="guests[${guestIndex}][email]" value="${email}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Guest Email">
        </td>
        <td class="py-2 px-4 border-b text-center">
            <button type="button" class="remove-guest bg-red-500 text-white px-2 py-1 rounded-md">Remove</button>
        </td>
    `;
            container.appendChild(row);

            // Hide the modal after adding the guest
            document.getElementById('guest-modal').classList.add('hidden');

            // Clear input fields
            nameInput.value = '';
            emailInput.value = '';
        });

        // Remove Guest
// Remove Guest
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('remove-guest')) {
        const row = event.target.closest('tr');
        
        // Remove the guest from the table
        if (row) {
            row.remove();
        }
    }
});





        // Remove Participant, Task, or Guest
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-participant')) {
                e.target.parentElement.remove();
            } else if (e.target.classList.contains('remove-task')) {
                e.target.closest('.task-item').remove();
            } else if (e.target.classList.contains('remove-guest')) {
                e.target.parentElement.remove();
            }
        });

        // SweetAlert2 example
        document.querySelector('#notulenForm').addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to update this MoM?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });
        });
    </script>
</body>

</html>
