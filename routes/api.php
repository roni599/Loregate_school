<?php

use App\Http\Controllers\AcademyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HeadingController;
use App\Http\Controllers\MediaLinkController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\StaffDataController;
use App\Http\Controllers\AcademyHistoryController;
use App\Http\Controllers\BoardNewsController;
use App\Http\Controllers\BoardNoticeController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\EducationBoardController;
use App\Http\Controllers\LeftPictureController;
use App\Http\Controllers\MagazineController;
use App\Http\Controllers\ManagingCommunityController;
use App\Http\Controllers\PrimePresedentController;
use App\Http\Controllers\RightPictureController;
use App\Http\Controllers\SlidevalueController;
use App\Http\Controllers\TeacherGalleryController;
use App\Http\Controllers\WebsitelinkController;
use App\Http\Controllers\WinnerGalleryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});



Route::get('allusers',[AcademyController::class,'allusers']);
Route::put('/userSelfUpdate', [AcademyController::class, 'userSelfUpdate']);
Route::put('/userSelfUpdaePassword', [AcademyController::class, 'userSelfUpdatePassword']);

Route::get('/academy/header', [AcademyController::class, 'index']);
Route::post('/academy/header/store', [AcademyController::class, 'store']);
Route::post('/academy/header/update', [AcademyController::class, 'update']);
Route::get('/academy/header/find/{id}', [AcademyController::class, 'find']);

Route::get('/academy/heading', [HeadingController::class, 'index']);
Route::post('/academy/heading/store', [HeadingController::class, 'store']);
Route::post('/academy/heading/update', [HeadingController::class, 'update']);
Route::get('/academy/heading/find/{id}', [HeadingController::class, 'find']);
Route::post('/academy/heading/delete', [HeadingController::class, 'delete']);

// Route::get('/academy/slidepicture', [SlideController::class, 'index']);
// Route::post('/academy/slidepicture/store', [SlideController::class, 'store']);
// Route::post('/academy/slidepicture/update', [SlideController::class, 'update']);
// Route::get('/academy/slidepicture/find/{id}', [SlideController::class, 'find']);
// Route::post('/academy/slidepicture/delete', [SlideController::class, 'delete']);



Route::post('/media-links', [MediaLinkController::class, 'store']);
Route::get('/media-find/{id}', [MediaLinkController::class, 'getLinks']);
Route::post('/media-links/update', [MediaLinkController::class, 'update']);

Route::post('/academy/staff-data', [StaffDataController::class, 'store']);
Route::get('/academy/staff-data/{id}',[StaffDataController::class,'find']);
Route::post('/academy/staff-data/update',[StaffDataController::class,'update']);

Route::post('/academy/history', [AcademyHistoryController::class, 'store']);
Route::get('/academy/history/{id}',[AcademyHistoryController::class,'find']);
Route::post('/academy/history/update',[AcademyHistoryController::class,'update']);

Route::post('/academy/magazine/store', [MagazineController::class, 'store']);
Route::get('/academy/magazine',[MagazineController::class,'index']);
Route::get('/academy/magazinefind/{id}',[MagazineController::class,'find']);



Route::post('/campus/store', [CampusController::class, 'store']);
Route::get('/campus/picture/{id}',[CampusController::class, 'find']);
Route::post('/campus/picture/update',[CampusController::class, 'update']);
Route::get('/campus/pictureindex',[CampusController::class,'index']);

Route::post('/academy/winnergallery', [WinnerGalleryController::class, 'store']);
Route::get('/academy/winneergallery',[WinnerGalleryController::class,'index']);

Route::post('/academy/boardnews', [BoardNewsController::class, 'store']);
Route::get('/academy/boardnews/find/{id}', [BoardNewsController::class, 'find']);
Route::get('academy/boardnewsindex',[BoardNewsController::class,'index']);

Route::post('/academy/websitelink', [WebsitelinkController::class, 'store']);
Route::get('/academy/websitelink/{id}', [WebsitelinkController::class, 'find']);
Route::get('/academy/weblinkindex',[WebsitelinkController::class,'index']);

Route::post('/academy/notice-boards', [BoardNoticeController::class, 'store']);
Route::get('/academy/board-notice',[BoardNoticeController::class,'index']);
Route::get('/academy/board-notice/find/{id}',[BoardNoticeController::class,'find']);

Route::post('/academy/education-board', [EducationBoardController::class, 'store']);
Route::get('/academy/education-board/{id}',[EducationBoardController::class,'find']);
Route::post('/academyeducation-board/update',[EducationBoardController::class,'update']);

Route::post('/academy/prime-presedent', [PrimePresedentController::class, 'store']);
Route::get('/academy/prime-presedent/{id}',[PrimePresedentController::class,'find']);
Route::post('/academy/prime-presedent/update',[PrimePresedentController::class,'update']);



Route::post('/academy/rightpicture', [RightPictureController::class, 'store']);
Route::get('/academy/rightpicture-picture/{id}',[RightPictureController::class,'find']);
Route::post('/academy/rightpicture/update',[RightPictureController::class,'update']);

Route::post('/academy/leftpicture', [LeftPictureController::class, 'store']);
Route::get('/academy/findleft-picture/{id}',[LeftPictureController::class,'find']);
Route::post('/academy/leftpicture/update',[LeftPictureController::class,'update']);

Route::post('/academy/teacher-gallery', [TeacherGalleryController::class, 'store']);
Route::get('/academy/teacher-gallery/{id}',[TeacherGalleryController::class,'find']);
Route::get('/academy/teacher-galleryindex',[TeacherGalleryController::class,'index']);

Route::post('/academy/managingcummunity', [ManagingCommunityController::class, 'store']);
Route::get('/academy/managingcummunity/{id}',[ManagingCommunityController::class,'find']);
Route::get('/academy/managingcummunityindex',[ManagingCommunityController::class,'index']);



Route::post('/slidesvlaue', [SlidevalueController::class, 'store']);
Route::get('/academy/slidevalue/{id}',[SlidevalueController::class, 'find']);
Route::post('/academy/slidevaluepicture/update',[SlidevalueController::class, 'update']);
Route::post('academy/slides/delete', [SlidevalueController::class, 'deleteImage']);


Route::get('/page-title', function () {
    return response()->json(['title' => 'Dynamic Loregate College']);
});
