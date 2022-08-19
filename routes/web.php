<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RotasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::middleware(['auth', 'permissoes'])->group(function () {
        $rotasBanco = RotasController::rotas();

        if ($rotasBanco) {
            foreach ($rotasBanco as $rota) {
                $nameRoute = RotasController::formaStringRota($rota->rota);

                # INDEX
                if ($rota->controller_index != 'not') {
                    Route::get("{$rota->rota}", "\App\Http\Controllers" . $rota->controller_index)->name('auth.index' . $nameRoute);
                }

                # GET     
                if ($rota->controller_get != 'not') {
                    Route::get("{$rota->rota}/{id?}/get", "\App\Http\Controllers" . $rota->controller_get)->name('auth.get' . $nameRoute);
                }

                # POST
                if ($rota->controller_post != 'not') {
                    Route::post("{$rota->rota}/inserir", "\App\Http\Controllers" . $rota->controller_post)->name('auth.post' . $nameRoute);
                }

                # PUT
                if ($rota->controller_put != 'not') {
                    Route::put("{$rota->rota}/atualizar", "\App\Http\Controllers" . $rota->controller_put)->name('auth.put' . $nameRoute);
                }

                # DELETE     
                if ($rota->controller_delete != 'not') {
                    Route::delete("{$rota->rota}/deletar", "\App\Http\Controllers" . $rota->controller_delete)->name('auth.delete' . $nameRoute);
                }

                # RESTORE     
                if ($rota->controller_restore != 'not') {
                    Route::delete("{$rota->rota}/restaurar", "\App\Http\Controllers" . $rota->controller_restore)->name('auth.restore' . $nameRoute);
                }
            }
        }
    });
});
