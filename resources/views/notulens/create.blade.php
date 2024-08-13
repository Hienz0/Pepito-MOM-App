<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New MOM</title>
    <!-- Include Tailwind CSS for styling -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav style="background-color: #F9F9F9;" class="fixed w-full shadow-md h-20 top-0 left-0">
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
                            <i class="fa-regular fa-bell text-4xl"></i>
                        </button>
                        <!-- Dropdown for notifications could go here -->
                    </div>
                    <!-- User Icon -->
                    <div class="relative">
                        <button type="button" id="userMenuButton"
                            class="flex items-center text-gray-700 hover:text-gray-900 focus:outline-none">
                            <i class="fa-regular fa-user text-4xl"></i>
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
                            <div
                                class="px-4 py-2 px-4 py-2 hover:bg-gray-100 transition-colors duration-300 rounded-md">
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

    {{-- Main Content --}}
    <div class="container mx-auto mt-28">
        <a href="{{ route('notulens.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Back to Notulens</a>

        <h1 class="mb-6 text-3xl font-bold text-center">Add a new Minutes Of Meeting</h1>
        <div class="bg-white shadow-md rounded-lg mb-6">

            <form id="notulenForm" method="POST" action="{{ route('notulens.store') }}">
                @csrf

                <div class="bg-gray-800 text-white p-4 rounded-t-lg">
                    <h2 class="text-xl font-semibold mb-0">Add a new Minutes Of Meeting</h2>
                </div>
                <div class="p-6">
                    <div class="flex flex-wrap mb-4">
                        <div class="w-full md:w-1/2 md:pr-2">
                            <div class="mb-4">
                                <label for="meeting_title" class="block text-gray-700 text-sm font-bold mb-2">Meeting
                                    Title</label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full md:w-3/5 lg:w-3/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="meeting_title" name="meeting_title" placeholder="Enter meeting title" required>
                            </div>
                            <div class="mb-4">
                                <label for="department"
                                    class="block text-gray-700 text-sm font-bold mb-2">Department</label>
                                <select name="department" id="department"
                                    class="shadow appearance-none border rounded w-full md:w-3/5 lg:w-3/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required>
                                    <option value="" disabled selected>Select department</option>
                                    <option value="HR">HR</option>
                                    <option value="IT">IT</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Marketing">Marketing</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="participants"
                                    class="block text-gray-700 text-sm font-bold mb-2">Participants</label>
                                <button type="button"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 focus:outline-none focus:shadow-outline"
                                    id="openParticipantModalBtn">Select Participants</button>

                                <input type="hidden" name="participants[]" id="participantsInput" required>

                            </div>
                        </div>
                        <div class="w-full md:w-1/2 md:pl-2">
                            <div class="flex mb-4 md:w-3/5 lg:w-3/5">
                                <div class="w-1/2 pr-2">
                                    <label for="meeting_date"
                                        class="block text-gray-700 text-sm font-bold mb-2">Date</label>
                                    <input type="date"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="meeting_date" name="meeting_date" required>
                                </div>
                                <div class="w-1/2 pl-2">
                                    <label for="meeting_time"
                                        class="block text-gray-700 text-sm font-bold mb-2">Time</label>
                                    <input type="time"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="meeting_time" name="meeting_time" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="meeting_location"
                                    class="block text-gray-700 text-sm font-bold mb-2">Location</label>
                                <select name="meeting_location" id="meeting_location"
                                    class="shadow appearance-none border rounded w-full md:w-3/5 lg:w-3/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
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
                                    class="shadow appearance-none border rounded w-full md:w-3/5 lg:w-3/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shad-outline"
                                    id="scripter" name="scripter" value="{{ $scripter->name }}" readonly>
                            </div>

                        </div>
                    </div>










                    <div class="p-4 participant-section">
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



                    <div class="p-4 guest-section">
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
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="agenda" name="agenda" rows="3" placeholder="Enter agenda" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="discussion" class="block text-gray-700 text-sm font-bold mb-2">Discussion</label>
                        <textarea
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="discussion" name="discussion" rows="3" placeholder="Enter discussion" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="decisions" class="block text-gray-700 text-sm font-bold mb-2">Decisions</label>
                        <textarea
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="decisions" name="decisions" rows="3" placeholder="Enter decisions" required></textarea>
                    </div>


                </div>

                <div class="bg-gray-800 text-white p-4 rounded-t-lg">
                    <h2 class="text-xl font-semibold mb-0">Task Section</h2>
                </div>
                <div class="p-6">
                    <!-- Tasks Section -->
                    <h3 class="text-xl font-semibold mt-6 py-6">Task Section</h3>

                    <div class="mb-4">
                        <label for="task_topic" class="block text-gray-700 text-sm font-bold mb-2">Task Topic</label>
                        <input type="text"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="task_topic" placeholder="Enter task topic">
                    </div>
                    <!-- Trigger Button -->
                    <div class="mb-4">
                        <label for="task_pic" class="block text-gray-700 text-sm font-bold mb-2">Person in
                            Charge</label>
                        <button type="button"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            id="openPICModalBtn">Select PIC</button>
                        <select
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="task_pic" name="task_pic[]" multiple required>
                            <option value="">Select a PIC</option>
                        </select>

                    </div>
                    <div class="mb-4">
                        <label for="task_due_date" class="block text-gray-700 text-sm font-bold mb-2">Due Date</label>
                        <input type="date"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="task_due_date">
                    </div>
                        <!-- Task Status -->
                    <div class="mb-4">
                        <label for="task_status" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                        <select
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="task_status" name="task_status">
                            <option value="Pending" selected>Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Complete">Complete</option>
                        </select>
                    </div>
                    <button type="button"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 focus:outline-none focus:shadow-outline"
                        id="addTaskBtn">Add Task</button>

                    <div class="overflow-x-auto mb-4">
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="px-4 py-2">Topic</th>
                                    <th class="px-4 py-2">PIC</th>
                                    <th class="px-4 py-2">Due Date</th>
                                    <th class="px-4 py-2">Status</th>
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





                <button type="submit" id="submitBtn"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full focus:outline-none focus:shadow-outline">Add
                    Notulen</button>
            </form>



        </div>
    </div>


    <!-- Modal -->
    <div id="participantModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-gray-800 text-white px-4 py-3">
                    <h3 class="text-lg leading-6 font-medium">Select Participants</h3>
                </div>
                <div class="p-4" style="max-height: 400px; overflow-y: auto;">
                    <input type="text" id="participantSearch"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Search participants by name or ID">
                    <div id="participantList" class="mt-4">
                        @foreach ($users as $user)
                            <div class="participant-item flex justify-between items-center p-2 border-b"
                                data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                                <span>{{ $user->name }} (ID: {{ $user->id }})</span>
                                <input type="checkbox" class="participant-checkbox">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="bg-gray-200 px-4 py-3 flex justify-end">
                    <button type="button" class="bg-green-500 text-white font-bold py-2 px-4 rounded mr-2"
                        id="openAddGuestModalBtn">Add Guest</button>
                    <button type="button" class="bg-red-500 text-white font-bold py-2 px-4 rounded mr-2"
                        id="closeParticipantModalBtn">Cancel</button>
                    <button type="button" class="bg-blue-500 text-white font-bold py-2 px-4 rounded"
                        id="selectParticipantsBtn">Select</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Guest Modal -->
    <div id="addGuestModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-gray-800 text-white px-4 py-3">
                    <h3 class="text-lg leading-6 font-medium">Add Guest</h3>
                </div>
                <div class="p-4">
                    <label for="guest_name" class="block text-gray-700 text-sm font-bold mb-2">Guest Name</label>
                    <input type="text" id="guest_name"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter guest name">
                    <label for="guest_email" class="block text-gray-700 text-sm font-bold mb-2 mt-4">Guest
                        Email</label>
                    <input type="email" id="guest_email"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Enter guest email">
                </div>
                <div class="bg-gray-200 px-4 py-3 flex justify-end">

                    <button type="button" class="bg-red-500 text-white font-bold py-2 px-4 rounded mr-2"
                        id="closeAddGuestModalBtn">Cancel</button>
                    <button type="button" class="bg-blue-500 text-white font-bold py-2 px-4 rounded"
                        id="addGuestBtn">Add Guest</button>
                </div>
            </div>
        </div>
    </div>

    <!-- PIC Selection Modal -->
    <!-- PIC Selection Modal -->
    <div id="picModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-gray-800 text-white px-4 py-3">
                    <h3 class="text-lg leading-6 font-medium">Select Person in Charge</h3>
                </div>
                <div class="p-4" style="max-height: 400px; overflow-y: auto;">
                    <input type="text" id="picSearch"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Search PICs by name or ID">
                    <div id="picList" class="mt-4">
                        @foreach ($users as $user)
                            <div class="pic-item flex justify-between items-center p-2 border-b"
                                data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                                <span>{{ $user->name }} (ID: {{ $user->id }})</span>
                                <input type="checkbox" class="pic-checkbox">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="bg-gray-200 px-4 py-3 flex justify-end">
                    <button type="button" class="bg-red-500 text-white font-bold py-2 px-4 rounded mr-2"
                        id="closePICModalBtn">Cancel</button>
                    <button type="button" class="bg-blue-500 text-white font-bold py-2 px-4 rounded"
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
                taskPicSelect.innerHTML = '<option value="">Select a PIC</option>';
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
                    }
                });
            }

            // Function to add selected PICs to the target select element
            function addSelectedPICsToTaskPic(selectedPICs) {
                // Clear the default option if at least one PIC is selected
                if (selectedPICs.length > 0) {
                    taskPic.innerHTML = '';
                } else {
                    taskPic.innerHTML = '<option value="">Select a PIC</option>';
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
                taskPicSelect.innerHTML = '<option value="">Select a PIC</option>';
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
            let tasks = [];

            addTaskBtn.addEventListener('click', () => {
                const taskTopic = taskTopicInput.value;
                const selectedPicOptions = Array.from(taskPicSelect.selectedOptions);
                const taskDueDate = taskDueDateInput.value;
                const taskStatus = document.getElementById('task_status').value;

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
                    task_status: taskStatus
                };
                tasks.push(task);

                const taskRow = document.createElement('tr');
                taskRow.innerHTML = `
                    <td class="border px-2 py-1">${taskTopic}</td>
                    <td class="border px-2 py-1">${taskPics.map(pic => pic.name).join(', ')}</td>
                    <td class="border px-2 py-1">${taskDueDate}</td>
                    <td class="border px-2 py-1">${taskStatus}</td>
                    <td class="border px-2 py-1">
                        <button type="button" class="bg-red-500 text-white font-bold py-1 px-2 rounded remove-task-btn">Remove</button>
                    </td>
                `;
                taskRow.querySelector('.remove-task-btn').addEventListener('click', () => {
                    tasksTable.removeChild(taskRow);
                    tasks = tasks.filter(t => t !== task);
                    updateTasksInput();
                });

                tasksTable.appendChild(taskRow);
                updateTasksInput();

                // Reset input fields
                taskTopicInput.value = '';
                taskPicSelect.value = '';
                taskDueDateInput.value = '';
                document.getElementById('task_status').value = 'Pending';
            });

            function updateTasksInput() {
                tasksInput.value = JSON.stringify(tasks);
            }

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
    </script>
</body>

</html>
