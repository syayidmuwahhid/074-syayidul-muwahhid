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
    /**
     * Display a listing of the resource for the authenticated user.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUser()
    {
        // Fetch the latest 5 transactions of the authenticated user
        $transactions = Transaction::where('user_add', Auth::user()->id)->limit(5)->orderBy('created_at', 'desc')->get();

        // Process each transaction to add additional data for the view
        foreach ($transactions as $transaction) {
            // Generate the URI for the transaction detail page
            $transaction['uri_detail'] =  route('transactions.show', Crypt::encryptString($transaction->id));

            // Split the tags string into an array
            $transaction['tags'] = explode(',', $transaction->tags);

            // Determine the badge status based on the transaction status
            if ($transaction->status_id == '1') {
                $transaction['badge_status'] = 'badge-warning';
            } elseif ($transaction->status_id == '2') {
                $transaction['badge_status'] = 'badge-success';
            } else {
                $transaction['badge_status'] = 'badge-danger';
            }
        }

        // Prepare the data for the view
        $resp = array(
            "title" => "Dashboard",
            "title_page" => "Welcome to API Resource Manager",
            "breadcrumbs" => array(
                "Home" => route('user.dashboard'),
                "Dashboard" => "#"
            ),
            "datas" => $transactions,
        );

        // Return the view with the prepared data
        return view('dashboard.user.index', $resp);
    }

    /**
     * Display a listing of the resource for the admin user.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin()
    {
        /**
         * Fetch the latest 10 activity logs.
         *
         * @var \Illuminate\Database\Eloquent\Collection $logs
         */
        $logs = ActivityLog::limit(10)->get();

        /**
         * Process each log to add additional data for the view.
         *
         * @var \App\Models\ActivityLog $log
         */
        foreach ($logs as $log) {
            /**
             * Set the background color based on the log type.
             *
             * @var string $log['color']
             */
            $log['color'] = 'bg-light-'. $log->type;

            /**
             * Set the icon based on the log type.
             *
             * @var string $log['icon']
             */
            $log['icon'] = 'bi-check-lg';

            /**
             * Determine the log color and icon based on the log type.
             */
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

        /**
         * Prepare the data for the view.
         *
         * @var array $resp
         */
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

        /**
         * Return the view with the prepared data.
         *
         * @return \Illuminate\View\View
         */
        return view('dashboard.admin.index', $resp);
    }

    /**
     * Display a listing of all activity logs for the admin user.
     *
     * @return \Illuminate\View\View
     */
    public function logs()
    {
        /**
         * Fetch all activity logs from the database.
         *
         * @var \Illuminate\Database\Eloquent\Collection $logs
         */
        $logs = ActivityLog::whereMonth('created_at', today())->get();

        /**
         * Process each log to add additional data for the view.
         *
         * @var \App\Models\ActivityLog $log
         */
        foreach ($logs as $log) {
            /**
             * Set the background color based on the log type.
             *
             * @var string $log['color']
             */
            $log['color'] = ' bg-light-'. $log->type;

            /**
             * Set the icon based on the log type.
             *
             * @var string $log['icon']
             */
            $log['icon'] = 'bi-check-lg';

            /**
             * Determine the log color and icon based on the log type.
             */
            if ($log->type == 'info') {
                $log['color'] = ' bg-light-primary';
                $log['icon'] = 'bi-info-lg';
            } elseif ($log->type == 'fail') {
                $log['color'] = ' bg-light-danger';
                $log['icon'] = 'bi-x-lg';
            } elseif ($log->type == 'warning') {
                $log['icon'] = 'bi-exclamation-triangle';
            }
        }

        /**
         * Prepare the data for the view.
         *
         * @var array $resp
         */
        $resp = array(
            "title" => "Logs",
            "title_page" => "Activity Logs",
            "breadcrumbs" => array(
                "Home" => route('admin.logs'),
                "Activity Logs" => "#"
            ),
            "datas" => $logs
        );

        /**
         * Return the view with the prepared data.
         *
         * @return \Illuminate\View\View
         */
        return view('dashboard.admin.logs', $resp);
    }
}
