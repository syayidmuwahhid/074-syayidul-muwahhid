<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Hash;

class Anyhelpers {
    const STATUSES =  array(
        [
            "id" => "0",
            "status" => "inactive"
        ],[
            "id" => "1",
            "status" => "active"
        ],[
            "id" => "2",
            "status" => "draft"
        ],[
            "id" => "3",
            "status" => "published"
        ],[
            "id" => "4",
            "status" => "unpublished"
        ]
    );

    const ROLES = array(
        [
            "id" => "1",
            "role" => "Administrator"
        ],[
            "id" => "2",
            "role" => "User"
        ]
    );

    const USERS = array(
        [
            "id" => "1",
            "username" => "Administrator",
            "email" => "admin@google.com",
            "password" => "123",
            "role" => "Administrator",
            "status" => "active",
            "created_at" => "2024-05-01 08:10:00",
            "avatar" => "assets/media/avatars/150-1.jpg",
            "phone" => "0815 2242 4252"
        ],[
            "id" => "2",
            "username" => "user1",
            "email" => "user1@google.com",
            "password" => "123",
            "role" => "User",
            "status" => "active",
            "created_at" => "2024-05-5 11:04:00",
            "avatar" => "assets/media/avatars/150-2.jpg",
            "phone" => "0815 2242 4252"
        ],[
            "id" => "3",
            "username" => "user2",
            "email" => "user2@google.com",
            "password" => "123",
            "role" => "User",
            "status" => "inactive",
            "created_at" => "2024-05-10 17:01:00",
            "avatar" => "assets/media/avatars/150-3.jpg",
            "phone" => "0815 2242 4252"
        ],[
            "id" => "4",
            "username" => "user3",
            "email" => "user3@google.com",
            "password" => "123",
            "role" => "User",
            "status" => "active",
            "created_at" => "2024-05-11 09:00:00",
            "avatar" => "assets/media/avatars/150-4.jpg",
            "phone" => "0815 2242 4252"
        ]
    );

    const TRANSACTIONS = array(
        [
            "id" => "1",
            "date" => "2024-04-21",
            "user_add" => "user1",
            "title" => "Website APP",
            "tags" => "Foto, Gambar"
        ],[
            "id" => "2",
            "date" => "2024-08-21",
            "user_add" => "user2",
            "title" => "Android ss",
            "tags" => "Foto, Gambar, Android"
        ],
    );

    const FILES = array(
        [
            "id" => "1",
            "name" => "work",
            "extension" => "png",
            "location" => "storage/",
            "transaction_id" => "1"
        ],[
            "id" => "2",
            "name" => "1",
            "extension" => "png",
            "location" => "assets/media/products/",
            "transaction_id" => "2"
        ],[
            "id" => "2",
            "name" => "2",
            "extension" => "png",
            "location" => "assets/media/products/",
            "transaction_id" => "2"
        ],[
            "id" => "2",
            "name" => "3",
            "extension" => "png",
            "location" => "assets/media/products/",
            "transaction_id" => "1"
        ],[
            "id" => "2",
            "name" => "4",
            "extension" => "png",
            "location" => "assets/media/products/",
            "transaction_id" => "2"
        ]
    );

    const LOGS = array(
        [
            "id" => "1",
            "transaction_id" => "1",
            "title" => "ll",
            "description" => "ssss",
            "user_add" => "2",
        ]
    );

    public static function getStatuses (?string $id = null) {
        if (isset($id)) {
            foreach (self::STATUSES as $data) {
                if ($data["id"] == $id) {
                    return $data;
                }
            }
            return array();
        }

        return self::STATUSES;
    }

    public static function getRoles (?string $id = null) {
        if (isset($id)) {
            foreach (self::ROLES as $data) {
                if ($data["id"] == $id) {
                    return $data;
                }
            }
            return array();
        }

        return self::ROLES;
    }

    public static function getUsers (?string $id = null) {
        if (isset($id)) {
            foreach (self::USERS as $data) {
                if ($data["id"] == $id) {
                    return $data;
                }
            }
            return array();
        }

        return self::USERS;
    }

    public static function getTransactions (?string $id = null) {
        if (isset($id)) {
            foreach (self::TRANSACTIONS as $data) {
                if ($data["id"] == $id) {
                    return $data;
                }
            }
            return array();
        }

        return self::TRANSACTIONS;
    }

    public static function getFiles (?string $id = null) {
        $result = array();
        if (isset($id)) {
            foreach (self::FILES as $data) {
                if ($data["transaction_id"] == $id) {
                    array_push($result, $data);
                }
            }
        } else {
            $result = self::FILES;
        }

        return $result;
    }

    public static function getMenus() {
        return array(
            [
                "title" => "Dashboard",
                "url" => route('admin.'),
                "status" => "",
                "icon" => "house-fill"
            ],[
                "title" => "Statuses",
                "url" => route('admin.statuses.'),
                "status" => "",
                "icon" => "card-heading"
            ],[
                "title" => "Roles",
                "url" => route('admin.roles.'),
                "status" => "",
                "icon" => "fingerprint"
            ],[
                "title" => "Users",
                "url" => route('admin.users.'),
                "status" => "",
                "icon" => "people-fill"
            ],[
                "title" => "Transactions",
                "url" => route('admin.transactions.'),
                "status" => "",
                "icon" => "cloud-upload-fill"
            ],[
                "title" => "Files",
                "url" => route('files.'),
                "status" => "",
                "icon" => "folder-symlink-fill"
            ]
        );
    }

    public static function getQuickMenus() {
        return array(
            [
                "title" => "New Status",
                "url" => route('admin.statuses.')
            ],[
                "title" => "New Role",
                "url" => route('admin.roles.')
            ]
        );
    }

}
