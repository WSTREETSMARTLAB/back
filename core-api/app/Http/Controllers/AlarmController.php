<?php

namespace App\Http\Controllers;

use App\Http\Processes\Alarm\GetAlarmListProcess;
use Illuminate\Http\Response;

class AlarmController extends Controller
{
    public function list(int $toolId, GetAlarmListProcess $process)
    {
        $userId = auth()->id();

        $data = $process->handle($toolId, $userId);

        return response()->json([
            'data' => $data
        ], Response::HTTP_OK);
    }
}
