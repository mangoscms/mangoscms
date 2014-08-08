<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

$realms = Realmlist::get();
$news = News::orderBy('id', 'DESC')->paginate(5);
View::share(array('realms' => $realms, 'news' => $news));

Route::get('/', function()
{
	return View::make('mainlayout');
});

Route::get('/login', function()
{
        return Redirect::to('/');
});

Route::get('/logout', function()
{
    Auth::logout();
    return Redirect::to('/');
});

Route::post('/logout', function()
{
    return Redirect::to('/');
});

Route::get('/register', function()
{
        return View::make('registerlayout');
});

Route::get('/play', function()
{
        return View::make('playlayout');
});

Route::get('/character', array('before' => 'auth' ,function()
{
        $characters = DB::connection('characters')->table('characters')->where('account', '=', Auth::user()->id)->get();
        return View::make('characterlayout', array('characters' => $characters));
}));

Route::post('/', array('uses' => 'HomeController@doLogin'));
Route::post('/register', array('uses' => 'HomeController@doRegister'));

Route::group(array('before' => 'auth|isadmin'), function()
{
        Route::get('/dashboard', function()
        {
            $users = User::paginate(15);
            $logs = Logs::orderBy('id', 'DESC')->paginate(15);
            return View::make('dashboardlayout', array('users' => $users, 'logs' => $logs));
        });
        
        Route::get('/deletepost/{news_id}', array('uses' => 'HomeController@deleteNews'));
        Route::get('/deleteuser/{user_id}', array('uses' => 'HomeController@deleteUser'));
        
        Route::post('/dashboard/news', array('uses' => 'HomeController@postNews'));
});