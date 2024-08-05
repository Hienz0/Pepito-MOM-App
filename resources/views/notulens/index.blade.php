<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pepito MOM App</title>
    <!-- Include Tailwind CSS for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="mb-6 text-3xl font-bold text-center">Meeting Notulen App</h1>

        <div class="flex justify-end mb-4">
            <p class="mr-4">Welcome, {{ Auth::user()->name }}!</p>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger bg-red-500 text-white px-4 py-2 rounded">Logout</button>
            </form>
        </div>

        @if (session('success'))
            <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between mb-6">
            <h2 class="text-2xl font-semibold">Meeting Minutes</h2>
            <a href="{{ route('notulens.create') }}" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded">Add New Notulen</a>
        </div>

        <div class="card shadow-sm bg-white rounded-lg overflow-hidden">
            <div class="card-body p-4">
                <table class="table-auto w-full text-left border-collapse">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="p-4">Meeting Title</th>
                            <th class="p-4">Date</th>
                            <th class="p-4">Time</th>
                            <th class="p-4">Participants</th>
                            <th class="p-4">Agenda</th>
                            <th class="p-4">Discussion</th>
                            <th class="p-4">Decisions</th>
                        </tr>
                    </thead>
                    <tbody id="notulenTable" class="divide-y divide-gray-200">
                        @foreach ($notulens as $notulen)
                            <tr onclick="window.location='{{ route('notulens.show', $notulen->id) }}'" class="hover:bg-gray-100 cursor-pointer">
                                <td class="p-4">{{ $notulen->meeting_title }}</td>
                                <td class="p-4">{{ $notulen->meeting_date }}</td>
                                <td class="p-4">{{ $notulen->meeting_time }}</td>
                                <td class="p-4">
                                    @foreach ($notulen->participants as $participant)
                                        {{ $participant->name }}@if (!$loop->last), @endif
                                    @endforeach
                                </td>
                                <td class="p-4">{{ $notulen->agenda }}</td>
                                <td class="p-4">{{ $notulen->discussion }}</td>
                                <td class="p-4">{{ $notulen->decisions }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
