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
    return view('login');
})->name('login');

Route::get('/main', function (){
    return view('main');
});
Route::post('/main', array(
    'as' => 'main',
    'uses' => 'userController@login',
));

Route::post('/', array(
    'as' => 'logout',
    'uses' => 'userController@logout',
));
//===================
//Rutas Usuario
//===================
Route::post('/user/login', 'userController@login');
Route::post('/user', 'userController@agregar');
Route::get('/user', 'userController@listar');
Route::get('/userPaginate','userController@listPaginate');
Route::get('/user/{id}', 'userController@show');
Route::delete('/user/{id}', 'userController@destroy');
Route::post('/user/{id}', 'userController@update');
Route::post('/searchUser','userController@search');
Route::get('/disk','userController@disco');

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
Route::get('/clientPaginate','clientController@listPaginate');
Route::get('/client/{id}', 'clientController@show');
Route::delete('/client/{id}', 'clientController@destroy');
Route::post('/client/{id}', 'clientController@update');
Route::post('/searchClient','clientController@search');

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
Route::get('/documentPaginate','mainDocumentController@listPaginate');
Route::get('/document/{id}', 'mainDocumentController@show');
Route::delete('/document/{id}', 'mainDocumentController@destroy');
Route::post('/document/{id}', 'mainDocumentController@update');
Route::post('/searchDocument','mainDocumentController@search');

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
//Rutas Expediente
//===================
Route::post('/casefile', 'casefilesController@agregar');
Route::get('/casefile', 'casefilesController@listar');
Route::get('/casefilePaginate','casefilesController@listPaginate');
Route::get('/casefile/{id}', 'casefilesController@show');
Route::delete('/casefile/{id}', 'casefilesController@destroy');
Route::post('/casefile/{id}', 'casefilesController@update');
Route::post('/searchCasefiles','casefilesController@search');

Route::get('/aca', function () {
    return view('casefiles.addCasefiles');
})->name('addCasefiles');
Route::get('/lca', function () {
    return view('casefiles.listCasefiles');
})->name('listCasefiles');
Route::get('/casefileview', function () {
    return view('casefiles.viewCasefile');
});
Route::get('/casefileedit',function(){
    return view('casefiles.updateCasefiles');
});
//==========================
//Rutas Expediente-Documento
//==========================
Route::post('/casefiledocument', 'casefilesDocumentController@agregar');
Route::post('/docuIntoCasefiles','casefilesDocumentController@agregarDocumentIntoCasefile');
Route::get('/casefiledocument', 'casefilesDocumentController@listar');
Route::get('/casefiledocumentPaginate','casefilesDocumentController@listPaginate');
Route::get('/casefiledocument/{id}', 'casefilesDocumentController@show');
Route::delete('/casefiledocument/{id}', 'casefilesDocumentController@destroy');
Route::get('/casedocu',function(){
    return view('casefilesDocument.addCasefilesDocument');
});

//===================
//Rutas UserLevel
//===================
Route::get('/userLevel', 'userLevelController@listar');

//===================
//Rutas UserLevel
//===================
Route::get('/accountState','accountStateController@listar');

//===================
//Rutas DocumentState
//===================
Route::get('/documentState', 'documentStateController@listar');

//===================
//Rutas DocumentType
//===================
Route::get('/documentType', 'documentTypeController@listar');

//===================
//Rutas CasefileType
//===================
Route::get('/casefileType','casefileTypeController@listar');

//===================
//Rutas CasefileState
//===================
Route::get('/casefileState','casefileStateController@listar');
