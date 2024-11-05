<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

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

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', App\Livewire\Dashboard\Page::class)->name('dashboard');
    Route::get('/companies', \App\Livewire\Company\Index::class)->name('companies.index');
    Route::get('/companies/create', \App\Livewire\Company\Create::class)->name('companies.create');
    Route::get('/companies/{company}', \App\Livewire\Company\Show::class)->name('companies.show');
    Route::get('/companies/{company}/edit', \App\Livewire\Company\Edit::class)->name('companies.edit');
    Route::get('/companies/{company}/contact-person/create', \App\Livewire\ContactPerson\Create::class)->name('contact-person.create');
    Route::get('/companies/{company}/contact-person/{contactPerson}/edit', \App\Livewire\ContactPerson\Edit::class)->name('contact-person.edit');

    Route::get('/users', \App\Livewire\User\Index::class)->name('users.index');
    Route::get('/users/create', \App\Livewire\User\Create::class)->name('users.create');
    Route::get('/users/{user}/edit', \App\Livewire\User\Edit::class)->name('users.edit');
    Route::get('/users/{user}/dependencies', \App\Livewire\User\Dependencies\Page::class)->name('users.dependencies');

    Route::get('/system-users', \App\Livewire\SystemUser\Index::class)->name('system-users.index');
    Route::get('/system-users/create', \App\Livewire\SystemUser\Create::class)->name('system-users.create');
    Route::get('/system-users/{user}/edit', \App\Livewire\SystemUser\Edit::class)->name('system-users.edit');

    Route::get('/welding-certificate', \App\Livewire\WeldingCertificates\Index::class)->name('welding-certificates.index');
    Route::get('/welding-certificate/create', \App\Livewire\WeldingCertificates\Create::class)->name('welding-certificates.create');
    Route::get('/welding-certificate/{weldingCertificate}/edit', \App\Livewire\WeldingCertificates\Edit::class)->name('welding-certificates.edit');

    Route::get('/wpqr', \App\Livewire\Wpqr\Index::class)->name('wpqr.index');
    Route::get('/wpqr/create', \App\Livewire\Wpqr\Create::class)->name('wpqr.create');
    Route::get('/wpqr/{wpqr}/edit', \App\Livewire\Wpqr\Edit::class)->name('wpqr.edit');

    Route::get('/wps', \App\Livewire\Wps\Index::class)->name('wps.index');
    Route::get('/wps/create', \App\Livewire\Wps\Create::class)->name('wps.create');
    Route::get('/wps/{wps}/edit', \App\Livewire\Wps\Edit::class)->name('wps.edit');

    Route::get('/welder', \App\Livewire\Welder\Index::class)->name('welder.index');
    Route::get('/welder/create', \App\Livewire\Welder\Create::class)->name('welder.create');
    Route::get('/welder/{welder}/edit', \App\Livewire\Welder\Edit::class)->name('welder.edit');

    Route::get('/machine-maintenance', \App\Livewire\MachineMaintenance\Index::class)->name('machine-maintenance.index');
    Route::get('/machine-maintenance/create', \App\Livewire\MachineMaintenance\Create::class)->name('machine-maintenance.create');
    Route::get('/machine-maintenance/{machineMaintenance}/edit', \App\Livewire\MachineMaintenance\Edit::class)->name('machine-maintenance.edit');

    Route::get('/project', \App\Livewire\Project\Index::class)->name('project.index');
    Route::get('/project/create', \App\Livewire\Project\Create::class)->name('project.create');
    Route::get('/project/{project}/edit', \App\Livewire\Project\Edit::class)->name('project.edit');

    Route::get('/supplier', \App\Livewire\Supplier\Index::class)->name('supplier.index');
    Route::get('/supplier/create', \App\Livewire\Supplier\Create::class)->name('supplier.create');
    Route::get('/supplier/{supplier}/edit', \App\Livewire\Supplier\Edit::class)->name('supplier.edit');

    Route::get('/welding-coordination', \App\Livewire\WeldingCoordination\Index::class)->name('welding-coordination.index');
    Route::get('/welding-coordination/create', \App\Livewire\WeldingCoordination\Create::class)->name('welding-coordination.create');
    Route::get('/welding-coordination/{weldingCoordination}/edit', \App\Livewire\WeldingCoordination\Edit::class)->name('welding-coordination.edit');
    Route::get('/welding-coordination/{weldingCoordination}/print', \App\Http\Controllers\WeldingCoordinationPrintController::class)->name('welding-coordination.print');

    Route::get('/ce', \App\Livewire\Ce\Index::class)->name('ce.index');
    Route::get('/ce/create', \App\Livewire\Ce\Create::class)->name('ce.create');
    Route::get('/ce/{ce}/edit', \App\Livewire\Ce\Edit::class)->name('ce.edit');
    Route::get('/ce/{ce}/print', \App\Http\Controllers\CePrintController::class)->name('ce.print');

    Route::get('/formulas/carbon-equivalent', \App\Livewire\Formula\CarbonEquivalent::class)->name('formulas.carbon-equivalent');
    Route::get('/formulas/heat-input', \App\Livewire\Formula\HeatInput::class)->name('formulas.heat-input');
    Route::get('/formulas/z-value', \App\Livewire\Formula\ZValue::class)->name('formulas.z-value');
    Route::get('/formulas/welding-speed', \App\Livewire\Formula\WeldingSpeed::class)->name('formulas.welding-speed');

    Route::get('/time-registration', \App\Livewire\TimeRegistration\Index::class)->name('time-registration.index');
    Route::get('/time-registration/create', \App\Livewire\TimeRegistration\Create::class)->name('time-registration.create');
    Route::get('/time-registration/{timeRegistration}/edit', \App\Livewire\TimeRegistration\Edit::class)->name('time-registration.edit');

    Route::get('/internal-order', \App\Livewire\InternalOrder\Index::class)->name('internal-order.index');
    Route::get('/internal-order/create', \App\Livewire\InternalOrder\Create::class)->name('internal-order.create');
    Route::get('/internal-order/{internalOrder}/edit', \App\Livewire\InternalOrder\Edit::class)->name('internal-order.edit');

    Route::get('/settings', \App\Livewire\Settings::class)->name('settings');
    Route::get('/documents', \App\Livewire\Document\Index::class)->name('documents.index');
    Route::get('/documents/create', \App\Livewire\Document\Create::class)->name('documents.create');
    Route::get('/documents/{document}', \App\Livewire\Document\Show::class)->name('documents.show');
    Route::get('/documents/{document}/edit', \App\Livewire\Document\Edit::class)->name('documents.edit');
    Route::get('/documents/{document}/revisions', \App\Livewire\DocumentRevision\Index::class)->name('document_revisions.index');

    Route::get('/switch-company/{company}', function (\App\Models\Company $company) {
        auth()->user()->current_company_id = $company->id;
        auth()->user()->save();

        if(request('redirect')) {
            return redirect(request('redirect'));
        }

        return redirect()->route('companies.index');
    })->name('switch-company');

    Route::get('lang/{locale}', function ($locale) {
        if (in_array($locale, ['en', 'da'])) {
            if (Illuminate\Support\Facades\Auth::check()) {
                Illuminate\Support\Facades\Auth::user()->locale = $locale;
                Illuminate\Support\Facades\Auth::user()->save();
            }
        }
        return redirect()->back();
    })->name('locale');


    Route::name('backoffice.')->prefix('backoffice')->middleware('can:access-backoffice')->group(function () {
        Route::get('/', \App\Livewire\Backoffice\Dashboard::class)->name('dashboard');
    });

});
