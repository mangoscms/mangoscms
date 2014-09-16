<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
        
        public function doLogin()
        {
                $rules = array(
                              'login_form_username' => 'required|min:3|max:32|alphanum',
                              'login_form_password' => 'required|min:3|max:32|alphanum'
                              );
                $validator = Validator::make(Input::all(), $rules);
                if ($validator->fails()) {
                    return Redirect::to('/')
                    ->withErrors($validator, 'login_form')
                    ->withInput(Input::except('login_form_password'));
                }
                else
                {
                    $userdata = array(
                                     'username' => strtoupper(Input::get('login_form_username')),
                                     'password' => strtoupper(Input::get('login_form_username').':'.Input::get('login_form_password'))
                                     );
                }
                if (Auth::attempt(array('username' => $userdata['username'], 'password' => $userdata['password']))) {
                    DB::table('logs')->insert(
                                             array('logs_type' => 5, 'logs_relation' => Request::getClientIp(), 'logs_username' => Auth::user()->username, 'logs_datetime' => date('Y-m-d H:i'))
                                             );
                    return Redirect::intended('dashboard');
                }
                else
                {
                    return Redirect::to('/');
                }
        }
        
        public function doRegister()
        {
                $rules = array(
                              'username'  => 'required|min:3|max:32|alphanum',
                              'password'  => 'required|min:3|max:32|alphanum',
                              'email'     => 'required|min:3|max:32|email',
                              'expansion' => 'required|min:0|max:4|integer'
                              );
                $validator = Validator::make(Input::all(), $rules);
                if ($validator->fails()) {
                    return Redirect::to('register')
                    ->withErrors($validator, 'register_form')
                    ->withInput(Input::except('password'));
                }
                else
                {
                    $userdata = array(
                                     'username'  => strtoupper(Input::get('username')),
                                     'password'  => Hash::make(strtoupper(Input::get('username').':'.Input::get('password'))),
                                     'email'     => Input::get('email'),
                                     'expansion' => Input::get('expansion')
                                     );
                }
                $user = DB::connection('mangos')->table('account')->where('username', $userdata['username'])->pluck('username');
                if (empty($user))
                {
                    DB::connection('mangos')->table('account')->insert(
                                                                      array('username' => $userdata['username'], 'sha_pass_hash' => $userdata['password'], 'gmlevel' => 0, 'email' => $userdata['email'], 'joindate' => date('Y-m-d'), 'last_ip' => Request::getClientIp(), 'expansion' => $userdata['expansion'])
                                                                      );
                    DB::table('logs')->insert(
                                             array('logs_type' => 4, 'logs_relation' => Request::getClientIp(), 'logs_username' => $userdata['username'], 'logs_datetime' => date('Y-m-d H:i'))
                                             );
                    return Redirect::intended('/');
                }
                else
                {
                    return Redirect::to('register')
                    ->withErrors('This username has been already taken.', 'register_form')
                    ->withInput(Input::except('password'));
                }
        }
        
        public function deleteNews()
        {
                if (Route::input('news_id') >= 0)
                {
                    $entry = DB::table('news')->where('id', Route::input('news_id'))->pluck('news_title');
                    DB::table('logs')->insert(
                                             array('logs_type' => 2, 'logs_relation' => $entry, 'logs_username' => Auth::user()->username, 'logs_datetime' => date('Y-m-d H:i'))
                                             );
                    News::destroy(Route::input('news_id'));
                    return Redirect::to('/');
                }
                else
                {
                    return Redirect::to('/');
                }
        }

        public function deleteUser()
        {
                if (Route::input('user_id') >= 0 && Route::input('user_id') != Auth::user()->id)
                {
                    $entry = DB::connection('mangos')->table('account')->where('id', Route::input('user_id'))->pluck('username');
                    DB::table('logs')->insert(
                                             array('logs_type' => 3, 'logs_relation' => $entry, 'logs_username' => Auth::user()->username, 'logs_datetime' => date('Y-m-d H:i'))
                                             );
                    User::destroy(Route::input('user_id'));
                    return Redirect::to('dashboard');
                }
                else
                {
                    return Redirect::to('dashboard');
                }
        }

        public function postNews()
        {
                $rules = array(
                              'news_title' => 'required|min:3|max:64',
                              'news_text' => 'required|min:3'
                              );
                $validator = Validator::make(Input::all(), $rules);
                if ($validator->fails()) {
                    return Redirect::to('dashboard')
                    ->withErrors($validator);
                }
                else
                {
                    $news = array(
                                 'news_title' => Input::get('news_title'),
                                 'news_text' => Input::get('news_text')
                                 );
                }

                DB::table('news')->insert(
                                         array('news_title' => $news['news_title'], 'news_text' => $news['news_text'], 'news_author' => Auth::user()->username, 'news_date' => date('Y-m-d'))
                                         );
                DB::table('logs')->insert(
                                         array('logs_type' => 1, 'logs_relation' => $news['news_title'], 'logs_username' => Auth::user()->username, 'logs_datetime' => date('Y-m-d H:i'))
                                         );
                return Redirect::intended('dashboard');
        }
}