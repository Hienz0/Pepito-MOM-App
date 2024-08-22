<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <!-- Include Tailwind CSS for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include Font Awesome for the eye icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        
    </style>
</head>
<body class="bg-gray-100">
        <!-- Navbar -->
        <nav style="background-color: #F9F9F9;" class="fixed w-full shadow-md h-20">
            <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Navbar image -->
                    <div class="flex-shrink-0 mr-auto h-12">
                        <a href="/">
                            <img src="{{ asset('images/pepito-logo.png') }}" alt="Navbar Logo" class="h-12 w-auto ml-2 " src="/">
                        </a>
                        
                    </div>
                    {{-- <div class="hidden md:flex items-center space-x-4">
                        <a href="#" class="text-gray-700 hover:text-gray-900">Home</a>
                        <a href="#" class="text-gray-700 hover:text-gray-900">About</a>
                        <a href="#" class="text-gray-700 hover:text-gray-900">Contact</a>
                    </div> --}}
                </div>
            </div>
        </nav>

        <div class="flex items-center justify-center min-h-screen">
            <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-bold text-center mb-6">{{ __('Reset Password') }}</h2>
        
                <form id="reset-password-form" method="POST" action="{{ route('password.email') }}">
                    @csrf
        
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
        
                    <div class="flex items-center justify-between mt-6">
                        <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white py-2 rounded-md">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </form>
                <div class="mt-4 text-center">
                    <a href="/login" class="text-green-500 hover:underline">{{ __('Back to Login') }}</a>
                </div>
            </div>
        </div>
        


    <script>
        document.getElementById('reset-password-form').addEventListener('submit', function(event) {
            event.preventDefault();
            var form = this;

            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Password reset link sent!',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = '/login';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message || 'Something went wrong. Please try again.'
                    });
                }
            }).catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Please try again.'
                });
            });
        });
    </script>
</body>
</html>
