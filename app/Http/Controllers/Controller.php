<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // success response
    public function success($data = [])
    {
        return response()->json(['success' => true, 'data' => $data]);
    }

    // error response
    public function error($message = '', $data = [])
    {
        return response()->json(['success' => false, 'message' => $message, 'data' => $data]);
    }
}
