<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Add New MOM</title>
    <!-- Include Tailwind CSS for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
        integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />





    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        /* Hide options by default */
        #task_pic option.hidden-option {
            display: none;
        }

        /* Show option when selected */
        #task_pic option:checked {
            display: block;
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
                                <div id="carousel" class="flex-grow overflow-hidden max-h-[178px]">
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
        class="bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white mx-6 px-4 py-2 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out min-[1380px]:absolute flex items-center justify-center space-x-2">
        <i class="fas fa-home"></i>
        <span>Back to Home</span>
    </a>


    <div class="mx-auto mt-24 ml-10 px-0 absolute bg-white shadow-md rounded-lg mb-6 w-96">
        <!-- Manual Title -->
        <h1 class="text-2xl font-bold text-center py-4">Add a New MoM</h1>

        <!-- Overview Section -->
        <section class="p-4">
            <h2 class="text-xl font-semibold mb-2">Overview</h2>
            <p class="text-sm text-gray-700">
                The "Add a New MoM" page allows users to create new Minutes of Meeting entries quickly and efficiently.
                This page is designed to capture essential meeting details, participant information, and key discussion
                points.
            </p>
        </section>

        <!-- Steps to Add a New MoM -->
        <section class="p-4">
            <h2 class="text-xl font-semibold mb-2">Steps to Add a New MoM</h2>
            <ol class="list-decimal pl-5 text-sm text-gray-700">
                <li><strong>Enter Meeting Details:</strong> Fill in the meeting title, date, time, and location. These
                    fields are mandatory and help identify the meeting.</li>
                <li><strong>Set the Agenda:</strong> Use the "Agenda" field to outline the topics to be discussed. This
                    helps keep the meeting focused and organized.</li>
                <li><strong>Add Participants:</strong> Click on the "Add Participants" button to open a modal. Here, you
                    can select participants from a list or add new ones by entering their name and email. Each
                    participant added will appear in the participant list below.</li>
                <li><strong>Add Guests:</strong> The "Add Guests" section allows you to invite external participants.
                    Use the "Add Guest" button to open a modal where you can enter the guest's name and email.</li>
                <li><strong>Note Action Items:</strong> Use the action items section to document specific tasks assigned
                    to participants. Each action item can include the task description, assignee, and due date.</li>
                <li><strong>Save the MoM:</strong> Once all details are filled out, click the "Save" button to create
                    the new MoM entry. You can also choose to "Save as Draft" if you need to come back and edit the
                    details later.</li>
            </ol>
        </section>

        <!-- Features Section -->
        <section class="p-4">
            <h2 class="text-xl font-semibold mb-2">Features</h2>
            <ul class="list-disc pl-5 text-sm text-gray-700">
                <li><strong>Auto-Save:</strong> The app automatically saves your progress as you enter information,
                    preventing data loss.</li>
                <li><strong>Editable Participants List:</strong> You can easily add or remove participants and guests
                    using the provided options.</li>
                <li><strong>Real-Time Validation:</strong> Fields are validated in real-time to ensure all required
                    information is provided correctly.</li>
                <li><strong>Responsive Design:</strong> The page is optimized for both desktop and mobile devices,
                    making it accessible from anywhere.</li>
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


    {{-- Main Content --}}
    <div class="container mx-auto mt-24 px-0 min-[1380px]:px-80">





        <form id="notulenForm" method="POST" enctype="multipart/form-data" action="{{ route('notulens.store') }}">
            @csrf


            <div class="bg-white shadow-md rounded-lg mb-6">



                <div class="p-6">

                    <div class="text-white p-4"
                        style="
                    background: linear-gradient(135deg, #FF9D03 0%, #FFB75E 100%);
                    border-radius: 0.5rem;
                ">
                        <h2 class="text-xl font-semibold mb-0">Add a New Minutes of Meeting</h2>
                    </div>

                </div>


                <div class="p-6">
                    <div class="flex flex-wrap mb-4">
                        <div class="w-full md:w-1/2 md:pr-2">
                            <div class="mb-4">
                                <label for="meeting_title" class="block text-gray-700 text-sm font-bold mb-2">Meeting
                                    Title</label>
                                <input type="text"
                                    class="has-tooltip shadow appearance-none border rounded w-full md:w-4/5 lg:w-4/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="meeting_title" name="meeting_title" placeholder="Enter meeting title"
                                    required
                                    data-tooltip="Enter a clear and descriptive title for the meeting. The title should provide a brief summary of the meeting's purpose or topic. For example, 'Project Kickoff Meeting' or 'Quarterly Financial Review.' This title will be used to identify and organize the meeting in records and communications, so make sure it is specific and relevant to the meeting content. Avoid vague titles and ensure that the title is easy to understand for all participants.">
                                {{-- md:w-3/5 lg:w-3/5 --}}
                            </div>
                            <div class="mb-4 relative has-tooltip"
                                data-tooltip="Select one or more departments relevant to the meeting. Use the checkboxes to choose the departments involved. For instance, you might select 'HR' if the meeting involves human resources or 'IT' if it relates to information technology. The selected departments help categorize and organize the meeting appropriately. Ensure you select all relevant departments to make sure the right people are informed and involved.">
                                <label for="department"
                                    class="block text-gray-700 text-sm font-bold mb-2">Department</label>
                                <div class="shadow appearance-none border rounded w-full md:w-4/5 lg:w-4/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline cursor-pointer flex justify-between items-center"
                                    onclick="toggleDropdown()">
                                    <span id="dropdown-label" class="truncate">Select Departments</span>
                                    <svg class="inline w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                <div id="checkbox-dropdown"
                                    class="absolute hidden shadow bg-white border rounded mt-2 w-full md:w-4/5 lg:w-4/5 z-10">
                                    <div class="p-2">
                                        <div class="flex items-center mb-2">
                                            <input id="department_hr" name="department[]" type="checkbox"
                                                value="HR" class="mr-2" onchange="updateLabel()">
                                            <label for="department_hr" class="text-gray-700">HR</label>
                                        </div>
                                        <div class="flex items-center mb-2">
                                            <input id="department_it" name="department[]" type="checkbox"
                                                value="IT" class="mr-2" onchange="updateLabel()">
                                            <label for="department_it" class="text-gray-700">IT</label>
                                        </div>
                                        <div class="flex items-center mb-2">
                                            <input id="department_finance" name="department[]" type="checkbox"
                                                value="Finance" class="mr-2" onchange="updateLabel()">
                                            <label for="department_finance" class="text-gray-700">Finance</label>
                                        </div>
                                        <div class="flex items-center mb-2">
                                            <input id="department_marketing" name="department[]" type="checkbox"
                                                value="Marketing" class="mr-2" onchange="updateLabel()">
                                            <label for="department_marketing" class="text-gray-700">Marketing</label>
                                        </div>
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


                            <div class="mb-4">
                                <label for="participants"
                                    class="block text-gray-700 text-sm font-bold mb-2">Participants</label>
                                <button type="button"
                                    class="has-tooltip bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white font-semibold py-2 px-4 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-300"
                                    id="openParticipantModalBtn"
                                    data-tooltip="Click this button to open a modal where you can select participants for the meeting. In the modal, you can search for participants by typing their names and check the boxes next to their names to add them. If you need to add guests who are not in the participant list, you can also open a separate modal to enter their names and email addresses. Make sure to review and select all the people you want to invite to ensure everyone relevant is included in the meeting.">
                                    Select Participants
                                </button>

                                <button type="button"
                                    class="has-tooltip bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white font-semibold py-2 px-4 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-300"
                                    id="openAddGuestModalBtn">Add Guest</button>


                                <input type="hidden" name="participants[]" id="participantsInput" required>

                            </div>
                        </div>
                        <div class="w-full md:w-1/2 md:pl-2">
                            <div class="flex mb-4 md:w-4/5 lg:w-4/5">
                                <div class="w-1/2 pr-2">
                                    <label for="meeting_date"
                                        class="block text-gray-700 text-sm font-bold mb-2">Date</label>
                                    <input type="date"
                                        class="has-tooltip shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="meeting_date" name="meeting_date" required
                                        data-tooltip="Select the date for the meeting using the calendar picker. This date should reflect when the meeting will take place. Click on the calendar icon or the date field to choose the appropriate date. The date format should be YYYY-MM-DD. Make sure to select the correct date to ensure all participants have accurate scheduling information. If the date is incorrect, it might affect the meeting's organization and attendance.">
                                </div>
                                <div class="w-1/2 pl-2">
                                    <label for="meeting_time"
                                        class="block text-gray-700 text-sm font-bold mb-2">Time</label>
                                    <input type="time"
                                        class="has-tooltip shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="meeting_time" name="meeting_time" required
                                        data-tooltip="Enter the start time of the meeting using the time picker. The time should be in the format HH:MM (24-hour clock). Select the hour and minute when the meeting will begin. Click on the time field to open the time picker and adjust the hour and minutes accordingly. Make sure to set the correct time to avoid scheduling conflicts and to ensure all participants join the meeting on time. If the time is incorrect, it may cause confusion and disrupt the meeting schedule.">
                                </div>
                            </div>
                            <div class="mb-4 has-tooltip"
                                data-tooltip="Choose the location where the meeting will take place from the dropdown list. This could be a physical location like a conference room or an online meeting link. If you’re selecting a physical location, ensure it is available and suitable for the meeting. If the meeting is online, make sure to include any necessary details or links in the meeting invite. The selected location will be visible to all participants, so please ensure it is accurate to avoid confusion and ensure a smooth meeting experience.">
                                <label for="meeting_location"
                                    class="block text-gray-700 text-sm font-bold mb-2">Location</label>
                                <select name="meeting_location" id="meeting_location"
                                    class="shadow appearance-none border rounded w-full md:w-4/5 lg:w-4/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                                    <option value="" disabled selected>Select Location</option>
                                    <option value="Location 1">Location 1</option>
                                    <option value="Location 2">Location 2</option>
                                    <option value="Location 3">Location 3</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="scripter"
                                    class="block text-gray-700 text-sm font-bold mb-2">Scripter</label>
                                <input type="text"
                                    class="has-tooltip shadow appearance-none border rounded w-full md:w-4/5 lg:w-4/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shad-outline"
                                    id="scripter" name="scripter" value="{{ $scripter->name }}" readonly
                                    data-tooltip="This field shows the name of the person who created this Minutes of Meeting (MoM). Since you are the one creating this MoM, your name is displayed here automatically. This information helps identify who is responsible for recording and documenting the meeting details. If you need to update the scripter's information or if this is not correct, please check with your system administrator or the person managing the MoM process.">
                            </div>

                        </div>
                    </div>










                    <div class="has-tooltip p-4 participant-section"
                        data-tooltip="This table displays the list of participants who have been selected for the meeting. Each row represents a participant, showing their ID, name, and available actions. You can review the list to ensure that all intended participants are included. The actions column allows you to manage the participant details if needed. If you need to add or remove participants, use the options available elsewhere in the interface. Ensure the list is accurate before finalizing the meeting details.">
                        <h3 class="text-lg leading-6 font-medium text-gray-700">Participant List</h3>
                        <table id="participantsTable"
                            class="w-full mt-4 border-collapse border border-gray-300 shadow-sm rounded-md overflow-hidden bg-white text-sm">
                            <thead class="bg-gradient-to-r from-green-400 to-green-600 text-white">
                                <tr>
                                    <th class="border border-gray-300 p-2 text-left">ID</th>
                                    <th class="border border-gray-300 p-2 text-left">Name</th>
                                    <th class="border border-gray-300 p-2 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="participantsList" class="bg-white divide-y divide-gray-200">
                                <!-- Participant rows will be added here -->
                            </tbody>
                        </table>

                    </div>



                    <div class="has-tooltip p-4 guest-section"
                        data-tooltip="This table displays the list of guests who have been invited to the meeting. Each row includes the guest's name, email address, and available actions. Use this table to review and manage the guest details. Ensure that the information is accurate and complete before finalizing the meeting. The 'Action' column provides options for editing or removing guest entries. If you need to add new guests, you can do so through the appropriate section of the interface.">
                        <h3 class="text-lg leading-6 font-medium text-gray-700">Guest List</h3>
                        <table
                            class="w-full mt-4 border-collapse border border-gray-300 shadow-sm rounded-md overflow-hidden bg-white text-sm">
                            <thead class="bg-gradient-to-r from-green-400 to-green-600 text-white">
                                <tr>
                                    <th class="border border-gray-300 p-2 text-left">Name</th>
                                    <th class="border border-gray-300 p-2 text-left">Email</th>
                                    <th class="border border-gray-300 p-2 text-left">Action</th>
                                </tr>
                            </thead>
                            <tbody id="guestList" class="bg-white divide-y divide-gray-200">
                                <!-- Guest list items will be added here -->
                            </tbody>
                        </table>

                    </div>


                    <div class="mb-4">
                        <label for="agenda" class="block text-gray-700 text-sm font-bold mb-2">Agenda</label>
                        <textarea
                            class="has-tooltip shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="agenda" name="agenda" rows="3" placeholder="Enter agenda" required
                            data-tooltip="Enter the detailed agenda for the meeting in this field. The agenda should outline the key topics and activities planned for the meeting, helping to ensure that all participants are aware of what will be discussed. Use this space to provide a clear and organized list of points or topics that will be covered, along with any relevant details. A well-defined agenda helps in keeping the meeting focused and productive. Make sure to include all necessary items to be addressed during the meeting."></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="discussion" class="block text-gray-700 text-sm font-bold mb-2">Discussion</label>
                        <textarea
                            class="has-tooltip shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="discussion" name="discussion" rows="3" placeholder="Enter discussion" required
                            data-tooltip="Use this field to document the key points and details of the discussions that took place during the meeting. Include summaries of conversations, decisions made, and any relevant comments from participants. This section helps in capturing the essence of the discussions for future reference and ensures that all significant points are recorded. A thorough and accurate description in this field will assist in understanding the outcomes and actions required from the meeting."></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="decisions" class="block text-gray-700 text-sm font-bold mb-2">Decisions</label>
                        <textarea
                            class="has-tooltip shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="decisions" name="decisions" rows="3" placeholder="Enter decisions" required
                            data-tooltip="Use this field to record all decisions made during the meeting. Clearly document each decision along with any relevant details, such as the responsible parties, deadlines, or any conditions attached to the decision. This section is crucial for tracking agreed-upon actions and ensuring that all participants are aware of the outcomes. Accurate recording of decisions helps in following up on action items and verifying that tasks are completed as planned."></textarea>
                    </div>


                </div>









            </div>


            <div class="bg-white shadow-md rounded-lg mb-6">
                <div class="p-6">

                    <div class="text-white p-4"
                        style="
                    background: linear-gradient(135deg, #FF9D03 0%, #FFB75E 100%);
                    border-radius: 0.5rem;
                ">
                        <h2 class="text-xl font-semibold mb-0">Task Section</h2>
                    </div>

                </div>

                <div class="p-6">


                    <!-- Tasks Section -->
                    <h3 class="text-xl font-semibold mt-6 py-6">Task Section</h3>

                    <div class="flex flex-wrap mb-4">

                        <div class="w-full md:w-1/2 md:pr-2">
                            <div class="mb-4 w-full md:w-4/5 md:pr-2">
                                <label for="task_topic" class="block text-gray-700 text-sm font-bold mb-2">Task
                                    Topic</label>
                                <input type="text"
                                    class="has-tooltip shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="task_topic" placeholder="Enter task topic"
                                    data-tooltip="Enter a brief and clear title for the task. This should succinctly describe the main focus or objective of the task. For example, 'Prepare Q3 Financial Report' or 'Update Website Content'. Use specific and descriptive language to ensure that the task is easily understood by all stakeholders. A well-defined task topic helps in organizing and prioritizing tasks effectively, and makes it easier to track progress and responsibilities. Be concise but comprehensive enough to convey the essence of the task."">
                            </div>

                            <!-- Trigger Button -->
                            <div class="mb-4 w-full md:w-4/5 md:pr-2">
                                <label for="task_pic" class="block text-gray-700 text-sm font-bold mb-2">Person in
                                    Charge</label>
                                <button type="button"
                                    class="has-tooltip bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white font-semibold py-2 px-4 mb-2 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-300"
                                    id="openPICModalBtn"
                                    data-tooltip="Click this button to open a modal where you can search for and select the person(s) responsible for this task. The modal allows you to choose multiple people using checkboxes. Once selected, their names will be displayed below in the 'Person in Charge' dropdown. Ensure that the correct individuals are assigned to avoid any confusion or delay in task completion. The dropdown will update to reflect the selected PIC(s).">
                                    Select PIC
                                </button>

                                <select
                                    class="has-tooltip shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="task_pic" name="task_pic[]" multiple
                                    data-tooltip="This dropdown will show the names of the selected persons in charge once you choose them from the modal. If no one is selected, it will display 'There is no PIC selected'. You can select multiple people, and their names will be listed here for easy reference.">
                                    <option value="">There is no PIC selected</option>
                                </select>


                            </div>

                            <!-- Task Completion -->
                            <div class="mb-4 w-full md:w-4/5 md:pr-2">
                                <label for="task_completion"
                                    class="block text-gray-700 text-sm font-bold mb-2">Completion</label>
                                <select
                                    class="has-tooltip shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="task_completion" name="task_completion"
                                    data-tooltip="Select the completion percentage of the task from the dropdown options. Choose from 0%, 25%, 50%, 75%, and 100% to represent the task's progress.">
                                    <option value="0%" selected>0%</option>
                                    <option value="25%">25%</option>
                                    <option value="50%">50%</option>
                                    <option value="75%">75%</option>
                                    <option value="100%">100%</option>
                                </select>
                            </div>

                        </div>

                        <div class="w-full md:w-1/2 md:pl-2">
                            <div class="mb-4 w-full md:w-4/5 md:pr-2">
                                <label for="task_due_date" class="block text-gray-700 text-sm font-bold mb-2">Due
                                    Date</label>
                                <input type="date"
                                    class="has-tooltip shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="task_due_date"
                                    data-tooltip="Select the due date for the task using the date picker. This should be the date by which the task needs to be completed. Click on the date field to open the calendar and choose the appropriate date. Make sure to set a realistic due date to ensure adequate time for task completion and avoid last-minute rushes. Setting a clear due date helps in managing deadlines effectively and keeping track of task progress.">
                            </div>


                            <div class="mb-4 w-full md:w-4/5 md:pr-2">
                                <label for="task_attachment"
                                    class="block text-gray-700 font-medium">Attachment</label>
                                <input type="file" id="task_attachment" name="attachment"
                                    class="has-tooltip mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
                                    data-tooltip="Upload any relevant files related to the task using the file picker. You can attach documents, images, or other types of files that are important for the task. Click on the 'Choose File' button to select a file from your device. Ensure that the file is correctly attached before submitting the form. If you need to attach multiple files, repeat the process for each file. Adding relevant attachments helps in providing additional context or necessary resources for the task.">
                            </div>

                            <!-- Task Description -->
                            <div class="mb-4 w-full md:w-4/5">
                                <label for="task_description"
                                    class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                                <textarea
                                    class="has-tooltip shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="task_description" rows="3" placeholder="Enter task description"
                                    data-tooltip="Provide a detailed description of the task. Include essential information such as objectives, expectations, and any relevant context that will help in understanding the task requirements. Be clear and concise to ensure that all participants are aware of what needs to be accomplished. If applicable, mention any specific guidelines or resources that should be considered while completing the task. This description serves as a reference for everyone involved in the task."></textarea>
                            </div>

                        </div>
                    </div>




                    <button type="button"
                        class="has-tooltip bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white font-semibold py-2 px-4 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-300"
                        id="addTaskBtn"
                        data-tooltip="Click this button to add the task details you have entered to the list. Ensure that all required fields are filled out before clicking this button. This will save the task and allow you to continue managing your tasks. If there are any validation errors or missing information, you will be prompted to correct them before the task is added.">
                        Add Task
                    </button>


                    <div class="has-tooltip overflow-x-auto mb-4 task-table-section"
                        data-tooltip="This table displays the list of tasks with their details. Each row represents a task and includes columns for the topic, person in charge (PIC), due date, status, attachment, and actions. Use this table to view, manage, and perform actions on your tasks. The columns are as follows: Topic (the task's name), PIC (the person responsible for the task), Due Date (when the task is due), Status (the current status of the task), Attachment (any files related to the task), and Action (options to edit or delete the task)">
                        <table
                            class="w-full mt-4 border-collapse border border-gray-300 shadow-sm rounded-md overflow-hidden bg-white text-sm">
                            <thead>
                                <tr class="bg-gradient-to-r from-green-400 to-green-600 text-white">
                                    <th class="border border-gray-300 p-2">Topic</th>
                                    <th class="border border-gray-300 p-2">PIC</th>
                                    <th class="border border-gray-300 p-2">Due Date</th>
                                    <th class="border border-gray-300 p-2">Status</th>
                                    <th class="border border-gray-300 p-2">Description</th>
                                    <th class="border border-gray-300 p-2">Attachment</th>
                                    <th class="border border-gray-300 p-2">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tasksTable">
                                <!-- Task rows will be appended here -->
                            </tbody>
                        </table>

                    </div>

                    <!-- Hidden input to collect tasks -->
                    <input type="hidden" name="tasks" id="tasksInput" required>
                    <input type="hidden" id="guestsInput" name="guests">

                </div>







            </div>

            <div class="bg-white shadow-md rounded-lg mb-6">
                <button type="submit" id="submitBtn"
                    class="has-tooltip bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white font-bold py-2 px-4 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out w-full focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50"
                    data-tooltip="Click this button to submit and add the Minutes of Meeting (MoM). Ensure that all required fields are completed and correct before clicking. This action will save your MoM data, including all the details and attachments you’ve added. If you need to make any changes, review the form fields before submitting.">Add
                    MoM</button>

            </div>


        </form>


    </div>


    <!-- Modal -->
    <div id="participantModal" class="fixed z-10 inset-0 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black bg-opacity-30 transition-opacity duration-300 opacity-0"></div>
            <!-- Modal Content -->
            <div
                class="bg-white rounded-lg shadow-lg sm:max-w-md w-full transform transition-transform transition-opacity duration-300 ease-out scale-90 opacity-0">
                <!-- Modal Header -->
                <div class="bg-white border-b border-gray-200 px-4 py-2.5 rounded-t-lg">
                    <h3 class="text-sm font-medium text-gray-700">Select Participants</h3>
                </div>
                <!-- Modal Content -->
                <div class="px-4 py-3 max-h-80 overflow-y-auto">
                    <input type="text" id="participantSearch"
                        class="border border-gray-300 rounded w-full py-1.5 px-2 text-sm text-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        placeholder="Search participants by name or ID">
                    <div id="participantList" class="mt-3">
                        @foreach ($users as $user)
                            <div class="participant-item flex justify-between items-center p-2 border-b border-gray-100"
                                data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                                <span class="text-sm text-gray-700">{{ $user->name }} (ID:
                                    {{ $user->id }})</span>
                                <input type="checkbox" class="participant-checkbox h-4 w-4 text-blue-600">
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="bg-gray-50 px-4 py-2.5 flex justify-end space-x-2 rounded-b-lg">
                    <button type="button"
                        class="bg-gradient-to-r from-blue-400 to-blue-600 text-white text-sm font-semibold py-1 px-3 rounded shadow-md hover:from-blue-500 hover:to-blue-700 transition"
                        id="selectParticipantsBtn">Select</button>
                    <button type="button"
                        class="bg-gradient-to-r from-red-400 to-red-600 text-white text-sm font-semibold py-1 px-3 rounded shadow-md hover:from-red-500 hover:to-red-700 transition"
                        id="closeParticipantModalBtn">Cancel</button>
                </div>

            </div>
        </div>
    </div>



    <!-- Add Guest Modal -->
    <div id="addGuestModal" class="fixed z-10 inset-0 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black bg-opacity-30 transition-opacity duration-300 opacity-0"
                aria-hidden="true"></div>
            <!-- Modal Content -->
            <div
                class="bg-white rounded-lg shadow-lg sm:max-w-md w-full transform transition-transform transition-opacity duration-300 ease-out scale-90 opacity-0">
                <!-- Modal Header -->
                <div class="bg-white border-b border-gray-200 px-4 py-2.5 rounded-t-lg">
                    <h3 class="text-sm font-medium text-gray-700">Add Guest</h3>
                </div>
                <!-- Modal Content -->
                <div class="px-4 py-3">
                    <label for="guest_name" class="block text-sm text-gray-700 mb-1">Guest Name</label>
                    <input type="text" id="guest_name"
                        class="border border-gray-300 rounded w-full py-1.5 px-2 text-sm text-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        placeholder="Enter guest name">
                    <label for="guest_email" class="block text-sm text-gray-700 mb-1 mt-3">Guest Email</label>
                    <input type="email" id="guest_email"
                        class="border border-gray-300 rounded w-full py-1.5 px-2 text-sm text-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        placeholder="Enter guest email">
                </div>
                <!-- Modal Footer -->
                <div class="bg-gray-50 px-4 py-2.5 flex justify-end space-x-2 rounded-b-lg">
                    <button type="button"
                        class="bg-gradient-to-r from-red-400 to-red-600 text-white text-sm font-semibold py-1 px-3 rounded shadow-md hover:from-red-500 hover:to-red-700 transition"
                        id="closeAddGuestModalBtn">Cancel</button>
                    <button type="button"
                        class="bg-gradient-to-r from-blue-400 to-blue-600 text-white text-sm font-semibold py-1 px-3 rounded shadow-md hover:from-blue-500 hover:to-blue-700 transition"
                        id="addGuestBtn">Add Guest</button>
                </div>

            </div>
        </div>
    </div>



    <!-- PIC Selection Modal -->
    <div id="picModal" class="fixed z-10 inset-0 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-black bg-opacity-30 transition-opacity duration-300 opacity-0"
                aria-hidden="true"></div>
            <!-- Modal Content -->
            <div
                class="bg-white rounded-lg shadow-lg sm:max-w-md w-full transform transition-transform transition-opacity duration-300 ease-out scale-90 opacity-0">
                <!-- Modal Header -->
                <div class="bg-white border-b border-gray-200 px-4 py-2.5 rounded-t-lg">
                    <h3 class="text-sm font-medium text-gray-700">Select Person in Charge</h3>
                </div>
                <!-- Modal Content -->
                <div class="px-4 py-3 max-h-80 overflow-y-auto">
                    <input type="text" id="picSearch"
                        class="border border-gray-300 rounded w-full py-1.5 px-2 text-sm text-gray-600 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        placeholder="Search PICs by name or ID">
                    <div id="picList" class="mt-3">
                        @foreach ($users as $user)
                            <div class="pic-item flex justify-between items-center p-2 border-b border-gray-100"
                                data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                                <span class="text-sm text-gray-700">{{ $user->name }} (ID:
                                    {{ $user->id }})</span>
                                <input type="checkbox" class="pic-checkbox h-4 w-4 text-blue-600">
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="bg-gray-50 px-4 py-2.5 flex justify-end space-x-2 rounded-b-lg">
                    <button type="button"
                        class="bg-gradient-to-r from-red-400 to-red-600 text-white text-sm font-semibold py-1 px-3 rounded shadow-md hover:from-red-500 hover:to-red-700 transition"
                        id="closePICModalBtn">Cancel</button>
                    <button type="button"
                        class="bg-gradient-to-r from-blue-400 to-blue-600 text-white text-sm font-semibold py-1 px-3 rounded shadow-md hover:from-blue-500 hover:to-blue-700 transition"
                        id="selectPICsBtn">Select</button>
                </div>

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
            const openParticipantModalBtn = document.getElementById('openParticipantModalBtn');
            const participantModal = document.getElementById('participantModal');
            const closeParticipantModalBtn = document.getElementById('closeParticipantModalBtn');
            const selectParticipantsBtn = document.getElementById('selectParticipantsBtn');
            const participantSearch = document.getElementById('participantSearch');
            const participantList = document.getElementById('participantList');
            const participantsList = document.getElementById('participantsList');
            const participantsInput = document.getElementById('participantsInput');
            const taskPicSelect = document.getElementById('task_pic');

            const openPICModalBtn = document.getElementById('openPICModalBtn');
            const picModal = document.getElementById('picModal');
            const closePICModalBtn = document.getElementById('closePICModalBtn');
            const picList = document.getElementById('picList');
            const taskPic = document.getElementById('task_pic');

            const addGuestBtn = document.getElementById('addGuestBtn');
            const guestNameInput = document.getElementById('guest_name');
            const guestEmailInput = document.getElementById('guest_email');
            const guestList = document.getElementById('guestList');
            const guestsInput = document.getElementById('guestsInput');

            const submitBtn = document.getElementById('submitBtn');
            const notulenForm = document.getElementById('notulenForm');


            function populatePicModal() {
                const picList = document.getElementById('picList');
                picList.innerHTML = ''; // Clear existing list

                taskPicSelect.querySelectorAll('option').forEach(option => {
                    if (option.value) { // Skip the default "Select a PIC" option
                        const div = document.createElement('div');
                        div.className = 'pic-item flex justify-between items-center p-2 border-b';
                        div.setAttribute('data-id', option.value);
                        div.setAttribute('data-name', option.textContent);

                        const span = document.createElement('span');
                        span.textContent = `${option.textContent} (ID: ${option.value})`;

                        const checkbox = document.createElement('input');
                        checkbox.type = 'checkbox';
                        checkbox.className = 'pic-checkbox';

                        div.appendChild(span);
                        div.appendChild(checkbox);
                        picList.appendChild(div);
                        // Attach event listener to toggle checkbox when the div is clicked
                        div.addEventListener('click', (e) => {
                            // Prevent the event from firing if the checkbox itself is clicked
                            if (e.target !== checkbox) {
                                checkbox.checked = !checkbox.checked;
                            }
                        });
                    }
                });

                // Add Guests to the modal
                guests.forEach(guest => {
                    const div = document.createElement('div');
                    div.className = 'guest-item flex justify-between items-center p-2 border-b';
                    div.setAttribute('data-id', guest.email); // Using email as a unique ID
                    div.setAttribute('data-name', guest.name);

                    const span = document.createElement('span');
                    span.textContent = `${guest.name} (Guest)`;

                    const checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.className = 'guest-checkbox';

                    div.appendChild(span);
                    div.appendChild(checkbox);
                    picList.appendChild(div);

                    // Attach event listener to toggle checkbox when the div is clicked
                    div.addEventListener('click', (e) => {
                        if (e.target !== checkbox) {
                            checkbox.checked = !checkbox.checked;
                        }
                    });
                });
            }

            // Function to add selected PICs to the target select element
            function addSelectedPICsToTaskPic(selectedPICsAndGuests) {
                // Clear the taskPic select if at least one PIC or guest is selected
                if (selectedPICsAndGuests.length > 0) {
                    taskPic.innerHTML = '';
                } else {
                    taskPic.innerHTML = '<option value="">There is no PIC or Guest selected</option>';
                }

                selectedPICsAndGuests.forEach((item) => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.textContent = `${item.name} (${item.type})`; // Display type in the dropdown
                    option.selected = true; // Make the added option selected
                    taskPic.appendChild(option);
                });
            }


            // Assuming you have a way to trigger this function to open the modal and populate the list
            // Open PIC modal
            document.getElementById('openPICModalBtn').addEventListener('click', function() {
                updateTaskPicOptions(); // Update the task PIC options first
                populatePicModal(); // Then populate the modal

                const picModal = document.getElementById('picModal');
                picModal.classList.remove('hidden');

                // Trigger the opening transition
                setTimeout(() => {
                    picModal.querySelector('.fixed.inset-0').classList.remove('opacity-0');
                    picModal.querySelector('.transform').classList.remove('opacity-0', 'scale-90');
                    picModal.querySelector('.transform').classList.add('opacity-100', 'scale-100');
                }, 10);
            });

            // Close PIC modal
            document.getElementById('closePICModalBtn').addEventListener('click', function() {
                const picModal = document.getElementById('picModal');

                // Trigger the closing transition
                picModal.querySelector('.fixed.inset-0').classList.add('opacity-0');
                picModal.querySelector('.transform').classList.remove('opacity-100', 'scale-100');
                picModal.querySelector('.transform').classList.add('opacity-0', 'scale-90');

                // Hide the modal after the transition
                setTimeout(() => {
                    picModal.classList.add('hidden');
                }, 300); // Match this duration with your CSS transition time
            });


            document.getElementById('selectPICsBtn').addEventListener('click', function() {
                const selectedPICsAndGuests = [];

                // Collect selected PICs
                document.querySelectorAll('#picList .pic-checkbox:checked').forEach(checkbox => {
                    const picItem = checkbox.closest('.pic-item');
                    selectedPICsAndGuests.push({
                        id: picItem.getAttribute('data-id'),
                        name: picItem.getAttribute('data-name'),
                        type: 'PIC' // Mark as PIC
                    });
                });

                // Collect selected Guests
                document.querySelectorAll('#picList .guest-checkbox:checked').forEach(checkbox => {
                    const guestItem = checkbox.closest('.guest-item');
                    selectedPICsAndGuests.push({
                        id: guestItem.getAttribute('data-id'),
                        name: guestItem.getAttribute('data-name'),
                        type: 'Guest' // Mark as Guest
                    });
                });

                // Handle the selected PICs and Guests as needed
                addSelectedPICsToTaskPic(selectedPICsAndGuests);
                console.log(selectedPICsAndGuests);

                // Trigger the closing transition
                picModal.querySelector('.fixed.inset-0').classList.add('opacity-0');
                picModal.querySelector('.transform').classList.remove('opacity-100', 'scale-100');
                picModal.querySelector('.transform').classList.add('opacity-0', 'scale-90');

                // Hide the modal after the transition
                setTimeout(() => {
                    picModal.classList.add('hidden');
                }, 300); // Match this duration with your CSS transition time
            });


            // Initialize pic item click functionality
            document.querySelectorAll('.pic-item').forEach(item => {
                const checkbox = item.querySelector('.pic-checkbox');

                // Add event listener to toggle the checkbox when the item is clicked
                item.addEventListener('click', (e) => {
                    // Prevent the event from firing if the checkbox itself is clicked
                    if (e.target !== checkbox) {
                        checkbox.checked = !checkbox.checked;
                    }
                });
            });
            // Open modal
            openParticipantModalBtn.addEventListener('click', () => {
                participantModal.classList.remove('hidden');
                setTimeout(() => {
                    participantModal.querySelector('.fixed.inset-0').classList.remove('opacity-0');
                    participantModal.querySelector('.transform').classList.remove('opacity-0',
                        'scale-90');
                    participantModal.querySelector('.transform').classList.add('opacity-100',
                        'scale-100');
                }, 10);
            });

            // Close modal
            closeParticipantModalBtn.addEventListener('click', () => {
                participantModal.querySelector('.fixed.inset-0').classList.add('opacity-0');
                participantModal.querySelector('.transform').classList.remove('opacity-100', 'scale-100');
                participantModal.querySelector('.transform').classList.add('opacity-0', 'scale-90');
                setTimeout(() => {
                    participantModal.classList.add('hidden');
                }, 300); // Match this duration with your CSS transition time
            });





            // // Open PIC Modal
            // openPICModalBtn.addEventListener('click', () => {
            //     picModal.classList.remove('hidden');
            // });

            // // Close PIC Modal
            // closePICModalBtn.addEventListener('click', () => {
            //     picModal.classList.add('hidden');
            // });


            // Open add guest modal
            openAddGuestModalBtn.addEventListener('click', () => {
                addGuestModal.classList.remove('hidden');
                setTimeout(() => {
                    addGuestModal.querySelector('.fixed.inset-0').classList.remove('opacity-0');
                    addGuestModal.querySelector('.transform').classList.remove('opacity-0',
                        'scale-90');
                    addGuestModal.querySelector('.transform').classList.add('opacity-100',
                        'scale-100');
                }, 10);
            });

            // Close add guest modal
            closeAddGuestModalBtn.addEventListener('click', () => {
                addGuestModal.querySelector('.fixed.inset-0').classList.add('opacity-0');
                addGuestModal.querySelector('.transform').classList.remove('opacity-100', 'scale-100');
                addGuestModal.querySelector('.transform').classList.add('opacity-0', 'scale-90');
                setTimeout(() => {
                    addGuestModal.classList.add('hidden');
                }, 300); // Match this duration with your CSS transition time
            });


            // Add guest
            addGuestBtn.addEventListener('click', () => {
                const guestName = guestNameInput.value.trim();
                const guestEmail = guestEmailInput.value.trim();

                if (!guestName || !guestEmail) {
                    showAlert('warning', 'Missing Information',
                        'Please enter both name and email for the guest.');
                    return;
                }

                if (!guestEmailInput.checkValidity()) {
                    showAlert('error', 'Invalid Email', 'Please enter a valid email address.');
                    return;
                }

                showAlert('success', 'Guest Added', 'Guest added successfully.');
                addGuestToList(guestName, guestEmail);
                resetGuestInputs();
                hideGuestModal();
            });

            function showAlert(icon, title, text) {
                Swal.fire({
                    icon: icon,
                    title: title,
                    text: text
                });
            }

            let guests = [];

            function addGuestToList(name, email) {
                const guest = {
                    name,
                    email
                };
                guests.push(guest); // Store guest data

                const guestRow = document.createElement('tr');
                guestRow.innerHTML = `
        <td class="px-2 py-1 whitespace-nowrap border border-gray-200">${name}</td>
        <td class="px-2 py-1 whitespace-nowrap border border-gray-200">${email}</td>
        <td class="px-2 py-1 whitespace-nowrap border border-gray-200">
            <button type="button" class="bg-gradient-to-r from-red-400 to-red-600 hover:from-red-500 hover:to-red-700 text-white text-sm font-medium py-1 px-3 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out remove-guest-btn flex items-center justify-center space-x-1">
                <i class="zmdi zmdi-delete"></i>
                <span>Remove</span>
            </button>
        </td>
    `;

                guestRow.querySelector('.remove-guest-btn').addEventListener('click', () => {
                    guestList.removeChild(guestRow);
                    guests = guests.filter(g => g !== guest); // Remove guest from the array
                    updateGuestsInput();
                    updateGuestsVisibility();
                });

                guestList.appendChild(guestRow);
                updateGuestsInput();
                updateGuestsVisibility();
            }

            function resetGuestInputs() {
                guestNameInput.value = '';
                guestEmailInput.value = '';
            }

            function hideGuestModal() {
                // Animate the closing transition
                addGuestModal.querySelector('.fixed.inset-0').classList.add('opacity-0');
                addGuestModal.querySelector('.transform').classList.remove('opacity-100', 'scale-100');
                addGuestModal.querySelector('.transform').classList.add('opacity-0', 'scale-90');

                // Wait for the transition to complete before hiding the modal
                setTimeout(() => {
                    addGuestModal.classList.add('hidden');
                }, 300); // Match this duration with your CSS transition time
            }


            function updateGuestsInput() {
                const guests = Array.from(guestList.querySelectorAll('tr')).map(row => {
                    return {
                        name: row.children[0].textContent,
                        email: row.children[1].textContent
                    };
                });
                guestsInput.value = JSON.stringify(guests);

                console.log(guests);
            }

            // Search participants
            participantSearch.addEventListener('input', () => {
                const searchQuery = participantSearch.value.toLowerCase();
                participantList.querySelectorAll('.participant-item').forEach(item => {
                    const name = item.getAttribute('data-name').toLowerCase();
                    const id = item.getAttribute('data-id').toLowerCase();
                    if (name.includes(searchQuery) || id.includes(searchQuery)) {
                        item.classList.remove('hidden');
                    } else {
                        item.classList.add('hidden');
                    }
                });
            });

            // Select participants
            selectParticipantsBtn.addEventListener('click', () => {
                participantsList.innerHTML = '';
                const selectedParticipants = [];
                participantList.querySelectorAll('.participant-item').forEach(item => {
                    const checkbox = item.querySelector('.participant-checkbox');
                    if (checkbox.checked) {
                        const id = item.getAttribute('data-id');
                        const name = item.getAttribute('data-name');
                        selectedParticipants.push({
                            id,
                            name
                        });

                        // Create a new table row element
                        const participantItem = document.createElement('tr');

                        // Set the inner HTML of the row with table data cells
                        participantItem.innerHTML = `
                            <td class="px-2 py-1 whitespace-nowrap border border-gray-200">${id}</td>
                            <td class="px-2 py-1 whitespace-nowrap border border-gray-200">${name}</td>
                            <button type="button" class="bg-gradient-to-r from-red-400 to-red-600 hover:from-red-500 hover:to-red-700 text-white ml-4 text-sm font-medium py-1 px-3 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out remove-participant-btn">
                                Remove <i class="zmdi zmdi-delete"></i>
                            </button>


                        `;

                        // Add event listener for the remove button
                        participantItem.querySelector('.remove-participant-btn').addEventListener(
                            'click', () => {
                                participantsList.removeChild(participantItem);
                                checkbox.checked = false;
                                updateParticipantsInput();
                                updateParticipantsVisibility();
                                updateTaskPicOptions();
                            });

                        // Append the new row to the participants list
                        participantsList.appendChild(participantItem);
                    }

                });
                updateParticipantsInput();
                updateParticipantsVisibility();
                updateTaskPicOptions();
                // Animate the closing transition
                participantModal.querySelector('.fixed.inset-0').classList.add('opacity-0');
                participantModal.querySelector('.transform').classList.remove('opacity-100', 'scale-100');
                participantModal.querySelector('.transform').classList.add('opacity-0', 'scale-90');

                // Wait for the transition to complete before hiding the modal
                setTimeout(() => {
                    participantModal.classList.add('hidden');
                }, 300); // Match this duration with your CSS transition time
            });


            // Initialize participant item click functionality
            document.querySelectorAll('.participant-item').forEach(item => {
                const checkbox = item.querySelector('.participant-checkbox');

                // Add event listener to toggle the checkbox when the item is clicked
                item.addEventListener('click', (e) => {
                    // Prevent the event from firing if the checkbox itself is clicked
                    if (e.target !== checkbox) {
                        checkbox.checked = !checkbox.checked;
                    }
                });
            });

            function updateParticipantsInput() {
                const participants = [];
                participantsList.querySelectorAll('tr').forEach(row => {
                    const id = row.querySelector('td:nth-child(1)').textContent.trim();
                    participants.push(id);
                });
                participantsInput.value = JSON.stringify(participants);
            }

            function updateParticipantsVisibility() {
                if (participantsList.children.length === 0) {
                    document.querySelector('.participant-section').classList.add('hidden');
                } else {
                    document.querySelector('.participant-section').classList.remove('hidden');
                }
            }


            updateParticipantsVisibility();

            function updateGuestsVisibility() {
                if (guestList.children.length === 0) {
                    document.querySelector('.guest-section').classList.add('hidden');
                } else {
                    document.querySelector('.guest-section').classList.remove('hidden');
                }

            }
            updateGuestsVisibility();


            function updateTaskPicOptions() {
                const taskPicSelect = document.getElementById('task_pic');
                let emptyOption = taskPicSelect.querySelector('option[value=""]');

                // Ensure the "No PIC selected" option exists if not already present
                if (!emptyOption) {
                    emptyOption = document.createElement('option');
                    emptyOption.value = "";
                    emptyOption.textContent = "There is no PIC selected";
                    taskPicSelect.prepend(emptyOption); // Add it to the top
                }

                // Clear any existing options except for the empty option
                Array.from(taskPicSelect.options).forEach(option => {
                    if (option.value !== "") {
                        option.remove();
                    }
                });

                // Add new options based on the participants list
                participantsList.querySelectorAll('tr').forEach(row => {
                    const id = row.querySelector('td:nth-child(1)').textContent.trim();
                    const name = row.querySelector('td:nth-child(2)').textContent.trim();

                    // Check if option already exists
                    let existingOption = taskPicSelect.querySelector(`option[value="${id}"]`);
                    if (!existingOption) {
                        // Create and append the new option with a hidden class initially
                        const option = document.createElement('option');
                        option.value = id;
                        option.textContent = name;
                        option.classList.add('hidden-option'); // Add the hidden class
                        taskPicSelect.appendChild(option);
                    }
                });

                // Set up an event listener to handle the visibility logic
                taskPicSelect.addEventListener('change', function() {
                    const selectedOptions = Array.from(taskPicSelect.selectedOptions);

                    // Loop through all options to hide or show them based on the selection
                    Array.from(taskPicSelect.options).forEach(option => {
                        if (option.value === "") {
                            // The "No PIC selected" option remains visible by default
                            option.style.display = '';
                        } else {
                            // Hide options that are not selected
                            option.style.display = selectedOptions.includes(option) ? '' : 'none';
                        }
                    });
                });

                // Trigger the event to set the initial state correctly
                taskPicSelect.dispatchEvent(new Event('change'));
            }





            // Task Section
            const addTaskBtn = document.getElementById('addTaskBtn');
            const tasksTable = document.getElementById('tasksTable');
            const taskTopicInput = document.getElementById('task_topic');
            const taskDueDateInput = document.getElementById('task_due_date');
            const tasksInput = document.getElementById('tasksInput');
            const taskDescriptionInput = document.getElementById('task_description');
            const taskAttachmentInput = document.getElementById('task_attachment'); // Reference to the file input
            const tasks = [];
            const attachments = []; // Array to store the file objects for each task

            addTaskBtn.addEventListener('click', () => {
                const taskTopic = taskTopicInput.value;
                const selectedPicOptions = Array.from(taskPicSelect.selectedOptions);
                const taskDueDate = taskDueDateInput.value;
                const taskCompletion = document.getElementById('task_completion').value;
                const taskDescription = taskDescriptionInput.value;
                const taskAttachment = taskAttachmentInput.files[0]; // Get the file object

                if (!taskTopic || selectedPicOptions.length === 0 || !taskDueDate) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please fill in all task fields.',
                    });
                    return;
                }

                const taskPics = selectedPicOptions.map(option => ({
                    id: option.value,
                    name: option.textContent
                }));

                let taskStatus = 'Pending';
                if (taskCompletion === '100%') {
                    taskStatus = 'Complete';
                } else if (taskCompletion !== '0%') {
                    taskStatus = 'In Progress';
                }

                const task = {
                    task_topic: taskTopic,
                    task_pics: taskPics,
                    task_due_date: taskDueDate,
                    task_completion: taskCompletion,
                    task_status: taskStatus,
                    task_description: taskDescription,
                    task_attachment_name: taskAttachment ? taskAttachment.name :
                        null // Store null if no attachment
                };
                tasks.push(task);

                if (taskAttachment) {
                    attachments.push(taskAttachment); // Store the file object separately
                } else {
                    attachments.push(null); // Push null if no attachment
                }

                const taskRow = document.createElement('tr');
                taskRow.innerHTML = `
        <td class="border border-gray-300 p-2">${taskTopic}</td>
        <td class="border border-gray-300 p-2">${taskPics.map(pic => pic.name).join(', ')}</td>
        <td class="border border-gray-300 p-2">${taskDueDate}</td>
        <td class="border border-gray-300 p-2">${taskCompletion}</td>
        <td class="border border-gray-300 p-2">${taskDescription}</td>
        <td class="border border-gray-300 p-2">${taskAttachment ? taskAttachment.name : 'No Attachment'}</td>
        <td class="border border-gray-300 p-2">
            <button type="button" class="bg-gradient-to-r from-red-400 to-red-600 hover:from-red-500 hover:to-red-700 text-white text-sm font-medium py-1 px-3 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out remove-task-btn flex items-center justify-center space-x-1">
                <i class="zmdi zmdi-delete"></i>
                <span>Remove</span>
            </button>
        </td>
    `;

                taskRow.querySelector('.remove-task-btn').addEventListener('click', () => {
                    const index = tasks.indexOf(task);
                    if (index > -1) {
                        tasks.splice(index, 1);
                        attachments.splice(index, 1); // Remove the corresponding attachment
                    }
                    tasksTable.removeChild(taskRow);
                    updateTasksInput();
                    updateTaskTableVisibility();
                });

                tasksTable.appendChild(taskRow);
                updateTasksInput();
                updateTaskTableVisibility();

                // Reset input fields
                taskTopicInput.value = '';
                taskPicSelect.value = '';
                taskDueDateInput.value = '';
                document.getElementById('task_completion').value = '0%';
                taskDescriptionInput.value = '';
                taskAttachmentInput.value = ''; // Clear the file input
                updateTaskPicOptions();
            });

            function updateTasksInput() {
                // Update the hidden input with tasks (excluding attachments)
                const tasksForJson = tasks.map(task => {
                    const {
                        task_attachment_name,
                        ...rest
                    } = task;
                    return rest;
                });
                tasksInput.value = JSON.stringify(tasksForJson);
            }

            function updateTaskTableVisibility() {
                if (tasksTable.children.length === 0) {
                    document.querySelector('.task-table-section').classList.add('hidden');
                } else {
                    document.querySelector('.task-table-section').classList.remove('hidden');
                }
            }

            updateTaskTableVisibility();


            submitBtn.addEventListener('click', (event) => {
                event.preventDefault(); // Prevent default submission

                // Temporarily prevent browser validation
                notulenForm.noValidate = true;

                if (notulenForm.checkValidity()) {
                    // Clear previous attachment inputs
                    document.querySelectorAll('.attachment-input').forEach(input => input.remove());

                    // Add dynamic file inputs to the form
                    // Add dynamic file inputs to the form for non-null attachments
                    attachments.forEach((file, index) => {
                        if (file) { // Only handle files that are not null
                            const fileInput = document.createElement('input');
                            fileInput.type = 'file';
                            fileInput.name = `attachments[${index}]`;
                            fileInput.classList.add('attachment-input');

                            // Set the files property using a DataTransfer object
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(file);
                            fileInput.files = dataTransfer.files; // Set the files for submission

                            notulenForm.appendChild(fileInput);
                        }
                    });

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you want to add this notulen?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, add it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            notulenForm.submit(); // Submit the form if confirmed
                            Swal.fire({
                                title: 'Added!',
                                text: 'Your notulen has been added.',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                } else {
                    // Show SweetAlert2 validation message
                    Swal.fire({
                        title: 'Validation Error',
                        text: 'Please fill out all required fields correctly.',
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Re-enable browser validation
                        notulenForm.noValidate = false;

                        // Scroll to the first invalid field
                        const firstInvalidField = notulenForm.querySelector(':invalid');
                        if (firstInvalidField) {
                            firstInvalidField.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });

                            // Focus and trigger the validation message after scrolling
                            setTimeout(() => {
                                firstInvalidField.focus();
                                firstInvalidField
                                    .reportValidity(); // Show the validation message
                            }, 500); // Adjust delay as necessary
                        }
                    });
                }
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
