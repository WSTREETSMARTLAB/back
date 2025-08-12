<?php

namespace App\Http\Controllers;

use App\Enums\ResponseMessage;
use App\Http\Processes\Tool\AuthorizeToolProcess;
use App\Http\Processes\Tool\GetMyToolsProcess;
use App\Http\Processes\Tool\GetToolPreferencesProcess;
use App\Http\Processes\Tool\GetToolSettingsProcess;
use App\Http\Processes\Tool\RegisterToolProcess;
use App\Http\Processes\Tool\ResolveUserToolProcess;
use App\Http\Processes\Tool\SetToolSettingsProcess;
use App\Http\Requests\Tool\AuthorizeToolRequest;
use App\Http\Requests\Tool\MyToolsRequest;
use App\Http\Requests\Tool\RegisterToolRequest;
use App\Http\Requests\Tool\ToolSettingsRequest;
use App\Http\Responses\HttpResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ToolController extends Controller
{
    public function myTools(GetMyToolsProcess $process): JsonResponse
    {
        $response = $process->handle(auth()->id());

        return response()->json([
            'data' => $response, // use resource class
        ], Response::HTTP_OK);
    }

    public function registerTool(RegisterToolRequest $request, RegisterToolProcess $process): HttpResponse
    {
        $requestData = $request->validated();
        $userId = auth()->user()->id;

        $process->handle($userId, $requestData);

        return new HttpResponse(
            [],
            ResponseMessage::REGISTER_SUCCESS->value
        );
    }

    public function authorizeTool(AuthorizeToolRequest $request, AuthorizeToolProcess $process): HttpResponse
    {
        $requestData = $request->validated();

        $response = $process->handle($requestData);

        return new HttpResponse(
            [
                'token' => $response
            ],
            ResponseMessage::AUTH_SUCCESS->value
        );
    }

    public function getPreferences(int $id, GetToolPreferencesProcess $process): JsonResponse
    {
        $userId = auth()->user()->id;

        $response = $process->handle($userId, $id);

        return response()->json([
            'data' => [
                'preferences' => $response // use resource class
            ]
        ], Response::HTTP_OK);
    }

    public function getSettings(int $id, GetToolSettingsProcess $process): JsonResponse
    {
        $data = $process->handle($id, auth()->id());

        return response()->json([
            'data' => [
                'settings' => $data->toArray() // use resource class
            ]
        ], Response::HTTP_OK);
    }

    public function setSettings(int $id, ToolSettingsRequest $request, SetToolSettingsProcess $process): HttpResponse
    {
        $requestData = $request->validated();

        $data = $process->handle($id, auth()->id(), $requestData);

        return new HttpResponse(
            [
                'settings' => $data->toArray()
            ],
            ResponseMessage::UPDATE_SUCCESS->value
        );
    }
}
