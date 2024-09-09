<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include Tailwind CSS for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include Font Awesome for the eye icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav style="background-color: #F9F9F9;" class="fixed w-full shadow-md h-20">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Navbar image -->
                <div class="flex-shrink-0 mr-auto h-12">
                    <img src="{{ asset('images/pepito-logo.png') }}" alt="Navbar Logo" class="h-12 w-auto ml-2 " src="/">
                </div>
                {{-- <div class="hidden md:flex items-center space-x-4">
                    <a href="#" class="text-gray-700 hover:text-gray-900">Home</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900">About</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900">Contact</a>
                </div> --}}
            </div>
        </div>
    </nav>

    <!-- Main content -->

    <div class="flex items-center justify-center min-h-screen">
        <div class="flex bg-white shadow-md rounded-xl w-full max-w-3xl aspect-[1440/1024]">
            <!-- Form Section -->
            <div class="w-full md:w-5/6 px-8 py-6 flex flex-col justify-center">
                <h2 class="text-center text-2xl font-bold mb-4">Login</h2>
                <form id="loginForm">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email address</label>
                        <input type="email"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="email" name="email" required>
                    </div>
                    <div class="mb-6 relative">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                        <input type="password"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline pr-10"
                            id="password" name="password" required>
                        <span class="absolute inset-y-12 right-0 pr-3 flex items-center text-gray-700">
                            <i class="far fa-eye cursor-pointer" id="togglePassword"></i>
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login</button>
                    </div>
                </form>
                <div class="text-center mt-4">
                    <a href="/password/reset" class="text-green-500 hover:underline">Forgot password?</a>
                </div>
                <div class="text-center mt-2">
                    <a href="/register" class="text-green-500 hover:underline">Don't have an account? Sign up</a>
                </div>
            </div>
            <!-- Image Section -->
            <div class="hidden md:flex w-2/3 items-center justify-center rounded-xl" style="background-color: #79b51f">
                <img src="{{ asset('images/pepito_mascot.png') }}" alt="Login Image"
                    class="object-contain h-96 w-full rounded-l">
                {{-- <div class="bg-green-500 h-full w-full obhect-cover"></div> --}}
            </div>

        </div>
    </div>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            const passwordValue = password.value;

            if (passwordValue.length < 8) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Password',
                    text: 'Password should be at least 8 characters long'
                });
                return; // Prevent form submission
            }

            const formData = new FormData(this);
            fetch('{{ route('login') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message without any button
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Logged in successfully!',
                            showConfirmButton: false, // Remove the "OK" button
                            timer: 1500 // Automatically close after 2 seconds
                        });

                        // Delayed redirect after 2 seconds (adjust as needed)
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 1500);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
</body>

</html>
