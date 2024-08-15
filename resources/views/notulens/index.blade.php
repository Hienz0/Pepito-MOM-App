<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pepito MOM App</title>
    <!-- Include Tailwind CSS for styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav style="background-color: #F9F9F9;" class="fixed w-full shadow-md h-20 top-0 left-0">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
            <div class="flex items-center justify-between h-full">
                <!-- Navbar image -->
                <div class="flex-shrink-0 mr-auto h-12">
                    <a href="/">
                        <img src="{{ asset('images/pepito-logo.png') }}" alt="Navbar Logo" class="h-12 w-auto ml-2" src="/">
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
                            <div class="px-4 py-2 px-4 py-2 hover:bg-gray-100 transition-colors duration-300 rounded-md">
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
    <div class="container mx-auto mt-10">
        <h1 class="mb-6 text-3xl font-bold text-center">Pepito MOM App</h1>
        @if (session('success'))
            <div
                class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between mb-6">
            <h2 class="text-2xl font-semibold">Minutes of Meeting List</h2>
            <!-- Search Bar -->
            <div class="relative flex-grow mx-4 max-w-lg ml-5">
                <input type="text" id="searchInput" placeholder="   Search by title or ID"
                    class="px-4 py-2 pl-12 border rounded w-full text-gray-700">
                <!-- Search Icon -->
                <i class="fa-solid fa-magnifying-glass absolute left-1 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
            </div>
            <a href="{{ route('notulens.create') }}"
                class="btn text-white px-4 py-2 rounded bg-[#79B51F] hover:bg-[#69A01C]">
                <i class="fas fa-circle-plus mr-5"></i> Add New MoM
            </a>

        </div>





        <div class="shadow-lg bg-white rounded-lg overflow-hidden z-[1]">
            <div class="p-6">
                <table class="table-auto w-full text-left border-collapse">
                    <thead class="text-white" style="background-color: #FF9D03">
                        <tr>
                            <th class="p-4 border-b-2 border-gray-200">Meeting Title</th>
                            <th class="p-4 border-b-2 border-gray-200">Date</th>
                            <th class="p-4 border-b-2 border-gray-200">Time</th>
                            <th class="p-4 border-b-2 border-gray-200">Status</th>
                            <th class="p-4 border-b-2 border-gray-200">Action</th>
                        </tr>
                    </thead>
                    <tbody id="notulenTable" class="divide-y divide-gray-200">
                        @foreach ($notulens as $notulen)
                            <tr onclick="window.location='{{ route('notulens.show', $notulen->id) }}'"
                                class="hover:bg-gray-100 cursor-pointer">
                                <td class="p-4">{{ $notulen->meeting_title }}</td>
                                <td class="p-4">{{ $notulen->meeting_date }}</td>
                                <td class="p-4">{{ $notulen->meeting_time }}</td>
                                <td class="p-4">{{ $notulen->status }}</td>
                                <td class="p-4 flex space-x-2">
                                    <!-- View Icon -->
                                    <a href="{{ route('notulens.show', $notulen->id) }}"
                                        class="text-blue-500 hover:text-blue-700" data-bs-toggle="tooltip"
                                        title="View">
                                        <i class="fa-solid fa-eye text-xl"></i>
                                    </a>

                                    @auth
                                    @if (Auth::user()->id == $notulen->scripter_id && $notulen->status != 'Inactive')
                                    <!-- Edit Icon -->
                                    <a href="{{ route('notulens.edit', $notulen->id) }}"
                                        class="text-yellow-500 hover:text-yellow-700" data-bs-toggle="tooltip"
                                        title="Edit">
                                        <i class="fa-solid fa-edit text-xl"></i>
                                    </a>
                
                                    <!-- Inactivate Icon -->
                                    <form id="inactivateForm" action="{{ route('notulens.inactivate', $notulen->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button" class="text-red-500 hover:text-red-700" data-bs-toggle="tooltip" title="Inactivate">
                                            <i class="fa-solid fa-ban text-xl"></i>
                                        </button>
                                    </form>
                                @endif
                                    @endauth
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination Controls -->
                <div class="flex justify-between items-center mt-6">
                    <button id="prevPage"
                        class="bg-[#79B51F] hover:bg-[#69A01C] text-white font-bold py-2 px-4 rounded flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>Previous
                    </button>

                    <div id="pagination" class="flex space-x-2"></div>

                    <button id="nextPage"
                        class="bg-[#79B51F] hover:bg-[#69A01C] text-white font-bold py-2 px-4 rounded flex items-center">
                        Next<i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
            event.stopPropagation(); // Prevent the document click event from immediately hiding the dropdown
        });
        // Initialize all tooltips on the page
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        // Initialize all tooltips on the page
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Pagination Logic
            const rowsPerPage = 7;
            let currentPage = 1;
            const tableBody = document.getElementById('notulenTable');
            const rows = tableBody.getElementsByTagName('tr');
            const totalPages = Math.ceil(rows.length / rowsPerPage);

            function displayRows() {
                for (let i = 0; i < rows.length; i++) {
                    rows[i].style.display = 'none';
                }
                let start = (currentPage - 1) * rowsPerPage;
                let end = start + rowsPerPage;
                for (let i = start; i < end && i < rows.length; i++) {
                    rows[i].style.display = '';
                }
            }

            function updatePagination() {
                const pagination = document.getElementById('pagination');
                pagination.innerHTML = '';
                for (let i = 1; i <= totalPages; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.textContent = i;
                    pageButton.className = 'px-2 py-1 rounded';
                    if (i === currentPage) {
                        pageButton.classList.add('bg-[#79B51F]', 'text-white');
                    } else {
                        pageButton.classList.add('bg-white', 'text-[#79B51F]', 'border', 'border-[#79B51F]');
                        pageButton.style.transition = 'background-color 0.3s, color 0.3s';
                        pageButton.onmouseover = function() {
                            pageButton.style.backgroundColor = '#79B51F';
                            pageButton.style.color = '#FF9D03';
                        };
                        pageButton.onmouseout = function() {
                            pageButton.style.backgroundColor = 'white';
                            pageButton.style.color = '#79B51F';
                        };
                        pageButton.onclick = function() {
                            currentPage = i;
                            displayRows();
                            updatePagination();
                        };
                    }
                    pagination.appendChild(pageButton);
                }
            }

            document.getElementById('prevPage').addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    displayRows();
                    updatePagination();
                }
            });

            document.getElementById('nextPage').addEventListener('click', function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    displayRows();
                    updatePagination();
                }
            });

            function filterRows() {
                const searchInput = document.getElementById('searchInput').value.toLowerCase();
                for (let i = 0; i < rows.length; i++) {
                    const title = rows[i].cells[0].textContent.toLowerCase();
                    const id = rows[i].cells[0].dataset
                    .id; // Assume ID is stored in a data attribute or can be retrieved
                    if (title.includes(searchInput) || (id && id.includes(searchInput))) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
                // Reset pagination after filtering
                currentPage = 1;
                totalPages = Math.ceil([...rows].filter(row => row.style.display !== 'none').length / rowsPerPage);
                displayRows();
                updatePagination();
            }

            // Event listener for the search input
            document.getElementById('searchInput').addEventListener('input', filterRows);

            // Initial display and pagination

// Handle Inactivation with Confirmation
document.querySelectorAll('#inactivateForm button').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        event.stopPropagation(); // Prevents the <tr> click event
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, inactivate it!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.closest('form').submit();
            }
        });
    });
});



            displayRows();
            updatePagination();
        });
    </script>
</body>

</html>
