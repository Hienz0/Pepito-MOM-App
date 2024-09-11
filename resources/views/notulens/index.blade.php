<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pepito MOM App</title>
    <!-- Include Tailwind CSS for styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
        integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <style>


        .notification-item {
    display: flex;
    flex-direction: column;
    align-items: center; /* Center horizontally */
    justify-content: center; /* Center vertically */
    text-align: center; /* Align text to center */
    width: 100%; /* Ensure the element takes the full width of its parent */
    height: 100%; /* Make sure it takes full height to be centered properly */
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
            <div class='relative flex-grow mx-4 max-w-lg ml-5'>
                <div
                    class="relative flex items-center w-full h-12 rounded-lg shadow-md bg-white overflow-hidden border border-gray-300">
                    <!-- Search Icon -->
                    <div class="grid place-items-center h-full w-12 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <!-- Input Field -->
                    <input class="peer h-full w-full outline-none text-sm text-gray-700 pl-4 pr-4" type="text"
                        id="searchInput" placeholder="Search by title or ID" />
                </div>
            </div>


            <a href="{{ route('notulens.create') }}"
                class="bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white px-4 py-2 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out flex items-center space-x-2">
                <i class="fas fa-circle-plus"></i>
                <span>Add New MoM</span>
            </a>


        </div>





        <div class="shadow-lg bg-white rounded-lg overflow-hidden z-[1]">
            <div class="p-6">
                <table class="table-auto w-full text-left border-collapse">
                    <thead class="text-white p-4"
                        style="
                            background: linear-gradient(135deg, #FF9D03 0%, #FFB75E 100%);
                            border-radius: 0.5rem;">
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
                                            <form id="inactivateForm"
                                                action="{{ route('notulens.inactivate', $notulen->id) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" class="text-red-500 hover:text-red-700"
                                                    data-bs-toggle="tooltip" title="Inactivate">
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
                        class="bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white font-bold py-2 px-4 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>Previous
                    </button>


                    <div id="pagination" class="flex space-x-2"></div>

                    <button id="nextPage"
                        class="bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white font-bold py-2 px-4 rounded-md shadow-md hover:shadow-lg transition-all duration-200 ease-in-out flex items-center">
                        Next<i class="fas fa-arrow-right ml-2"></i>
                    </button>

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


            // Ole updatePagination Function
            // function updatePagination() {
            //     const pagination = document.getElementById('pagination');
            //     pagination.innerHTML = '';
            //     for (let i = 1; i <= totalPages; i++) {
            //         const pageButton = document.createElement('button');
            //         pageButton.textContent = i;
            //         pageButton.className = 'px-2 py-1 rounded';
            //         if (i === currentPage) {
            //             pageButton.classList.add('bg-[#79B51F]', 'text-white');
            //         } else {
            //             pageButton.classList.add('bg-white', 'text-[#79B51F]', 'border', 'border-[#79B51F]');
            //             pageButton.style.transition = 'background-color 0.3s, color 0.3s';
            //             pageButton.onmouseover = function() {
            //                 pageButton.style.backgroundColor = '#79B51F';
            //                 pageButton.style.color = '#FF9D03';
            //             };
            //             pageButton.onmouseout = function() {
            //                 pageButton.style.backgroundColor = 'white';
            //                 pageButton.style.color = '#79B51F';
            //             };
            //             pageButton.onclick = function() {
            //                 currentPage = i;
            //                 displayRows();
            //                 updatePagination();
            //             };
            //         }
            //         pagination.appendChild(pageButton);
            //     }
            // }

            function updatePagination() {
                const pagination = document.getElementById('pagination');
                pagination.innerHTML = '';

                function createPageButton(pageNumber, active) {
                    const pageButton = document.createElement('button');
                    pageButton.textContent = pageNumber;
                    pageButton.className = 'px-2 py-1 rounded';

                    if (active) {
                        pageButton.classList.add('bg-gradient-to-r', 'from-green-400', 'to-green-600',
                            'text-white');
                    } else {
                        pageButton.classList.add('bg-white', 'text-green-600', 'border', 'border-green-600');
                        pageButton.style.transition = 'background-color 0.3s, color 0.3s';
                        pageButton.onmouseover = function() {
                            pageButton.classList.remove('bg-white');
                            pageButton.classList.add('bg-gradient-to-r', 'from-green-500', 'to-green-700',
                                'text-white');
                        };
                        pageButton.onmouseout = function() {
                            pageButton.classList.remove('bg-gradient-to-r', 'from-green-500', 'to-green-700',
                                'text-white');
                            pageButton.classList.add('bg-white', 'text-green-600');
                        };
                        pageButton.onclick = function() {
                            currentPage = pageNumber;
                            displayRows();
                            updatePagination();
                        };
                    }
                    return pageButton;
                }

                // function createPageButton(pageNumber, active) {
                //         const pageButton = document.createElement('button');
                //         pageButton.textContent = pageNumber;
                //         pageButton.className = 'px-2 py-1 rounded';
                //         if (active) {
                //             pageButton.classList.add('bg-[#79B51F]', 'text-white');
                //         } else {
                //             pageButton.classList.add('bg-white', 'text-[#79B51F]', 'border', 'border-[#79B51F]');
                //             pageButton.style.transition = 'background-color 0.3s, color 0.3s';
                //             pageButton.onmouseover = function() {
                //                 pageButton.style.backgroundColor = '#79B51F';
                //                 pageButton.style.color = '#FF9D03';
                //             };
                //             pageButton.onmouseout = function() {
                //                 pageButton.style.backgroundColor = 'white';
                //                 pageButton.style.color = '#79B51F';
                //             };
                //             pageButton.onclick = function() {
                //                 currentPage = pageNumber;
                //                 displayRows();
                //                 updatePagination();
                //             };
                //         }
                //         return pageButton;
                //     }

                // Helper function to add ellipsis
                function addEllipsis() {
                    const ellipsis = document.createElement('span');
                    ellipsis.textContent = '...';
                    ellipsis.className = 'px-2 py-1';
                    pagination.appendChild(ellipsis);
                }

                // Always show the first page button
                pagination.appendChild(createPageButton(1, currentPage === 1));

                if (totalPages <= 10) {
                    // Show all page buttons if there are 10 or fewer pages
                    for (let i = 2; i <= totalPages; i++) {
                        pagination.appendChild(createPageButton(i, i === currentPage));
                    }
                } else {
                    let startPage, endPage;

                    if (currentPage <= 6) {
                        // If the current page is within the first 6, show the first 8 pages
                        startPage = 2;
                        endPage = 8;
                    } else if (currentPage >= totalPages - 5) {
                        // If the current page is within the last 6 pages, show the last 8 pages
                        startPage = totalPages - 7;
                        endPage = totalPages - 1;
                    } else {
                        // Otherwise, show the current page in the middle with 2 pages before and after
                        startPage = currentPage - 2;
                        endPage = currentPage + 2;
                    }

                    // Show ellipsis after the first page if we're not showing the first 8 pages
                    if (startPage > 2) {
                        addEllipsis();
                    }

                    // Show the calculated range of pages
                    for (let i = startPage; i <= endPage; i++) {
                        pagination.appendChild(createPageButton(i, i === currentPage));
                    }

                    // Show ellipsis before the last page if we're not showing the last 8 pages
                    if (endPage < totalPages - 1) {
                        addEllipsis();
                    }

                    // Show last page button
                    pagination.appendChild(createPageButton(totalPages, currentPage === totalPages));
                }
            }

            // Initial call to updatePagination
            updatePagination();


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
