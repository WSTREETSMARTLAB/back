<?php

namespace App\Http\Controllers;

use App\Http\Processes\Tool\AuthorizeToolProcess;
use App\Http\Processes\Tool\GetToolPreferencesProcess;
use App\Http\Processes\Tool\GetToolSettingsProcess;
use App\Http\Processes\Tool\GetMyToolsProcess;
use App\Http\Processes\Tool\RegisterToolProcess;
use App\Http\Processes\Tool\ResolveUserToolProcess;
use App\Http\Processes\Tool\SetToolSettingsProcess;
use App\Http\Requests\AuthorizeToolRequest;
use App\Http\Requests\Tool\RegisterToolRequest;
use App\Http\Requests\Tool\MyToolsRequest;
use App\Http\Requests\Tool\ToolSettingsRequest;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ToolController extends Controller
{
    public function myTools(GetMyToolsProcess $process): JsonResponse
    {
        $response = $process->handle(auth()->id());

        return response()->json([
            'data' => $response,
        ], Response::HTTP_OK);
    }

    public function registerTool(RegisterToolRequest $request, RegisterToolProcess $process): JsonResponse
    {
        $requestData = $request->validated();
        $userId = auth()->user()->id;

        $process->handle($userId, $requestData);

        return response()->json([], Response::HTTP_OK);
    }

    public function authorizeTool(AuthorizeToolRequest $request, AuthorizeToolProcess $process): JsonResponse
    {
        $requestData = $request->validated();

        $response = $process->handle($requestData);

        return response()->json([
            'data' => [
                'token' => $response
            ]
        ], Response::HTTP_OK);
    }

    public function getPreferences(int $id, GetToolPreferencesProcess $process): JsonResponse
    {
        $userId = auth()->user()->id;

        $response = $process->handle($userId, $id);

        return response()->json([
            'data' => [
                'preferences' => $response
            ]
        ], Response::HTTP_OK);
    }

    public function getSettings(int $id, GetToolSettingsProcess $process): JsonResponse
    {
        $data = $process->handle($id, auth()->id());

        return response()->json([
            'data' => [
                'settings' => $data->toArray()
            ]
        ], Response::HTTP_OK);
    }

    public function setSettings(int $id, ToolSettingsRequest $request, SetToolSettingsProcess $process): JsonResponse
    {
        $requestData = $request->validated();

        $data = $process->handle($id, auth()->id(), $requestData);

        return response()->json([
            'data' => [
                'settings' => $data->toArray()
            ]
        ], Response::HTTP_OK);
    }
}
