<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\File;
use App\Models\FileExtension;
use App\Models\Status;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Define the home route based on the user's role
        $home_route = route('admin.dashboard');
        // Fetch all transactions
        $datas = Transaction::all();

        // If the user is not an admin, filter transactions by the user's ID
        if (Auth::user()->role_id != 1) {
            $datas = $datas->where('user_add', Auth::user()->id);
            $home_route = route('user.dashboard');
        }

        // Process each transaction to add badge class and tags array
        foreach ($datas as $data) {
            if ($data->status_id == '1') {
                $data->badge = 'badge-light-warning';
            } elseif ($data->status_id == '2') {
                $data->badge = 'badge-light-success';
            } else {
                $data->badge = 'badge-light-danger';
            }

            $data->tags = explode(',', $data->tags);
        }

        // Prepare the response data
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

        // Return the view with the response data
        return view('transactions.index', $resp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        /**
         * Prepare the response data for the view
         *
         * @var array $resp
         */
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

        // Return the view with the response data
        return view('transactions.form', $resp);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validate the request data
            $request->validate([
                'title' => ['required']
            ]);

            // Create a new Transaction instance
            $resource = new Transaction();
            $resource->title = $request->title;
            $resource->status_id = $request->status_id;
            $resource->user_add = Auth::user()->id;

            // If tags are provided, process and save them
            if ($request->tags) {
                $tags = [];
                $tags_payload = json_decode($request->tags);
                foreach ($tags_payload as $tag) {
                    array_push($tags, $tag->value);
                }
                $tags = implode(",", $tags);
                $resource->tags = $tags;
            }

            // Save the Transaction instance
            $resource->save();
            DB::commit();

            // Set success flash message and log the activity
            session()->flash('success', 'uccessfully added the resource, continue with adding files');
            ActivityLog::addLog('success', 'Adding new resource "'. $resource->title. '"');

            // Prepare the response data for the next view
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

            // Return the view with the response data
            return view('transactions.form', $resp);

        } catch (\Throwable $th) {
            // Rollback the database transaction in case of an error
            DB::rollBack();

            // Set error flash message and log the activity
            session()->flash('error', $th->getMessage());
            ActivityLog::addLog('fail', 'Adding new resource ['. $th->getMessage().']');

            // Redirect back to the previous page with the input data
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $id The encrypted ID of the resource to be displayed.
     * @return \Illuminate\View\View The view with the resource details.
     * @throws \Illuminate\Contracts\Encryption\DecryptException If the ID cannot be decrypted.
     */
    public function show(string $id)
    {
        // Decrypt the ID
        $id = Crypt::decryptString($id);

        // Set the home route and transaction route based on the user's role
        $uriHome = route('user.dashboard');
        $uriTransaction = route('user.transactions.index');

        if (Auth::user()->role_id == 1) {
            $uriHome = route('admin.dashboard');
            $uriTransaction = route('admin.transactions.index');
        }

        // Fetch the transaction data
        $data = Transaction::find($id);

        // Set the badge class based on the status
        if ($data->status_id == '1') {
            $data->badge = 'badge-light-warning';
        } elseif ($data->status_id == '2') {
            $data->badge = 'badge-light-success';
        } else {
            $data->badge = 'badge-light-danger';
        }

        // Process each file associated with the transaction
        foreach ($data->file as $file) {
            $file->filename = $file['location'].$file['name'];
            $file['img_link'] = asset('assets/media/svg/avatars/blank.svg');
            $ext = explode('.', $file->filename)[1];

            // check data
            $accExtension = FileExtension::where('extension', $ext)->first('type');

            if ($accExtension) {
                if ($accExtension->type == 'video') {
                    $file['img_link'] = 'https://png.pngtree.com/png-vector/20190215/ourmid/pngtree-play-video-icon-graphic-design-template-vector-png-image_530837.jpg';
                    $file['modalAsset'] = '<video width="640" height="360" controls>
                    <source src="'. asset($file->filename).'" type="video/mp4">
                    Your browser does not support the video tag.
                    </video>';
                } elseif ($accExtension->type == 'document') {
                    $file['img_link'] = 'https://st3.depositphotos.com/4799321/14326/v/450/depositphotos_143261637-stock-illustration-pdf-download-vector-icon-simple.jpg';
                    $file['modalAsset'] = '<iframe src="'. asset($file->filename).'" width="800" height="500"></iframe>';
                } elseif ($accExtension->type == 'image') {
                    $file['img_link'] = asset($file->filename);
                    $file['modalAsset'] = '<img src="'. asset($file->filename).'" alt="file" />';
                }
            }

        }

        // Prepare the response data for the view
        $resp = array(
            "title" => "Transactions",
            "title_page" => "Detail Data Transactions",
            "breadcrumbs" => array(
                "Home" => $uriHome,
                "Transactions" => $uriTransaction,
                "Detail" => "#"
            ),
            "data" => $data,
            "statuses" => Status::all()
        );

        // Redirect to the error-500 page if the data is not found
        if (!$resp['data']) {
            return redirect()->route('error-500');
        }

        // Return the view with the response data
        return view('transactions.detail', $resp);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request The request object containing the input data.
     * @param  string  $id The encrypted ID of the resource to be updated.
     * @return \Illuminate\Http\RedirectResponse Redirects back to the previous page with a success or error flash message.
     * @throws \Illuminate\Contracts\Encryption\DecryptException If the ID cannot be decrypted.
     * @throws \Throwable If an error occurs during the database transaction.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            // Validate the request data
            $request->validate([
                'title' => ['required']
            ]);

            // Decrypt the ID
            $id = Crypt::decryptString($id);

            // Find the resource by ID
            $resource = Transaction::find($id);

            // Update the resource's attributes
            $resource->title = $request->title;
            $resource->status_id = $request->status_id;

            // If tags are provided, process and save them
            if ($request->tags) {
                $tags = [];
                $tags_payload = json_decode($request->tags);
                foreach ($tags_payload as $tag) {
                    array_push($tags, $tag->value);
                }
                $tags = implode(",", $tags);
                $resource->tags = $tags;
            }

            // Save the updated resource
            $resource->save();

            // Commit the database transaction
            DB::commit();

            // Set success flash message and log the activity
            session()->flash('success', 'uccessfully updated the resource');
            ActivityLog::addLog('success', 'Updating resource "'. $resource->title. '"');

            // Redirect back to the previous page
            return redirect()->back();

        } catch (\Throwable $th) {
            // Rollback the database transaction in case of an error
            DB::rollBack();

            // Set error flash message and log the activity
            session()->flash('error', $th->getMessage());
            ActivityLog::addLog('fail', 'Updating resource ['. $th->getMessage().']');

            // Redirect back to the previous page with the input data
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id The encrypted ID of the resource to be deleted.
     * @return \Illuminate\Http\RedirectResponse Redirects back to the previous page with a success or error flash message.
     * @throws \Illuminate\Contracts\Encryption\DecryptException If the ID cannot be decrypted.
     * @throws \Throwable If an error occurs during the database transaction.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            // Decrypt the ID
            $id = Crypt::decryptString($id);

            // Find the transaction by ID
            $transacion = Transaction::find($id);

            // Delete the transaction
            $transacion->delete();

            // Delete associated files
            foreach ($transacion->file as $file) {
                $files = File::find($file->id);
                $files->delete();

                // Check if the file exists and delete it
                if (FacadesFile::exists($files->location . $files->name)) {
                    FacadesFile::delete($files->location . $files->name);
                }
            }

            // Commit the database transaction
            DB::commit();

            // Set success flash message and log the activity
            session()->flash('success', 'File deleted successfully');
            ActivityLog::addLog('success', 'Removing resource "'. $transacion->title .'"');

            // Redirect back to the previous page
            return redirect()->back();

        } catch (\Throwable $th) {
            // Rollback the database transaction in case of an error
            DB::rollBack();

            // Set error flash message and log the activity
            session()->flash('error', $th->getMessage());
            ActivityLog::addLog('fail', 'Removing resource ['. $th->getMessage().']');

            // Redirect back to the previous page
            return back();
        }
    }

    /**
     * Change the status of a transaction.
     *
     * @param Request $request The request object containing the input data.
     * @return \Illuminate\Http\RedirectResponse Redirects back to the previous page with a success or error flash message.
     * @throws \Throwable If an error occurs during the database transaction.
     */
    public function changeStatus(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();
        try {
            // Find the transaction by ID
            $resource = Transaction::find($request->id);

            // Update the status of the transaction
            $resource->status_id = $request->status;

            // Save the updated transaction
            $resource->save();

            // Commit the database transaction
            DB::commit();

            // Set success flash message and log the activity
            session()->flash('success', 'Status changed');
            ActivityLog::addLog('success', 'Changing status resource "'. $resource->title. '"');

            // Redirect back to the previous page
            return redirect()->back();

        } catch (\Throwable $th) {
            // Rollback the database transaction in case of an error
            DB::rollBack();

            // Set error flash message and log the activity
            session()->flash('error', $th->getMessage());
            ActivityLog::addLog('fail', 'Changing status resource ['. $th->getMessage().']');

            // Redirect back to the previous page
            return back();
        }
    }
}
