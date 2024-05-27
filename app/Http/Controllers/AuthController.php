<?php

namespace App\Http\Controllers;

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

            // Check if the user's account is active
            if (Auth::user()->status!= 1) {
                // Return back with an error message and only the email input
                return back()->withErrors([
                    'login' => 'Your account is not active.',
                ])->onlyInput('email');
            }

            // Regenerate the session ID
            $request->session()->regenerate();

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

    public function signup(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8'],
            ]);

            $payload = $request->all();

            if ($payload['password'] != $payload['confirmPassword']) {
                throw new Error('The password and confirmation password do not match.');
            }

            unset($payload['confirmPassword']);
            unset($payload['_token']);
            $payload['status'] = 1;
            $payload['role_id'] = 2;
            $payload['password'] = Hash::make($payload['password']);

            User::create($payload);

            DB::commit();
            session()->flash('success', 'Please log in to continue');
            return redirect()->route('login');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors([
                'error' => $th->getMessage(),
            ])->withInput();
        }

    }
}
