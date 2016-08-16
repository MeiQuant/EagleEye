<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Rule;
use App\Exceptions\ProgramException;
use App\Platform;
use DB;
use App\BasePlatform;



class PlatformController extends Controller
{

    public function index()
    {
        return BasePlatform::paginate();
    }


    public function getPlatformDetail(Request $request)
    {
        $id = (int)$request->input('id');
        return BasePlatform::with('volumeData')->find($id);


    }
}
