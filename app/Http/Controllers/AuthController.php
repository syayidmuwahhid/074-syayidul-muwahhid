<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Error;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display the login form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request The incoming request.
     * @return \Illuminate\Http\RedirectResponse The redirect response after authentication.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to authenticate the user with the provided credentials
        if (Auth::attempt($credentials)) {

            // Check if the user's account is not active
            if (Auth::user()->status != 1) {
                // Return back with an error message and only the email input
                return back()->withErrors([
                    'login' => 'Your account is not active.',
                ])->onlyInput('email');
            }

            // Regenerate the session ID
            $request->session()->regenerate();

            //log
            ActivityLog::addLog('info', 'Logged into System');

            // Redirect the user to the appropriate dashboard based on their role
            if (Auth::user()->role_id == 1) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.dashboard');

            // Uncomment the following line to redirect to the intended URL
            // return redirect()->intended('dashboard');
        }

        // Return back with an error message and only the email input
        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle user logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        // Logout the authenticated user
        Auth::logout();

        // Invalidate all of the current user's sessions...
        $request->session()->invalidate();

        // Regenerate the session ID...
        $request->session()->regenerateToken();

        // Redirect the user to the home page
        return redirect('/');
    }

    /**
     * Display the registration form.
     *
     * @return \Illuminate\View\View The view for the registration form.
     */
    public function register()
    {
    // Return the registration view
        return view('auth.register');
    }

    /**
     * Handles user registration.
     *
     * @param  \Illuminate\Http\Request  $request The incoming request.
     * @return \Illuminate\Http\RedirectResponse The redirect response after registration.
     * @throws \Throwable If any error occurs during the registration process.
     */
    public function signup(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate the incoming request data
            $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required', 'in:8'],
            ]);

            // Get all the request data
            $payload = $request->all();

            // Check if the password and confirm password match
            if ($payload['password']!= $payload['confirmPassword']) {
                throw new Error('The password and confirmation password do not match.');
            }

            // Remove unnecessary data from the payload
            unset($payload['confirmPassword']);
            unset($payload['_token']);

            // Set default values for user registration
            $payload['status'] = 1;
            $payload['role_id'] = 2;
            $payload['password'] = Hash::make($payload['password']);
            $payload['avatar'] = 'assets/media/svg/avatars/blank.svg';

            // Create a new user in the database
            User::create($payload);

            // Commit the database transaction
            DB::commit();

            // Set a success flash message and redirect the user to the login page
            session()->flash('success', 'Please log in to continue');
            return redirect()->route('login');

        } catch (\Throwable $th) {
            // Rollback the database transaction in case of any error
            DB::rollBack();

            // Return back with an error message and the input data
            return back()->withErrors([
                'error' => $th->getMessage(),
            ])->withInput();
        }
    }
}
