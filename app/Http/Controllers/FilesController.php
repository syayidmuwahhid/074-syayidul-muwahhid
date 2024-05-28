<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\File;
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
     */
    public function index()
    {
        $files = File::all();

        if (Auth::user()->role_id != 1) {
            $files = File::select('files.*')
            ->join('transactions', 'transactions.id', 'transaction_id')
            ->where('transactions.user_add', Auth::user()->id)
            ->get();
        }

        foreach ($files as $file) {
            $ext = explode('.', $file->location.$file->name)[1];

            if ($ext == 'mp4' || $ext == 'mkv' || $ext == 'mov' || $ext == 'ts') {
                $file['img_link'] = 'https://png.pngtree.com/png-vector/20190215/ourmid/pngtree-play-video-icon-graphic-design-template-vector-png-image_530837.jpg';
            } elseif ($ext == 'pdf') {
                $file['img_link'] = 'https://st3.depositphotos.com/4799321/14326/v/450/depositphotos_143261637-stock-illustration-pdf-download-vector-icon-simple.jpg';
            } else {
                $file['img_link'] = asset($file->location.$file->name);
            }
        }

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

        return view('files.index', $resp);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $resp = array(
            'status' => 'fail',
        );

        try {
            $path = "storage/files/" . Auth::user()->id . "/$request->transaction_title/";
            $img_name = time() . $request->file('file')->hashName();
            $request->file('file')->move($path, $img_name);
            $filename = $path.$img_name;

            $file = new File();
            $file->name = $img_name;
            $file->location = $path;
            $file->transaction_id = $request->transaction_id;
            $file->save();

            $resp['status'] = 'success';
            $resp['data'] = $filename;

            DB::commit();
            ActivityLog::addLog('success', 'Adding file into resource "' . $file->transaction->title . '"');
        } catch (\Throwable $th) {
            DB::rollBack();
            $resp['msg'] = $th->getMessage();
            ActivityLog::addLog('fail', 'Adding file into resource ['. $th->getMessage() .']');
        }
        return response()->json($resp);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $id = Crypt::decryptString($id);
            $file = File::find($id);
            $file->delete();

            if (FacadesFile::exists($file->location . $file->name)) {
                FacadesFile::delete($file->location . $file->name);
            }

            DB::commit();
            session()->flash('success', 'File deleted successfully');
            ActivityLog::addLog('success', 'Removing file into resource "' . $file->transaction->title . '"');
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Unable to delete');
            ActivityLog::addLog('fail', 'Removing file into resource ['. $th->getMessage() .']');
        }
        return redirect()->back();
    }
}
