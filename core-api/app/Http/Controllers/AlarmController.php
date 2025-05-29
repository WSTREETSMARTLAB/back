<?php

namespace App\Http\Controllers;

use App\Http\Processes\Alarm\DeleteAlarmsProcess;
use App\Http\Processes\Alarm\GetAlarmListProcess;
use App\Http\Requests\Tool\DeleteAlarmsRequest;
use Illuminate\Http\Response;

class AlarmController extends Controller
{
    public function list(int $toolId, GetAlarmListProcess $process)
    {
        $userId = auth()->id();

        $perPage = request()->query('per_page', 15);

        $data = $process->handle($toolId, $userId, $perPage);

        return response()->json([
            'data' => $data
        ], Response::HTTP_OK);
    }

    public function delete(int $toolId, DeleteAlarmsRequest $request, DeleteAlarmsProcess $process)
    {
        return "ok";
    }
}
