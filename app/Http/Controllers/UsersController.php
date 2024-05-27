<?php

namespace App\Http\Controllers;

use App\Helpers\Anyhelpers;
use App\Models\File;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\User;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resp = array(
            "title" => "Users",
            "title_page" => "Data Users",
            "breadcrumbs" => array(
                "Home" => route('admin.dashboard'),
                "Users" => "#"
            ),
            "datas" => User::all(),
            "roles" => Role::all(),
        );
        return view('users.index', $resp);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
        return view('users.form', $resp);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8'],
            ]);

            $payload = $request->all();

            unset($payload['_token']);
            $payload['status'] = 1;
            $payload['password'] = Hash::make($payload['password']);
            $payload['avatar'] = 'assets/media/svg/avatars/blank.svg';

            $path = "storage/avatars/";
            if ($request->hasFile('avatar')) {
                $img_name = time() . $request->file('avatar')->hashName();
                $request->file('avatar')->move($path, $img_name);
                $payload['avatar'] = $path.$img_name;
            }

            User::create($payload);

            DB::commit();
            session()->flash('success', 'Successfully created');
            return redirect()->route('admin.users.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors([
                'error' => $th->getMessage(),
            ])->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = Crypt::decryptString($id);
        $user = User::find($id);

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

        if (!$resp['data']) {
            return redirect()->route('error-500');
        }

        return view('users.detail', $resp);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = Crypt::decryptString($id);
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
        return view('users.edit', $resp);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email'],
            ]);

            $id = Crypt::decryptString($id);

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role_id = $request->role_id;

            if ($request->password) {
                $user->password =  Hash::make($request->password);
            }

            $path = "storage/avatars/";
            if ($request->hasFile('avatar')) {
                $img_name = time() . $request->file('avatar')->hashName();
                $request->file('avatar')->move($path, $img_name);
                $user->avatar = $path.$img_name;
            }

            $user->save();
            DB::commit();
            session()->flash('success', 'Successfully updated');

            return redirect()->route('admin.users.show', Crypt::encryptString($id));

        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', $th->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $id = Crypt::decryptString($id);
            $user = User::find($id);
            $user->delete();
            DB::commit();
            session()->flash('success', 'User deleted successfully');
            return redirect()->route('admin.users.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', $th->getMessage());
            return back();
        }
    }

    public function changeStatus(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::find($request->id);
            $user->status = $request->status;
            $user->save();

            DB::commit();
            session()->flash('success', 'User Status Changed');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', $th->getMessage());
            return back();
        }
        return $request->all();
    }

    public function profile()
    {
        $user = User::find(Auth::user()->id);

        $resp = array(
            "title" => "Profile",
            "title_page" => "My Profile",
            "breadcrumbs" => array(
                "Home" => Auth::user()->role_id == 1 ? route('admin.dashboard') : route('user.dashboard'),
                "Profile" => "#"
            ),
            "data" => $user,
            "count_files" => File::join('transactions', 'transactions.id', 'transaction_id')
                ->where('transactions.user_add', Auth::user()->id)
                ->count()
        );

        return view('users.detail', $resp);
    }

    public function editProfile(string $id)
    {
        $id = Crypt::decryptString($id);
        $resp = array(
            "title" => "Profile",
            "title_page" => "Edit Profile",
            "breadcrumbs" => array(
                "Home" => Auth::user()->role_id == 1 ? route('admin.dashboard') : route('user.dashboard'),
                "Profile" => route('profile.index'),
                "Edit" => "#"
            ),
            "action" => route('profile.update', Crypt::encryptString($id)),
            "data" => User::find($id),
            "roles" => Role::all()
        );

        if (!$resp['data']) {
            return redirect()->route('error-500');
        }

        return view('users.edit', $resp);
    }

    public function updateProfile(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email'],
            ]);

            $id = Crypt::decryptString($id);

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;

            if ($request->password) {
                $user->password =  Hash::make($request->password);
            }

            $path = "storage/avatars/";
            if ($request->hasFile('avatar')) {
                $img_name = time() . $request->file('avatar')->hashName();
                $request->file('avatar')->move($path, $img_name);
                $user->avatar = $path.$img_name;
            }

            $user->save();
            DB::commit();
            session()->flash('success', 'Successfully updated');

            return redirect()->route('profile.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', $th->getMessage());
            return back()->withInput();
        }
    }
}
