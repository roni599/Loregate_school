<?php

use App\Http\Controllers\AcademyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HeadingController;
use App\Http\Controllers\MediaLinkController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\StaffDataController;
use App\Http\Controllers\AcademyHistoryController;
use App\Http\Controllers\AdmissionAssignController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\BoardNewsController;
use App\Http\Controllers\BoardNoticeController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassInformationController;
use App\Http\Controllers\EducationBoardController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\FormNameController;
use App\Http\Controllers\LeftPictureController;
use App\Http\Controllers\MagazineController;
use App\Http\Controllers\ManagingCommunityController;
use App\Http\Controllers\PreviousEducationController;
use App\Http\Controllers\PrimePresedentController;
use App\Http\Controllers\RightPictureController;
use App\Http\Controllers\SlidevalueController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherGalleryController;
use App\Http\Controllers\TermsConditionController;
use App\Http\Controllers\WebsitelinkController;
use App\Http\Controllers\WinnerGalleryController;
use Illuminate\Support\Facades\Route;
use Whoops\Run;

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
    Route::post('/admissionregister/store',[AdmissionController::class,'signup']);
    Route::post('/admissionregister/login',[AdmissionController::class,'login']);
});

Route::get('/academy/header', [AcademyController::class, 'index']);
Route::post('/academy/header/store-update', [AcademyController::class, 'storeUpdate']);
Route::post('/academy/header/update', [AcademyController::class, 'update']);
Route::get('/academy/header/find/{id}', [AcademyController::class, 'find']);

Route::get('/academy/heading', [HeadingController::class, 'index']);
Route::post('/academy/heading/store-update', [HeadingController::class, 'storeUpdate']);
Route::post('/academy/heading/update', [HeadingController::class, 'update']);
Route::get('/academy/heading/find/{id}', [HeadingController::class, 'find']);
Route::post('/academy/heading/delete', [HeadingController::class, 'delete']);

// Route::get('/academy/slidepicture', [SlideController::class, 'index']);
// Route::post('/academy/slidepicture/store', [SlideController::class, 'store']);
// Route::post('/academy/slidepicture/update', [SlideController::class, 'update']);
// Route::get('/academy/slidepicture/find/{id}', [SlideController::class, 'find']);
// Route::post('/academy/slidepicture/delete', [SlideController::class, 'delete']);


Route::get('/all/Data',[MediaLinkController::class, 'all']);
Route::get('/media-links',[MediaLinkController::class,'index']);
Route::post('/media-links/store-update', [MediaLinkController::class, 'storeUpdate']);
Route::get('/media-find/{id}', [MediaLinkController::class, 'getLinks']);
Route::post('/media-links/update', [MediaLinkController::class, 'update']);

Route::get('academy/staff-data',[StaffDataController::class,'index']);
Route::post('/academy/staff-data/store-update', [StaffDataController::class, 'storeUpdate']);
Route::get('/academy/staff-data/{id}',[StaffDataController::class,'find']);
Route::post('/academy/staff-data/update',[StaffDataController::class,'update']);

Route::get('/academy/history',[AcademyHistoryController::class,'index']);
Route::post('/academy/history/store-update', [AcademyHistoryController::class, 'storeUpdate']);
Route::get('/academy/history/{id}',[AcademyHistoryController::class,'find']);
Route::post('/academy/history/update',[AcademyHistoryController::class,'update']);

Route::post('/academy/magazine/store', [MagazineController::class, 'store']);
Route::get('/academy/magazine',[MagazineController::class,'index']);
Route::get('/academy/education',[MagazineController::class,'educationdata']);
Route::get('/academy/health',[MagazineController::class,'healthdata']);
Route::get('/academy/religion',[MagazineController::class,'religiondata']);
Route::get('/academy/news',[MagazineController::class,'newsdata']);
Route::get('/academy/story',[MagazineController::class,'storydata']);
Route::get('/academy/poem',[MagazineController::class,'poemdata']);
Route::get('/academy/jokes',[MagazineController::class,'jokesdata']);
Route::get('/academy/magic',[MagazineController::class,'magicdata']);
Route::get('/academy/magazinefind/{id}',[MagazineController::class,'find']);



Route::get('/campus/pictureindex',[CampusController::class,'index']);
Route::post('/campus/picture/store-update', [CampusController::class, 'storeUpdate']);
Route::get('/campus/picturefind',[CampusController::class, 'findto']);
Route::post('/campus/picture/update',[CampusController::class, 'update']);

Route::get('/academy/winneergallery',[WinnerGalleryController::class,'index']);
Route::post('/academy/winnergallery', [WinnerGalleryController::class, 'store']);

Route::get('academy/boardnewsindex',[BoardNewsController::class,'index']);
Route::post('/academy/boardnews', [BoardNewsController::class, 'store']);
Route::get('/academy/boardnews/find/{id}', [BoardNewsController::class, 'find']);

Route::get('/academy/weblinkindex',[WebsitelinkController::class,'index']);
Route::post('/academy/websitelink', [WebsitelinkController::class, 'store']);
Route::get('/academy/websitelink/{id}', [WebsitelinkController::class, 'find']);

