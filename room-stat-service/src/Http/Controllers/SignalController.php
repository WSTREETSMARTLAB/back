<?php

namespace App\Http\Controllers;

use App\Http\Processes\ReceiveSignalProcess;
use Symfony\Component\HttpFoundation\Request;

class SignalController
{
    public function receive(Request $request, ReceiveSignalProcess $process)
    {


        return 'signal ok';
    }
}
