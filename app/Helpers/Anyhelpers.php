<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Hash;

class Anyhelpers {

    public static function getMenus() {
        return array(
            [
                "title" => "Dashboard",
                "url" => route('admin.dashboard'),
                "status" => "",
                "icon" => "house-fill"
            ],
            // [
            //     "title" => "Statuses",
            //     "url" => route('admin.statuses.'),
            //     "status" => "",
            //     "icon" => "card-heading"
            // ],[
            //     "title" => "Roles",
            //     "url" => route('admin.roles.'),
            //     "status" => "",
            //     "icon" => "fingerprint"
            // ],
            [
                "title" => "Users",
                "url" => route('admin.users.index'),
                "status" => "",
                "icon" => "people-fill"
            ],[
                "title" => "Transactions",
                "url" => route('admin.transactions.index'),
                "status" => "",
                "icon" => "cloud-upload-fill"
            ],[
                "title" => "Files",
                "url" => route('files.index'),
                "status" => "",
                "icon" => "folder-symlink-fill"
            ],[
                "title" => "Logs",
                "url" => route('admin.logs'),
                "status" => "",
                "icon" => "activity"
            ]
        );
    }

    public static function getStatus($status)
    {
        if ($status == 1) {
            return "active";
        }

        return "inactive";
    }

}
