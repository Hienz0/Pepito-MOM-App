<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Notulen</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container py-8">
        <h1 class="text-2xl font-semibold mb-4">Edit MoM</h1>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-200 text-red-800 p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('notulens.update', $notulen->id) }}" method="POST" enctype="multipart/form-data" id="notulenForm">
            @csrf
            @method('PUT')


            <div class="grid gap-4 mb-4">
                <div class="form-group">
                    <label for="meeting_title" class="block text-sm font-medium text-gray-700">Meeting Title:</label>
                    <input type="text" id="meeting_title" name="meeting_title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('meeting_title', $notulen->meeting_title) }}" required>
                </div>

                <div class="form-group">
                    <label for="department" class="block text-sm font-medium text-gray-700">Department:</label>
                    <select id="department" name="department[]" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @php
                            $selectedDepartments = json_decode(old('department', $notulen->department), true);
                        @endphp
                        <option value="HR" {{ in_array('HR', $selectedDepartments) ? 'selected' : '' }}>HR</option>
                        <option value="IT" {{ in_array('IT', $selectedDepartments) ? 'selected' : '' }}>IT</option>
                        <option value="Finance" {{ in_array('Finance', $selectedDepartments) ? 'selected' : '' }}>Finance</option>
                        <option value="Marketing" {{ in_array('Marketing', $selectedDepartments) ? 'selected' : '' }}>Marketing</option>
                    </select>
                </div>
                

                <div class="form-group">
                    <label for="meeting_date" class="block text-sm font-medium text-gray-700">Meeting Date:</label>
                    <input type="date" id="meeting_date" name="meeting_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('meeting_date', $notulen->meeting_date) }}" required>
                </div>

                <div class="form-group">
                    <label for="meeting_time" class="block text-sm font-medium text-gray-700">Meeting Time:</label>
                    <input type="time" id="meeting_time" name="meeting_time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('meeting_time', $notulen->meeting_time) }}" required>
                </div>

                <div class="form-group">
                    <label for="meeting_location" class="block text-sm font-medium text-gray-700">Meeting Location:</label>
                    <input type="text" id="meeting_location" name="meeting_location" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('meeting_location', $notulen->meeting_location) }}" required>
                </div>

                <div class="form-group">
                    <label for="agenda" class="block text-sm font-medium text-gray-700">Agenda:</label>
                    <textarea id="agenda" name="agenda" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="4" required>{{ old('agenda', $notulen->agenda) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="discussion" class="block text-sm font-medium text-gray-700">Discussion:</label>
                    <textarea id="discussion" name="discussion" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="4">{{ old('discussion', $notulen->discussion) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="decisions" class="block text-sm font-medium text-gray-700">Decisions:</label>
                    <textarea id="decisions" name="decisions" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="4">{{ old('decisions', $notulen->decisions) }}</textarea>
                </div>

            <!-- Existing fields -->

            <div class="grid gap-4 mb-4">
                <!-- Add participants section -->
                <div class="form-group">
                    <label for="participants" class="block text-sm font-medium text-gray-700">Participants:</label>
                    <div id="participants-container">
                        @foreach($notulen->participants as $participant)
                            <div class="flex items-center mb-2">
                                <input type="text" name="participants[]" value="{{ $participant->id }}" readonly class="bg-gray-200 border border-gray-300 rounded-md shadow-sm w-full mr-2">
                                <button type="button" class="remove-participant bg-red-500 text-white px-2 py-1 rounded-md">Remove</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" id="add-participant" class="bg-blue-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-600">Add Participant</button>
                </div>

                <div class="form-group">
                    <label for="tasks" class="block text-sm font-medium text-gray-700">Tasks:</label>
                    <div id="tasks-container">
                        @foreach($notulen->tasks as $task)
                            <div class="task-item mb-4 p-4 border border-gray-300 rounded-md">
                                <input type="hidden" name="tasks[{{ $loop->index }}][task_id]" value="{{ $task->id }}">
                                <div class="flex items-center mb-2">
                                    <input type="text" name="tasks[{{ $loop->index }}][task_topic]" value="{{ $task->task_topic }}" class="border border-gray-300 rounded-md shadow-sm w-full mr-2" placeholder="Task Topic">
                                    <input type="date" name="tasks[{{ $loop->index }}][task_due_date]" value="{{ $task->task_due_date }}" class="border border-gray-300 rounded-md shadow-sm w-full mr-2" placeholder="Due Date">
                                    <button type="button" class="remove-task bg-red-500 text-white px-2 py-1 rounded-md">Remove</button>
                                </div>
                
                                <div class="mb-2">
                                    <label for="task_pic" class="block text-sm font-medium text-gray-700">Person in Charge (PIC):</label>
                                    <select name="tasks[{{ $loop->index }}][task_pic][]" multiple class="border border-gray-300 rounded-md shadow-sm w-full">
                                        @foreach($notulen->participants as $participant)
                                            <option value="{{ $participant->id }}" {{ in_array($participant->id, json_decode($task->task_pic)) ? 'selected' : '' }}>
                                                {{ $participant->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                
                                <div class="mb-2">
                                    <label for="task_status" class="block text-sm font-medium text-gray-700">Status:</label>
                                    <select name="tasks[{{ $loop->index }}][task_status]" class="border border-gray-300 rounded-md shadow-sm w-full">
                                        <option value="Pending" {{ $task->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="In Progress" {{ $task->status === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="Complete" {{ $task->status === 'Complete' ? 'selected' : '' }}>Complete</option>
                                    </select>
                                </div>
                
                                <div class="mb-2">
                                    <label for="task_description" class="block text-sm font-medium text-gray-700">Description:</label>
                                    <textarea name="tasks[{{ $loop->index }}][description]" class="border border-gray-300 rounded-md shadow-sm w-full">{{ $task->description }}</textarea>
                                </div>

                                <div class="mb-2">
                                    <label for="task_attachments" class="block text-sm font-medium text-gray-700">Attachments:</label>
                                    <input type="file" name="tasks[{{ $loop->index }}][attachment]" class="border border-gray-300 rounded-md shadow-sm w-full">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" id="add-task" class="bg-blue-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-600">Add Task</button>
                </div>
                
                
                

                <!-- Add guests section -->
                <div class="form-group">
                    <label for="guests" class="block text-sm font-medium text-gray-700">Guests:</label>
                    <div id="guests-container">
                        @foreach($notulen->guests as $guest)
                            <div class="flex items-center mb-2">
                                <input type="text" name="guests[name][]" value="{{ $guest->name }}" class="border border-gray-300 rounded-md shadow-sm w-full mr-2" placeholder="Guest Name">
                                <input type="email" name="guests[email][]" value="{{ $guest->email }}" class="border border-gray-300 rounded-md shadow-sm w-full mr-2" placeholder="Guest Email">
                                <button type="button" class="remove-guest bg-red-500 text-white px-2 py-1 rounded-md">Remove</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" id="add-guest" class="bg-blue-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-600">Add Guest</button>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md shadow-sm hover:bg-blue-600">Update</button>
            </div>
        </form>
    </div>

    <script>
        // Add Participant
        document.getElementById('add-participant').addEventListener('click', function() {
            const container = document.getElementById('participants-container');
            const input = document.createElement('div');
            input.classList.add('flex', 'items-center', 'mb-2');
            input.innerHTML = `
                <input type="text" name="participants[]" class="bg-gray-200 border border-gray-300 rounded-md shadow-sm w-full mr-2" placeholder="Participant ID">
                <button type="button" class="remove-participant bg-red-500 text-white px-2 py-1 rounded-md">Remove</button>
            `;
            container.appendChild(input);
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
                @foreach($notulen->participants as $participant)
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


        // Add Guest
        document.getElementById('add-guest').addEventListener('click', function() {
            const container = document.getElementById('guests-container');
            const input = document.createElement('div');
            input.classList.add('flex', 'items-center', 'mb-2');
            input.innerHTML = `
                <input type="text" name="guests[name][]" class="border border-gray-300 rounded-md shadow-sm w-full mr-2" placeholder="Guest Name">
                <input type="email" name="guests[email][]" class="border border-gray-300 rounded-md shadow-sm w-full mr-2" placeholder="Guest Email">
                <button type="button" class="remove-guest bg-red-500 text-white px-2 py-1 rounded-md">Remove</button>
            `;
            container.appendChild(input);
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
        document.querySelector('#notulenForm').addEventListener('submit', function (e) {
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
