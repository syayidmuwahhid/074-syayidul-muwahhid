<?php

use App\Helpers\Anyhelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Mockery\Matcher\Any;

Route::get('/', function () {
    return view('auth.welcome');
})->name('welcome');

Route::name('login.')->prefix('login')->group(function () {
    Route::get('/', function () {
        $resp = array(
            'action' => route('login.sign-in'),
        );

        return view('auth.login', $resp);
    });

    Route::post('/', function () {
        return redirect()->route('user.');
    })->name('sign-in');
});

Route::name('register.')->prefix('register')->group(function () {
    Route::get('/', function () {
        $resp = array(
            'action' => route('register.submit'),
        );

        return view('auth.register', $resp);
    });

    Route::post('/', function () {
        return redirect()->route('login.');
    })->name('submit');
});


Route::get('/home', function () {
    $resp = array(
        "isadmin" => false,
        "title" => "Dashboard",
        "title_page" => "Welcome to API Resource Manager",
        "breadcrumbs" => array(
            "Home" => route('user.'),
            "Dashboard" => "#"
        ),
    );

    return view('dashboard.user.index', $resp);
})->name('user.');

Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('/', function () {
        $resp = array(
            "isadmin" => true,
            "title" => "Dashboard",
            "title_page" => "Welcome to API Resource Manager",
            "breadcrumbs" => array(
                "Home" => route('admin.'),
                "Dashboard" => "#"
            ),
        );

        return view('dashboard.admin.index', $resp);
    });

    Route::name('statuses.')->prefix('statuses')->group(function () {
        Route::get('/', function () {
            $resp = array(
                "isadmin" => true,
                "title" => "Statuses",
                "title_page" => "Data Statuses",
                "breadcrumbs" => array(
                    "Home" => route('admin.'),
                    "Statuses" => "#"
                ),
                "datas" => Anyhelpers::getStatuses(),
                "action" => route('admin.statuses.store')
            );

            return view('statuses.index', $resp);
        });

        Route::post('/', function (Request $request) {
            return $request->all();
        })->name('store');

        Route::get('/edit/{id}', function (Request $request) {
            $id = Crypt::decryptString($request->id);
            $resp = array(
                "isadmin" => true,
                "title" => "Statuses",
                "title_page" => "Edit Data Statuses",
                "breadcrumbs" => array(
                    "Home" => route('admin.'),
                    "Statuses" => route('admin.statuses.'),
                    "Edit" => "#"
                ),
                "datas" => Anyhelpers::getStatuses(),
                "data" => Anyhelpers::getStatuses($id),
                "action" => route('admin.statuses.update')
            );

            return view('statuses.index', $resp);
        })->name('edit');

        Route::put('/', function (Request $request) {
            return $request->all();
        })->name('update');

        Route::delete('/', function (Request $request) {
            return $request->all();
        })->name('delete');
    });


    Route::name('roles.')->prefix('roles')->group(function () {
        Route::get('/', function () {
            $resp = array(
                "isadmin" => true,
                "title" => "Roles",
                "title_page" => "Data Roles",
                "breadcrumbs" => array(
                    "Home" => route('admin.'),
                    "roles" => "#"
                ),
                "datas" => Anyhelpers::getRoles(),
                "action" => route('admin.roles.store')
            );

            return view('roles.index', $resp);
        });

        Route::post('/', function (Request $request) {
            return $request->all();
        })->name('store');

        Route::get('/edit/{id}', function (Request $request) {
            $id = Crypt::decryptString($request->id);
            $resp = array(
                "isadmin" => true,
                "title" => "Roles",
                "title_page" => "Data Roles",
                "breadcrumbs" => array(
                    "Home" => route('admin.'),
                    "roles" => route('admin.roles.'),
                    "Edit" => "#"
                ),
                "datas" => Anyhelpers::getRoles(),
                "data" => Anyhelpers::getRoles($id),
                "action" => route('admin.roles.update')
            );
            return view('roles.index', $resp);
        })->name('edit');

        Route::put('/', function (Request $request) {
            return $request->all();
        })->name('update');

        Route::delete('/', function (Request $request) {
            return $request->all();
        })->name('delete');
    });

    Route::name('users.')->prefix('users')->group(function () {
        Route::get('/', function () {
            $resp = array(
                "isadmin" => true,
                "title" => "Users",
                "title_page" => "Data Users",
                "breadcrumbs" => array(
                    "Home" => route('admin.'),
                    "Users" => "#"
                ),
                "datas" => Anyhelpers::getUsers(),
                "statuses" => Anyhelpers::getStatuses(),
            );
            return view('users.index', $resp);
        });

        Route::get('/{id}', function (Request $request) {
            $id = Crypt::decryptString($request->id);
            $resp = array(
                "isadmin" => true,
                "title" => "Users",
                "title_page" => "Detail Data Users",
                "breadcrumbs" => array(
                    "Home" => route('admin.'),
                    "Users" => route('admin.users.'),
                    "Detail" => "#"
                ),
                "data" => Anyhelpers::getUsers($id),
                "statuses" => Anyhelpers::getStatuses(),
            );
            return view('users.detail', $resp);
        })->name('show');

        Route::get('/edit/{id}', function (Request $request) {
            $id = Crypt::decryptString($request->id);
            $resp = array(
                "isadmin" => true,
                "title" => "Users",
                "title_page" => "Edit Data Users",
                "breadcrumbs" => array(
                    "Home" => route('admin.'),
                    "Users" => route('admin.users.'),
                    "Detail" => route('admin.users.show', $request->id),
                    "Edit" => "#"
                ),
                "action" => route('admin.users.update'),
                "data" => Anyhelpers::getUsers($id),
                "statuses" => Anyhelpers::getStatuses(),
            );
            return view('users.form', $resp);
        })->name('edit');

        Route::put('/', function (Request $request) {
            return $request->all();
        })->name('update');

        Route::delete('/', function (Request $request) {
            return $request->all();
        })->name('delete');

        Route::patch('/', function (Request $request) {
            return $request->all();
        })->name('change-status');
    });

    Route::name('transactions.')->prefix('transactions')->group(function () {
        Route::get('/', function () {
            $resp = array(
                "isadmin" => true,
                "title" => "Transactions",
                "title_page" => "Data Transactions",
                "breadcrumbs" => array(
                    "Home" => route('admin.'),
                    "transactions" => "#"
                ),
                "datas" => Anyhelpers::getTransactions(),
                "users" => Anyhelpers::getUsers(),
            );

            return view('transactions.index', $resp);
        });

        Route::get('/{id}', function (Request $request) {
            $id = Crypt::decryptString($request->id);
            $resp = array(
                "isadmin" => true,
                "title" => "Transactions",
                "title_page" => "Detail Data Transactions",
                "breadcrumbs" => array(
                    "Home" => route('admin.'),
                    "Transactions" => route('admin.transactions.'),
                    "Detail" => "#"
                ),
                "data" => Anyhelpers::getTransactions($id),
                "statuses" => Anyhelpers::getStatuses(),
                "files" => Anyhelpers::getFiles($id)
            );
            return view('transactions.detail', $resp);
        })->name('show');
    });
});

