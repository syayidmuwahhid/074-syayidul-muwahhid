<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\File;
use App\Models\Status;
use App\Models\Transaction;
use App\Models\User;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $home_route = route('admin.dashboard');
        $datas = Transaction::all();

        if (Auth::user()->role_id != 1) {
            $datas = $datas->where('user_add', Auth::user()->id);
            $home_route = route('user.dashboard');
        }

        $resp = array(
            "title" => "Transactions",
            "title_page" => "Data Transactions",
            "breadcrumbs" => array(
                "Home" => $home_route,
                "transactions" => "#"
            ),
            "datas" => $datas,
            "users" => User::all()->whereNotIn('role_id', '1')
        );

        return view('transactions.index', $resp);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $resp = array(
            "title" => "Resource",
            "title_page" => "New Resource",
            "breadcrumbs" => array(
                "Home" => route('user.dashboard'),
                "Resources" => route('user.transactions.index'),
                "Add" => "#"
            ),
            "action" => route('user.transactions.store'),
            "statuses" => Status::all()
        );
        return view('transactions.form', $resp);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'title' => ['required']
            ]);

            $resource = new Transaction();
            $resource->title = $request->title;
            $resource->status_id = $request->status_id;
            $resource->user_add = Auth::user()->id;

            if ($request->tags) {
                $tags = [];
                $tags_payload = json_decode($request->tags);
                foreach ($tags_payload as $tag) {
                    array_push($tags, $tag->value);
                }
                $tags = implode(",", $tags);
                $resource->tags = $tags;
            }
            $resource->save();
            DB::commit();
            session()->flash('success', 'successfully added the resource, continue with adding files');
            ActivityLog::addLog('success', 'Adding new resource "' . $resource->title . '"');

            $resp = array(
                "title" => "Add Files to Resource",
                "title_page" => "Add Files to Resource",
                "breadcrumbs" => array(
                    "Home" => route('user.dashboard'),
                    "Resources" => route('user.transactions.index'),
                    "Add Resource" => route('user.transactions.create'),
                    "Add Files" => "#"
                ),
                "action" => route('user.files.store'),
                "data" => $resource
            );
            return view('transactions.form', $resp);

        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', $th->getMessage());
            ActivityLog::addLog('fail', 'Adding new resource ['. $th->getMessage() .']');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = Crypt::decryptString($id);
        $uriHome = route('user.dashboard');
        $uriTransaction = route('user.transactions.index');

        if (Auth::user()->role_id == 1) {
            $uriHome = route('admin.dashboard');
            $uriTransaction = route('admin.transactions.index');
        }

        $resp = array(
            "title" => "Transactions",
            "title_page" => "Detail Data Transactions",
            "breadcrumbs" => array(
                "Home" => $uriHome,
                "Transactions" => $uriTransaction,
                "Detail" => "#"
            ),
            "data" => Transaction::find($id),
            "statuses" => Status::all()
        );

        if (!$resp['data']) {
            return redirect()->route('error-500');
        }

        return view('transactions.detail', $resp);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'title' => ['required']
            ]);

            $id = Crypt::decryptString($id);

            $resource = Transaction::find($id);
            $resource->title = $request->title;
            $resource->status_id = $request->status_id;

            if ($request->tags) {
                $tags = [];
                $tags_payload = json_decode($request->tags);
                foreach ($tags_payload as $tag) {
                    array_push($tags, $tag->value);
                }
                $tags = implode(",", $tags);
                $resource->tags = $tags;
            }
            $resource->save();
            DB::commit();
            session()->flash('success', 'successfully updated the resource');
            ActivityLog::addLog('success', 'Updating resource "' . $resource->title . '"');

            return redirect()->back();

        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', $th->getMessage());
            ActivityLog::addLog('fail', 'Updating resource ['. $th->getMessage() .']');
            return redirect()->back()->withInput();
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
            $transacion = Transaction::find($id);
            $transacion->delete();

            foreach ($transacion->file as $file) {
                $files = File::find($file->id);
                $files->delete();

                if (FacadesFile::exists($files->location . $files->name)) {
                    FacadesFile::delete($files->location . $files->name);
                }
            }

            DB::commit();
            session()->flash('success', 'File deleted successfully');
            ActivityLog::addLog('success', 'Removing resource "' . $transacion->title . '"');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', $th->getMessage());
            ActivityLog::addLog('fail', 'Removing resource ['. $th->getMessage() .']');
            return back();
        }
    }

    public function changeStatus(Request $request)
    {
        DB::beginTransaction();
        try {
            $resource = Transaction::find($request->id);
            $resource->status_id = $request->status;
            $resource->save();
            DB::commit();
            session()->flash('success', 'Status changed');
            ActivityLog::addLog('success', 'Changing status resource "' . $resource->title . '"');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', $th->getMessage());
            ActivityLog::addLog('fail', 'Changing status resource ['. $th->getMessage() .']');
            return back();
        }
    }
}
