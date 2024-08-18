<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\ApplicationController;
use App\Http\Conttollers\TestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

Route::get('/', [HomeController::class, 'index']);
Route::post('/', [HomeController::class, 'login']);

Route::get('admin/login', [AdminController::class, 'login']);
Route::post('admin/login', [AdminController::class, 'authenticate']);

Route::get('admin/logout', [AdminController::class, 'logout']);

Route::get('admin', [AdminController::class, 'index'])->middleware('auth:admin');
Route::get('list', [AdminController::class, 'refresh'])->middleware('auth:admin');
Route::get('make', [ApplicationController::class, 'make'])->middleware('auth:admin');
Route::get('admin/download', [AdminController::class, 'download'])->middleware('auth:admin');
Route::get('admin/downloadapplications', [AdminController::class, 'downloadapplications'])->middleware('auth:admin');
Route::get('admin/show', [AdminController::class, 'show'])->middleware('auth:admin');
Route::get('admin/sorting', [AdminController::class, 'sorting'])->middleware('auth:admin');
Route::post('admin/loaddata', [AdminController::class, 'LoadData'])->middleware('auth:admin');

Route::resource('admin/settings', SettingController::class)->middleware('auth:admin');
Route::post('admin/settings/override', [SettingController::class, 'overrideClicked']);

Route::get('branch', [RegisterController::class, 'branch']);
Route::post('branch', [RegisterController::class, 'branchConfirm']);

Route::get('kindergarten', [RegisterController::class, 'kindergarten']);
Route::post('kindergarten', [RegisterController::class, 'kindergartenConfirm']);

Route::get('other', [RegisterController::class, 'other']);
Route::post('other', [RegisterController::class, 'otherConfirm']);

Route::get('nursery', [RegisterController::class, 'nursery']);
Route::post('nursery', [RegisterController::class, 'nurseryConfirm']);

Route::get('alevels', [RegisterController::class, 'alevels']);
Route::post('alevels', [RegisterController::class, 'alevelsConfirm']);

Route::get('grade6', [RegisterController::class, 'grade6']);
Route::post('grade6', [RegisterController::class, 'grade6Confirm']);

Route::get('london', [RegisterController::class, 'london']);
Route::post('london', [RegisterController::class, 'londonConfirm']);

Route::get('newreg', [RegisterController::class, 'newRegistration']);

Route::get('application/login', [ApplicationController::class, 'login']);
Route::post('application/login', [ApplicationController::class, 'checklogin']);
Route::get('application/logout', [ApplicationController::class, 'logout']);
Route::get('application/status', [ApplicationController::class, 'status'])->middleware('auth:user');
Route::get('application/child', [ApplicationController::class, 'child'])->middleware('auth:user');
Route::post('application/child', [ApplicationController::class, 'childSave'])->middleware('auth:user');
Route::get('application/father', [ApplicationController::class, 'father'])->middleware('auth:user');
Route::post('application/father', [ApplicationController::class, 'fatherSave'])->middleware('auth:user');
Route::get('application/mother', [ApplicationController::class, 'mother'])->middleware('auth:user');
Route::post('application/mother', [ApplicationController::class, 'motherSave'])->middleware('auth:user');
Route::get('application/other', [ApplicationController::class, 'other'])->middleware('auth:user');
Route::post('application/other', [ApplicationController::class, 'otherSave'])->middleware('auth:user');
Route::get('application/church', [ApplicationController::class, 'church'])->middleware('auth:user');
Route::post('application/church', [ApplicationController::class, 'churchSave'])->middleware('auth:user');
Route::get('application/connections', [ApplicationController::class, 'connections'])->middleware('auth:user');
Route::post('application/connections', [ApplicationController::class, 'connectionsSave'])->middleware('auth:user');
Route::get('application/oba', [ApplicationController::class, 'oba'])->middleware('auth:user');
Route::post('application/oba', [ApplicationController::class, 'obaSave'])->middleware('auth:user');
Route::get('application/staff', [ApplicationController::class, 'staff'])->middleware('auth:user');
Route::post('application/staff', [ApplicationController::class, 'staffSave'])->middleware('auth:user');
Route::get('application/results', [ApplicationController::class, 'results'])->middleware('auth:user');
Route::post('application/results', [ApplicationController::class, 'resultsSave'])->middleware('auth:user');
Route::get('application/subjects', [ApplicationController::class, 'subjects'])->middleware('auth:user');
Route::post('application/subjects', [ApplicationController::class, 'subjectsSave'])->middleware('auth:user');
Route::get('application/general', [ApplicationController::class, 'general'])->middleware('auth:user');
Route::post('application/general', [ApplicationController::class, 'generalSave'])->middleware('auth:user');
Route::get('application/submit', [ApplicationController::class, 'submit'])->middleware('auth:user');
Route::post('application/submit', [ApplicationController::class, 'submitForm'])->middleware('auth:user');
Route::get('application/finalised', [ApplicationController::class, 'finalised']);

Route::get('formpurchase', [PayController::class, 'purchase']);
Route::get('response', [PayController::class, 'response']);

Route::get('register', [RegisterController::class, 'verify']);
Route::post('register', [RegisterController::class, 'register']);

Route::get('createapplication', function(Request $request) {
	return view('admin.createapplication')->with(['request'=>$request]);
})->middleware('auth:admin');
Route::post('createapplication', [AdminController::class, 'createapplication'])->middleware('auth:admin');
