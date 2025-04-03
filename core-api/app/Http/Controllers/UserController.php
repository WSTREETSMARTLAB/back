<?php

namespace App\Http\Controllers;

use App\Http\Processes\User\FetchAuthenticatedUserProcess;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function showMe(FetchAuthenticatedUserProcess $process)
    {
        $response = $process->handle(auth()->id());

        return response()->json([
            'data' => $response->toArray()
        ], Response::HTTP_OK);
    }
}
