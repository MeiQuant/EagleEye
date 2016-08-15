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
       return Platform::with('platform')->paginate();
    }


    public function getPlatformDetail(Request $request)
    {
        $id = (int)$request->input('id');
        $data = DB::table('platform_data')
            ->join('platform', 'platform_data.platform_id', '=', 'platform.id')
            ->select('platform_data.*', 'platform.name as pname')
            ->where('platform.id', '=', $id)
            ->get();
        print_r($data);


    }
}
