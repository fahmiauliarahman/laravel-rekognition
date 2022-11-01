<?php

use App\Http\Controllers\AWSController;
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

Route::get('face_detector', function () {
  return view('face_detector');
})->name('face_detector');

Route::get('face_compare', function () {
  return view('face_compare');
})->name('face_compare');

Route::get('celebrity_recognition', function () {
  return view('celebrity_recognition');
})->name('celebrity_recognition');

Route::get('text_recognition', function () {
  return view('text_recognition');
})->name('text_recognition');

Route::get('object_detection', function () {
  return view('object_detection');
})->name('object_detection');


Route::post('face_detector', [AWSController::class, 'submit_face_detector'])->name('face_detector.submit');
Route::post('celebrity_recognition', [AWSController::class, 'submit_celebrity_recognition'])->name('celebrity_recognition.submit');
Route::post('text_recognition', [AWSController::class, 'submit_text_recognition'])->name('text_recognition.submit');
Route::post('face_compare', [AWSController::class, 'submit_face_compare'])->name('face_compare.submit');
Route::post('object_detection', [AWSController::class, 'submit_object_detection'])->name('object_detection.submit');
