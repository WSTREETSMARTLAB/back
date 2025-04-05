<?php

namespace App\Http\Controllers;

use App\Http\Processes\Tool\RegisterToolProcess;
use App\Http\Processes\Tool\ResolveUserToolProcess;
use App\Http\Requests\Tool\RegisterToolRequest;
use App\Http\Requests\Tool\ShowToolsRequest;
use Illuminate\Http\Response;

class ToolController extends Controller
{
    public function showTools(ShowToolsRequest $request, ResolveUserToolProcess $process)
    {
        $requestData = $request->validated();

        $response = $process->handle(auth()->id(), $requestData['type']);

        return response()->json([
            'data' => $response,
        ], Response::HTTP_OK);
    }

    public function registerTool(RegisterToolRequest $request, RegisterToolProcess $process)
    {
        $requestData = $request->validated();

        $response = $process->handle(auth()->id(), $requestData);

        return response()->json([
            'data' => $response->toArray(),
        ], Response::HTTP_OK);
    }
}
