<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DgDashboardController;
use App\Http\Controllers\DtDashboardController;
use App\Http\Controllers\DashboardInspecteurController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RapportMissionController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\ConvocationController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\AmendeController;
use App\Http\Controllers\InspectionPreemballeController;
use App\Http\Controllers\InspectionPesageController;
use App\Http\Controllers\InspectionVolumeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/dashboard', function () {

    $user = Auth::user();

    if (!$user) {
        abort(403);
    }

    return match ($user->role) {

        'admin' => redirect()->route('dashboard.admin'),

        'dg' => redirect()->route('dashboard.dg'),

        'dt' => redirect()->route('dashboard.dt'),

        'inspecteur' => redirect()->route('dashboard.inspecteur'),

        default => abort(403),
    };

})->middleware(['auth', 'force.password.change', 'verified'])->name('dashboard');


Route::middleware(['auth', 'force.password.change', 'role:admin'])->group(function () {
Route::resource('users', UserController::class);

Route::put('/users/{user}/reset-password', [UserController::class, 'resetPassword'])
    ->name('users.reset-password');

});


Route::middleware(['auth', 'force.password.change', 'verified'])->group(function () {

    Route::get(
        '/dashboard/admin',
        [AdminDashboardController::class, 'index']
    )->name('dashboard.admin');

    Route::get(
        '/dashboard/dg',
        [DgDashboardController::class, 'index']
    )->name('dashboard.dg');

    Route::get(
        '/dashboard/dt',
        [DtDashboardController::class, 'index']
    )->name('dashboard.dt');

    Route::get(
        '/dashboard/inspecteur',
        [DashboardInspecteurController::class, 'index']
    )->name('dashboard.inspecteur');
    
});

Route::middleware(['auth', 'force.password.change', 'role:admin,dg,dt'])->group(function () {

    // Gestion missions
    Route::resource('missions', MissionController::class);

    Route::get(
        '/missions/{mission}/fichemission',
        [MissionController::class, 'ficheMission']
    )->name('missions.fichemission');

    Route::patch(
    '/missions/{mission}/cloturer',
    [MissionController::class, 'cloture']
    )->name('missions.cloture');


});




Route::middleware(['auth', 'force.password.change', 'role:admin,dt,dg,inspecteur'])->group(function () {

Route::prefix('inspections/{inspection}/pesages')
    ->name('inspections.pesages.')
    ->group(function () {

        Route::get('/create', [InspectionPesageController::class, 'create'])
            ->name('create');

        Route::post('/', [InspectionPesageController::class, 'store'])
            ->name('store');

        Route::get('/show', [InspectionPesageController::class, 'show'])
            ->name('show');

        Route::get('/edit', [InspectionPesageController::class, 'edit'])
            ->name('edit');

        Route::put('/', [InspectionPesageController::class, 'update'])
            ->name('update');

        Route::delete('/', [InspectionPesageController::class, 'destroy'])
            ->name('destroy');
    });


    Route::prefix('inspections/{inspection}/volumes')
    ->name('inspections.volumes.')
    ->group(function () {

        Route::get('/create', [InspectionVolumeController::class, 'create']
        )->name('create');

        Route::post('/', [InspectionVolumeController::class, 'store']
        )->name('store');

        Route::get('/show', [InspectionVolumeController::class, 'show']
        )->name('show');

        Route::get('/edit', [InspectionVolumeController::class, 'edit']
        )->name('edit');

        Route::put('/', [InspectionVolumeController::class, 'update']
        )->name('update');

        Route::delete('/', [InspectionVolumeController::class, 'destroy']
        )->name('destroy');
    });



    Route::prefix('inspections/{inspection}/preemballe')
    ->name('inspections.preemballes.')
    ->group(function () {


    Route::get('/create', [InspectionPreemballeController::class, 'create']
    )->name('create');

    Route::post('/', [InspectionPreemballeController::class, 'store']
    )->name('store');

    Route::get('/show', [InspectionPreemballeController::class, 'show']
    )->name('show');

    Route::get('/edit', [InspectionPreemballeController::class, 'edit']
    )->name('edit');

    Route::put('/', [InspectionPreemballeController::class, 'update']
    )->name('update');

    Route::delete('/', [InspectionPreemballeController::class, 'destroy']
    )->name('destroy');

    });

    Route::get('/amendes', [AmendeController::class, 'index'])
    ->name('amendes.index');

    Route::get('/amendes/ifu/{ifu}', [AmendeController::class, 'show'])
    ->name('amendes.show');

    Route::get('/amendes/{amende}/edit', [AmendeController::class, 'edit'])
    ->name('amendes.edit');

    Route::put('/amendes/{amende}', [AmendeController::class, 'update'])
    ->name('amendes.update');

});

Route::middleware(['auth', 'force.password.change', 'role:admin,dt,dg,inspecteur'])->group(function () {

    Route::resource('inspections', InspectionController::class);

    Route::get('/missions',
        [MissionController::class, 'index']
    )->name('missions.index');
    
    Route::get('/missions/{mission}', [MissionController::class, 'show'])
    ->name('missions.show');

    

    Route::resource(
       'convocations',
       ConvocationController::class
     );

    Route::get(
       'convocations/generer/{inspection}',
       [ConvocationController::class, 'generer']
    )->name('convocations.generer');

    Route::prefix('rapports')->name('rapports.')->group(function () {

    Route::get('/', [RapportMissionController::class, 'index'])
        ->name('index');

    Route::get('/{mission}', [RapportMissionController::class, 'show'])
        ->name('show');

    Route::get('/{mission}/edit', [RapportMissionController::class, 'edit'])
        ->name('edit');

    Route::put('/{mission}', [RapportMissionController::class, 'update'])
        ->name('update');
    });

});



Route::middleware('auth')->group(function () {

    Route::get(
        '/profil',
        [ProfileController::class, 'show']
    )->name('profile.show');

    Route::get(
        '/profil/modifier',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::put(
        '/profil',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
    ->name('profile.password');

    Route::delete(
        '/profil/photo',
        [ProfileController::class, 'removePhoto']
    )->name('profile.photo.destroy');

});

require __DIR__.'/auth.php';
