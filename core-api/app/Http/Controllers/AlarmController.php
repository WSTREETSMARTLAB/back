<?php

namespace App\Http\Controllers;

use App\Domain\Alarm\Processes\DeleteAlarmsProcess;
use App\Domain\Alarm\Processes\GetAlarmListProcess;
use App\Http\Requests\Tool\DeleteAlarmsRequest;
use App\Http\Responses\HttpResponse;
use App\System\Enums\ResponseMessage;
use Illuminate\Http\Response;

class AlarmController extends Controller
{
    public function list(int $toolId, GetAlarmListProcess $process)
    {
        $userId = auth()->id(); // todo move to role permission logic (user can see alarm list)

        $perPage = request()->query('per_page', 15);

        $data = $process->handle($toolId, $userId, $perPage);

//        return new HttpResponse(
//            $data, use resource class
//        );

        return response()->json([
            'data' => $data
        ], Response::HTTP_OK);
    }

    public function delete(int $toolId, DeleteAlarmsRequest $request, DeleteAlarmsProcess $process)
    {
        $userId = auth()->id(); // todo move to role permission logic (user can delete alarms)

        $requestData = $request->validated();

        $process->handle($toolId, $userId, $requestData['ids']);

        return new HttpResponse(
            [],
            ResponseMessage::DELETE_SUCCESS->value
        );
    }
}
