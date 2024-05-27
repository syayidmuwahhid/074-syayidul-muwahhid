<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;

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
        } catch (\Throwable $th) {
            DB::rollBack();
            $resp['msg'] = $th->getMessage();
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
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Unable to delete');
        }
        return redirect()->back();
    }
}
