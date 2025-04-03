<?php

namespace App\Http\Controllers;

use App\Http\Processes\User\FetchAuthenticatedUserProcess;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function showMe(FetchAuthenticatedUserProcess $process)
    {
        $data = $process->handle();

        return response()->json([
            'data' => $data->toArray()
        ], Response::HTTP_OK);
    }
}
