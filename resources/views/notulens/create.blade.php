<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        class="bg-[#79B51F] hover:bg-[#69A01C] text-white px-4 mx-6 py-2 rounded min-[1380px]:absolute">
        <i class="fas fa-home"></i> Back to Home
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

                    <div class="text-white p-4" style="background-color: #FF9D03">
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
                                    id="meeting_title" name="meeting_title" placeholder="Enter meeting title" required
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
                                    class="has-tooltip bg-[#79B51F] hover:bg-[#69A01C] text-white font-bold py-2 px-4 rounded mb-4 focus:outline-none focus:shadow-outline"
                                    id="openParticipantModalBtn"
                                    data-tooltip="Click this button to open a modal where you can select participants for the meeting. In the modal, you can search for participants by typing their names and check the boxes next to their names to add them. If you need to add guests who are not in the participant list, you can also open a separate modal to enter their names and email addresses. Make sure to review and select all the people you want to invite to ensure everyone relevant is included in the meeting.">Select
                                    Participants</button>

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
                            class="min-w-full divide-y divide-gray-200 border border-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                        ID</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                        Name</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                        Actions</th>
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
                        <table class="min-w-full divide-y divide-gray-200 border border-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                        Name</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                        Email</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-200">
                                        Action</th>
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

                    <div class=" text-white p-4" style="background-color: #FF9D03">
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
                                    class="has-tooltip bg-[#79B51F] hover:bg-[#69A01C] text-white font-bold py-2 px-4 mb-2 rounded focus:outline-none focus:shadow-outline"
                                    id="openPICModalBtn"
                                    data-tooltip="Click this button to open a modal where you can search for and select the person(s) responsible for this task. The modal allows you to choose multiple people using checkboxes. Once selected, their names will be displayed below in the 'Person in Charge' dropdown. Ensure that the correct individuals are assigned to avoid any confusion or delay in task completion. The dropdown will update to reflect the selected PIC(s).">Select
                                    PIC</button>
                                <select
                                    class="has-tooltip shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="task_pic" name="task_pic[]" multiple required
                                    data-tooltip="This dropdown will show the names of the selected persons in charge once you choose them from the modal. If no one is selected, it will display 'There is no PIC selected'. You can select multiple people, and their names will be listed here for easy reference.">
                                    <option value="">There is no PIC selected</option>
                                </select>

                            </div>

                            <!-- Task Status -->
                            <div class="mb-4 w-full md:w-4/5 md:pr-2">
                                <label for="task_status"
                                    class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                                <select
                                    class="has-tooltip shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="task_status" name="task_status"
                                    data-tooltip="Select the current status of the task from the dropdown options. The available statuses are 'Pending', 'In Progress', and 'Complete'. Choose 'Pending' if the task has not yet started, 'In Progress' if work is underway, and 'Complete' when the task is finished. This helps track the progress and manage task deadlines effectively.">
                                    <option value="Pending" selected>Pending</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Complete">Complete</option>
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
                        class="has-tooltip bg-[#79B51F] hover:bg-[#69A01C] text-white font-bold py-2 px-4 rounded mb-4 focus:outline-none focus:shadow-outline"
                        id="addTaskBtn"
                        data-tooltip="Click this button to add the task details you have entered to the list. Ensure that all required fields are filled out before clicking this button. This will save the task and allow you to continue managing your tasks. If there are any validation errors or missing information, you will be prompted to correct them before the task is added.">Add
                        Task</button>

                    <div class="has-tooltip overflow-x-auto mb-4 task-table-section"
                        data-tooltip="This table displays the list of tasks with their details. Each row represents a task and includes columns for the topic, person in charge (PIC), due date, status, attachment, and actions. Use this table to view, manage, and perform actions on your tasks. The columns are as follows: Topic (the task's name), PIC (the person responsible for the task), Due Date (when the task is due), Status (the current status of the task), Attachment (any files related to the task), and Action (options to edit or delete the task)">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead class="bg-[#FF9D03] text-white">
                                <tr>
                                    <th class="px-4 py-2">Topic</th>
                                    <th class="px-4 py-2">PIC</th>
                                    <th class="px-4 py-2">Due Date</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-4 py-2">Attachment</th>
                                    <th class="px-4 py-2">Action</th>
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
                    class="has-tooltip bg-[#79B51F] hover:bg-[#69A01C] text-white font-bold py-2 px-4 rounded w-full focus:outline-none focus:shadow-outline"
                    data-tooltip="Click this button to submit and add the Minutes of Meeting (MoM). Ensure that all required fields are completed and correct before clicking. This action will save your MoM data, including all the details and attachments you’ve added. If you need to make any changes, review the form fields before submitting.">Add
                    MoM</button>
            </div>


        </form>


    </div>


