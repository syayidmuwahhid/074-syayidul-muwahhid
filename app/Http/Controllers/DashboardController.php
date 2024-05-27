<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function indexUser()
    {
        $resp = array(
            "title" => "Dashboard",
            "title_page" => "Welcome to API Resource Manager",
            "breadcrumbs" => array(
                "Home" => route('user.dashboard'),
                "Dashboard" => "#"
            ),
            "datas" => Transaction::where('user_add', Auth::user()->id)->limit(5)->orderBy('created_at', 'desc')->get(),
        );

        return view('dashboard.user.index', $resp);
    }

    public function indexAdmin()
    {
        $resp = array(
            "title" => "Dashboard",
            "title_page" => "Welcome to API Resource Manager",
            "breadcrumbs" => array(
                "Home" => route('admin.dashboard'),
                "Dashboard" => "#"
            ),
        );

        return view('dashboard.admin.index', $resp);
    }
}
