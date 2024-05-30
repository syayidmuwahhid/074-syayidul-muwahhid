<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\File;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Prepare data for the view
         *
         * @var array $resp
         */
        $resp = array(
            "title" => "Users",
            "title_page" => "Data Users",
            "breadcrumbs" => array(
                "Home" => route('admin.dashboard'),
                "Users" => "#"
            ),
            "datas" => User::all(), // Fetch all users
            "roles" => Role::all(), // Fetch all roles
        );

        // Return the view with the prepared data
        return view('users.index', $resp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        /**
         * Prepare data for the view
         *
         * @var array $resp
         */
        $resp = array(
            "title" => "Users",
            "title_page" => "Add Users",
            "breadcrumbs" => array(
                "Home" => route('admin.dashboard'),
                "Users" => route('admin.users.index'),
                "Add" => "#"
            ),
            "action" => route('admin.users.store'),
            "roles" => Role::orderBy('id', 'desc')->get(),
        );

        // Return the view with the prepared data
        return view('users.form', $resp);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();
        try {
            // Validate the incoming request data
            $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8'],
            ]);

            // Prepare the payload for creating a new user
            $payload = $request->all();

            // Remove the CSRF token from the payload
            unset($payload['_token']);

            // Set the default status to active
            $payload['status'] = 1;

            // Hash the password before storing it in the database
            $payload['password'] = Hash::make($payload['password']);

            // Set a default avatar image
            $payload['avatar'] = 'assets/media/svg/avatars/blank.svg';

            // If an avatar image is provided, save it to the storage directory
            $path = "storage/avatars/";
            if ($request->hasFile('avatar')) {
                $img_name = time(). $request->file('avatar')->hashName();
                $request->file('avatar')->move($path, $img_name);
                $payload['avatar'] = $path.$img_name;
            }

            // Create a new user using the prepared payload
            $user = User::create($payload);

            // Commit the database transaction
            DB::commit();

            // Set a success flash message and log the activity
            session()->flash('success', 'Successfully created');
            ActivityLog::addLog('success', 'Adding new user "'. $user->email. '"');

            // Redirect to the users index page
            return redirect()->route('admin.users.index');

        } catch (\Throwable $th) {
            // Rollback the database transaction in case of an error
            DB::rollBack();

            // Log the error and set an error flash message
            ActivityLog::addLog('fail', 'Adding new user ['. $th->getMessage().']');
            return back()->withErrors([
                'error' => $th->getMessage(),
            ])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $id The encrypted ID of the user to be displayed.
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Contracts\Encryption\DecryptException
     */
    public function show(string $id)
    {
        // Decrypt the ID
        $id = Crypt::decryptString($id);

        // Fetch the user from the database
        $user = User::find($id);

        // Prepare data for the view
        $resp = array(
            "title" => "Users",
            "title_page" => "Detail Data Users",
            "breadcrumbs" => array(
                "Home" => route('admin.dashboard'),
                "Users" => route('admin.users.index'),
                "Detail" => "#"
            ),
            "data" => $user,
            "count_files" => File::join('transactions', 'transactions.id', 'transaction_id')
                ->where('transactions.user_add', $id)
                ->count()
        );

        // If the user does not exist, redirect to the 500 error page
        if (!$resp['data']) {
            return redirect()->route('error-500');
        }

        // Return the view with the prepared data
        return view('users.detail', $resp);
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param string $id The encrypted ID of the user to be edited.
     * @return \Illuminate\View\View
     * @throws \Illuminate\Contracts\Encryption\DecryptException
     */
    public function edit(string $id)
    {
        // Decrypt the ID
        $id = Crypt::decryptString($id);

        // Prepare data for the view
        $resp = array(
            "title" => "Users",
            "title_page" => "Edit Data Users",
            "breadcrumbs" => array(
                "Home" => route('admin.dashboard'),
                "Users" => route('admin.users.index'),
                "Detail" => route('admin.users.show', Crypt::encryptString($id)),
                "Edit" => "#"
            ),
            "action" => route('admin.users.update', Crypt::encryptString($id)),
            "data" => User::find($id),
            "roles" => Role::all()
        );

        // Return the view with the prepared data
        return view('users.edit', $resp);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request The incoming request data.
     * @param  string $id The encrypted ID of the user to be updated.
     * @return \Illuminate\Http\RedirectResponse Redirects to the user's detail page after successful update.
     * @throws \Illuminate\Contracts\Encryption\DecryptException If the ID decryption fails.
     * @throws \Throwable If any error occurs during the database transaction.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            // Validate the incoming request data
            $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email'],
            ]);

            // Decrypt the ID
            $id = Crypt::decryptString($id);

            // Fetch the user from the database
            $user = User::find($id);

            // Update the user's attributes
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role_id = $request->role_id;

            // If a new password is provided, hash it and update the user's password
            if ($request->password) {
                $user->password =  Hash::make($request->password);
            }

            // If an avatar image is provided, save it to the storage directory and update the user's avatar
            $path = "storage/avatars/";
            if ($request->hasFile('avatar')) {
                $img_name = time(). $request->file('avatar')->hashName();
                $request->file('avatar')->move($path, $img_name);
                $user->avatar = $path.$img_name;
            }

            // Save the updated user to the database
            $user->save();

            // Commit the database transaction
            DB::commit();

            // Set a success flash message and log the activity
            session()->flash('success', 'Successfully updated');
            ActivityLog::addLog('success', 'Updating user "'. $user->email. '"');

            // Redirect to the user's detail page
            return redirect()->route('admin.users.show', Crypt::encryptString($id));

        } catch (\Throwable $th) {
            // Rollback the database transaction in case of an error
            DB::rollBack();

            // Set an error flash message and log the error
            session()->flash('error', $th->getMessage());
            ActivityLog::addLog('fail', 'Updating user ['. $th->getMessage().']');

            // Redirect back to the previous page with the input data
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id The encrypted ID of the user to be deleted.
     * @return \Illuminate\Http\RedirectResponse Redirects to the users index page after successful deletion.
     * @throws \Illuminate\Contracts\Encryption\DecryptException If the ID decryption fails.
     * @throws \Throwable If any error occurs during the database transaction.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            // Decrypt the ID
            $id = Crypt::decryptString($id);

            // Fetch the user from the database
            $user = User::find($id);

            // Delete the user
            $user->delete();

            // Commit the database transaction
            DB::commit();

            // Set a success flash message and log the activity
            session()->flash('success', 'User deleted successfully');
            ActivityLog::addLog('success', 'Removing user "'. $user->email. '"');

            // Redirect to the users index page
            return redirect()->route('admin.users.index');

        } catch (\Throwable $th) {
            // Rollback the database transaction in case of an error
            DB::rollBack();

            // Set an error flash message and log the error
            session()->flash('error', $th->getMessage());
            ActivityLog::addLog('fail', 'Removing user ['. $th->getMessage().']');

            // Redirect back to the previous page
            return back();
        }
    }

    /**
     * Change the status of a user.
     *
     * @param Request $request The incoming request containing the user ID and new status.
     * @return \Illuminate\Http\RedirectResponse Redirects back to the previous page after successful status change.
     * @throws \Throwable If any error occurs during the database transaction.
     */
    public function changeStatus(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();
        try {
            // Find the user by ID
            $user = User::find($request->id);

            // Update the user's status
            $user->status = $request->status;

            // Save the updated user to the database
            $user->save();

            // Commit the database transaction
            DB::commit();

            // Set a success flash message and log the activity
            session()->flash('success', 'User Status Changed');
            ActivityLog::addLog('success', 'Changing status user "'. $user->email. '"');

            // Redirect back to the previous page
            return redirect()->back();

        } catch (\Throwable $th) {
            // Rollback the database transaction in case of an error
            DB::rollBack();

            // Set an error flash message and log the error
            session()->flash('error', $th->getMessage());
            ActivityLog::addLog('fail', 'Changing status user ['. $th->getMessage().']');

            // Redirect back to the previous page
            return back();
        }
    }

    /**
     * Display the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        // Fetch the authenticated user's data from the database
        $user = User::find(Auth::user()->id);

        // Prepare data for the view
        $resp = array(
            "title" => "Profile",
            "title_page" => "My Profile",
            "breadcrumbs" => array(
                "Home" => Auth::user()->role_id == 1? route('admin.dashboard') : route('user.dashboard'),
                "Profile" => "#"
            ),
            "data" => $user,
            // Count the number of files uploaded by the authenticated user
            "count_files" => File::join('transactions', 'transactions.id', 'transaction_id')
                ->where('transactions.user_add', Auth::user()->id)
                ->count()
        );

        // Return the view with the prepared data
        return view('users.detail', $resp);
    }

    /**
     * Method to display the edit profile form.
     *
     * @param string $id The encrypted ID of the user to be edited.
     * @return \Illuminate\View\View Returns a view with the necessary data for editing the user's profile.
     * @throws \Illuminate\Contracts\Encryption\DecryptException If the ID decryption fails.
     */
    public function editProfile(string $id)
    {
        // Decrypt the ID
        $id = Crypt::decryptString($id);

        // Prepare data for the view
        $resp = array(
            "title" => "Profile",
            "title_page" => "Edit Profile",
            "breadcrumbs" => array(
                "Home" => Auth::user()->role_id == 1? route('admin.dashboard') : route('user.dashboard'),
                "Profile" => route('profile.index'),
                "Edit" => "#"
            ),
            "action" => route('profile.update', Crypt::encryptString($id)),
            "data" => User::find($id),
            "roles" => Role::all()
        );

        // If the user does not exist, redirect to the 500 error page
        if (!$resp['data']) {
            return redirect()->route('error-500');
        }

        // Return the view with the prepared data
        return view('users.edit', $resp);
    }

    /**
     * Method to update the authenticated user's profile.
     *
     * @param Request $request The incoming request containing the user's updated data.
     * @param string $id The encrypted ID of the user to be updated.
     * @return \Illuminate\Http\RedirectResponse Redirects to the user's profile page after successful update.
     * @throws \Illuminate\Contracts\Encryption\DecryptException If the ID decryption fails.
     * @throws \Throwable If any error occurs during the database transaction.
     */
    public function updateProfile(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            // Validate the incoming request data
            $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email'],
            ]);

            // Decrypt the ID
            $id = Crypt::decryptString($id);

            // Fetch the user from the database
            $user = User::find($id);

            // Update the user's attributes
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;

            // If a new password is provided, hash it and update the user's password
            if ($request->password) {
                $user->password =  Hash::make($request->password);
            }

            // If an avatar image is provided, save it to the storage directory and update the user's avatar
            $path = "storage/avatars/";
            if ($request->hasFile('avatar')) {
                $img_name = time(). $request->file('avatar')->hashName();
                $request->file('avatar')->move($path, $img_name);
                $user->avatar = $path.$img_name;
            }

            // Save the updated user to the database
            $user->save();

            // Commit the database transaction
            DB::commit();

            // Set a success flash message and log the activity
            session()->flash('success', 'Successfully updated');
            ActivityLog::addLog('success', 'Updating profile');

            // Redirect to the user's profile page
            return redirect()->route('profile.index');

        } catch (\Throwable $th) {
            // Rollback the database transaction in case of an error
            DB::rollBack();

            // Set an error flash message and log the error
            session()->flash('error', $th->getMessage());
            ActivityLog::addLog('fail', 'Updating profile ['. $th->getMessage().']');

            // Redirect back to the previous page with the input data
            return back()->withInput();
        }
    }
}
