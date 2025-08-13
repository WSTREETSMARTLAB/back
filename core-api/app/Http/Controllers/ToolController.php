<?php

namespace App\Http\Controllers;

use App\Domain\Tool\Processes\AuthorizeToolProcess;
use App\Domain\Tool\Processes\GetMyToolsProcess;
use App\Domain\Tool\Processes\GetToolPreferencesProcess;
use App\Domain\Tool\Processes\GetToolSettingsProcess;
use App\Domain\Tool\Processes\RegisterToolProcess;
use App\Domain\Tool\Processes\SetToolSettingsProcess;
use App\Enums\ResponseMessage;
use App\Http\Processes\Tool\ResolveUserToolProcess;
use App\Http\Requests\Tool\AuthorizeToolRequest;
use App\Http\Requests\Tool\MyToolsRequest;
use App\Http\Requests\Tool\RegisterToolRequest;
use App\Http\Requests\Tool\ToolSettingsRequest;
use App\Http\Responses\HttpResponse;

class ToolController extends Controller
{
    public function myTools(GetMyToolsProcess $process): HttpResponse
    {
        $response = $process->handle(auth()->id());

        return new HttpResponse(
            $response->toArray() // TODO use resource class
        );
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

    public function getPreferences(int $id, GetToolPreferencesProcess $process): HttpResponse
    {
        $userId = auth()->user()->id;

        $response = $process->handle($userId, $id);

        return new HttpResponse(
            [
                'preferences' => $response // use resource class
            ]
        );
    }

    public function getSettings(int $id, GetToolSettingsProcess $process): HttpResponse
    {
        $data = $process->handle($id, auth()->id());

        return new HttpResponse(
            [
                'settings' => $data->toArray() // use resource class
            ]
        );
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
