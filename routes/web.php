<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Admin\UserdetailController;

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


/*Route::get('/', function () {
    return view('welcome');
});*/

//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear'); 
    return '<h1>Cache facade value cleared</h1>';
});

//fronend route 
Route::get('/', [FrontendController::class, 'homepage']);
Route::any('/login', [FrontendController::class, 'login']);
Route::any('/signup', [FrontendController::class, 'signup']);
Route::any('/student-signup', [FrontendController::class, 'student_signup']);
Route::any('/verify-user/{token}', [FrontendController::class, 'verifyUser']);
Route::any('/become-a-tutor', [FrontendController::class, 'become_a_tutor']);
Route::any('/find-a-tutor', [FrontendController::class, 'find_a_tutor']);
Route::any('/tutor-signup/{userid}', [FrontendController::class, 'tutor_details_page']);
Route::any('/submit_tutor_signup', [FrontendController::class, 'submit_tutor_signup']);
Route::any('/tutor-detail/{tutorid}', [FrontendController::class, 'tutor_detail_single_page']);
Route::any('/getcalendar_fronted/{id}', [FrontendController::class, 'getcalendar_fronted']);

Route::group(['middleware' => ['dashboardmiddleware']], function() {

Route::any('/dashboard', [DashboardController::class, 'dashboard']);
Route::any('/logout', [DashboardController::class, 'logout']);

Route::any('/profile/{id?}', [DashboardController::class, 'profileUpdate']);
Route::any('/delete_education/{id}', [DashboardController::class, 'deleteEducation']);
Route::any('/delete_certificate/{id}', [DashboardController::class, 'deleteCertificate']);
Route::any('/delete_experience/{id}', [DashboardController::class, 'deleteExperience']);
Route::any('/delete_identity/{id}', [DashboardController::class, 'deleteIdentity']);

Route::any('/calendar', [DashboardController::class, 'calendar']);
Route::any('/getcalendar/{id}', [DashboardController::class, 'getcalendar']);
Route::any('/get-event-by-id/{byid}', [DashboardController::class, 'getEventByid']);
Route::any('/editcalendar', [DashboardController::class, 'editcalendar']);
Route::any('/add-schedule', [DashboardController::class, 'addSchedule']);
Route::any('/add-availability-schedule', [DashboardController::class, 'add_availability_Schedule']);

Route::any('/purchase-lession-by-student', [DashboardController::class, 'purchase_lession_by_student']);

Route::any('/purchase-data', [DashboardController::class, 'getPurchasesData']);

Route::any('/mark-as-read-user',[DashboardController::class, 'markNotification_user'])->name('markNotification_user');

Route::any('/tutors', [DashboardController::class, 'tutors']);
Route::any('/tutor/{id}', [DashboardController::class, 'tutor']);

Route::any('/settings', [DashboardController::class, 'settings']);
Route::any('/support', [DashboardController::class, 'support']);
Route::any('/change_password', [DashboardController::class, 'change_password']);

Route::any('/order', [DashboardController::class, 'order']);
Route::any('/teaching-orders', [DashboardController::class, 'teachingOrders']);

Route::any('/student-orders', [DashboardController::class, 'studentOrders']);
Route::any('/cancel_order', [DashboardController::class, 'cancel_order']);
Route::any('/cancel_order_by_id', [DashboardController::class, 'cancel_order_by_id']);



});

