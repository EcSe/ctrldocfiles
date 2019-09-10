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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/main', array(
    'as' => 'main',
    'uses' => 'userController@login',
));

Route::post('/', array(
    'as' => 'logout',
    'uses' => 'userController@logout',
));
Route::any('ViewerJS/{all?}', function(){

    return View::make('ViewerJS.index');
});
//===================
//Rutas Usuario
//===================
Route::post('/user/login', 'userController@login');
Route::post('/user', 'userController@agregar');
Route::get('/user', 'userController@listar');
Route::get('/user/{id}', 'userController@show');
Route::delete('/user/{id}', 'userController@destroy');
Route::post('/user/{id}', 'userController@update');

Route::get('/add', function () {
    return view('usuario.addUser');
})->name('addUser');
Route::get('/list', function () {
    return view('usuario.listUser');
})->name('listUser');
Route::get('/usrview', function () {
    return view('usuario.viewUser');
});
Route::get('/usredit', function () {
    return view('usuario.updateUser');
});

//===================
//Rutas Cliente
//===================
Route::post('/client', 'clientController@agregar');
Route::get('/client', 'clientController@listar');
Route::get('/client/{id}', 'clientController@show');
Route::delete('/client/{id}', 'clientController@destroy');
Route::post('/client/{id}', 'clientController@update');

Route::get('/ac', function () {
    return view('client.addClient');
})->name('addClient');
Route::get('/lc', function () {
    return view('client.listClient');
})->name('listClient');
Route::get('/clientview', function () {
    return view('client.viewClient');
});
Route::get('/clientedit',function(){
    return view('client.updateClient');
});
//===================
//Rutas Documento
//===================
Route::post('/document', 'mainDocumentController@agregar');
Route::get('/document', 'mainDocumentController@listar');
Route::get('/document/{id}', 'mainDocumentController@show');
Route::delete('/document/{id}', 'mainDocumentController@destroy');
Route::post('/document/{id}', 'mainDocumentController@update');

Route::get('/ad', function () {
    return view('document.addDocument');
})->name('addDocument');
Route::get('/ld', function () {
    return view('document.listDocument');
})->name('listDocument');
Route::get('/docview', function () {
    return view('document.viewDocument');
});
Route::get('/docedit',function(){
    return view('document.updateDocument');
});

//===================
//Rutas UserLevel
//===================
Route::get('/userLevel', 'userLevelController@listar');

//===================
//Rutas DocumentState
//===================
Route::get('/documentState', 'documentStateController@listar');

//===================
//Rutas DocumentType
//===================
Route::get('/documentType', 'documentTypeController@listar');
