<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\File;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class DashboardController extends Controller
{
    public function indexUser()
    {
        $transactions = Transaction::where('user_add', Auth::user()->id)->limit(5)->orderBy('created_at', 'desc')->get();
        foreach ($transactions as $transaction) {
            $transaction['uri_detail'] =  route('transactions.show', Crypt::encryptString($transaction->id));
            $transaction['tags'] = explode(',', $transaction->tags);

            if ($transaction->status_id == '1') {
                $transaction['badge_status'] = 'badge-warning';
            } elseif ($transaction->status_id == '2') {
                $transaction['badge_status'] = 'badge-success';
            } else {
                $transaction['badge_status'] = 'badge-danger';
            }
        }

        $resp = array(
            "title" => "Dashboard",
            "title_page" => "Welcome to API Resource Manager",
            "breadcrumbs" => array(
                "Home" => route('user.dashboard'),
                "Dashboard" => "#"
            ),
            "datas" => $transactions,
        );

        return view('dashboard.user.index', $resp);
    }

    public function indexAdmin()
    {
        $logs = ActivityLog::limit(10)->get();

        foreach ($logs as $log) {
            $log['color'] = 'bg-light' . $log->type;
            $log['icon'] = 'bi-check-lg';

            if ($log->type == 'info') {
                $log['color'] = 'bg-light-primary';
                $log['icon'] = 'bi-info-lg';
            } elseif ($log->type == 'fail') {
                $log['color'] = 'bg-light-danger';
                $log['icon'] = 'bi-x-lg';
            } elseif ($log->type == 'warning') {
                $log['icon'] = 'bi-exclamation-triangle';
            }
        }

        $resp = array(
            "title" => "Dashboard",
            "title_page" => "Welcome to API Resource Manager",
            "breadcrumbs" => array(
                "Home" => route('admin.dashboard'),
                "Dashboard" => "#"
            ),
            "count_users" => User::count(),
            "count_files" => File::count(),
            "count_transactions" => Transaction::count(),
            "logs" => $logs,
        );

        return view('dashboard.admin.index', $resp);
    }

    public function logs()
    {
        $logs = ActivityLog::all();

        foreach ($logs as $log) {
            $log['color'] = 'bg-light' . $log->type;
            $log['icon'] = 'bi-check-lg';

            if ($log->type == 'info') {
                $log['color'] = 'bg-light-primary';
                $log['icon'] = 'bi-info-lg';
            } elseif ($log->type == 'fail') {
                $log['color'] = 'bg-light-danger';
                $log['icon'] = 'bi-x-lg';
            } elseif ($log->type == 'warning') {
                $log['icon'] = 'bi-exclamation-triangle';
            }
        }

        $resp = array(
            "title" => "Logs",
            "title_page" => "Activity Logs",
            "breadcrumbs" => array(
                "Home" => route('admin.logs'),
                "Activity Logs" => "#"
            ),
            "datas" => $logs
        );

        return view('dashboard.admin.logs', $resp);
    }
}
