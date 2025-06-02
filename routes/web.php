<?php


use App\Http\Controllers\Admin\IndexAdminController;
use App\Http\Controllers\Admin\LangAdminController;
use App\Http\Controllers\Admin\LogsController;
use App\Http\Controllers\Admin\PageAdminController;
use App\Http\Controllers\Admin\PictureController;
use App\Http\Controllers\Admin\ReviewAdminController;
use App\Http\Controllers\Admin\SectionAdminController;
use App\Http\Controllers\Admin\SettingAdminController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\TelegramUserAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutoController;
use App\Http\Controllers\CargoBidController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin')->group(function () {

    Route::middleware('guest:admin')->group(function() {
        Route::view('login', 'admin.login')->name('admin_login');
        Route::post('auth', [UserAdminController::class, 'auth'])->name('admin_auth');
    });

    Route::middleware(['auth:admin'])->group(function() {
        Route::get('/', [IndexAdminController::class, 'index'])->name('admin_index');

        // Pages
        Route::get('pages/create', [PageAdminController::class, 'create'])->name('page_create');
        Route::post('pages/store', [PageAdminController::class, 'store'])->name('page_store');
        Route::get('pages/edit/{page}', [PageAdminController::class, 'edit'])->name('page_edit');
        Route::post('pages/update/{page}', [PageAdminController::class, 'update'])->name('page_update');
        Route::get('pages/delete/{page}', [PageAdminController::class, 'destroy'])->name('page_delete');

        // Sections
        Route::post('sections/store/{page}', [SectionAdminController::class, 'store'])->name('section_store');
        Route::post('sections/update/status/{section?}', [SectionAdminController::class, 'changeStatus'])->name('section_changeStatus');
        Route::post('sections/update/sort', [SectionAdminController::class, 'changeSort'])->name('section_update_sort');
        Route::post('sections/update/{section?}/page/{page?}', [SectionAdminController::class, 'update'])->name('section_update');
        Route::post('sections/delete/{section?}', [SectionAdminController::class, 'destroy'])->name('section_delete');

        // News
        Route::get('review', [ReviewAdminController::class, 'index'])->name('review_admin');
        Route::get('review/add', [ReviewAdminController::class, 'create'])->name('review_create');
        Route::post('review/store', [ReviewAdminController::class, 'store'])->name('review_store');
        Route::get('review/edit/{review}', [ReviewAdminController::class, 'edit'])->name('review_edit');

        // Change status News
        Route::post('review/update/status/{review}', [ReviewAdminController::class, 'changeStatus'])->name('review_changeStatus');
        Route::post('review/update/{review}', [ReviewAdminController::class, 'update'])->name('review_update');
        Route::get('reviewdelete/{review}', [ReviewAdminController::class, 'destroy'])->name('review_delete');

        // Lang
        Route::get('lang', [LangAdminController::class, 'index'])->name('lang_admin');
        Route::get('lang/export', [LangAdminController::class, 'export'])->name('lang_export');
        Route::post('lang/import', [LangAdminController::class, 'import'])->name('lang_import');

        // Logs
        Route::get('logs', [LogsController::class, 'index'])->name('logs');

        // Settings
        Route::get('settings', [SettingAdminController::class, 'index'])->name('setting_index');
        Route::post('settings/update/{setting?}', [SettingAdminController::class, 'update'])->name('setting_update');

        // Users
        Route::get('users', [UserAdminController::class, 'index'])->name('users_admin');
        Route::get('users/add', [UserAdminController::class, 'create'])->name('users_create');
        Route::post('users/store', [UserAdminController::class, 'store'])->name('users_store');

        Route::get('users/edit/{user}', [UserAdminController::class, 'edit'])->name('users_edit');
        Route::post('users/update/{user}', [UserAdminController::class, 'update'])->name('users_update');
        Route::any('users/delete/{user}', [UserAdminController::class, 'destroy'])->name('users_delete');

        // Telegram Users
        Route::get('telegram/users', [TelegramUserAdminController::class, 'index'])->name('telegram_users_admin');

        Route::get('telegram/users/edit/{user}', [TelegramUserAdminController::class, 'edit'])->name('telegram_users_edit');
        Route::post('telegram/users/update/{user}', [TelegramUserAdminController::class, 'update'])->name('telegram_users_update');

        // Logout
        Route::get('logout', [UserAdminController::class, 'logout'])->name('admin_logout');

        // Pictures
        Route::post('pictures/delete/{picture}', [PictureController::class, 'destroy'])->name('pictures_delete');

        // File manager
        Route::group(['prefix' => 'filemanager'], function() {
            \UniSharp\LaravelFilemanager\Lfm::routes();
        });

        // Statistic
        Route::get('cargo', [StatisticController::class, 'cargoList'])->name('statistic_cargo');
        Route::get('transport', [StatisticController::class, 'transportList'])->name('statistic_transport');
        Route::get('handshake', [StatisticController::class, 'handshakeList'])->name('statistic_handshake');
    });

});


