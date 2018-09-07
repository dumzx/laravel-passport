<?php

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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth','verified'])->prefix('dashboard')->group(function () {
    // Clients
    Route::get('/clients', function () {
        return view('passport.client');
    })->name('clients');

    Route::get('/personal-access-tokens', function () {
        return view('passport.personalAccessToken');
    })->name('personal-access-tokens');

    Route::get('/authorized-clients', function () {
        return view('passport.authorizedClient');
    })->name('authorized-clients');
});

Route::get('/redirect', function () {

    $query = http_build_query([
        'client_id' => '86567ea7-d8fb-4700-bb28-763576e4faef',
        'redirect_uri' => url('callback'),
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect(url('oauth/authorize?'.$query));
});

Route::get('/callback', function () {
    $http = new GuzzleHttp\Client;
    dd($http,request()->get('code'),url('oauth/token'));
    $response = $http->post(url('oauth/token'), [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => '86567ea7-d8fb-4700-bb28-763576e4faef',
            'client_secret' => 'hlvpPTf35LQ6iKB1BlSmlKmEi83zP89Mp17j3MUm3FY9AHsmeNBY6Ce9Jurb',
            'redirect_uri' => url('callback'),
            'code' => request()->get('code'),
        ],
        'debug' => true,
    ]);
    dd($response);
    return json_decode((string) $response->getBody(), true);
});
