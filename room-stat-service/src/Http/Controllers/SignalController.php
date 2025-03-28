<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Request;

class SignalController
{
    public function receive(Request $request)
    {
        return 'signal ok';
    }
}
