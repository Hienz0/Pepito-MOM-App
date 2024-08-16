<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotulenController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;



// dummy inject code
use App\Models\Notulen;
use App\Models\NotulenTask;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;


Route::get('/inject-dummy-notulens', function () {
    $scripter = User::find(1); // Find the user with id 1

    if (!$scripter) {
        return "User with id 1 not found.";
    }

    $users = User::all();
    $totalUsers = $users->count();


    for ($i = 0; $i < 120; $i++) {
        // Create a dummy notulen with multiple departments
        $notulen = Notulen::create([
            'meeting_title' => 'Dummy Meeting ' . ($i + 1),
            'meeting_date' => Carbon::now()->addDays($i)->format('Y-m-d'),
            'department' => json_encode(['HR', 'IT', 'Finance']), // Store multiple departments as JSON
            'meeting_time' => Carbon::now()->addHours($i)->format('H:i'),
            'meeting_location' => 'Dummy Location',
            'agenda' => 'Dummy Agenda ' . ($i + 1),
            'discussion' => 'Dummy Discussion ' . ($i + 1),
            'decisions' => 'Dummy Decisions ' . ($i + 1),
            'scripter_id' => $scripter->id,
            'status' => 'Open',
        ]);


        // Attach random participants
        $participantCount = rand(1, min(5, $totalUsers));
        $participantIds = $users->random($participantCount)->pluck('id')->toArray();
        $notulen->participants()->attach($participantIds);

        // Create tasks for the notulen (randomly deciding to add tasks or not)
        if (rand(0, 1)) {
            $taskCount = rand(1, 5);
            for ($j = 0; $j < $taskCount; $j++) {
                $taskPicCount = rand(1, min(3, $totalUsers));
                $taskPics = $users->random($taskPicCount)->pluck('id')->toArray();

                NotulenTask::create([
                    'notulen_id' => $notulen->id,
                    'task_topic' => 'Dummy Task Topic ' . ($j + 1),
                    'task_pic' => json_encode($taskPics),
                    'task_due_date' => Carbon::now()->addDays($j)->format('Y-m-d'),
                    'status' => 'Pending',
                    'description' => 'Dummy Description ' . ($j + 1),
                    'attachment' => null,
                ]);
            }
        }
    }

    return "20 Dummy Notulen records have been created successfully!";
});


// dummy inject code

// Routes requiring authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/', [NotulenController::class, 'index'])->name('notulens.index');
    Route::get('/create', [NotulenController::class, 'create'])->name('notulens.create');
    Route::post('/store', [NotulenController::class, 'store'])->name('notulens.store');
    Route::get('/notulens/{id}', [NotulenController::class, 'show'])->name('notulens.show');
    Route::put('/notulens/tasks/{id}', [NotulenController::class, 'updateTask'])->name('notulens.updateTask');

    // edit notulen
    Route::get('/notulens/{id}/edit', [NotulenController::class, 'edit'])->name('notulens.edit');
    Route::put('/notulens/{id}', [NotulenController::class, 'update'])->name('notulens.update');

    //distribute notulen
    Route::post('notulens/{id}/distribute', [NotulenController::class, 'distribute'])->name('distribute.mom');

    // Inactivate a Mom
    Route::patch('/notulens/{id}/inactivate', [NotulenController::class, 'inactivate'])->name('notulens.inactivate');





    Route::get('/home', function () {
        return view('home');
    })->name('home');
});

// Authentication routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/test-email', function () {
    Mail::raw('This is a test email', function ($message) {
        $message->to('aldyanqseven2@gmail.com')
                ->subject('Test Email');
    });
    return 'Email sent!';
});

use App\Http\Controllers\EmailController;

Route::get('/send-welcome-email', [EmailController::class, 'sendWelcomeEmail']);


// reset password
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
