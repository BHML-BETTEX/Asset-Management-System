<?php

use App\Http\Controllers\BasicinfoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DesktopController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Models\Desktop;
use App\Models\Employee;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/master', [HomeController::class, 'master'])->name('master');


//User
Route::get('/users', [UserController::class, 'users'])->name('users');
Route::get('/users/create', [UserController::class, 'create'])->name('create');
Route::post('/users/store', [UserController::class, 'users_store'])->name('users_store');
Route::get('/users/delete/{user_id}', [UserController::class, 'users_delete'])->name('users.delete');
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::post('/name/change', [UserController::class, 'name_change'])->name('name.change');
Route::post('/password/change', [UserController::class, 'password_change'])->name('password.change');

//Role
Route::get('/roles', [RoleController::class, 'roles'])->name('roles.index');
Route::get('/roles/create', [RoleController::class, 'roles_create'])->name('roles.create');
Route::post('/roles/store', [RoleController::class, 'roles_store'])->name('roles_store');
Route::get('/roles/edit/{role_id}', [RoleController::class, 'edit'])->name('roles_edit');
Route::post('/roles/update', [RoleController::class, 'roles_update'])->name('roles_update');
Route::get('/roles/destroy/{role_id}', [RoleController::class, 'destroy'])->name('destroy');



//Basic Info
Route::get('/basic_info', [BasicinfoController::class, 'basic_info'])->name('basicinfo');

//Department
Route::get('/department', [CategoryController::class, 'department'])->name('department');
Route::post('/department/store', [CategoryController::class, 'department_store'])->name('department.store');
Route::get('/department/delete/{department_id}', [CategoryController::class, 'department_delete'])->name('department.delete');
Route::post('/department/update', [CategoryController::class, 'department_update'])->name('department.update');
Route::get('/department/edit/{department_id}', [CategoryController::class, 'department_edit'])->name('department_edit');

//designation
Route::get('/designation', [CategoryController::class, 'designation'])->name('designation');
Route::post('/designation/store', [CategoryController::class, 'designation_store'])->name('designation.store');
Route::get('/designation/delete/{designation_id}', [CategoryController::class, 'designation_delete'])->name('designation.delete');
Route::get('/designation/edit/{designation_id}', [CategoryController::class, 'designation_edit'])->name('designation.edit');
Route::post('/designation/update', [CategoryController::class, 'designation_update'])->name('designation.update');

//product
Route::get('/producttype', [CategoryController::class, 'product_type'])->name('producttype_list');
Route::post('/producttype/store', [CategoryController::class, 'product_type_store'])->name('product.store');
Route::get('/producttype/delete/{ProductType_id}', [CategoryController::class, 'product_type_delete'])->name('product.delete');

//supplier
Route::get('/supplier', [CategoryController::class, 'supplier'])->name('supplier');
Route::post('/supplier/store', [CategoryController::class, 'supplier_store'])->name('supplier.store');
Route::get('/supplier/delete/{supplier_id}', [CategoryController::class, 'supplier_delete'])->name('supplier.delete');

//brand
Route::get('/brand', [CategoryController::class, 'brand'])->name('brand');
Route::post('/brand/store', [CategoryController::class, 'brand_store'])->name('brand.store');
Route::get('/brand/delete{brand_id}', [CategoryController::class, 'brand_delete'])->name('brand.delete');

//status
Route::get('/status', [CategoryController::class, 'status'])->name('status');
Route::post('/status/store', [CategoryController::class, 'status_store'])->name('status.store');
Route::get('/status/delete{status_id}', [CategoryController::class, 'status_delete'])->name('status.delete');

//Size Mesurment
Route::get('/size_mesurment', [CategoryController::class, 'size_mesurment'])->name('size');
Route::post('/size_mesurment/store', [CategoryController::class, 'size_mesurment_store'])->name('size.store');
Route::get('/size_mesurment/delete{sizemesurment_id}', [CategoryController::class, 'size_mesurment_delete'])->name('size.delete');

//color
Route::get('/color', [CategoryController::class, 'color'])->name('color');
Route::post('/color/store', [CategoryController::class, 'color_store'])->name('color.store');
Route::get('/color/delete/{color_id}', [CategoryController::class, 'color_delete'])->name('color.delete');

//Company
Route::get('/company', [CategoryController::class, 'company_list'])->name('company.list');
Route::post('/company/store', [CategoryController::class, 'company_store'])->name('company.store');  
Route::get('/company/delete/{company_id}', [CategoryController::class, 'company_delete'])->name('company.delete');     

