<?php

use App\Models\Role;
use App\Models\User;
// use app\Http\Middleware\Role;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LabTestController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PartnershipController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\MedicalOfficerController;
use App\Http\Controllers\DrugPrescriptionController;

// Authentication file
require __DIR__.'/api-auth.php';



Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth:sanctum'])->group(function(){
    // Notes route
    Route::apiResource('notes', NoteController::class);
});

Route::get('run', function(){
    return 'running...';
});



// Supper admin
Route::middleware(['auth:sanctum', 'role:super-admin'])->group(function(){

    Route::apiResource('users', UserController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('user-roles', UserRoleController::class);

    Route::apiResource('images', ImageController::class);
    Route::apiResource('user-info', UserInfoController::class);

    Route::apiResource('posts', PostController::class);
    Route::apiResource('comments', CommentController::class);
    Route::apiResource('likes', LikeController::class);
    Route::apiResource('subscribers', SubscriberController::class);

});



// 'admin'
Route::middleware(['auth:sanctum'])->group(function(){
    Route::prefix('admin')->group(function () {
        Route::get('/', function(){
            return 'admin';
        });
        Route::apiResource('likes', LikeController::class);
    });
});


// 'partnerships'
Route::middleware(['auth:sanctum'])->group(function(){
    Route::prefix('partnerships')->group(function () {
        Route::get('/', function(){
            return 'partnerships';
        });
        Route::apiResource('likes', LikeController::class);
    });
});


// 'pharmacies'
Route::middleware(['auth:sanctum'])->group(function(){
    Route::prefix('pharmacies')->group(function () {
        Route::get('/', function(){
            return 'pharmacies';
        });
        Route::apiResource('likes', LikeController::class);
    });
});


// 'hospitals'
Route::middleware(['auth:sanctum'])->group(function(){
    Route::prefix('hospitals')->group(function () {
        Route::get('/', function(){
            return 'hospitals';
        });
        Route::apiResource('likes', LikeController::class);
    });
});


// 'doctors'
Route::middleware(['auth:sanctum'])->group(function(){
    Route::prefix('doctors')->group(function () {
        Route::get('/', function(){
            return 'doctors';
        });
        Route::apiResource('likes', LikeController::class);
    });
});


// 'medical-officers'
Route::middleware(['auth:sanctum'])->group(function(){
    Route::prefix('medical-officers')->group(function () {
        Route::get('/', function(){
            return 'medical-officers';
        });
        Route::apiResource('likes', LikeController::class);
    });
});


// 'patients'
Route::middleware(['auth:sanctum'])->group(function(){

    Route::apiResource('emergencies', EmergencyController::class)
    ->except('destroy');

    Route::apiResource('patients', PatientController::class)
        ->except('destroy');

    Route::apiResource('medical-officers', MedicalOfficerController::class)
    ->except('destroy');

    Route::apiResource('doctors', DoctorController::class)
    ->except('destroy');

    Route::apiResource('hospitals', HospitalController::class)
    ->except('destroy');

    Route::apiResource('pharmacies', PharmacyController::class)
    ->except('destroy');

    Route::apiResource('partnerships', PartnershipController::class)
    ->except('destroy');

    Route::apiResource('treatments', TreatmentController::class)
    ->except('destroy');

    Route::apiResource('appointments', AppointmentController::class)
    ->except('destroy');

    Route::apiResource('drugs', DrugController::class)
    ->except('destroy');

    Route::apiResource('prescriptions', PrescriptionController::class)
    ->except('destroy');

    Route::apiResource('drug-prescriptions', DrugPrescriptionController::class)
    ->except('destroy');

    Route::apiResource('lab-test', LabTestController::class)
    ->except('destroy');

    Route::apiResource('donations', DonationController::class)
    ->except('destroy');

    Route::apiResource('payments', PaymentController::class)
    ->except('destroy');

});



// 'emergencies'



// Guest users
Route::middleware(['guest'])->group(function(){
    Route::apiResource('posts', PostController::class)->only(['index', 'show']);
    Route::apiResource('subscribers', SubscriberController::class)->only(['store']);
});


Route::get('assign', function(){

    $userData = [
        'name' => 'amtech',
        'email' => 'amtech@gmail.com',
        'password' => Hash::make('password'),
    ];

    echo $selectUser = User::where('email', $userData['email'])->first();
    if(!$selectUser){
        echo $user = User::create($userData);
        echo "<br>";
    }


    $roleData = ['super-admin', 'admin', 'editor', 'author', 'viewer', 'user'];
    $RD = [];
    foreach($roleData as $rd){
        $RD[] = Role::create(['role' => $rd]);
    }
    print($RD);
    echo "<br>";

    $rolesHierarchy = [
        'super-admin' => ['super-admin', 'admin', 'editor', 'author', 'viewer', 'user'],
        'admin' => ['admin', 'editor', 'author', 'viewer', 'user'],
        'editor' => ['editor', 'author', 'viewer', 'user'],
        'author' => ['author', 'viewer', 'user'],
        'viewer' => ['viewer', 'user'],
        'user' => ['viewer', 'user'],
    ];

    $user_id = 1;
    echo $find_role = 'super-admin';
    echo "<br>";

        if(!$user_id || !$find_role){ return false; }
        $user = User::find($user_id);
        if(!$user){ return false; }

        if(!count($user->roles)){
            return false;
        }else{
            $roles = [];
            foreach($user->roles as $userRole){
                $roles[] = $userRole->role;
            }
            $all_roles = array_unique($roles);
            print_r($all_roles);

            foreach($all_roles as $all){
                if(in_array($find_role, $rolesHierarchy[$all], true)){
                    return true;
                }
            }
            return false;
        }

    return 'assigned!';
});


Route::prefix('test')->group(function () {

    Route::get('/', function(){
        return 'testing api...';
    });


    Route::apiResource('emergencies', EmergencyController::class)
    ->except('destroy');

    Route::apiResource('patients', PatientController::class)
        ->except('destroy');

    Route::apiResource('medical-officers', MedicalOfficerController::class)
    ->except('destroy');

    Route::apiResource('doctors', DoctorController::class)
    ->except('destroy');

    Route::apiResource('hospitals', HospitalController::class)
    ->except('destroy');

    Route::apiResource('pharmacies', PharmacyController::class)
    ->except('destroy');

    Route::apiResource('partnerships', PartnershipController::class)
    ->except('destroy');

    Route::apiResource('treatments', TreatmentController::class)
    ->except('destroy');

    Route::apiResource('appointments', AppointmentController::class)
    ->except('destroy');

    Route::apiResource('drugs', DrugController::class)
    ->except('destroy');

    Route::apiResource('prescriptions', PrescriptionController::class)
    ->except('destroy');

    Route::apiResource('drug-prescriptions', DrugPrescriptionController::class)
    ->except('destroy');

    Route::apiResource('lab-test', LabTestController::class)
    ->except('destroy');

    Route::apiResource('donations', DonationController::class)
    ->except('destroy');

    Route::apiResource('payments', PaymentController::class)
    ->except('destroy');
});




// Migrate users roles after database migration
Route::get('migrate-roles', function (){

    $result['start'] = now();

    $allRoles = ['super-admin', 'admin', 'partnerships', 'pharmacies', 'hospitals', 'doctors', 'medical-officers', 'patients', 'emergencies'];
    foreach($allRoles as $role){

        $dbRole = Role::where('role', $role)->get();
        if(count($dbRole)){
            continue;
        }

        Role::create(['role' => $role]);
    }

    $result['all_roles'] = $allRoles;
    $result['roles'] = Role::all();
    $result['end'] = now();
    return $result;
});
