<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Notulen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Include Choices.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">

    <!-- Include Choices.js JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

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
        <h1 class="text-2xl font-bold text-center py-4">Edit MoM</h1>

        <!-- Overview Section -->
        <section class="p-4">
            <h2 class="text-xl font-semibold mb-2">Overview</h2>
            <p class="text-sm text-gray-700">
                The "Edit MoM" page enables users to modify existing Minutes of Meeting entries. This page is designed
                to update meeting details, participants, and tasks, ensuring that the records are accurate and
                up-to-date.
            </p>
        </section>

        <!-- Steps to Edit a MoM -->
        <section class="p-4">
            <h2 class="text-xl font-semibold mb-2">Steps to Edit a MoM</h2>
            <ol class="list-decimal pl-5 text-sm text-gray-700">
                <li><strong>Update Meeting Details:</strong> Edit the meeting title, date, time, and location as needed.
                    These fields are essential for maintaining accurate meeting records.</li>
                <li><strong>Modify the Agenda:</strong> Adjust the "Agenda" field to reflect any changes in the topics
                    discussed during the meeting. This helps in keeping the meeting summary relevant.</li>
                <li><strong>Edit Participants:</strong> Use the "Edit Participants" button to modify the list of
                    participants. You can add new participants or remove existing ones. Ensure that the participant list
                    is accurate.</li>
                <li><strong>Update Guests:</strong> The "Edit Guests" section allows you to adjust the list of external
                    participants. Use the "Edit Guest" button to modify guest details as necessary.</li>
                <li><strong>Revise Action Items:</strong> Update the action items section to reflect any changes in
                    tasks or deadlines. Each task can be edited to update the description, assignee, or due date.</li>
                <li><strong>Save Changes:</strong> Click the "Save" button to apply the updates to the MoM entry. You
                    can also choose to "Save as Draft" if you need to continue editing later.</li>
            </ol>
        </section>

        <!-- Features Section -->
        <section class="p-4">
            <h2 class="text-xl font-semibold mb-2">Features</h2>
            <ul class="list-disc pl-5 text-sm text-gray-700">
                <li><strong>Real-Time Updates:</strong> Changes are reflected immediately, ensuring that all
                    modifications are up-to-date.</li>
                <li><strong>Editable Fields:</strong> All fields, including participants and tasks, can be updated to
                    reflect the latest information.</li>
                <li><strong>Validation and Alerts:</strong> The page provides real-time validation to ensure that all
                    required fields are filled out correctly. Alerts will notify you of any issues.</li>
                <li><strong>Responsive Design:</strong> The page is designed to work seamlessly on both desktop and
                    mobile devices, making editing convenient from any device.</li>
            </ul>
        </section>
    </div>

    <!-- Tooltip element outside all input fields and main container -->
    <!-- Tooltip element -->
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

            <div class="bg-white shadow-[0_0px_50px_-15px_rgba(0,0,0,0.3)] rounded-lg overflow-hidden mb-8 p-6">
                <div class="text-white p-4"
                    style="
                background: linear-gradient(135deg, #FF9D03 0%, #FFB75E 100%);
                border-radius: 0.5rem;
            ">
                    <h1 class="text-2xl font-semibold mb-0">Edit Minutes of Meeting</h1>
                </div>

                <div class="flex flex-wrap mb-4">
                    <div class="w-full md:w-1/2 md:pr-2">
                        <div class="form-group">
                            <label for="meeting_title" class="block text-sm font-medium text-gray-700 mt-4">Meeting
                                Title:</label>
                            <input type="text" id="meeting_title" name="meeting_title"
                                class="has-tooltip shadow appearance-none border rounded w-full md:w-4/5 lg:w-4/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                value="{{ old('meeting_title', $notulen->meeting_title) }}" required
                                data-tooltip="Please enter the title of the meeting in this field. The title should be descriptive enough to clearly identify the purpose of the meeting. For example, you might enter something like 'Quarterly Sales Review' or 'Project Kickoff Meeting'. This field is required and must be filled out to proceed.">
                        </div>
                        <div class="mb-4 relative has-tooltip" data-tooltip="Select one or more departments relevant to the meeting...">
                            <label for="department" class="block text-gray-700 text-sm font-bold mb-2">Department</label>
                            <div class="relative w-full md:w-4/5 lg:w-4/5">
                        
                                <!-- Div that should be in front -->
                                <div id="dropdown-toggle" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline cursor-pointer flex justify-between items-center z-10 relative" onclick="toggleDropdown()">
                                    <span id="dropdown-label" class="truncate">
                                        @php
                                            $selectedDepartments = json_decode(old('department', $notulen->department), true);
                                            echo empty($selectedDepartments) ? 'Select Departments' : implode(', ', $selectedDepartments);
                                        @endphp
                                    </span>
                                    <svg class="inline w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                        
                                <!-- Input field that should be behind -->
                                <input type="text" id="dummyInput" class="absolute inset-0 shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline cursor-pointer z-0" required>
                        
                            </div>
                        
                            <div id="checkbox-dropdown" class="absolute hidden shadow bg-white border rounded mt-2 w-full md:w-4/5 lg:w-4/5 z-10">
                                <div class="p-2">
                                    @php
                                        $departments = ['HR', 'IT', 'Finance', 'Marketing'];
                                        $selectedDepartments = json_decode(old('department', $notulen->department), true);
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
                        
                                // Toggle required attribute on the dummy input based on checkbox selection
                                const dummyInput = document.getElementById('dummyInput');
                                if (checkboxes.length > 0) {
                                    dummyInput.required = false; // Remove required if one or more checkboxes are checked
                                } else {
                                    dummyInput.required = true;  // Add required if no checkboxes are checked
                                }
                            }
                        
                            // Close the dropdown if the user clicks outside of it
                            document.addEventListener('click', function(event) {
                                const dropdown = document.getElementById('checkbox-dropdown');
                                const button = document.getElementById('dropdown-toggle');
                        
                                // Close the dropdown only if clicking outside both the button and the dropdown
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
                                        class="has-tooltip shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        value="{{ old('meeting_date', $notulen->meeting_date) }}" required
                                        data-tooltip="Select the meeting date from the calendar. The date should be in the format YYYY-MM-DD. Ensure that the date you select is correct, as it will be used to schedule the meeting and cannot be changed once submitted. If the date is incorrect, you may need to update it before finalizing the submission.">
                                </div>
                            </div>
                            <div class="w-1/2 pl-2">
                                <div class="form-group">
                                    <label for="meeting_time" class="block text-sm font-medium text-gray-700">Meeting
                                        Time:</label>
                                    <input type="time" id="meeting_time" name="meeting_time"
                                        class="has-tooltip shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        value="{{ old('meeting_time', $notulen->meeting_time) }}" required
                                        data-tooltip="Select the meeting time using the time picker. The time should be in the format HH:MM, where hours are in 24-hour format (e.g., 14:30 for 2:30 PM). Ensure the time you select is accurate as it will be used to schedule the meeting. If the time is incorrect, you will need to update it before finalizing the submission. This field is required and must be filled in to proceed with the scheduling.">
                                </div>
                            </div>
                        </div>
                        <div class="has-tooltip form-group mt-4"
                            data-tooltip="Select the meeting location from the dropdown list. You can choose from available options such as conference rooms, online meetings, or specific locations. Make sure to choose the correct location where the meeting will take place. If you select 'Online,' ensure you provide the necessary online meeting details elsewhere. If 'Off-site' or other specific locations are selected, additional information might be needed. This selection is crucial for organizing the meeting and should accurately reflect the meeting's venue.">
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
                        class="has-tooltip shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        rows="4" required
                        data-tooltip="Enter the detailed agenda for the meeting in this text area. Include key topics to be discussed, objectives, and any important points that need to be covered. This section helps to outline the structure of the meeting and ensure all relevant topics are addressed. Make sure to provide clear and organized information to facilitate an efficient and productive meeting. If you have attachments or additional notes related to the agenda, consider mentioning them here or providing links where necessary. This field is required to proceed with the meeting planning.">{{ old('agenda', $notulen->agenda) }}</textarea>
                </div>

                <div class="form-group mt-4">
                    <label for="discussion" class="block text-sm font-medium text-gray-700">Discussion:</label>
                    <textarea id="discussion" name="discussion"
                        class="has-tooltip shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        rows="4"
                        data-tooltip="Provide a detailed summary of the discussions that took place during the meeting in this text area. Include key points, decisions made, action items assigned, and any relevant comments or observations. This section should capture the essence of the meeting's discussion to ensure all participants are informed of what was discussed and agreed upon. Make sure to document any follow-up actions or points that require attention. This information is critical for maintaining accurate records and ensuring accountability.">{{ old('discussion', $notulen->discussion) }}</textarea>
                </div>

                <div class="form-group mt-4">
                    <label for="decisions" class="block text-sm font-medium text-gray-700">Decisions:</label>
                    <textarea id="decisions" name="decisions"
                        class="has-tooltip shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        rows="4"
                        data-tooltip="Document all decisions made during the meeting in this text area. Clearly outline each decision, including who is responsible for executing it, and any relevant deadlines or conditions associated with it. This section is crucial for tracking agreed-upon actions and ensuring accountability. Make sure to be precise and include any important details that were discussed. This record helps in monitoring progress and serves as a reference for future meetings. If there are multiple decisions, consider using bullet points or a numbered list for clarity.">{{ old('decisions', $notulen->decisions) }}</textarea>
                </div>
            </div>



            <div class="bg-white shadow-[0_0px_50px_-15px_rgba(0,0,0,0.3)] rounded-lg overflow-hidden mb-8 p-6">
                <div class="text-white p-4"
                    style="
                background: linear-gradient(135deg, #FF9D03 0%, #FFB75E 100%);
                border-radius: 0.5rem;
            ">
                    <h1 class="text-2xl font-semibold mb-0">Edit Participant & Guest</h1>
                </div>

                <!-- Add participants section -->
                <div class="form-group mt-4">
                    <label for="participants" class="block text-sm font-medium text-gray-700">Participants:</label>
                    <div class="overflow-x-auto">
                        <table
                            class="has-tooltip w-full mt-4 border-collapse border border-gray-300 shadow-md rounded-md overflow-hidden bg-white text-sm"
                            data-tooltip="This table displays the complete list of participants currently associated with this meeting. Each row includes the participant's unique ID, their name, and an action button that allows you to remove them from the list. To add new participants, or to make other changes to the existing list, please use the 'Manage Participants' button below. This button will open a modal where you can search for participants, select or deselect them, and then update the list accordingly.">
                            <thead>
                                <tr class="bg-gradient-to-r from-green-400 to-green-600 text-white">
                                    <th class="border border-gray-300 p-2">ID</th>
                                    <th class="border border-gray-300 p-2">Name</th>
                                    <th class="border border-gray-300 p-2">Action</th>
                                </tr>
                            </thead>
                            <tbody id="participants-container">
                                @foreach ($notulen->participants as $participant)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="border border-gray-300 p-2">
                                            <input type="text" name="participants[]"
                                                value="{{ $participant->id }}" readonly
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        </td>
                                        <td class="border border-gray-300 p-2">
                                            <input type="text" value="{{ $participant->name }}" readonly
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                        </td>
                                        <td class="border border-gray-300 p-2 text-center">
                                            <button type="button"
                                                class="bg-gradient-to-r from-red-400 to-red-600 hover:from-red-500 hover:to-red-700 text-white text-sm font-medium py-1 px-3 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out remove-participant flex items-center justify-center space-x-1">
                                                <i class="zmdi zmdi-delete mr-1"></i>
                                                Remove
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <button type="button" id="add-participant"
                        class="has-tooltip bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white font-bold py-2 px-4 my-4 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out mb-4 focus:outline-none focus:shadow-outline"
                        data-tooltip="Click this button to open the participant management modal, where you can search for new participants to add to the meeting. In the modal, you can select multiple participants, who will then be added to the list of participants for this meeting. Ensure to save your changes after adding participants to update the participant list accordingly.">Add
                        Participant</button>

                    <button type="button"
                        class="has-tooltip open-guest-modal bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white font-bold py-2 px-4 my-4 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out mb-4 focus:outline-none focus:shadow-outline"
                        data-tooltip="Click this button to open the 'Add Guest' modal. In the modal, you can enter the name and email address of a new guest to invite them to the meeting. Make sure to input accurate information, as this will be used to send invitations and meeting details to the guest. After adding a guest, they will appear in the guest list below. Use this feature to efficiently manage additional attendees for the meeting.">Add
                        Guest</button>

                </div>

                <!-- Modal -->
                <!-- Participant Modal -->
                <!-- Participant Modal -->
                <div id="participant-modal" class="fixed z-10 inset-0 hidden overflow-y-auto">
                    <div class="flex items-center justify-center min-h-screen px-4">
                        <!-- Backdrop -->
                        <div class="fixed inset-0 bg-black bg-opacity-30 transition-opacity duration-300 opacity-0"
                            aria-hidden="true"></div>
                        <!-- Modal Content -->
                        <div
                            class="bg-white p-5 rounded-lg shadow-lg sm:w-1/3 w-full transform transition-transform transition-opacity duration-300 ease-out scale-90 opacity-0">
                            <!-- Modal Header -->
                            <h2 class="text-base font-semibold text-gray-800 mb-3">Select Participants</h2>

                            <!-- Search Input -->
                            <div class="mb-3">
                                <input type="text" id="search-participants" placeholder="Search by ID or Name..."
                                    class="w-full px-3 py-1.5 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                            </div>

                            <!-- Participant Table -->
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white border border-gray-300 rounded-md">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="py-1 px-2 border-b text-left text-xs font-medium text-gray-700">
                                                ID</th>
                                            <th class="py-1 px-2 border-b text-left text-xs font-medium text-gray-700">
                                                Name</th>
                                            <th class="py-1 px-2 border-b text-left text-xs font-medium text-gray-700">
                                                Select</th>
                                        </tr>
                                    </thead>
                                    <tbody id="modal-participants-container">
                                        @foreach ($users as $participant)
                                            <tr>
                                                <td class="py-1 px-2 border-b text-sm text-gray-600">
                                                    {{ $participant->id }}</td>
                                                <td class="py-1 px-2 border-b text-sm text-gray-600">
                                                    {{ $participant->name }}</td>
                                                <td class="py-1 px-2 border-b text-center">
                                                    <input type="checkbox"
                                                        class="participant-checkbox h-4 w-4 text-blue-500"
                                                        value="{{ $participant->id }}"
                                                        data-name="{{ $participant->name }}"
                                                        @if ($participant->id == auth()->id()) checked disabled @endif>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Modal Footer -->
                            <div class="mt-3 flex justify-end space-x-2">
                                <button id="add-selected-participants" type="button"
                                    class="bg-gradient-to-r from-blue-400 to-blue-600 text-white text-sm font-medium py-1.5 px-3 rounded-md shadow-md hover:from-blue-500 hover:to-blue-700 transition hidden">Add
                                    Selected</button>
                                <button id="close-modal" type="button"
                                    class="bg-gradient-to-r from-gray-400 to-gray-600 text-white text-sm font-medium py-1.5 px-3 rounded-md shadow-md hover:from-gray-500 hover:to-gray-700 transition">Complete</button>
                            </div>

                        </div>
                    </div>
                </div>






                <!-- Add guests section -->
                <div id="guests-section" class="form-group hidden">
                    <label for="guests" class="block text-sm font-medium text-gray-700">Guests:</label>
                    <div class="overflow-x-auto">
                        <table
                            class="has-tooltip w-full mt-4 border-collapse border border-gray-300 shadow-md rounded-md overflow-hidden bg-white text-sm"
                            data-tooltip="This table displays all the guests invited to the meeting. You can manage guest information, such as their names and email addresses, directly in the table. Use the 'Remove' button to delete a guest if necessary. Remember to use the 'Manage Guests' button below to add new guests or to make bulk changes. Ensure that the guest information is accurate and up-to-date, as it will be used for communication related to the meeting.">
                            <thead class="text-white p-4"
                                style="
                            background: linear-gradient(135deg, #FF9D03 0%, #FFB75E 100%);
                            border-radius: 0.5rem;">
                                <tr>
                                    <th class="border border-gray-300 p-2">Name</th>
                                    <th class="border border-gray-300 p-2">Email</th>
                                    <th class="border border-gray-300 p-2">Action</th>
                                </tr>
                            </thead>
                            <tbody id="guests-container">
                                @foreach ($notulen->guests as $guest)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="border border-gray-300 p-2">
                                            <input type="text" name="guests[{{ $loop->index }}][name]"
                                                value="{{ $guest->name }}"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                placeholder="Guest Name">
                                        </td>
                                        <td class="border border-gray-300 p-2">
                                            <input type="email" name="guests[{{ $loop->index }}][email]"
                                                value="{{ $guest->email }}"
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                placeholder="Guest Email">
                                        </td>
                                        <td class="border border-gray-300 p-2 text-center">
                                            <button type="button"
                                                class="bg-gradient-to-r from-red-400 to-red-600 hover:from-red-500 hover:to-red-700 text-white text-sm font-medium py-1 px-3 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out remove-guest flex items-center justify-center space-x-1">
                                                <i class="zmdi zmdi-delete mr-1"></i>
                                                Remove
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <button type="button"
                        class="open-guest-modal if-guest-empty has-tooltip bg-[#79B51F] hover:bg-[#69A01C] text-white font-bold py-2 px-4 my-4 rounded mb-4 focus:outline-none focus:shadow-outline"
                        data-tooltip="Click this button to open the 'Add Guest' modal. In the modal, you can enter the name and email address of a new guest to invite them to the meeting. Make sure to input accurate information, as this will be used to send invitations and meeting details to the guest. After adding a guest, they will appear in the guest list below. Use this feature to efficiently manage additional attendees for the meeting.">Add
                        Guest</button>
                </div>
                <!-- Guest Modal -->
                <div id="guest-modal" class="fixed z-10 inset-0 hidden overflow-y-auto">
                    <div class="flex items-center justify-center min-h-screen px-4">
                        <!-- Backdrop -->
                        <div class="fixed inset-0 bg-black bg-opacity-30 transition-opacity duration-300 opacity-0"
                            aria-hidden="true"></div>
                        <!-- Modal Content -->
                        <div
                            class="bg-white p-5 rounded-lg shadow-lg w-full sm:w-1/3 mx-4 transform transition-transform transition-opacity duration-300 ease-out scale-90 opacity-0">
                            <!-- Modal Header -->
                            <h2 class="text-base font-semibold text-gray-800 mb-4">Add Guest</h2>

                            <!-- Guest Name Input -->
                            <div class="mb-3">
                                <label for="guest-name" class="block text-sm font-medium text-gray-700">Name:</label>
                                <input type="text" id="guest-name"
                                    class="w-full px-3 py-1.5 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                                    placeholder="Guest Name">
                            </div>

                            <!-- Guest Email Input -->
                            <div class="mb-3">
                                <label for="guest-email"
                                    class="block text-sm font-medium text-gray-700">Email:</label>
                                <input type="email" id="guest-email"
                                    class="w-full px-3 py-1.5 border border-gray-300 rounded text-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                                    placeholder="Guest Email">
                            </div>

                            <!-- Modal Footer -->
                            <div class="flex justify-end space-x-2">
                                <button id="add-guest" type="button"
                                    class="bg-gradient-to-r from-blue-400 to-blue-600 text-white text-sm font-medium py-1.5 px-3 rounded-md shadow-md hover:from-blue-500 hover:to-blue-700 transition">Add
                                    Guest</button>
                                <button id="close-guest-modal" type="button"
                                    class="bg-gradient-to-r from-gray-400 to-gray-600 text-white text-sm font-medium py-1.5 px-3 rounded-md shadow-md hover:from-gray-500 hover:to-gray-700 transition">Close</button>
                            </div>

                        </div>
                    </div>
                </div>






            </div>






            <div class="has-tooltip bg-white shadow-[0_0px_50px_-15px_rgba(0,0,0,0.3)] rounded-lg overflow-hidden mb-8 p-6"
                data-tooltip="This section allows you to edit the details of a task. Use the options provided to modify task information such as the topic, description, due date, person in charge, and other relevant details. Ensure that all changes are accurate before saving to keep the task information up to date.">
                <div class="text-white p-4"
                    style="
                background: linear-gradient(135deg, #FF9D03 0%, #FFB75E 100%);
                border-radius: 0.5rem;
            ">
                    <h1 class="text-2xl font-semibold mb-0">Edit Task</h1>
                </div>

                <div class="form-group p-4 bg-gray-50 rounded-lg shadow-md">
                    <div class="form-group p-4">
                        {{-- <label for="tasks" class="block text-sm font-medium text-gray-700 mb-2">Tasks:</label> --}}
                        <div id="tasks-container">
                            <!-- Loop through each task only once -->
                            @foreach ($notulen->tasks as $taskIndex => $task)
                            <div class="task-item mb-4 p-4 border shadow-lg rounded-md bg-gradient-to-r from-orange-200 to-orange-300">
                                <div class="task-item mb-4 p-4 border border-gray-300 rounded-md shadow-sm bg-white">
                                    <input type="hidden" name="tasks[{{ $taskIndex }}][task_id]"
                                        value="{{ $task->id }}">


                                    <!-- Task Topic and Due Date -->
                                    <div class="flex items-center mb-4 space-x-4 bg-gradient-to-r from-green-400 to-green-600 p-4 rounded-md">
                                        <input type="text" name="tasks[{{ $taskIndex }}][task_topic]"
                                            value="{{ $task->task_topic }}"
                                            class="has-tooltip shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            placeholder="Task Topic"
                                            required
                                            data-tooltip="Enter the topic or title of the task. This should be a brief and descriptive label that summarizes the main objective or focus of the task. The topic helps identify and categorize the task for easier reference and management.">
                                        <input type="date" name="tasks[{{ $taskIndex }}][task_due_date]"
                                            value="{{ $task->task_due_date }}"
                                            class="has-tooltip shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            placeholder="Due Date"
                                            required
                                            data-tooltip="Select the due date for the task. This date should indicate when the task is expected to be completed. Make sure to choose a realistic deadline that allows sufficient time for task completion. The due date helps in tracking the progress and ensuring timely execution of tasks.">
                                        <button type="button"
                                            class="has-tooltip bg-gradient-to-r from-red-400 to-red-600 hover:from-red-500 hover:to-red-700 text-white text-sm font-medium py-1 px-3 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out remove-task flex items-center justify-center space-x-1"
                                            data-tooltip="Click to remove this task from the list. This action will delete the task and it will no longer be visible in the task list. Be cautious as this action may be irreversible depending on the application's settings. Make sure you really want to remove this task before confirming the action.">
                                            <i class="zmdi zmdi-delete mr-1"></i>
                                            Remove
                                        </button>
                                    </div>


                                    <!-- Modal -->
                                    <div id="picModal_{{ $taskIndex }}"
                                        class="fixed z-10 inset-0 hidden overflow-y-auto">
                                        <div class="flex items-center justify-center min-h-screen px-4">
                                            <!-- Backdrop -->
                                            <div
                                                class="fixed inset-0 bg-black bg-opacity-30 transition-opacity duration-300 opacity-0">
                                            </div>
                                            <!-- Modal Content -->
                                            <div
                                                class="bg-white rounded-lg shadow-lg sm:max-w-md w-full transform transition-transform transition-opacity duration-300 ease-out scale-90 opacity-0">
                                                <!-- Modal Header -->
                                                <div
                                                    class="bg-white border-b border-gray-200 px-4 py-2.5 rounded-t-lg">
                                                    <h3 class="text-sm font-medium text-gray-700">Assign Person in
                                                        Charge
                                                        (PIC)</h3>
                                                </div>
                                                <!-- Modal Content -->
                                                <div class="px-4 py-3 max-h-80 overflow-y-auto">
                                                    <input type="text" id="picSearch_{{ $taskIndex }}"
                                                        class="border border-gray-300 rounded w-full py-1.5 px-2 text-sm text-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                                        placeholder="Search participants or guests">
                                                    <div id="task_pic_container_{{ $taskIndex }}"
                                                        class="mt-3 space-y-2">
                                                        <!-- Loop through participants -->
                                                        @foreach ($notulen->participants as $participant)
                                                            <div class="participant-item flex justify-between items-center p-2 border-b border-gray-100"
                                                                data-id="{{ $participant->id }}"
                                                                data-name="{{ $participant->name }}">
                                                                <span
                                                                    class="text-sm text-gray-700">{{ $participant->name }}</span>
                                                                <input type="checkbox"
                                                                    name="tasks[{{ $taskIndex }}][task_pic][]"
                                                                    value="{{ $participant->id }}"
                                                                    {{ in_array($participant->id, json_decode($task->task_pic, true)) ? 'checked' : '' }}
                                                                    class="h-4 w-4 text-blue-600 pic-checkbox">
                                                            </div>
                                                        @endforeach

                                                        <!-- Loop through guest PICs, adding 'g_' prefix when rendering -->
                                                        @foreach ($notulen->guests as $guest)
                                                            <div class="guest-item flex justify-between items-center p-2 border-b border-gray-100"
                                                                data-id="g_{{ $guest->id }}"
                                                                data-name="{{ $guest->name }}">
                                                                <span
                                                                    class="text-sm text-gray-700">{{ $guest->name }}
                                                                    (Guest)
                                                                </span>
                                                                <input type="checkbox"
                                                                    name="tasks[{{ $taskIndex }}][task_pic][]"
                                                                    value="g_{{ $guest->id }}"
                                                                    {{ in_array($guest->id, json_decode($task->guest_pic, true)) ? 'checked' : '' }}
                                                                    class="h-4 w-4 text-blue-600 guest-checkbox">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <!-- Modal Footer -->
                                                <div
                                                    class="bg-gray-50 px-4 py-2.5 flex justify-end space-x-2 rounded-b-lg">
                                                    <button type="button"
                                                        class="bg-gradient-to-r from-blue-400 to-blue-600 text-white text-sm font-semibold py-1 px-3 rounded shadow-md hover:from-blue-500 hover:to-blue-700 transition"
                                                        id="selectPICBtn_{{ $taskIndex }}">Save</button>
                                                    <button type="button"
                                                        class="bg-gradient-to-r from-red-400 to-red-600 text-white text-sm font-semibold py-1 px-3 rounded shadow-md hover:from-red-500 hover:to-red-700 transition hidden"
                                                        id="closePicModalBtn_{{ $taskIndex }}">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Button to open the modal -->
                                    <button
                                        class=" text-white px-4 py-2 rounded-md bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700"
                                        id="openPicModalBtn_{{ $taskIndex }}"
                                        data-task-index="{{ $taskIndex }}" type="button">
                                        Assign Person in Charge (PIC)
                                    </button>

                                    <!-- Display selected participants and guests -->
                                    <div id="selectedPicContainer_{{ $taskIndex }}" class="mt-4">
                                        <h3 class="text-sm font-medium text-gray-700">Selected Person in Charge (PIC):
                                        </h3>
                                        <ul id="selectedPicList_{{ $taskIndex }}" class="mt-2 space-y-1">
                                            <!-- Selected participants and guests will be shown here -->
                                        </ul>
                                    </div>




                                    <!-- Completion Section -->
                                    <div class="mb-4">
                                        <label for="task_completion"
                                            class="block text-sm font-medium text-gray-700 mb-1">Completion:</label>
                                        <select name="tasks[{{ $taskIndex }}][task_completion]"
                                            class="has-tooltip px-3 py-2 border border-gray-300 rounded-md shadow-sm w-full"
                                            data-tooltip="Select the current completion percentage of the task from the dropdown. Choose the percentage that best represents the progress of the task, ranging from 0% (not started) to 100% (completed). This helps track the task's progress and ensures that all tasks are up-to-date with their respective completion status.">
                                            <option value="0%" {{ $task->completion == '0%' ? 'selected' : '' }}>
                                                0%
                                            </option>
                                            <option value="25%" {{ $task->completion == '25%' ? 'selected' : '' }}>
                                                25%
                                            </option>
                                            <option value="50%" {{ $task->completion == '50%' ? 'selected' : '' }}>
                                                50%
                                            </option>
                                            <option value="75%" {{ $task->completion == '75%' ? 'selected' : '' }}>
                                                75%
                                            </option>
                                            <option value="100%"
                                                {{ $task->completion == '100%' ? 'selected' : '' }}>
                                                100%</option>
                                        </select>
                                    </div>

                                    <!-- Description Section -->
                                    <div class="mb-4">
                                        <label for="task_description"
                                            class="block text-sm font-medium text-gray-700 mb-1">Description:</label>
                                        <textarea name="tasks[{{ $taskIndex }}][description]"
                                            class="has-tooltip shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            data-tooltip="Enter a detailed description of the task. This should include any relevant information or notes about the task that can help in understanding its requirements, objectives, and progress. The description provides context and clarity to ensure everyone involved in the task is aware of its specifics.">{{ $task->description }}</textarea>
                                    </div>

                                    <!-- Attachments Section -->
                                    <div class="has-tooltip mb-4"
                                        data-tooltip="Use this section to manage file attachments related to the task. If there is an existing attachment, you can view it by clicking the 'View Current Attachment' link. If no attachment is present, it will display 'No attachment'. You can add or replace the attachment by selecting a file from your computer using the file input below. Ensure that the file you upload is relevant to the task and properly labeled.">
                                        <label for="task_attachments"
                                            class="block text-sm font-medium text-gray-700 mb-1">Attachments:</label>
                                        @if ($task->attachment)
                                            <!-- Check if there is an attachment -->
                                            <div class="mb-2">
                                                <a href="{{ asset('storage/' . $task->attachment) }}" target="_blank"
                                                    class="text-green-700 hover:underline">
                                                    View Current Attachment
                                                </a>
                                            </div>
                                        @else
                                            <div class="text-gray-500 mb-2">No attachment</div>
                                        @endif
                                        <input type="file" name="tasks[{{ $taskIndex }}][attachment]"
                                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                    </div>

                                    <!-- Console log for debugging -->
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            @if ($task->attachment)
                                                console.log('Task {{ $task->id }} has an attachment: {{ $task->attachment }}');
                                            @else
                                                console.log('Task {{ $task->id }} does not have an attachment.');
                                            @endif
                                        });
                                    </script>
                                </div>
                            </div>

                            @endforeach

                        </div>
                        <button type="button" id="add-task"
                            class="bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white font-bold py-2 px-4 my-4 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out focus:outline-none focus:shadow-outline">
                            Add Task
                        </button>
                    </div>

                </div>


            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white font-bold py-2 px-4 mb-4 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out w-full focus:outline-none focus:shadow-outline">Update</button>

            </div>

        </form>

        {{-- <div class="grid gap-4 mb-4">
            </div> --}}



    </div>

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
                    (event.deltaY > 0 && scrollTop + offsetHeight >=
                    scrollHeight) // Scrolling down at the bottom
                ) {
                    event.preventDefault();
                }

                event.stopPropagation(); // Stop the wheel event from propagating to the page
            });
        });

        // Add Participant
        // Open Modal
        document.getElementById('add-participant').addEventListener('click', function() {
            // Show the modal container first
            const modal = document.getElementById('participant-modal');
            modal.classList.remove('hidden');

            // Trigger the opening transition
            setTimeout(() => {
                modal.querySelector('.fixed.inset-0').classList.remove('opacity-0');
                modal.querySelector('.transform').classList.remove('opacity-0', 'scale-90');
                modal.querySelector('.transform').classList.add('opacity-100', 'scale-100');
            }, 10);

            // Get the list of already selected participant IDs
            const selectedParticipantIds = Array.from(document.querySelectorAll(
                    '#participants-container input[name="participants[]"]'))
                .map(input => input.value);

            // Check the corresponding checkboxes in the modal
            document.querySelectorAll('.participant-checkbox').forEach(function(checkbox) {
                checkbox.checked = selectedParticipantIds.includes(checkbox.value);
            });
        });

        // Close Modal
        document.getElementById('close-modal').addEventListener('click', function() {
            const modal = document.getElementById('participant-modal');

            // Trigger the closing transition
            modal.querySelector('.fixed.inset-0').classList.add('opacity-0');
            modal.querySelector('.transform').classList.remove('opacity-100', 'scale-100');
            modal.querySelector('.transform').classList.add('opacity-0', 'scale-90');

            // Hide the modal after the transition
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // Match this duration with your CSS transition time
        });


        // Add/Remove Participants on Checkbox Change
        // Add/Remove Participants on Checkbox Change
        // Update PIC options when a participant is added/removed
        document.querySelectorAll('.participant-checkbox').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const participantId = checkbox.value;
                const participantName = checkbox.getAttribute('data-name');
                const container = document.getElementById('participants-container');

                if (checkbox.checked) {
                    // Add participant
                    if (!Array.from(container.querySelectorAll('input[name="participants[]"]')).some(
                            input => input.value === participantId)) {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                    <td class="border border-gray-300 p-2">
                        <input type="text" name="participants[]" value="${participantId}" readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </td>
                    <td class="border border-gray-300 p-2">
                        <input type="text" value="${participantName}" readonly class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </td>
                    <td class="border border-gray-300 p-2 text-center">
                        <button type="button" 
                        class="bg-gradient-to-r from-red-400 to-red-600 hover:from-red-500 hover:to-red-700 text-white text-sm font-medium py-1 px-3 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out remove-participant flex items-center justify-center space-x-1">
                        <i class="zmdi zmdi-delete mr-1"></i>
                        Remove
                    </button>

                    </td>
                `;
                        container.appendChild(row);
                    }
                } else {
                    // Remove participant
                    const rowToRemove = Array.from(container.querySelectorAll('tr'))
                        .find(row => row.querySelector('input[name="participants[]"]').value ===
                            participantId);
                    if (rowToRemove) {
                        rowToRemove.remove();
                    }
                }

                // Update checkboxes in all task items
                Array.from(document.querySelectorAll('[id^="task_pic_container_"]')).forEach((container,
                    i) => {
                    updatePICCheckboxes(i);
                });
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
        // Add Task
        document.getElementById('add-task').addEventListener('click', function() {
            const container = document.getElementById('tasks-container');
            const index = container.children.length; // Get the current number of task items
            const item = document.createElement('div');
            item.classList.add('task-item', 'mb-4', 'p-4', 'border', 'shadow-lg', 'rounded-md', 'bg-gradient-to-r', 'from-orange-200', 'to-orange-300');
            item.innerHTML = `
            <div class="task-item mb-4 p-4 border border-gray-300 rounded-md shadow-sm bg-white">
                
                               <div class="flex items-center mb-4 space-x-4 bg-gradient-to-r from-green-400 to-green-600 p-4 rounded-md">
                    <input type="text" name="tasks[${index}][task_topic]" 
                        class="border border-gray-300 rounded-md shadow-sm w-full mr-2 px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" 
                        placeholder="Task Topic">
                    <input type="date" name="tasks[${index}][task_due_date]" 
                        class="border border-gray-300 rounded-md shadow-sm w-full mr-2 px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" 
                        placeholder="Due Date">
                    <input type="hidden" name="tasks[${index}][task_id]">
            <button type="button" 
                class="remove-task bg-gradient-to-r from-red-400 to-red-600 hover:from-red-500 hover:to-red-700 text-white text-sm font-medium py-1 px-3 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out flex items-center justify-center space-x-1">
                <i class="zmdi zmdi-delete mr-1"></i>
                Remove
            </button>
                </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Person in Charge (PIC):</label>
            <button class="bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white px-4 py-2 rounded-md"
                id="openPicModalBtn_${index}" data-task-index="${index}" type="button">
                Assign Person in Charge (PIC)
            </button>
            <div id="selectedPicContainer_${index}" class="mt-4">
                <h3 class="text-sm font-medium text-gray-700">Selected Person in Charge (PIC):</h3>
                <ul id="selectedPicList_${index}" class="mt-2 space-y-1">
                    <!-- Selected participants and guests will be shown here -->
                </ul>
            </div>
        </div>

         <!-- PIC Modal -->
                                <div id="picModal_${index}"
                                    class="fixed z-10 inset-0 hidden overflow-y-auto">
                                    <div class="flex items-center justify-center min-h-screen px-4">
                                        <!-- Backdrop -->
                                        <div
                                            class="fixed inset-0 bg-black bg-opacity-30 transition-opacity duration-300 opacity-0">
                                        </div>
                                        <!-- Modal Content -->
                                        <div
                                            class="bg-white rounded-lg shadow-lg sm:max-w-md w-full transform transition-transform transition-opacity duration-300 ease-out scale-90 opacity-0">
                                            <!-- Modal Header -->
                                            <div class="bg-white border-b border-gray-200 px-4 py-2.5 rounded-t-lg">
                                                <h3 class="text-sm font-medium text-gray-700">Assign Person in Charge
                                                    (PIC)</h3>
                                            </div>
                                            <!-- Modal Content -->
                                            <div class="px-4 py-3 max-h-80 overflow-y-auto">
                                                <input type="text" id="picSearch_${index}"
                                                    class="border border-gray-300 rounded w-full py-1.5 px-2 text-sm text-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500"
                                                    placeholder="Search participants or guests">
                                                <div id="task_pic_container_${index}"
                                                    class="mt-3 space-y-2">
                                                    <!-- Loop through participants -->
                                                    @foreach ($notulen->participants as $participant)
                                                        <div class="participant-item flex justify-between items-center p-2 border-b border-gray-100"
                                                            data-id="{{ $participant->id }}"
                                                            data-name="{{ $participant->name }}">
                                                            <span
                                                                class="text-sm text-gray-700">{{ $participant->name }}</span>
                                                            <input type="checkbox"
                                                                name="tasks[${index}][task_pic][]"
                                                                value="{{ $participant->id }}"

                                                                class="h-4 w-4 text-blue-600 pic-checkbox">
                                                        </div>
                                                    @endforeach

                                                    <!-- Loop through guest PICs, adding 'g_' prefix when rendering -->
                                                    @foreach ($notulen->guests as $guest)
                                                        <div class="guest-item flex justify-between items-center p-2 border-b border-gray-100"
                                                            data-id="g_{{ $guest->id }}"
                                                            data-name="{{ $guest->name }}">
                                                            <span class="text-sm text-gray-700">{{ $guest->name }}
                                                                (Guest)</span>
                                                            <input type="checkbox"
                                                                name="tasks[${index}][task_pic][]"
                                                                value="g_{{ $guest->id }}"
                                                                class="h-4 w-4 text-blue-600 guest-checkbox">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- Modal Footer -->
                                            <div
                                                class="bg-gray-50 px-4 py-2.5 flex justify-end space-x-2 rounded-b-lg">
                                                <button type="button"
                                                    class="bg-gradient-to-r from-blue-400 to-blue-600 text-white text-sm font-semibold py-1 px-3 rounded shadow-md hover:from-blue-500 hover:to-blue-700 transition"
                                                    id="selectPICBtn_${index}">Save</button>
                                                <button type="button"
                                                    class="bg-gradient-to-r from-red-400 to-red-600 text-white text-sm font-semibold py-1 px-3 rounded shadow-md hover:from-red-500 hover:to-red-700 transition hidden"
                                                    id="closePicModalBtn_${index}">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                <!-- Replace status with completion -->
                <div class="mb-4">
                    <label for="task_completion" class="block text-sm font-medium text-gray-700 mb-1">Completion:</label>
                    <select name="tasks[${index}][task_completion]" 
                        class="border border-gray-300 rounded-md shadow-sm w-full px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="0%">0%</option>
                        <option value="25%">25%</option>
                        <option value="50%">50%</option>
                        <option value="75%">75%</option>
                        <option value="100%">100%</option>
                    </select>
                </div>
                        <div class="mb-4">
                            <label for="task_description" class="block text-sm font-medium text-gray-700 mb-1">Description:</label>
                            <textarea name="tasks[${index}][description]" 
                                class="border border-gray-300 rounded-md shadow-sm w-full px-3 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="task_attachment_${index}" class="block text-sm font-medium text-gray-700 mb-1">Attachment:</label>
                            <input type="file"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                                id="task_attachment_${index}" name="tasks[${index}][attachment]">
                        </div>
            </div>
 
                    `;

            container.appendChild(item);

            // Update the PIC checkboxes for this new task
            updatePICCheckboxes(index);
            // Add event listener to the newly added remove button
            item.querySelector('.remove-task').addEventListener('click', function() {
                container.removeChild(item);
            });

            // Attach modal event listeners for the new task
            attachModalEventListeners(index);
        });

        // Function to attach modal event listeners for the "Assign Person in Charge" button
        function attachModalEventListeners(taskIndex) {
            const modal = document.getElementById(`picModal_${taskIndex}`);
            const openBtn = document.getElementById(`openPicModalBtn_${taskIndex}`);
            const closeBtn = document.getElementById(`closePicModalBtn_${taskIndex}`);
            const saveBtn = document.getElementById(`selectPICBtn_${taskIndex}`);
            const searchInput = document.getElementById(`picSearch_${taskIndex}`);
            const participantItems = modal.querySelectorAll('.participant-item');
            const guestItems = modal.querySelectorAll('.guest-item');
            const selectedPicList = document.getElementById(`selectedPicList_${taskIndex}`);

            // Load selected participants and guests on page load
            updateSelectedList(participantItems, guestItems, selectedPicList);

            // Open modal
            openBtn.addEventListener('click', () => {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modal.querySelector('.fixed.inset-0').classList.remove('opacity-0');
                    modal.querySelector('.transform').classList.remove('opacity-0', 'scale-90');
                    modal.querySelector('.transform').classList.add('opacity-100', 'scale-100');
                }, 10);
            });

            // Close modal
            closeBtn.addEventListener('click', () => {
                closePICModal(modal);
            });

            // Save selected participants and guests
            saveBtn.addEventListener('click', () => {
                updateSelectedList(participantItems, guestItems, selectedPicList);
                closePICModal(modal);
            });

            // Search functionality
            searchInput.addEventListener('input', function() {
                const filter = this.value.toLowerCase();

                // Filter participant items
                participantItems.forEach(item => {
                    const name = item.dataset.name.toLowerCase();
                    item.style.display = name.includes(filter) ? 'flex' : 'none';
                });

                // Filter guest items
                guestItems.forEach(item => {
                    const name = item.dataset.name.toLowerCase();
                    item.style.display = name.includes(filter) ? 'flex' : 'none';
                });
            });
        }


        function updateSelectedList(participantItems, guestItems, selectedPicList) {
            selectedPicList.innerHTML = ''; // Clear the list

            participantItems.forEach(item => {
                const checkbox = item.querySelector('input[type="checkbox"]');
                if (checkbox.checked) {
                    const name = item.dataset.name;
                    const li = document.createElement('li');
                    li.classList.add('text-sm', 'text-gray-700');
                    li.textContent = name;
                    selectedPicList.appendChild(li);
                }
            });

            guestItems.forEach(item => {
                const checkbox = item.querySelector('input[type="checkbox"]');
                if (checkbox.checked) {
                    const name = item.dataset.name + ' (Guest)';
                    const li = document.createElement('li');
                    li.classList.add('text-sm', 'text-gray-700');
                    li.textContent = name;
                    selectedPicList.appendChild(li);
                }
            });
        }

        function closePICModal(modal) {
            modal.querySelector('.fixed.inset-0').classList.add('opacity-0');
            modal.querySelector('.transform').classList.remove('opacity-100', 'scale-100');
            modal.querySelector('.transform').classList.add('opacity-0', 'scale-90');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }


        // Function to update PIC options for a specific task index
        // Function to update PIC options for a specific task index in the modal
        function updatePICCheckboxes(index) {
            const container = document.getElementById(`task_pic_container_${index}`);
            const participants = Array.from(document.querySelectorAll('input[name="participants[]"]'));
            const guests = Array.from(document.querySelectorAll('input[name^="guests["]'));

            // Convert guests to an array of objects and ensure uniqueness based on email
            const guestArray = guests.map(guest => {
                const guestRow = guest.closest('tr');
                return {
                    id: guestRow.querySelector('input[name$="[email]"]').value,
                    name: guestRow.querySelector('input[name$="[name]"]').value
                };
            });

            // Remove duplicates based on the id
            const uniqueGuests = Array.from(new Map(guestArray.map(guest => [guest.id, guest])).values());

            // Store the current checked state
            const checkedParticipants = Array.from(container.querySelectorAll('input[type="checkbox"]'))
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);

            container.innerHTML = ''; // Clear existing checkboxes

            // Loop through participants and create checkboxes in the modal structure
            participants.forEach(participant => {
                const participantId = participant.value;
                const participantName = participant.closest('tr').querySelector('td:nth-child(2) input').value;

                const isChecked = checkedParticipants.includes(participantId);

                // Create participant container following modal structure
                const checkboxContainer = document.createElement('div');
                checkboxContainer.classList.add('participant-item', 'flex', 'justify-between', 'items-center',
                    'p-2', 'border-b', 'border-gray-100');
                checkboxContainer.setAttribute('data-id', participantId);
                checkboxContainer.setAttribute('data-name', participantName);

                checkboxContainer.innerHTML = `
            <span class="text-sm text-gray-700">${participantName}</span>
            <input type="checkbox" name="tasks[${index}][task_pic][]" value="${participantId}" ${isChecked ? 'checked' : ''} class="h-4 w-4 text-blue-600 pic-checkbox">
        `;

                container.appendChild(checkboxContainer);
            });

            // Loop through unique guests and create checkboxes in the modal structure
            uniqueGuests.forEach(guest => {
                // Prefix the guest ID with 'g_'
                const guestId = `g_${guest.id}`;
                const guestName = guest.name;
                const isChecked = checkedParticipants.includes(guestId);

                // Log the details of the guest being processed
                console.log(`Processing guest:`, {
                    originalId: guest.id,
                    prefixedId: guestId,
                    name: guestName,
                    isChecked: isChecked
                });
                // Create guest container following modal structure
                const checkboxContainer = document.createElement('div');
                checkboxContainer.classList.add('guest-item', 'flex', 'justify-between', 'items-center', 'p-2',
                    'border-b', 'border-gray-100');
                checkboxContainer.setAttribute('data-id', guestId);
                checkboxContainer.setAttribute('data-name', guestName);

                checkboxContainer.innerHTML = `
            <span class="text-sm text-gray-700">${guestName} (Guest)</span>
            <input type="checkbox" name="tasks[${index}][task_pic][]" value="${guestId}" ${isChecked ? 'checked' : ''} class="h-4 w-4 text-blue-600 guest-checkbox">
        `;

                container.appendChild(checkboxContainer);
            });
        }






        // Open Modal
        document.querySelectorAll('.open-guest-modal').forEach(button => {
            button.addEventListener('click', function() {
                const guestModal = document.getElementById('guest-modal');

                // Show the modal container first
                guestModal.classList.remove('hidden');

                // Trigger the opening transition
                setTimeout(() => {
                    guestModal.querySelector('.fixed.inset-0').classList.remove('opacity-0');
                    guestModal.querySelector('.transform').classList.remove('opacity-0',
                        'scale-90');
                    guestModal.querySelector('.transform').classList.add('opacity-100',
                        'scale-100');
                }, 10);
            });
        });

        // Close Modal
        document.getElementById('close-guest-modal').addEventListener('click', function() {
            const guestModal = document.getElementById('guest-modal');

            // Trigger the closing transition
            guestModal.querySelector('.fixed.inset-0').classList.add('opacity-0');
            guestModal.querySelector('.transform').classList.remove('opacity-100', 'scale-100');
            guestModal.querySelector('.transform').classList.add('opacity-0', 'scale-90');

            // Hide the modal after the transition
            setTimeout(() => {
                guestModal.classList.add('hidden');
            }, 300); // Duration should match the CSS transition duration
        });


        // Add Guest
        // Function to check and toggle the visibility of the guests section
        function toggleGuestsSection() {
            const container = document.getElementById('guests-container');
            const guestsSection = document.getElementById('guests-section');
            const addGuestButton = document.querySelector('.if-guest-empty');

            if (container.querySelectorAll('tr').length > 0) {
                guestsSection.classList.remove('hidden');
                addGuestButton.classList.add('hidden'); // Hide the "Add Guest" button
            } else {
                guestsSection.classList.add('hidden');
                addGuestButton.classList.remove('hidden'); // Show the "Add Guest" button
            }
        }

        // Call the function on page load to ensure the correct state
        document.addEventListener('DOMContentLoaded', toggleGuestsSection);

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
            const guestIndex = container.querySelectorAll('tr').length;

            if (Array.from(container.querySelectorAll('input[name^="guests["][email]')).some(input => input
                    .value === email)) {
                alert('This guest is already added.');
                return;
            }

            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="border border-gray-300 p-2">
                    <input type="text" name="guests[${guestIndex}][name]" value="${name}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Guest Name">
                </td>
                <td class="border border-gray-300 p-2">
                    <input type="email" name="guests[${guestIndex}][email]" value="${email}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Guest Email">
                </td>
                <td class="border border-gray-300 p-2 text-center">
                <button type="button" 
                    class="bg-gradient-to-r from-red-400 to-red-600 hover:from-red-500 hover:to-red-700 text-white text-sm font-medium py-1 px-3 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out remove-guest flex items-center justify-center space-x-1">
                    <i class="zmdi zmdi-delete mr-1"></i>
                    Remove
                </button>

                </td>
            `;
            container.appendChild(row);

            // Get the guest modal element
            const guestModal = document.getElementById('guest-modal');

            // Trigger the closing transition
            guestModal.querySelector('.fixed.inset-0').classList.add('opacity-0');
            guestModal.querySelector('.transform').classList.remove('opacity-100', 'scale-100');
            guestModal.querySelector('.transform').classList.add('opacity-0', 'scale-90');

            // Hide the modal after the transition
            setTimeout(() => {
                guestModal.classList.add('hidden');
            }, 300); // Duration should match the CSS transition duration


            nameInput.value = '';
            emailInput.value = '';

            toggleGuestsSection(); // Recheck after adding a guest

            // Update checkboxes in all task items
            Array.from(document.querySelectorAll('[id^="task_pic_container_"]')).forEach((container, i) => {
                updatePICCheckboxes(i);
            });
        });

        // Remove Guest
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-guest')) {
                const row = event.target.closest('tr');

                if (row) {
                    row.remove();
                }

                toggleGuestsSection(); // Recheck after removing a guest
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

            // Temporarily disable browser validation
            this.noValidate = true;

            let allTasksValid = true;

             // Loop through all task containers to check if PIC is selected
    const taskContainers = document.querySelectorAll('[id^="tasks-container"] .task-item');
    taskContainers.forEach((taskContainer, index) => {
        const picCheckboxes = taskContainer.querySelectorAll('.pic-checkbox, .guest-checkbox');
        const isPicSelected = Array.from(picCheckboxes).some(checkbox => checkbox.checked);

        if (!isPicSelected) {
            allTasksValid = false;
            Swal.fire({
                title: 'Validation Error',
                text: `Please select at least one Person in Charge (PIC) for task ${index + 1}.`,
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
            return; // Exit the loop if a task has no PIC selected
        }
    });

            if (this.checkValidity()) {
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
                        this.submit();
                    }
                });
            } else {
                Swal.fire({
                    title: 'Validation Error',
                    text: 'Please fill out all required fields correctly.',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Re-enable browser validation
                    this.noValidate = false;

                    // Scroll to the first invalid field
                    const firstInvalidField = this.querySelector(':invalid');
                    if (firstInvalidField) {
                        firstInvalidField.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });

                        // Focus and trigger the validation message after scrolling
                        setTimeout(() => {
                            firstInvalidField.focus();
                            firstInvalidField.reportValidity(); // Show the validation message
                        }, 500); // Adjust delay as necessary
                    }
                });
            }
        });

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

        document.addEventListener('DOMContentLoaded', function() {
            // Attach event listeners to each "Assign Person in Charge (PIC)" button
            document.querySelectorAll('[id^="openPicModalBtn_"]').forEach(button => {
                const taskIndex = button.dataset.taskIndex;
                const modal = document.getElementById(`picModal_${taskIndex}`);
                const openBtn = document.getElementById(`openPicModalBtn_${taskIndex}`);
                const closeBtn = document.getElementById(`closePicModalBtn_${taskIndex}`);
                const saveBtn = document.getElementById(`selectPICBtn_${taskIndex}`);
                const searchInput = document.getElementById(`picSearch_${taskIndex}`);
                const participantItems = modal.querySelectorAll('.participant-item');
                const guestItems = modal.querySelectorAll('.guest-item');
                const selectedPicList = document.getElementById(`selectedPicList_${taskIndex}`);

                // Load selected participants and guests on page load
                updateSelectedList(participantItems, guestItems, selectedPicList);

                // Open modal
                openBtn.addEventListener('click', () => {
                    modal.classList.remove('hidden');
                    setTimeout(() => {
                        modal.querySelector('.fixed.inset-0').classList.remove('opacity-0');
                        modal.querySelector('.transform').classList.remove('opacity-0',
                            'scale-90');
                        modal.querySelector('.transform').classList.add('opacity-100',
                            'scale-100');
                    }, 10);
                });

                // Close modal
                closeBtn.addEventListener('click', () => {
                    closePICModal(modal);
                });

                // Save selected participants and guests
                saveBtn.addEventListener('click', () => {
                    updateSelectedList(participantItems, guestItems, selectedPicList);
                    closePICModal(modal);
                });

                // Search functionality
                searchInput.addEventListener('input', function() {
                    const filter = this.value.toLowerCase();

                    // Filter participant items
                    participantItems.forEach(item => {
                        const name = item.dataset.name.toLowerCase();
                        item.style.display = name.includes(filter) ? 'flex' : 'none';
                    });

                    // Filter guest items
                    guestItems.forEach(item => {
                        const name = item.dataset.name.toLowerCase();
                        item.style.display = name.includes(filter) ? 'flex' : 'none';
                    });
                });

                // Function to update the list of selected participants and guests
                function updateSelectedList(participantItems, guestItems, selectedPicList) {
                    selectedPicList.innerHTML = ''; // Clear the list

                    // Collect selected participants
                    participantItems.forEach(item => {
                        const checkbox = item.querySelector('input[type="checkbox"]');
                        if (checkbox.checked) {
                            const name = item.dataset.name;
                            if (!isAlreadySelected(name,
                                    selectedPicList)) { // Avoid adding duplicates
                                const li = document.createElement('li');
                                li.classList.add('text-sm', 'text-gray-700');
                                li.textContent = name;
                                selectedPicList.appendChild(li);
                            }
                        }
                    });

                    // Collect selected guests
                    guestItems.forEach(item => {
                        const checkbox = item.querySelector('input[type="checkbox"]');
                        if (checkbox.checked) {
                            const name = item.dataset.name + ' (Guest)';
                            if (!isAlreadySelected(name,
                                    selectedPicList)) { // Avoid adding duplicates
                                const li = document.createElement('li');
                                li.classList.add('text-sm', 'text-gray-700');
                                li.textContent = name;
                                selectedPicList.appendChild(li);
                            }
                        }
                    });
                }

                // Function to check if a name is already in the list
                function isAlreadySelected(name, selectedPicList) {
                    const selectedItems = selectedPicList.querySelectorAll('li');
                    for (let i = 0; i < selectedItems.length; i++) {
                        if (selectedItems[i].textContent === name) {
                            return true;
                        }
                    }
                    return false;
                }

                // Function to close the modal
                function closePICModal(modal) {
                    modal.querySelector('.fixed.inset-0').classList.add('opacity-0');
                    modal.querySelector('.transform').classList.remove('opacity-100', 'scale-100');
                    modal.querySelector('.transform').classList.add('opacity-0', 'scale-90');
                    setTimeout(() => {
                        modal.classList.add('hidden');
                    }, 300);
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

            event.stopPropagation(); // Prevent the document click event from immediately hiding the dropdown
        });

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