<!-- Modal -->
<div id="participantModal" class="fixed z-10 inset-0 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-black bg-opacity-30" aria-hidden="true"></div>
        <div class="bg-white rounded-lg shadow-lg sm:max-w-md w-full transform transition-all">
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
                            <span class="text-sm text-gray-700">{{ $user->name }} (ID: {{ $user->id }})</span>
                            <input type="checkbox" class="participant-checkbox h-4 w-4 text-blue-600">
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="bg-gray-50 px-4 py-2.5 flex justify-end space-x-2 rounded-b-lg">
                <button type="button" class="bg-blue-500 text-white text-sm font-semibold py-1 px-3 rounded shadow-sm hover:bg-blue-600 transition"
                    id="selectParticipantsBtn">Select</button>
                <button type="button" class="bg-red-500 text-white text-sm font-semibold py-1 px-3 rounded shadow-sm hover:bg-red-600 transition"
                    id="closeParticipantModalBtn">Cancel</button>
                <button type="button" class="bg-green-500 text-white text-sm font-semibold py-1 px-3 rounded shadow-sm hover:bg-green-600 transition"
                    id="openAddGuestModalBtn">Add Guest</button>
            </div>
        </div>
    </div>
</div>


<!-- Add Guest Modal -->
<div id="addGuestModal" class="fixed z-10 inset-0 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-black bg-opacity-30" aria-hidden="true"></div>
        <div class="bg-white rounded-lg shadow-lg sm:max-w-md w-full transform transition-all">
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
                <button type="button" class="bg-red-500 text-white text-sm font-semibold py-1 px-3 rounded shadow-sm hover:bg-red-600 transition"
                    id="closeAddGuestModalBtn">Cancel</button>
                <button type="button" class="bg-blue-500 text-white text-sm font-semibold py-1 px-3 rounded shadow-sm hover:bg-blue-600 transition"
                    id="addGuestBtn">Add Guest</button>
            </div>
        </div>
    </div>
</div>


    <!-- PIC Selection Modal -->
    <!-- PIC Selection Modal -->