// Auth
Route::prefix('{locale?}')->middleware(['localization', 'guest'])->group(function() {
    Route::post('login', [AuthController::class, 'auth'])->name('auth_login');
    Route::post('register', [AuthController::class, 'store'])->name('auth_store');
});


// Profile
Route::prefix('{locale?}')->middleware(['localization', 'auth'])->group(function() {
    // Chats
    Route::get('messages', [UserController::class, 'messages'])->name('messages');
    Route::get('messages/{chat?}', [UserController::class, 'messages'])->name('messages');
    Route::post('messages/{chat}/store', [MessageController::class, 'sendMessage'])
        ->middleware('throttle:messages')
        ->name('messages.send');
    Route::post('chats/private', [MessageController::class, 'getOrCreatePrivateChat'])
        ->name('chats.getOrCreatePrivate');

    Route::get('logout', [AuthController::class, 'logout'])->name('auth_logout');
    Route::get('tariffs', [UserController::class, 'tariffs'])->name('tariffs');
    Route::get('settings', [UserController::class, 'settings'])->name('settings');
    Route::post('update', [UserController::class, 'update'])->name('update_profile');

    // Company
    Route::get('companies', [UserController::class, 'companies'])->name('companies');
    Route::post('update/company', [UserController::class, 'updateCompany'])->name('update_company');
    Route::delete('certificate/{id}', [CompanyController::class, 'deleteCertificate'])->name('deleteCertificate');

    // Subscribe
    Route::get('subscribes', [UserController::class, 'subscribes'])->name('subscribes');

    // Cargos
    Route::get('cargos', [CargoController::class, 'cargos'])->name('cargos');
    Route::get('cargos/create', [CargoController::class, 'create'])->name('cargos.create');
    Route::get('cargos/edit/{cargoLoading}', [CargoController::class, 'edit'])->name('cargos.edit');
    Route::post('cargos/update/{cargoLoading}', [CargoController::class, 'update'])->name('cargos.update');
    Route::post('cargos/store', [CargoController::class, 'store'])->name('cargos.store');
    Route::get('cargos/delete/{cargoLoading}', [CargoController::class, 'delete'])->name('cargos.delete');

    // Work-cargos
    Route::get('work-cargos', [CargoController::class, 'workCargos'])->name('workCargos');
    // Coordination's
    Route::get('сoordinations', [CargoController::class, 'сoordinations'])->name('сoordinations');
    Route::get('execution', [CargoController::class, 'execution'])->name('execution');

    // Auto
    Route::get('auto-park', [AutoController::class, 'autoPark'])->name('auto-park');
    // Drivers
    Route::get('drivers', [AutoController::class, 'drivers'])->name('drivers');
    // Notifications
    Route::get('notifications', [AutoController::class, 'notifications'])->name('notifications');
    Route::get('notifications/inner', [AutoController::class, 'notificationsInner'])->name('notificationsInner');


    // Cargo bid
    Route::post('/cargo/{cargo}/bid', [CargoBidController::class, 'store'])->name('cargo.bids.store');
    Route::post('/bids/{bid}/accept', [CargoBidController::class, 'accept'])->name('cargo.bids.accept');
    Route::post('/bids/{cargoLoading}/finish', [CargoBidController::class, 'finish'])->name('cargo.bids.finished');
    Route::post('/bids/{bid}/decline', [CargoBidController::class, 'decline'])->name('cargo.bids.decline');

    // Drivers
    Route::post('/drivers/store', [DriverController::class, 'store'])->name('drivers.store');

    // Transport
    Route::post('/transports', [TransportController::class, 'store'])->name('transports.store');
});

// Pages
Route::prefix('{locale?}')->middleware(['localization'])->group(function() {
    Route::get('{page:slug?}', [PageController::class, 'index']);
    Route::get('{page:slug?}/company/{article?}', [ArticleController::class, 'index'])->name('company-inner');
    Route::get('{page:slug?}/cargo-inner/{cargoLoading?}', [ArticleController::class, 'cargo'])->name('cargo-inner');
});

Route::post('/verify-code', [AuthController::class, 'verifyCode']);
Route::post('/resend-code', [AuthController::class, 'resendCode']);
//Route::post('send-telegram', [FeedbackController::class, 'sendTelegram'])->name('send.telegram');