//store
Route::get('/store', [StoreController::class, 'store'])->name('store');
Route::post('/store/store', [StoreController::class, 'store_store'])->name('store.store');
Route::get('/store/delete/{stores_id}', [StoreController::class, 'store_delete'])->name('store.delete');
Route::get('/store/edit/{stores_id}', [StoreController::class, 'store_edit'])->name('store.edit');
Route::post('/store/update', [StoreController::class, 'store_update'])->name('store.update');
Route::get('/store/view/{stores_id}', [StoreController::class, 'store_view'])->name('store.view');
Route::get('/store/issue', [StoreController::class, 'issue'])->name('issue');
Route::post('/store/issue/store', [StoreController::class, 'issue_store'])->name('issue.store');
Route::get('/store/search_by_id/{store_id}', [StoreController::class, 'search_by_id'])->name('search.product');
Route::get('/store/return', [StoreController::class, 'return'])->name('return');
Route::get('/store/return_search_by_id/{store_id}', [StoreController::class, 'return_search_by_id'])->name('return.search.product');
Route::post('/store/return/update', [StoreController::class, 'return_update'])->name('return_update');
Route::get('/store/status/{stores_id}', [StoreController::class, 'store_status'])->name('store.status');
Route::get('/store/invoice/{stores_id}', [StoreController::class, 'invoice'])->name('invoice');
Route::get('/store/search', [StoreController::class, 'store_search'])->name('store_search');
Route::get('/history', [StoreController::class, 'history'])->name('history');



//password
Route::get('/computer_pass', [PasswordController::class, 'computer_pass'])->name('computer_pass');
Route::post('/computer_pass/store', [PasswordController::class, 'computer_pass_store'])->name('computer_pass_store');
Route::get('/computer_pass/delete/{id}', [PasswordController::class, 'computer_pass_delete'])->name('computer_pass_delete');
Route::get('/mail_pass', [PasswordController::class, 'mail_pass'])->name('mail_pass');
Route::post('/mail_pass/store', [PasswordController::class, 'mail_pass_store'])->name('mail_pass_store');
Route::get('/camera_pass', [PasswordController::class, 'camera_pass'])->name('camera_pass');
Route::post('/camera_pass/store', [PasswordController::class, 'camera_pass_store'])->name('camera_pass_store');
Route::get('/camera_pass/delete/{camera_id}', [PasswordController::class, 'camera_pass_delete'])->name('camera_pass_delete');
Route::get('/internet_pass', [PasswordController::class, 'internet_pass'])->name('internet_pass');
Route::post('/internet_pass/store', [PasswordController::class, 'internet_pass_store'])->name('internet_pass_store');
Route::get('/internet_pass/delete/{internet_id}', [PasswordController::class, 'internet_pass_delete'])->name('internet_pass_delete');
Route::get('/ding_pass', [PasswordController::class, 'ding_pass'])->name('ding_pass');
Route::post('/ding_pass/store', [PasswordController::class, 'ding_pass_store'])->name('ding_pass_store');
Route::get('/ding_pass/delete/{ding_id}', [PasswordController::class, 'ding_pass_delete'])->name('ding_pass_delete');
Route::get('/others_pass', [PasswordController::class, 'others_pass'])->name('others_pass');

//employee Managment
Route::get('/employee', [EmployeeController::class, 'employee'])->name('employee');
Route::post('/employee/store', [EmployeeController::class, 'employee_store'])->name('employee.store');
Route::get('/employee/delete/{employee_id}', [EmployeeController::class, 'employee_delete'])->name('employee.delete');
Route::get('/employee/edit/{employee_id}', [EmployeeController::class, 'employee_edit'])->name('employee_edit');
Route::post('/employee/update', [EmployeeController::class, 'employee_update'])->name('employee_update');
Route::get('/employee/search_by_id/{employee_id}', [EmployeeController::class, 'search_by_id'])->name('search.empl');
Route::get('/search', [EmployeeController::class, 'search'])->name('search');


//desktop
Route::get('/desktop', [DesktopController::class, 'desktop'])->name('desktop');
Route::post('/desktop/store/', [DesktopController::class, 'desktop_store'])->name('desktop.store');
Route::get('/desktop/view/{desktop_id}', [DesktopController::class, 'desktop_view'])->name('desktop.view');