<!-- PIC Selection Modal -->
<div id="picModal" class="fixed z-10 inset-0 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-black bg-opacity-30" aria-hidden="true"></div>
        <div class="bg-white rounded-lg shadow-lg sm:max-w-md w-full transform transition-all">
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
                            <span class="text-sm text-gray-700">{{ $user->name }} (ID: {{ $user->id }})</span>
                            <input type="checkbox" class="pic-checkbox h-4 w-4 text-blue-600">
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="bg-gray-50 px-4 py-2.5 flex justify-end space-x-2 rounded-b-lg">
                <button type="button" class="bg-red-500 text-white text-sm font-semibold py-1 px-3 rounded shadow-sm hover:bg-red-600 transition"
                    id="closePICModalBtn">Cancel</button>
                <button type="button" class="bg-blue-500 text-white text-sm font-semibold py-1 px-3 rounded shadow-sm hover:bg-blue-600 transition"
                    id="selectPICsBtn">Select</button>
            </div>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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


            function updateTaskPicOptions() {
                const participants = [];
                taskPicSelect.innerHTML = '<option value="">There is no PIC selected</option>';
                participantsList.querySelectorAll('span').forEach(item => {
                    const id = item.getAttribute('data-id');
                    const name = item.textContent;
                    const option = document.createElement('option');
                    option.value = id;
                    option.textContent = name;
                    taskPicSelect.appendChild(option);
                });
            }

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
            }

            // Function to add selected PICs to the target select element
            function addSelectedPICsToTaskPic(selectedPICs) {
                // Clear the default option if at least one PIC is selected
                if (selectedPICs.length > 0) {
                    taskPic.innerHTML = '';
                } else {
                    taskPic.innerHTML = '<option value="">There is no PIC selected</option>';
                }

                selectedPICs.forEach((pic) => {
                    const option = document.createElement('option');
                    option.value = pic.id;
                    option.textContent = pic.name;
                    option.selected = true; // Make the added option selected
                    taskPic.appendChild(option);
                });
            }


            // Assuming you have a way to trigger this function to open the modal and populate the list
            document.getElementById('openPICModalBtn').addEventListener('click', function() {
                updateTaskPicOptions(); // Update the task PIC options first
                populatePicModal(); // Then populate the modal
                document.getElementById('picModal').classList.remove('hidden');
            });

            document.getElementById('closePICModalBtn').addEventListener('click', function() {
                document.getElementById('picModal').classList.add('hidden');
            });

            document.getElementById('selectPICsBtn').addEventListener('click', function() {
                const selectedPICs = [];
                document.querySelectorAll('#picList .pic-checkbox:checked').forEach(checkbox => {
                    const picItem = checkbox.closest('.pic-item');
                    selectedPICs.push({
                        id: picItem.getAttribute('data-id'),
                        name: picItem.getAttribute('data-name')
                    });
                });
                // Handle the selected PICs as needed
                addSelectedPICsToTaskPic(selectedPICs);
                console.log(selectedPICs);
                document.getElementById('picModal').classList.add('hidden');
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
            });

            // Close modal
            closeParticipantModalBtn.addEventListener('click', () => {
                participantModal.classList.add('hidden');
            });

            // Open PIC Modal
            openPICModalBtn.addEventListener('click', () => {
                picModal.classList.remove('hidden');
            });

            // Close PIC Modal
            closePICModalBtn.addEventListener('click', () => {
                picModal.classList.add('hidden');
            });


            // Open add guest modal
            openAddGuestModalBtn.addEventListener('click', () => {
                addGuestModal.classList.remove('hidden');
            });

            // Close add guest modal
            closeAddGuestModalBtn.addEventListener('click', () => {
                addGuestModal.classList.add('hidden');
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

            function addGuestToList(name, email) {
                const guestRow = document.createElement('tr');
                guestRow.innerHTML = `
            <td class="px-2 py-1 whitespace-nowrap border border-gray-200">${name}</td>
            <td class="px-2 py-1 whitespace-nowrap border border-gray-200">${email}</td>
            <td class="px-2 py-1 whitespace-nowrap border border-gray-200">
                <button type="button" class="bg-red-500 text-white font-bold py-1 px-2 rounded remove-guest-btn">Remove</button>
            </td>
        `;
                guestRow.querySelector('.remove-guest-btn').addEventListener('click', () => {
                    guestList.removeChild(guestRow);
                    updateGuestsInput(); // Update hidden input when a guest is removed
                    updateGuestsVisibility();
                });

                guestList.appendChild(guestRow);
                updateGuestsInput(); // Update hidden input after adding a guest
                updateGuestsVisibility();
            }

            function resetGuestInputs() {
                guestNameInput.value = '';
                guestEmailInput.value = '';
            }

            function hideGuestModal() {
                addGuestModal.classList.add('hidden');
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
                            <td class="px-2 py-1 whitespace-nowrap border border-gray-200">
                                <button type="button" class="bg-red-500 text-white font-bold py-1 px-2 rounded remove-participant-btn">Remove</button>
                            </td>
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
                participantModal.classList.add('hidden');
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
                const participants = [];
                taskPicSelect.innerHTML = '<option value="">There is no PIC selected</option>';
                participantsList.querySelectorAll('tr').forEach(row => {
                    const id = row.querySelector('td:nth-child(1)').textContent.trim();
                    const name = row.querySelector('td:nth-child(2)').textContent.trim();
                    const option = document.createElement('option');
                    option.value = id;
                    option.textContent = name;
                    taskPicSelect.appendChild(option);
                });
            }


            // Task Section
            const addTaskBtn = document.getElementById('addTaskBtn');
            const tasksTable = document.getElementById('tasksTable');
            const taskTopicInput = document.getElementById('task_topic');
            const taskDueDateInput = document.getElementById('task_due_date');
            const tasksInput = document.getElementById('tasksInput');
            const taskDescriptionInput = document.getElementById('task_description');
            let tasks = [];

            addTaskBtn.addEventListener('click', () => {
                const taskTopic = taskTopicInput.value;
                const selectedPicOptions = Array.from(taskPicSelect.selectedOptions);
                const taskDueDate = taskDueDateInput.value;
                const taskStatus = document.getElementById('task_status').value;
                const taskDescription = taskDescriptionInput.value;

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

                const task = {
                    task_topic: taskTopic,
                    task_pics: taskPics,
                    task_due_date: taskDueDate,
                    task_status: taskStatus,
                    task_description: taskDescription
                };
                tasks.push(task);

                const taskRow = document.createElement('tr');
                taskRow.innerHTML = `
                    <td class="border px-2 py-1">${taskTopic}</td>
                    <td class="border px-2 py-1">${taskPics.map(pic => pic.name).join(', ')}</td>
                    <td class="border px-2 py-1">${taskDueDate}</td>
                    <td class="border px-2 py-1">${taskStatus}</td>
                    <td class="border px-2 py-1">${taskDescription}</td>
                    <td class="border px-2 py-1">
                        <button type="button" class="bg-red-500 text-white font-bold py-1 px-2 rounded remove-task-btn">Remove</button>
                    </td>
                `;
                taskRow.querySelector('.remove-task-btn').addEventListener('click', () => {
                    tasksTable.removeChild(taskRow);
                    tasks = tasks.filter(t => t !== task);
                    updateTasksInput();
                    updateTaskTableVisibility()
                });

                tasksTable.appendChild(taskRow);
                updateTasksInput();
                updateTaskTableVisibility()

                // Reset input fields
                taskTopicInput.value = '';
                taskPicSelect.value = '';
                taskDueDateInput.value = '';
                document.getElementById('task_status').value = 'Pending';
                taskDescriptionInput.value = '';

            });

            function updateTasksInput() {
                tasksInput.value = JSON.stringify(tasks);
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
                event.preventDefault();
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
                        notulenForm.submit();
                        Swal.fire({
                            title: 'Added!',
                            text: 'Your notulen has been added.',
                            icon: 'success',
                            showConfirmButton: false
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
    </script>
</body>

</html>