//admin route 
Route::group(['middleware' => ['adminmiddleware']], function() {


Route::get('/admin/dashboard', [AdminController::class, 'index']);
Route::any('/admin/logout', [AdminController::class, 'logout']);
Route::any('/admin/user_register_by_admin', [AdminController::class, 'user_register_by_admin']);

//student-testimonials
Route::any('/admin/student-testimonials', [AdminController::class, 'student_testimonials']);
Route::any('/admin/create_testimonial', [AdminController::class, 'create_testimonial']);
Route::any('/admin/testimonial_status_update', [AdminController::class, 'testimonial_status_update']);
Route::any('/admin/testimonial_delete/{id}', [AdminController::class, 'testimonial_delete']);

Route::any('/admin/edit_testimonial', [AdminController::class, 'edit_testimonial']);

Route::any('/admin/update_testimonial', [AdminController::class, 'update_testimonial']);

//pages
Route::any('admin/edit-homepage/{homepage_id}', [AdminController::class, 'edit_homepage']);
Route::any('admin/update_homepage/{homepage_id}', [AdminController::class, 'update_homepage']);


//subject
Route::any('/admin/subject', [AdminController::class, 'subject']);
Route::any('/admin/subject/create_subject', [AdminController::class, 'create_subject']);
Route::any('/admin/subject/get_subject_value', [AdminController::class, 'get_subject_value']);
Route::any('/admin/subject/update_subject', [AdminController::class, 'update_subject']);
Route::any('/admin/subject/delete_subject/{id}', [AdminController::class, 'delete_subject']);

//teaches-level
Route::any('/admin/teaches_level', [AdminController::class, 'teaches_level']);
Route::any('/admin/teaches_level/create_level', [AdminController::class, 'create_level']);
Route::any('/admin/teaches_level/get_level_value', [AdminController::class, 'get_level_value']);
Route::any('/admin/teaches_level/update_level', [AdminController::class, 'update_level']);
Route::any('/admin/teaches_level/delete_level/{id}', [AdminController::class, 'delete_level']);

//hourly-Rate
Route::any('/admin/hourly_rate', [AdminController::class, 'hourly_rate']);
Route::any('/admin/hourly_rate/create_rate', [AdminController::class, 'create_rate']);
Route::any('/admin/hourly_rate/get_rate', [AdminController::class, 'get_rate']);
Route::any('/admin/hourly_rate/update_rate', [AdminController::class, 'update_rate']);
Route::any('/admin/hourly_rate/delete_rate/{id}', [AdminController::class, 'delete_rate']);

//spoken Language
Route::any('/admin/spoken_language', [AdminController::class, 'spoken_language']);
Route::any('/admin/spoken_language/create_spoken_language', [AdminController::class, 'create_spoken_language']);
Route::any('/admin/spoken_language/get_spoken_language', [AdminController::class, 'get_spoken_language']);
Route::any('/admin/spoken_language/update_spoken_language', [AdminController::class, 'update_spoken_language']);
Route::any('/admin/spoken_language/status_update', [AdminController::class, 'language_status_update']);
Route::any('/admin/spoken_language/delete_language/{id}', [AdminController::class, 'delete_language']);

//notification 
Route::any('/mark-as-read',[AdminController::class, 'markNotification'])->name('markNotification');

Route::get('/admin/userlist', [UserdetailController::class, 'index']);
Route::get('/admin/studentlist', [UserdetailController::class, 'studentlist']);
Route::get('/admin/teacherlist', [UserdetailController::class, 'teacherlist']);
Route::get('/admin/tutor-request', [UserdetailController::class, 'tutorrequest']);
Route::get('/admin/adminlist', [UserdetailController::class, 'adminlist']);
Route::get('admin/view-profile/{userid}', [UserdetailController::class, 'viewprofile']);
Route::get('admin/edit-profile/{userid}', [UserdetailController::class, 'editprofile']);

Route::get('admin/tutor-details/{userid}', [UserdetailController::class, 'tutordetails']);
Route::any('admin/update_user_profile', [UserdetailController::class, 'update_user_profile']);
Route::any('admin/change-user-status', [UserdetailController::class, 'status_update']);
Route::any('/admin/admin_apporove_profile', [UserdetailController::class, 'admin_apporove_profile']);

Route::any('admin/delete-user/{id}', [UserdetailController::class, 'delete_user']);
Route::any('admin/delete-student/{id}', [UserdetailController::class, 'delete_student']);
Route::any('admin/delete-teacher/{id}', [UserdetailController::class, 'delete_teacher']);
Route::any('admin/delete-admin/{id}', [UserdetailController::class, 'delete_admin']);

/*Ruchika Sharma*/
Route::any('/admin/edit-become-a-tutor', [AdminController::class, 'edit_become_a_tutor']);
Route::any('/admin/save_content', [AdminController::class, 'save_content']);
/*Support*/
Route::any('admin/update_support', [AdminController::class, 'update_support_content']);
Route::any('admin/save_support', [AdminController::class, 'save_support_content']);

//social_platforms
Route::any('admin/social_platforms', [AdminController::class, 'social_platforms']);
Route::any('admin/social_platform/create_platform', [AdminController::class, 'create_platform']);
Route::any('admin/social_platform/get_platform', [AdminController::class, 'get_platform']);
Route::any('admin/social_platform/edit_platform', [AdminController::class, 'edit_platform']);
Route::any('/admin/social_platform/platform_status_update', [AdminController::class, 'platform_status_update']);
Route::any('/admin/social_platform/delete_platform/{id}', [AdminController::class, 'delete_platform']);

/*footer-data*/
Route::any('admin/update_footer', [AdminController::class, 'update_footer_content']);
Route::any('admin/save_footer', [AdminController::class, 'save_footer_content']);


//All orders
Route::any('admin/all_orders', [AdminController::class, 'all_orders']);
Route::any('admin/lesson_orders', [AdminController::class, 'lesson_orders']);
Route::any('admin/order_details/{order_id}', [AdminController::class, 'order_details']);


//discount-coupon
Route::any('admin/discount_coupon', [AdminController::class, 'discount_coupon']);
Route::any('admin/discount_coupon/create_coupon', [AdminController::class, 'create_coupon']);
Route::any('admin/discount_coupon/get_coupon', [AdminController::class, 'get_coupon']);
Route::any('admin/discount_coupon/edit_coupon', [AdminController::class, 'edit_coupon']);
Route::any('admin/discount_coupon/status_update', [AdminController::class, 'coupon_status_update']);
Route::any('admin/discount_coupon/delete_coupon/{id}', [AdminController::class, 'delete_coupon']);

//meeting_tools
Route::any('admin/meeting_tools', [AdminController::class, 'meeting_tools']);
Route::any('admin/meeting_tools/get_tools', [AdminController::class, 'get_tools']);
Route::any('admin/meeting_tools/edit_tools', [AdminController::class, 'edit_tools']);

//commission settings
Route::any('admin/commission_settings', [AdminController::class, 'commission_setting']);
Route::any('admin/commission_settings/get_commission', [AdminController::class, 'get_commission']);
Route::any('admin/commission_settings/edit_commission', [AdminController::class, 'edit_commission']);


});

Route::get('/admin', [AdminController::class, 'login']);
Route::post('/check_login', [AdminController::class, 'check_login']);

Route::get('/forget-password', [AdminController::class, 'showForgetPasswordForm']);
Route::post('/reset-data', [AdminController::class, 'submitForgetPasswordForm']);
Route::get('/forget-pass-confi', [AdminController::class, 'forgetpassconfirm']);
Route::get('/forgetpassotp', [AdminController::class, 'forgetpassotp']);
Route::post('/forgetpassotpsubmit', [AdminController::class, 'forgetpassotpsubmit']);
Route::get('/new-password', [AdminController::class, 'newpassword']);
Route::post('/new-password2', [AdminController::class, 'newpassword2']);
Route::get('/reset-password-success', [AdminController::class, 'resetpasswordsuccess']);






