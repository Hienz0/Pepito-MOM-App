<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle the registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        Log::info('Register request data: ', $request->all());

        try {
            $request->validate([
                'email' => 'required|email|unique:users,email',
                'fullname' => 'required|string|max:255',
                'password' => 'required|string|min:8|confirmed',
                'phone' => 'required|string|max:15',
            ]);

            $user = User::create([
                'email' => $request->email,
                'name' => $request->fullname,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
            ]);

            // Log the user in after registration
            auth()->login($user);

            // Redirect to a desired route after successful registration
            return response()->json(['success' => true, 'message' => 'Registration successful! Please log in.']);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['success' => false, 'message' => $errors[0]]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred during registration.']);
        }
    }
}
