<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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


Route::get('/health-check', function (Request $request) {
    return response()->json([
        'message' => 'V1 Server is ready to use'
    ], 200);
});


Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/verify', [AuthController::class, 'verify']);
Route::get('/auth/resend-email-verification', [AuthController::class, 'resend']);

Route::post('/tools/auth', [ToolController::class, 'authorizeTool']);

Route::middleware('auth:sanctum')->group(function () { // todo set user role for routes
    Route::get('/auth/logout', [AuthController::class, 'logout']);

    // Users
    Route::get('/users/me', [UserController::class, 'showMe']);

    // Tools
    Route::get('/tools/my', [ToolController::class, 'myTools']);
    Route::post('/tools/register', [ToolController::class, 'registerTool']);
    Route::get('/tools/{id}/preferences', [ToolController::class, 'getPreferences']);
    Route::get('/tools/{id}/settings', [ToolController::class, 'getSettings']);
    Route::put('/tools/{id}/settings', [ToolController::class, 'setSettings']);
});
