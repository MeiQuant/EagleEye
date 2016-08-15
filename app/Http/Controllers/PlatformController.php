<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Rule;
use App\Exceptions\ProgramException;
use App\Platform;

class PlatformController extends Controller
{

    public function index()
    {
       return Platform::with('platform')->paginate();
    }


    public function getPlatformDetail(Request $request)
    {
        $id = (int)$request->input('id');

    }
}