Route::get('/academy/board-notice',[BoardNoticeController::class,'index']);
Route::post('/academy/notice-boards', [BoardNoticeController::class, 'store']);
Route::get('/academy/board-notice/find/{id}',[BoardNoticeController::class,'find']);

Route::get('/academy/education-board', [EducationBoardController::class, 'index']);
Route::post('/academy/education-board/store-update', [EducationBoardController::class, 'storeUpdate']);
Route::get('/academy/education-board/{id}',[EducationBoardController::class,'find']);
Route::post('/academyeducation-board/update',[EducationBoardController::class,'update']);

Route::get('/academy/prime-presedent',[PrimePresedentController::class,'index']);
Route::post('/academy/prime-presedent/store-update', [PrimePresedentController::class, 'storeUpdate']);
Route::get('/academy/prime-presedent/{id}',[PrimePresedentController::class,'find']);
Route::post('/academy/prime-presedent/update',[PrimePresedentController::class,'update']);


Route::get('/academy/rightpicture',[RightPictureController::class,'index']);
Route::post('/academy/rightpicture/store-update', [RightPictureController::class, 'storeUpdate']);
Route::get('/academy/rightpicture-picture/{id}',[RightPictureController::class,'find']);
Route::post('/academy/rightpicture/update',[RightPictureController::class,'update']);

Route::get('/academy/leftpicture',[LeftPictureController::class,'index']);
Route::post('/academy/leftpicture/store-update', [LeftPictureController::class, 'storeUpdate']);
Route::get('/academy/findleft-picture/{id}',[LeftPictureController::class,'find']);
Route::post('/academy/leftpicture/update',[LeftPictureController::class,'update']);

Route::post('/academy/teacher-gallery', [TeacherGalleryController::class, 'store']);
Route::get('/academy/teacher-gallery/{id}',[TeacherGalleryController::class,'find']);
Route::get('/academy/teacher-galleryindex',[TeacherGalleryController::class,'index']);

Route::get('/academy/managingcummunityindex',[ManagingCommunityController::class,'index']);
Route::post('/academy/managingcummunity', [ManagingCommunityController::class, 'store']);
Route::get('/academy/managingcummunity/{id}',[ManagingCommunityController::class,'find']);


Route::get('/academy/slidevalue',[SlidevalueController::class,'index']);
// Route::post('/slidesvlaue', [SlidevalueController::class, 'store']);
Route::post('/slidesvlaue', [SlidevalueController::class, 'storeUpdate']);
Route::get('/academy/slidevalue/{id}',[SlidevalueController::class, 'find']);
Route::post('/academy/slidevaluepicture/update',[SlidevalueController::class, 'update']);
Route::post('academy/slides/delete', [SlidevalueController::class, 'deleteImage']);


Route::get('/page-title', function () {
    return response()->json(['title' => 'Dynamic Loregate College']);
});

Route::get('allusers',[AcademyController::class,'allusers']);
Route::put('/userSelfUpdate', [AcademyController::class, 'userSelfUpdate']);
Route::put('/userSelfUpdaePassword', [AcademyController::class, 'userSelfUpdatePassword']);


Route::get('/classes', [ClassController::class, 'index']);
Route::post('/classes/store', [ClassController::class, 'store']);
Route::post('/classes/update-status/{id}', [ClassController::class, 'updateStatus']);


Route::get('/admissionassign',[AdmissionAssignController::class,'index']);
Route::post('/admissionassign/store',[AdmissionAssignController::class,'store']);
Route::get('/admissionassign/findassign', [AdmissionAssignController::class, 'findassign']);

Route::get('/form-names',[FormNameController::class,'index']);
Route::get('/form-names/status/index',[FormNameController::class,'statusIndex']);
Route::post('/form-names/store', [FormNameController::class, 'store']);
Route::post('/form-names/update-status/{id}', [FormNameController::class, 'updateStatus']);

Route::get('/fields',[FieldController::class,'index']);
Route::get('/fields/status/index',[FieldController::class,'statusIndex']);
Route::get('/fields/studentinformation',[FieldController::class,'studentinformation']);
Route::post('/fields/store', [FieldController::class, 'store']);
Route::post('/fields/update-status/{id}', [FieldController::class, 'updateStatus']);

Route::get('/previous-educations', [PreviousEducationController::class, 'index']);
Route::post('/previous-educations/store', [PreviousEducationController::class, 'store']);

Route::get('/terms-condition', [TermsConditionController::class, 'index']);
Route::post('/terms-conditions/storeUpdate', [TermsConditionController::class, 'storeUpdate']);

Route::get('/class-information',[ClassInformationController::class,'index']);
Route::post('/class-information/store', [ClassInformationController::class, 'store']);


Route::get('/studentadmissions',[StudentController::class, 'index']);
Route::get('/studentadmission/find',[StudentController::class, 'studentadmissionfind']);
Route::post('/studentadmission/store', [StudentController::class, 'store']);