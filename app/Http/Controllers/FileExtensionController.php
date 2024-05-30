<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\FileExtension;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class FileExtensionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resp = array(
            "title" => "File Extensions",
            "title_page" => "Data File Extension",
            "breadcrumbs" => array(
                "Home" => route('admin.dashboard'),
                "File Extensions" => "#"
            ),
            "action" => route('admin.file-extensions.store'),
            "datas" => FileExtension::all(), // Fetch all file extensions
        );
        return view('extensions.index', $resp);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'type' => ['required'],
                'extension' => ['required'],
            ]);

            $extension = new FileExtension();
            $extension->type = $request->type;
            $extension->extension = $request->extension;
            $extension->save();

            DB::commit();
            session()->flash('success', 'Data has been saved');
            ActivityLog::addLog('success', 'Adding File extension');

            return redirect()->back();
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
            ActivityLog::addLog('error', 'Adding File extension ['. $th->getMessage() .']');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = Crypt::decryptString($id);

        $resp = array(
            "title" => "File Extensions",
            "title_page" => "Edit Data File Extension",
            "breadcrumbs" => array(
                "Home" => route('admin.dashboard'),
                "File Extensions" => "#"
            ),
            "action" => route('admin.file-extensions.update', Crypt::encryptString($id)),
            "datas" => FileExtension::all(), // Fetch all file extensions
            "data" => FileExtension::find($id), // Fetch file extensions
        );
        return view('extensions.index', $resp);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'type' => ['required'],
                'extension' => ['required'],
            ]);

            $id = Crypt::decryptString($id);

            $extension = FileExtension::find($id);
            $extension->type = $request->type;
            $extension->extension = $request->extension;
            $extension->save();

            DB::commit();
            session()->flash('success', 'Data has been updated');
            ActivityLog::addLog('success', 'Updating File extension');

            return redirect()->route('admin.file-extensions.index');
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
            ActivityLog::addLog('error', 'Updating File extension ['. $th->getMessage() .']');
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
            // Decrypt the ID
            $id = Crypt::decryptString($id);

            // Fetch the file extension from the database
            $extension = FileExtension::find($id);

            // Delete the file extension
            $extension->delete();

            // Commit the database transaction
            DB::commit();

            // Set a success flash message and log the activity
            session()->flash('success', 'File Extension deleted successfully');
            ActivityLog::addLog('success', 'Removing File Extension "'. $extension->extension. '"');

            // Redirect to the file-extension index page
            return redirect()->route('admin.file-extensions.index');

        } catch (\Throwable $th) {
            // Rollback the database transaction in case of an error
            DB::rollBack();

            // Set an error flash message and log the error
            session()->flash('error', $th->getMessage());
            ActivityLog::addLog('fail', 'Removing File Extension ['. $th->getMessage().']');

            // Redirect back to the previous page
            return redirect()->back();
        }
    }
}
