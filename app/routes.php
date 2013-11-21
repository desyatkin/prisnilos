<?php



/*
|-------------------------------------------------------------------------------
| Администрироване сайта
|-------------------------------------------------------------------------------
|
| Все маршруты имеют префикс /admin/
| Закрыто стандартной авторизацией
|
|-------------------------------------------------------------------------------
*/
Route::group(array('before' => 'auth', 'prefix' => 'admin'), function (){

	//------------------------------------------------------------------------------
	// Домашняя страница админки
	//------------------------------------------------------------------------------
	Route::get('/', function() {
		$view = View::make('admin.home');
		return $view;
	});

	//------------------------------------------------------------------------------
	// Категории
	//------------------------------------------------------------------------------
	Route::controller('categories', 'CategoriesController');

	//------------------------------------------------------------------------------
	// Статьи
	//------------------------------------------------------------------------------
	Route::controller('articles', 'ArticlesController');

});

Route::get('/delete_slashes', 'SiteController@getDeleteSlashes');

//------------------------------------------------------------------------------
// Форма входа
//------------------------------------------------------------------------------
Route::get('/login', function() {
	return View::make('login');
});

//------------------------------------------------------------------------------
// Авторизация пользователя посредством ajax
//------------------------------------------------------------------------------
Route::post('/login', function () { 
	if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')), true)) {
		return Redirect::to('/admin');
	} else {
		return Redirect::to('/login');
	}
});

//------------------------------------------------------------------------------
// Выход пользователя из системы
//------------------------------------------------------------------------------
Route::get('/logout', function () {
	Auth::logout();
	return Redirect::to('/');
});


