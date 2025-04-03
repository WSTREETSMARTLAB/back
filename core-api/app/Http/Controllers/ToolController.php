<?php

namespace App\Http\Controllers;

use App\Http\Processes\Tool\ResolveUserToolProcess;
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
}
