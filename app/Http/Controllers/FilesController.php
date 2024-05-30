<?php

namespace App\Http\Controllers;

use App\Helpers\Anyhelpers;
use App\Models\ActivityLog;
use App\Models\File;
use App\Models\FileExtension;
use App\Models\Transaction;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all files
        $files = File::all();

        // If the user is not an admin, fetch only the files related to the user
        if (Auth::user()->role_id!= 1) {
            $files = File::select('files.*')
                ->join('transactions', 'transactions.id', 'transaction_id')
                ->where('transactions.user_add', Auth::user()->id)
                ->get();
        }

        // Loop through the files to generate image links based on file type
        foreach ($files as $file) {
            $file['img_link'] = asset('assets/media/svg/avatars/blank.svg');
            $ext = explode('.', $file->name)[1];

            // check data
            $accExtension = FileExtension::where('extension', $ext)->first('type');

            if ($accExtension) {
                if ($accExtension->type == 'video') {
                    $file['img_link'] = 'https://png.pngtree.com/png-vector/20190215/ourmid/pngtree-play-video-icon-graphic-design-template-vector-png-image_530837.jpg';

                } elseif ($accExtension->type == 'document') {
                    $file['img_link'] = 'https://st3.depositphotos.com/4799321/14326/v/450/depositphotos_143261637-stock-illustration-pdf-download-vector-icon-simple.jpg';

                } elseif ($accExtension->type == 'image') {
                    $file['img_link'] = asset($file->location. $file->name);

                }
            }
        }

        // Prepare the response data
        $resp = array(
            "title" => "Files",
            "title_page" => "Data Files",
            "breadcrumbs" => array(
                "Home" => route('user.dashboard'),
                "Files" => "#"
            ),
            "datas" => $files,
            "transactions" => Transaction::where('user_add', Auth::user()->id)->get()
        );

        // Return the view with the response data
        return view('files.index', $resp);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();

        // Initialize the response array
        $resp = array(
            'tatus' => 'fail',
        );

        // Initialize the HTTP status code
        $code = 500;

        try {
            // Validate the incoming request
            $request->validate([
                'file' => ['required', 'mimes:'. Anyhelpers::getExtension()]
            ]);

            // Prepare the file path
            $path = "storage/files/". Auth::user()->id. "/$request->transaction_title/";

            // Generate a unique name for the file
            $img_name = time(). $request->file('file')->hashName();

            // Move the uploaded file to the specified location
            $request->file('file')->move($path, $img_name);

            // Prepare the full file path
            $filename = $path. $img_name;

            // Create a new File model instance
            $file = new File();

            // Set the file properties
            $file->name = $img_name;
            $file->location = $path;
            $file->transaction_id = $request->transaction_id;

            // Save the file to the database
            $file->save();

            // Update the response array
            $resp['status'] = 'success';
            $resp['data'] = $filename;

            // Commit the database transaction
            DB::commit();

            // Log the successful file addition activity
            ActivityLog::addLog('success', 'Adding file into resource "'. $file->transaction->title. '"');

            // Update the HTTP status code
            $code = 200;
        } catch (\Throwable $th) {
            // Rollback the database transaction
            DB::rollBack();

            // Set the error message in the response array
            $resp['msg'] = $th->getMessage();

            // Log the failed file addition activity
            ActivityLog::addLog('fail', 'Adding file into resource ['. $th->getMessage(). ']');
        }

        // Return the response as a JSON response with the specified HTTP status code
        return response()->json($resp, $code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id The encrypted ID of the file to be deleted.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Contracts\Encryption\DecryptException If the decryption fails.
     * @throws \Throwable If an error occurs during the database transaction or file deletion.
     */
    public function destroy(string $id)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Decrypt the ID
            $id = Crypt::decryptString($id);

            // Find the file in the database
            $file = File::find($id);

            // Delete the file record from the database
            $file->delete();

            // Check if the file exists in the storage
            if (FacadesFile::exists($file->location. $file->name)) {
                // Delete the file from the storage
                FacadesFile::delete($file->location. $file->name);
            }

            // Commit the database transaction
            DB::commit();

            // Set a success flash message
            session()->flash('success', 'File deleted successfully');

            // Log the successful file deletion activity
            ActivityLog::addLog('success', 'Removing file into resource "'. $file->transaction->title. '"');
        } catch (\Throwable $th) {
            // Rollback the database transaction
            DB::rollBack();

            // Set an error flash message
            session()->flash('error', 'Unable to delete');

            // Log the failed file deletion activity
            ActivityLog::addLog('fail', 'Removing file into resource ['. $th->getMessage().']');
        }

        // Redirect back to the previous page
        return redirect()->back();
    }
}
