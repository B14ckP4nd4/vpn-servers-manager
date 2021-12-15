<?php

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
//    $user = new  \App\Models\User();
//    $user->password = Hash::make('KN4&~t@f3/{P9+B');
//    $user->email = 'admin@ansiblemaster.com';
//    $user->name = 'Admin';
//    $gfa = new PragmaRX\Google2FA\Google2FA();
//    $secret = $gfa->generateSecretKey();
//    $qr = $gfa->getQRCodeUrl(
//        'AnsibleMaster',
//        'admin@ansiblemaster.com',
//        $secret
//    );
//    echo $qr;
//    $user->google2fa_secret = $secret;
//    $user->save();
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','2fa'])->name('dashboard');

Route::post('/2fa', function () {
    return redirect(\route('dashboard'));
})->name('2fa')->middleware('2fa');

require __DIR__.'/auth.php';
