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
    <div class="container mt-10 p-8 bg-white shadow-md rounded-lg">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Edit Notulen</h1>
        
        <!-- Display any errors -->
        @if($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('notulens.update', $notulen->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Meeting Title -->
            <div class="mb-4">
                <label for="meeting_title" class="block text-gray-700 font-bold mb-2">Meeting Title</label>
                <input type="text" name="meeting_title" id="meeting_title" value="{{ old('meeting_title', $notulen->meeting_title) }}" class="border rounded w-full py-2 px-3 text-gray-700">
            </div>

            <!-- Meeting Date -->
            <div class="mb-4">
                <label for="meeting_date" class="block text-gray-700 font-bold mb-2">Meeting Date</label>
                <input type="date" name="meeting_date" id="meeting_date" value="{{ old('meeting_date', $notulen->meeting_date) }}" class="border rounded w-full py-2 px-3 text-gray-700">
            </div>

            <!-- Meeting Time -->
            <div class="mb-4">
                <label for="meeting_time" class="block text-gray-700 font-bold mb-2">Meeting Time</label>
                <input type="time" name="meeting_time" id="meeting_time" value="{{ old('meeting_time', $notulen->meeting_time) }}" class="border rounded w-full py-2 px-3 text-gray-700">
            </div>

            <!-- Agenda -->
            <div class="mb-4">
                <label for="agenda" class="block text-gray-700 font-bold mb-2">Agenda</label>
                <textarea name="agenda" id="agenda" class="border rounded w-full py-2 px-3 text-gray-700">{{ old('agenda', $notulen->agenda) }}</textarea>
            </div>

            <!-- Discussion -->
            <div class="mb-4">
                <label for="discussion" class="block text-gray-700 font-bold mb-2">Discussion</label>
                <textarea name="discussion" id="discussion" class="border rounded w-full py-2 px-3 text-gray-700">{{ old('discussion', $notulen->discussion) }}</textarea>
            </div>

            <!-- Decisions -->
            <div class="mb-4">
                <label for="decisions" class="block text-gray-700 font-bold mb-2">Decisions</label>
                <textarea name="decisions" id="decisions" class="border rounded w-full py-2 px-3 text-gray-700">{{ old('decisions', $notulen->decisions) }}</textarea>
            </div>

            <!-- Action Items -->
            <div class="mb-4">
                <label for="action_items" class="block text-gray-700 font-bold mb-2">Action Items</label>
                <textarea name="action_items" id="action_items" class="border rounded w-full py-2 px-3 text-gray-700">{{ old('action_items', $notulen->action_items) }}</textarea>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Notulen</button>
            </div>
        </form>
    </div>
</body>

</html>
