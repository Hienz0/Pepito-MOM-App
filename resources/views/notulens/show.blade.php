<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </style>
</head>

<body>

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
                            class="hidden absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg]">
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
    <div class="container mx-auto mt-24 min-[1380px]:px-80">
        <h1 class="mb-8 text-center text-3xl">Minutes of Meeting Details</h1>

        <div class="bg-white shadow-[0_0px_50px_-15px_rgba(0,0,0,0.3)] rounded-lg overflow-hidden mb-8 p-4">
            <div class="p-4">
                <div class="bg-[#FF9D03] text-white p-4">
                    <h2 class="text-2xl">{{ $notulen->meeting_title }}</h2>
                </div>
            </div>
            <div class="p-4">
                <p class="pb-4"><strong>Department</strong>
                    @if (is_array(json_decode($notulen->department)))
                        {{ implode(', ', json_decode($notulen->department)) }}
                    @else
                        {{ $notulen->department }}
                    @endif
                </p>
                <p class="pb-4"><strong>Date:</strong> {{ $notulen->meeting_date }}</p>
                <p class="pb-4"><strong>Time:</strong> {{ $notulen->meeting_time }}</p>
                <p class="pb-4"><strong>Location:</strong> {{ $notulen->meeting_location }}</p>
                <p class="pb-4"><strong>Scripter:</strong> {{ $notulen->scripter->name }}</p>

                @if ($notulen->participants->isNotEmpty())
                    <h3 class="text-xl font-semibold mt-6">Participants</h3>
                    <table class="w-full mt-4 border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-[#FF9D03] text-white">
                                <th class="border border-gray-300 p-2">ID</th>
                                <th class="border border-gray-300 p-2">Name</th>
                                <th class="border border-gray-300 p-2">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notulen->participants as $participant)
                                <tr>
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
                    <table class="w-full mt-4 border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-[#FF9D03] text-white">
                                <th class="border border-gray-300 p-2">Name</th>
                                <th class="border border-gray-300 p-2">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notulen->guests as $guest)
                                <tr>
                                    <td class="border border-gray-300 p-2">{{ $guest->name }}</td>
                                    <td class="border border-gray-300 p-2">{{ $guest->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif


                <p class="pb-4"><strong>Agenda:</strong> {{ $notulen->agenda }}</p>
                <p class="pb-4"><strong>Discussion:</strong> {{ $notulen->discussion }}</p>
                <p class="pb-4"><strong>Decisions:</strong> {{ $notulen->decisions }}</p>

                {{-- Distrubute Button --}}
                <div class="flex justify-end">
                    <button id="distributeButton"
                        class="text-white px-4 py-2 rounded
                        {{ $notulen->status === 'Inactive' ? 'bg-gray-500 cursor-not-allowed' : 'bg-[#79B51F] hover:bg-[#69A01C]' }}"
                        {{ $notulen->status === 'Inactive' ? 'disabled' : '' }}>
                        Distribute
                    </button>
                </div>
                




            </div>
        </div>


        @if ($notulen->tasks->isNotEmpty())
        <div class="all-tasks">
            <h3 class="text-xl font-semibold mt-6">All Tasks</h3>

            <div class="bg-white shadow-[0_0px_50px_-15px_rgba(0,0,0,0.3)] rounded-lg overflow-hidden mb-8 p-4">
    
                <div class="p-4">
                    <table class="w-full mt-4 border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-[#FF9D03] text-white">
                                <th class="border border-gray-300 p-2">Topic</th>
                                <th class="border border-gray-300 p-2">PIC</th>
                                <th class="border border-gray-300 p-2">Due Date</th>
                                <th class="border border-gray-300 p-2">Status</th>
                                <th class="border border-gray-300 p-2">Description</th>
                                <th class="border border-gray-300 p-2">Attachment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notulen->tasks as $task)
                                <tr>
                                    <td class="border border-gray-300 p-2">{{ $task->task_topic }}</td>
                                    <td class="border border-gray-300 p-2">
                                        @php
                                            $taskPics = json_decode($task->task_pic, true);
                                            $picNames = App\Models\User::whereIn('id', $taskPics)->pluck('name')->toArray();
                                            echo implode(', ', $picNames);
                                        @endphp
                                    </td>
                                    <td class="border border-gray-300 p-2">{{ $task->task_due_date }}</td>
                                    <td class="border border-gray-300 p-2" {{-- style="background-color: {{ $task->status === 'Complete' ? '#b3e6ac' : 'transparent' }}"> --}}
                                        style="background-color: {{ $task->status === 'Complete' ? '#b3e6ac' : ($task->status === 'In Progress' ? '#63c6ff' : ($task->status === 'Due Today' ? '#ffeb3b' : ($task->status === 'Past Due' ? '#f44336' : 'transparent'))) }}">
        
                                        {{ $task->status }}</td>
                                    <td class="border border-gray-300 p-2">{{ $task->description }}</td>
                                    <td class="border border-gray-300 p-2">
                                        @if ($task->attachment)
                                            <a href="{{ asset('storage/' . $task->attachment) }}" target="_blank"
                                                class="text-blue-500 hover:underline">View Attachment</a>
                                        @else
                                            No Attachment
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


        @if ($userTasks->isNotEmpty())
           
        <div class="my-tasks">
            <h3 class="text-xl font-semibold mt-6">My Tasks</h3>

            <div class="bg-white shadow-[0_0px_50px_-15px_rgba(0,0,0,0.3)] rounded-lg overflow-hidden mb-8 p-4">
                <div class="p-4">
                    <table class="w-full mt-4 border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-[#FF9D03] text-white">
                                <th class="border border-gray-300 p-2">Topic</th>
                                <th class="border border-gray-300 p-2">PIC</th>
                                <th class="border border-gray-300 p-2">Due Date</th>
                                <th class="border border-gray-300 p-2">Status</th>
                                <th class="border border-gray-300 p-2">Description</th>
                                <th class="border border-gray-300 p-2">Attachment</th>
                                <th class="border border-gray-300 p-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userTasks as $task)
                                <tr>
                                    <td class="border border-gray-300 p-2">{{ $task->task_topic }}</td>
                                    <td class="border border-gray-300 p-2">
                                        @php
                                            $taskPics = json_decode($task->task_pic, true);
                                            $picNames = App\Models\User::whereIn('id', $taskPics)->pluck('name')->toArray();
                                            echo implode(', ', $picNames);
                                        @endphp
                                    </td>
                                    <td class="border border-gray-300 p-2">{{ $task->task_due_date }}</td>
                                    <td class="border border-gray-300 p-2"
                                        style="background-color: {{ $task->status === 'Complete' ? '#b3e6ac' : ($task->status === 'In Progress' ? '#63c6ff' : ($task->status === 'Due Today' ? '#ffeb3b' : ($task->status === 'Past Due' ? '#f44336' : 'transparent'))) }}">
                                        {{ $task->status }}</td>
                                    <td class="border border-gray-300 p-2">{{ $task->description }}</td>
                                    <td class="border border-gray-300 p-2">
                                        @if ($task->attachment)
                                            @if (Str::endsWith($task->attachment, ['.jpg', '.jpeg', '.png', '.gif']))
                                                <a href="{{ asset('storage/' . $task->attachment) }}" target="_blank"
                                                    class="text-blue-500 hover:underline">View Image</a>
                                            @elseif (Str::endsWith($task->attachment, ['.pdf', '.docx', '.pptx']))
                                                <a href="{{ asset('storage/' . $task->attachment) }}" target="_blank"
                                                    class="text-blue-500 hover:underline">View Document</a>
                                            @else
                                                <a href="{{ asset('storage/' . $task->attachment) }}" target="_blank"
                                                    class="text-blue-500 hover:underline">Download File</a>
                                            @endif
                                        @else
                                            No Attachment
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 p-2">
                                        @if ($notulen->status !== 'Inactive')
                                            <button class="bg-[#79B51F] hover:bg-[#69A01C] text-white px-4 py-2 rounded update-task-btn"
                                                data-task-id="{{ $task->id }}"
                                                data-task-topic="{{ $task->task_topic }}"
                                                data-task-description="{{ $task->description }}"
                                                data-task-status="{{ $task->status }}"
                                                data-task-attachment="{{ $task->attachment }}">Update</button>
                                        @else
                                            <button class="bg-gray-400 text-white px-4 py-2 rounded cursor-not-allowed"
                                                disabled>
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
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                            id="task_attachment" name="attachment">
                    </div>
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded"
                            id="task_complete" name="complete">
                        <label for="task_complete" class="ml-2 block text-gray-700">Mark as complete</label>
                    </div>
                    <div class="flex justify-end">
                        <button type="button"
                            class="bg-gray-500 text-white px-4 py-2 rounded mr-2 close-modal">Close</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const updateTaskButtons = document.querySelectorAll('.update-task-btn');
            const updateTaskModal = document.getElementById('updateTaskModal');
            const modalContent = document.getElementById('modalContent');
            const updateTaskForm = document.getElementById('updateTaskForm');
            const taskIdInput = document.getElementById('task_id');
            const taskDescriptionInput = document.getElementById('task_description');
            const taskCompleteInput = document.getElementById('task_complete');
            const closeModalButtons = document.querySelectorAll('.close-modal');

            updateTaskButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const taskId = button.getAttribute('data-task-id');
                    const taskDescription = button.getAttribute('data-task-description');
                    const taskStatus = button.getAttribute('data-task-status');

                    taskIdInput.value = taskId;
                    taskDescriptionInput.value = taskDescription;
                    taskCompleteInput.checked = (taskStatus ===
                        'Complete'); // Set checked based on task status
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
                userDropdown.classList.toggle('hidden');
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
    </script>
</body>

</html>
