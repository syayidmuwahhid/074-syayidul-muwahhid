<?php
namespace App\Helpers;

use App\Models\FileExtension;
use Illuminate\Support\Facades\Hash;

class Anyhelpers {

    public static function getMenus() {
        return array(
            [
                "title" => "Dashboard",
                "url" => route('admin.dashboard'),
                "icon" => "house-fill"
            ],
            [
                "title" => "Users",
                "url" => route('admin.users.index'),
                "icon" => "people-fill"
            ],[
                "title" => "File Extensions",
                "url" => route('admin.file-extensions.index'),
                "icon" => "file-earmark-medical"
            ],[
                "title" => "Transactions",
                "url" => route('admin.transactions.index'),
                "icon" => "cloud-upload-fill"
            ],[
                "title" => "Files",
                "url" => route('files.index'),
                "icon" => "folder-symlink-fill"
            ],[
                "title" => "Logs",
                "url" => route('admin.logs'),
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

    public static function getExtension()
    {
        $data = FileExtension::all();
        $exts = '';

        $i = 0;
        foreach ($data as $ext) {
            $exts .= $ext->extension;
            $exts .= $i++ < count($data) - 1 ?  ',' : '';
        }

        return $exts;
    }

}