Route::name('transactions.')->prefix('transactions')->group(function () {
    Route::get('/', function () {
        $resp = array(
            "isadmin" => true,
            "title" => "Transactions",
            "title_page" => "Data Transactions",
            "breadcrumbs" => array(
                "Home" => route('admin.'),
                "transactions" => "#"
            ),
        );

        return view('transactions.index', $resp);
    });

    Route::get('/create', function () {
        return "view Created";
    })->name('create');

    Route::get('/{id}', function (Request $request) {
        $id = Crypt::decryptString($request->id);
        $resp = array(
            "isadmin" => true,
            "title" => "Transactions",
            "title_page" => "Detail Data Transactions",
            "breadcrumbs" => array(
                "Home" => route('admin.'),
                "Transactions" => route('transactions.'),
                "Detail" => "#"
            ),
            "data" => Anyhelpers::getTransactions($id),
            "statuses" => Anyhelpers::getStatuses(),
        );
        return view('transactions.detail', $resp);
    })->name('show');

    Route::post('/', function (Request $request) {
        return $request->all();
    })->name('store');

    Route::get('/edit/{id}', function (Request $request) {
        return "view Edited selected id = $request->id";
    })->name('edit');

    Route::put('/', function (Request $request) {
        return $request->all();
    })->name('update');

    Route::delete('/', function (Request $request) {
        return $request->all();
    })->name('delete');
});

Route::name('files.')->prefix('files')->group(function () {
    Route::get('/', function () {
        $resp = array(
            "isadmin" => true,
            "title" => "Files",
            "title_page" => "Data Files",
            "breadcrumbs" => array(
                "Home" => route('admin.'),
                "files" => "#"
            ),
        );

        return view('files.index', $resp);
    });

    Route::get('/{id}', function (Request $request) {
        return "Detail data";
    })->name('show');

    Route::delete('/', function (Request $request) {
        return $request->all();
    })->name('delete');
});
