<?php

use Illuminate\Support\Facades\Mail;
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
});

Route::get('/mail-test', function () {
    try {
        $token = $_GET['token'] ?? '';
        if ($token !== 'itc') {
            throw new Exception('You shall not pass.');
        }
        Mail::raw("I keep forgetting how to send an email in Laravel without using Mailables. The the documentation does not help so I’m writing this down here for future reference.", function ($message) {
            $message->to('yingying.yao@it-consultis.com')
                ->subject('My Introduction');
        });
        return "Done Test";
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
});
